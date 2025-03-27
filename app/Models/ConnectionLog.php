<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Services\ConnectionManager;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ConnectionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'context_type',
        'context_id',
        'status',
        'connected_at',
        'disconnected_at',
        'reconnected_at',
        'metadata'
    ];

    protected $casts = [
        'connected_at' => 'datetime',
        'disconnected_at' => 'datetime',
        'reconnected_at' => 'datetime',
        'metadata' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 最新の接続ログを取得する
     *
     * @param int $userId
     * @param string $contextType
     * @param int $contextId
     * @return ConnectionLog|null
     */
    public static function getLatestLog($userId, $contextType, $contextId)
    {
        return self::where('user_id', $userId)
            ->where('context_type', $contextType)
            ->where('context_id', $contextId)
            ->latest()
            ->first();
    }

    /**
     * 接続状態が「接続中」かどうかを確認する
     *
     * @return bool
     */
    public function isConnected()
    {
        return $this->status === ConnectionManager::STATUS_CONNECTED;
    }

    /**
     * 接続状態が「一時的に切断」かどうかを確認する
     *
     * @return bool
     */
    public function isTemporarilyDisconnected()
    {
        return $this->status === ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED;
    }

    /**
     * 特定のコンテキストで現在接続中のユーザーのIDを取得する
     *
     * @param string $contextType
     * @param int $contextId
     * @return array
     */
    public static function getConnectedUserIds($contextType, $contextId)
    {
        return self::select('user_id')
            ->where('context_type', $contextType)
            ->where('context_id', $contextId)
            ->where('status', ConnectionManager::STATUS_CONNECTED)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('connection_logs as newer')
                    ->whereRaw('connection_logs.user_id = newer.user_id')
                    ->whereRaw('connection_logs.context_type = newer.context_type')
                    ->whereRaw('connection_logs.context_id = newer.context_id')
                    ->whereRaw('connection_logs.id < newer.id');
            })
            ->pluck('user_id')
            ->toArray();
    }

    /**
     * ユーザーの接続継続時間を計算（秒単位）
     *
     * @return int|null
     */
    public function getConnectionDuration()
    {
        // 接続中の場合は現在時刻までの時間を計算
        if ($this->status === ConnectionManager::STATUS_CONNECTED) {
            return $this->connected_at ? now()->diffInSeconds($this->connected_at) : null;
        }

        // 切断された場合は接続から切断までの時間を計算
        if ($this->disconnected_at && $this->connected_at) {
            return $this->disconnected_at->diffInSeconds($this->connected_at);
        }

        return null;
    }

    /**
     * 特定期間内の接続エラー頻度を分析
     *
     * @param int $userId
     * @param int $hours 分析する時間枠（時間単位）
     * @return array 分析結果
     */
    public static function analyzeConnectionIssues($userId, $hours = 24)
    {
        $startTime = now()->subHours($hours);

        $disconnections = self::where('user_id', $userId)
            ->where('created_at', '>=', $startTime)
            ->whereIn('status', [
                ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED,
                ConnectionManager::STATUS_DISCONNECTED
            ])
            ->count();

        $reconnections = self::where('user_id', $userId)
            ->where('created_at', '>=', $startTime)
            ->whereNotNull('reconnected_at')
            ->count();

        return [
            'total_disconnections' => $disconnections,
            'successful_reconnections' => $reconnections,
            'failure_rate' => $disconnections > 0 ?
                (($disconnections - $reconnections) / $disconnections) * 100 : 0
        ];
    }

    /**
     * 特定のコンテキストに対するユーザーの初回接続を記録する
     *
     * @param int $userId
     * @param string $contextType
     * @param int $contextId
     * @return ConnectionLog
     */
    public static function recordInitialConnection($userId, $contextType, $contextId)
    {
        // すでにログが存在するか確認
        $existingLog = self::getLatestLog($userId, $contextType, $contextId);
        if ($existingLog && $existingLog->isConnected()) {
            return $existingLog;
        }

        // クライアント情報の記録
        $clientInfo = request()->header('User-Agent');
        $ipAddress = request()->ip();

        // 初回接続ログの作成
        return self::create([
            'user_id' => $userId,
            'context_type' => $contextType,
            'context_id' => $contextId,
            'status' => ConnectionManager::STATUS_CONNECTED,
            'connected_at' => now(),
            'metadata' => [
                'client_info' => $clientInfo,
                'ip_address' => $ipAddress,
                'connection_type' => 'initial'
            ]
        ]);
    }

    /**
     * 指定期間で絞り込むスコープ
     *
     * @param Builder $query
     * @param Carbon $start
     * @param Carbon $end
     * @return Builder
     */
    public function scopePeriod(Builder $query, Carbon $start, Carbon $end): Builder
    {
        // created_at が期間内、または disconnected_at が期間内、または reconnected_at が期間内
        // または status が connected/temporarily_disconnected で connected_at が期間開始前
        return $query->where(function ($q) use ($start, $end) {
            $q->whereBetween('created_at', [$start, $end])
                ->orWhereBetween('disconnected_at', [$start, $end])
                ->orWhereBetween('reconnected_at', [$start, $end])
                ->orWhere(function ($subQ) use ($start) {
                    $subQ->whereIn('status', [ConnectionManager::STATUS_CONNECTED, ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED])
                        ->where('connected_at', '<', $start);
                });
        });
    }

    /**
     * リアルタイム接続状況を取得
     *
     * @return array{total_connected: int, room_connected: int, debate_connected: int, temporarily_disconnected: int}
     */
    public static function getRealtimeConnectionStats(): array
    {
        // 最新のログのみを対象にするサブクエリ
        $latestLogsSubquery = self::select(DB::raw('MAX(id) as id'))
            ->groupBy('user_id', 'context_type', 'context_id');

        $stats = self::select(
            'status',
            'context_type',
            DB::raw('COUNT(DISTINCT user_id) as user_count') // ユーザー単位でカウント
        )
            ->joinSub($latestLogsSubquery, 'latest_logs', function ($join) {
                $join->on('connection_logs.id', '=', 'latest_logs.id');
            })
            ->whereIn('status', [
                ConnectionManager::STATUS_CONNECTED,
                ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED
            ])
            ->groupBy('status', 'context_type')
            ->get();

        $result = [
            'total_connected' => 0,
            'room_connected' => 0,
            'debate_connected' => 0,
            'temporarily_disconnected' => 0,
        ];

        foreach ($stats as $stat) {
            if ($stat->status === ConnectionManager::STATUS_CONNECTED) {
                $result['total_connected'] += $stat->user_count;
                if ($stat->context_type === 'room') {
                    $result['room_connected'] += $stat->user_count;
                } elseif ($stat->context_type === 'debate') {
                    $result['debate_connected'] += $stat->user_count;
                }
            } elseif ($stat->status === ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED) {
                $result['temporarily_disconnected'] += $stat->user_count;
            }
        }

        return $result;
    }

    /**
     * 指定期間内に頻繁な切断が記録されたユーザーを取得
     *
     * @param Carbon $start
     * @param Carbon $end
     * @return \Illuminate\Support\Collection
     */
    public static function getFrequentDisconnectionUsers(Carbon $start, Carbon $end)
    {
        // metadata->frequent_disconnections が true のログを検索
        // DBによってはJSONカラムのクエリ方法が異なる場合がある
        return self::select('user_id', DB::raw('COUNT(*) as frequent_count'))
            ->where('metadata->frequent_disconnections', true) // JSONパス式 (MySQL 5.7+, PostgreSQL)
            // ->whereJsonContains('metadata', ['frequent_disconnections' => true]) // Laravel 9+
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('user_id')
            ->orderByDesc('frequent_count')
            ->with('user:id,name') // ユーザー情報も取得
            ->get();
    }

    /**
     * 指定期間内の切断傾向を分析
     *
     * @param Carbon $start
     * @param Carbon $end
     * @return array
     */
    public static function analyzeDisconnectionTrends(Carbon $start, Carbon $end): array
    {
        $logs = self::whereIn('status', [
            ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED,
            ConnectionManager::STATUS_DISCONNECTED
        ])
            ->whereBetween('created_at', [$start, $end])
            ->select('created_at', 'metadata')
            ->get();

        $trends = [
            'by_hour' => array_fill(0, 24, 0),
            'by_client' => [],
            // 'by_ip_region' => [], // IPジオロケーション実装時に追加
            'by_disconnect_type' => [],
        ];

        foreach ($logs as $log) {
            // 時間帯別
            $hour = $log->created_at->hour;
            $trends['by_hour'][$hour]++;

            // クライアント別 (User-Agentを簡易的に分類)
            $userAgent = $log->metadata['client_info'] ?? 'Unknown';
            $client = self::parseUserAgent($userAgent); // User-Agent解析ヘルパー関数
            $trends['by_client'][$client] = ($trends['by_client'][$client] ?? 0) + 1;

            // 切断タイプ別
            $disconnectType = $log->metadata['disconnect_type'] ?? 'unknown';
            $trends['by_disconnect_type'][$disconnectType] = ($trends['by_disconnect_type'][$disconnectType] ?? 0) + 1;

            // IP地域別 (別途実装)
        }

        // 結果を整形 (例: 上位N件に絞るなど)
        arsort($trends['by_client']);
        arsort($trends['by_disconnect_type']);

        return $trends;
    }

    /**
     * User-Agent文字列を簡易的に解析するヘルパー関数
     * (より正確な解析にはライブラリ(jenssegers/agentなど)の利用を推奨)
     *
     * @param string $userAgent
     * @return string
     */
    private static function parseUserAgent(string $userAgent): string
    {
        if (preg_match('/(Chrome|Firefox|Safari|Edge|MSIE|Trident)/i', $userAgent, $matches)) {
            $browser = $matches[1] == 'Trident' ? 'IE' : $matches[1];
            if (preg_match('/(Windows|Macintosh|Linux|Android|iPhone|iPad)/i', $userAgent, $osMatches)) {
                return $browser . ' on ' . $osMatches[1];
            }
            return $browser;
        }
        return 'Unknown';
    }

    /**
     * 特定ユーザーの接続セッション履歴を取得
     *
     * @param int $userId
     * @param Carbon $start
     * @param Carbon $end
     * @return array
     */
    public static function getUserConnectionSessions(int $userId, Carbon $start, Carbon $end): array
    {
        $logs = self::where('user_id', $userId)
            ->period($start, $end) // 作成したスコープを利用
            ->orderBy('created_at')
            ->get();

        $sessions = [];
        $currentSession = null;

        foreach ($logs as $log) {
            if ($log->status === ConnectionManager::STATUS_CONNECTED) {
                // 新しいセッションの開始 or 再接続
                if ($currentSession === null) {
                    $currentSession = [
                        'start' => $log->connected_at ?? $log->created_at, // connected_at がなければ created_at
                        'end' => null,
                        'status' => 'connected',
                        'logs' => [],
                        'disconnection_duration' => $log->metadata['disconnection_duration'] ?? null,
                        'reconnected_at' => $log->reconnected_at,
                    ];
                } elseif ($currentSession['status'] === 'disconnected') {
                    // 確定切断後の再接続は新しいセッションとして扱う
                    $sessions[] = $currentSession;
                    $currentSession = [
                        'start' => $log->connected_at ?? $log->created_at,
                        'end' => null,
                        'status' => 'connected',
                        'logs' => [],
                        'disconnection_duration' => $log->metadata['disconnection_duration'] ?? null,
                        'reconnected_at' => $log->reconnected_at,
                    ];
                } else {
                    // 一時切断からの復帰
                    $currentSession['status'] = 'connected';
                    $currentSession['reconnected_at'] = $log->reconnected_at;
                    $currentSession['disconnection_duration'] = $log->metadata['disconnection_duration'] ?? null;
                }
                $currentSession['logs'][] = $log;
            } elseif ($log->status === ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED) {
                if ($currentSession !== null && $currentSession['status'] === 'connected') {
                    $currentSession['status'] = 'temporarily_disconnected';
                    $currentSession['disconnected_at'] = $log->disconnected_at; // 一時切断時刻
                }
                // セッションがない場合や既に切断状態の場合はログだけ追加（エラーケース）
                if ($currentSession === null) {
                    // 孤立した一時切断ログ（前の接続が見えない場合）
                    $currentSession = [
                        'start' => null, // 開始不明
                        'end' => null,
                        'status' => 'temporarily_disconnected',
                        'disconnected_at' => $log->disconnected_at,
                        'logs' => [],
                    ];
                }
                $currentSession['logs'][] = $log;
            } elseif ($log->status === ConnectionManager::STATUS_DISCONNECTED) {
                if ($currentSession !== null) {
                    $currentSession['status'] = 'disconnected';
                    // finalized_at があればそれを終了時刻とするのがより正確
                    $currentSession['end'] = $log->metadata['finalized_at'] ? Carbon::parse($log->metadata['finalized_at']) : $log->created_at;
                    $currentSession['disconnected_at'] = $currentSession['disconnected_at'] ?? $log->disconnected_at ?? $log->created_at; // 切断時刻
                    $currentSession['logs'][] = $log;
                    $sessions[] = $currentSession;
                    $currentSession = null; // セッション終了
                } else {
                    // 孤立した切断確定ログ
                    $sessions[] = [
                        'start' => null,
                        'end' => $log->metadata['finalized_at'] ? Carbon::parse($log->metadata['finalized_at']) : $log->created_at,
                        'status' => 'disconnected',
                        'disconnected_at' => $log->disconnected_at ?? $log->created_at,
                        'logs' => [$log],
                    ];
                }
            }
        }

        // ループ終了時にまだ接続中のセッションがあれば追加
        if ($currentSession !== null) {
            $sessions[] = $currentSession;
        }

        // セッションの継続時間などを計算
        foreach ($sessions as &$session) {
            if ($session['start'] && $session['end']) {
                $session['duration'] = $session['end']->diffInSeconds($session['start']);
            } elseif ($session['start'] && $session['status'] === 'connected') {
                $session['duration'] = now()->diffInSeconds($session['start']);
            } else {
                $session['duration'] = null;
            }
        }

        return $sessions;
    }
}

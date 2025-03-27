<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConnectionLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\ConnectionManager;

class ConnectionAnalyticsController extends Controller
{
    /**
     * 接続分析ダッシュボードを表示
     */
    public function index(Request $request)
    {
        // 期間指定の取得 (デフォルト: 過去7日間)
        $period = $request->input('period', '7d');
        [$startDate, $endDate] = $this->parsePeriod($period, $request);

        // リアルタイム接続状況
        $realtimeStats = ConnectionLog::getRealtimeConnectionStats();

        // 異常検知: 頻繁な切断ユーザー
        $frequentDisconnectionUsers = ConnectionLog::getFrequentDisconnectionUsers($startDate, $endDate);

        // 異常検知: 低再接続率ユーザー (例: 閾値50%)
        // $lowReconnectionRateUsers = ConnectionLog::getLowReconnectionRateUsers($startDate, $endDate, 50); // 必要なら実装

        // 切断傾向分析
        $disconnectionTrends = ConnectionLog::analyzeDisconnectionTrends($startDate, $endDate);

        // --- 既存の集計も期間指定に対応 ---
        // 直近24時間の切断統計 (これは固定でも良いかも)
        $disconnectionStats24h = ConnectionLog::select(
            DB::raw('DATE_FORMAT(created_at, "%H:00") as hour'),
            DB::raw('COUNT(*) as count')
        )
            ->whereIn('status', [ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED, ConnectionManager::STATUS_DISCONNECTED]) // 切断イベントをカウント
            ->where('created_at', '>=', now()->subDay())
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        // ユーザー別の切断頻度ランキング (指定期間)
        $userDisconnectionRanking = ConnectionLog::select(
            'user_id',
            DB::raw('COUNT(*) as disconnection_count')
        )
            ->whereIn('status', [ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED, ConnectionManager::STATUS_DISCONNECTED])
            ->whereBetween('created_at', [$startDate, $endDate]) // 期間指定
            ->groupBy('user_id')
            ->orderByDesc('disconnection_count')
            ->limit(10)
            ->with('user:id,name')
            ->get();

        // 平均再接続率 (指定期間) - 修正
        $totalTemporaryDisconnections = ConnectionLog::where('status', ConnectionManager::STATUS_TEMPORARILY_DISCONNECTED)
            ->whereBetween('created_at', [$startDate, $endDate]) // 期間内に一時切断が発生したログの数
            ->count();

        // 期間内に再接続が記録されたログの数をカウント
        // 注意: これは期間内に「再接続が完了した」ログの数であり、
        // 期間内に「一時切断になったものが再接続した」数とは厳密には異なる場合があります。
        $totalReconnections = ConnectionLog::whereNotNull('reconnected_at')
            ->whereBetween('reconnected_at', [$startDate, $endDate]) // 期間内に再接続日時が記録されたログの数
            ->count();

        // 再接続率の計算 (0除算を回避し、100%を超えないように調整)
        $reconnectionRate = 0;
        if ($totalTemporaryDisconnections > 0) {
            // 期間内の一時切断数に対する、期間内の再接続数の割合
            $rate = ($totalReconnections / $totalTemporaryDisconnections) * 100;
            $reconnectionRate = min($rate, 100); // 100%を上限とする
        } elseif ($totalReconnections > 0) {
            // 期間内に一時切断はないが再接続ログがある場合 (期間外からの再接続など)
            // この場合の扱いは要件によりますが、ここでは 0% または 100% とします (例: 0%)
            $reconnectionRate = 0; // または 100 など、仕様に応じて決定
        }

        return view('admin.connection_analytics', compact(
            'startDate', // ビューで期間表示用
            'endDate',   // ビューで期間表示用
            'period',    // ビューで選択状態保持用
            'realtimeStats',
            'frequentDisconnectionUsers',
            // 'lowReconnectionRateUsers',
            'disconnectionTrends',
            'disconnectionStats24h', // 名前変更
            'userDisconnectionRanking',
            'reconnectionRate' // 修正された再接続率
        ));
    }

    /**
     * 特定ユーザーの接続履歴詳細
     */
    public function userDetail(Request $request, User $user)
    {
        // 期間指定の取得 (デフォルト: 過去7日間)
        $period = $request->input('period', '7d');
        [$startDate, $endDate] = $this->parsePeriod($period, $request);

        // 接続セッション履歴を取得
        $connectionSessions = ConnectionLog::getUserConnectionSessions($user->id, $startDate, $endDate);

        // 接続問題概要 (指定期間)
        $connectionIssues = ConnectionLog::analyzeConnectionIssues($user->id, $startDate->diffInHours($endDate)); // 時間で指定

        // ページネーションはセッションベースでは難しいので、一旦全件表示か、
        // もしくはログ単位のページネーションに戻すか検討
        // $connectionLogs = ConnectionLog::where('user_id', $user->id)
        //     ->period($startDate, $endDate) // スコープ利用
        //     ->orderByDesc('created_at')
        //     ->paginate(15);

        return view('admin.user_connection_detail', compact(
            'user',
            'startDate',
            'endDate',
            'period',
            'connectionSessions', // セッションデータを渡す
            'connectionIssues'
            // 'connectionLogs' // 必要ならログ単位も渡す
        ));
    }

    /**
     * 期間指定文字列をパースして開始日と終了日を取得
     */
    private function parsePeriod(string $period, Request $request): array
    {
        $endDate = now();
        switch ($period) {
            case '24h':
                $startDate = now()->subDay();
                break;
            case '30d':
                $startDate = now()->subDays(30);
                break;
            case 'custom':
                // カスタム期間のバリデーションと取得
                $request->validate([
                    'start_date' => 'required|date|before_or_equal:end_date',
                    'end_date' => 'required|date|after_or_equal:start_date',
                ]);
                $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
                $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
                break;
            case '7d':
            default:
                $startDate = now()->subDays(7);
                break;
        }
        return [$startDate, $endDate];
    }
}

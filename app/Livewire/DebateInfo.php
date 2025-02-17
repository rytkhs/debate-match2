<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Debate;
use Illuminate\Support\Facades\Auth;
use App\Events\TurnAdvanced;
use App\Jobs\AdvanceDebateTurnJob;
use App\Jobs\EvaluateDebateJob;
use Carbon\Carbon;
use Livewire\Attributes\On;

class DebateInfo extends Component
{
    public Debate $debate;
    public string $currentTurnName;
    public string $nextTurnName;
    public ?int $turnEndTime;
    public ?string $currentSpeaker;
    public bool $isMyTurn;
    public bool $isPrepTime;
    public bool $isQuestioningTurn = false;

    public function mount(Debate $debate): void
    {
        $this->debate = $debate;
        $this->syncTurnState();
    }

    /**
     * ターンが進行した際のイベントハンドラ
     */
    #[On("echo-private:debate.{debate.room_id},TurnAdvanced")]
    public function handleTurnAdvanced(array $data): void
    {
        if (!$this->isValidTurnAdvanceData($data)) {
            return;
        }

        $this->reloadDebate($data['debate_id']);
        $this->dispatchTurnAdvancedEvents();
    }

    /**
     * ターンの進行データが有効かチェック
     */
    private function isValidTurnAdvanceData(array $data): bool
    {
        return isset($data['debate_id']);
    }

    /**
     * ディベートモデルの再読み込み
     */
    private function reloadDebate(int $debateId): void
    {
        $this->debate = Debate::with(['affirmativeUser', 'negativeUser'])
            ->find($debateId);

        if ($this->debate) {
            $this->syncTurnState();
        }
    }

    /**
     * ターン進行関連のイベントをディスパッチ
     */
    private function dispatchTurnAdvancedEvents(): void
    {
        $this->dispatch('turn-advanced', turnEndTime: $this->turnEndTime);
        $this->dispatch('$refresh');
    }

    /**
     * ターン関連の状態を同期
     */
    public function syncTurnState(): void
    {
        $currentTurn = $this->debate->current_turn;
        $turns = $this->debate->getTurns();

        $this->setTurnInfo($currentTurn, $turns);
        $this->setUserTurnStatus();
        $this->setTurnFlags($turns, $currentTurn);
    }

    /**
     * ターン情報の設定
     */
    private function setTurnInfo(int $currentTurn, array $turns): void
    {
        $this->currentTurnName = $turns[$currentTurn]['name'] ?? '終了';
        $this->nextTurnName = $turns[$currentTurn + 1]['name'] ?? '終了';
        $this->currentSpeaker = $turns[$currentTurn]['speaker'] ?? null;
        $this->turnEndTime = $this->debate->turn_end_time?->timestamp;
    }

    /**
     * ユーザーのターン状態を設定
     */
    private function setUserTurnStatus(): void
    {
        $userId = Auth::id();
        $this->isMyTurn = $this->checkIfUsersTurn($userId);
    }

    /**
     * ユーザーのターンかどうかをチェック
     */
    private function checkIfUsersTurn(int $userId): bool
    {
        return ($this->currentSpeaker === 'affirmative' && $this->debate->affirmativeUser->id === $userId)
            || ($this->currentSpeaker === 'negative' && $this->debate->negativeUser->id === $userId);
    }

    /**
     * ターンに関するフラグを設定
     */
    private function setTurnFlags(array $turns, int $currentTurn): void
    {
        $this->isPrepTime = $turns[$currentTurn]['is_prep_time'] ?? false;
        $this->isQuestioningTurn = strpos($this->currentTurnName, '質疑') !== false;
    }

    /**
     * 手動でターンを進める
     */
    public function advanceTurnManually(): void
    {
        $this->authorize('advanceTurn', $this->debate);
        $this->debate->advanceToNextTurn();
        session()->flash('success', 'ターンを進めました。');
    }

    public function render()
    {
        return view('livewire.debate-info');
    }
}

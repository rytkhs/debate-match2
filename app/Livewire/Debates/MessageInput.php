<?php

namespace App\Livewire\Debates;

use Livewire\Component;
use App\Models\Debate;
use App\Models\DebateMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Session;
use App\Events\DebateMessageSent;
use Livewire\Attributes\On;
use App\Models\Room;
use App\Services\DebateService;

class MessageInput extends Component
{
    public Debate $debate;
    #[Session]
    public string $newMessage = '';
    public bool $isMyTurn = false;
    public ?string $currentSpeaker;
    public ?string $currentTurnName;
    public bool $isPrepTime;
    public bool $isQuestioningTurn = false;
    protected $debateService;

    protected array $rules = [
        'newMessage' => 'required|string|max:5000',
    ];

    public function boot(DebateService $debateService)
    {
        $this->debateService = $debateService;
    }

    public function mount(Debate $debate): void
    {
        $this->debate = $debate;
        $this->syncTurnState();
    }

    #[On("echo-private:debate.{debate.id},TurnAdvanced")]
    public function handleTurnAdvanced(): void
    {
        $this->debate->refresh();
        $this->syncTurnState();
    }

    #[On("echo-private:debate.{debate.id},DebateFinished")]
    public function handleDebateFinished(): void
    {
        // ディベート終了で初期化
        $this->newMessage = '';
    }

    private function syncTurnState(): void
    {
        $turns = $this->debateService->getFormat($this->debate);
        $currentTurn = $this->debate->current_turn;

        $this->currentSpeaker = $turns[$currentTurn]['speaker'] ?? null;
        $this->currentTurnName = $turns[$currentTurn]['name'] ?? null;
        $this->isPrepTime = $turns[$currentTurn]['is_prep_time'] ?? false;
        $this->isQuestioningTurn = strpos($this->currentTurnName, '質疑') !== false;

        $this->isMyTurn = $this->checkIfUsersTurn(Auth::id());
    }

    private function checkIfUsersTurn(int $userId): bool
    {
        return ($this->currentSpeaker === 'affirmative' && $this->debate->affirmativeUser->id === $userId)
            || ($this->currentSpeaker === 'negative' && $this->debate->negativeUser->id === $userId);
    }

    public function sendMessage(): void
    {
        // ディベートが存在するか、進行中かをチェック
        if (!$this->debate || !$this->debate->room || $this->debate->room->status !== Room::STATUS_DEBATING) {
            return;
        }

        // 準備時間中は送信不可
        if ($this->isPrepTime) {
            return;
        }

        // 発言権がない場合は送信不可（質疑応答時は例外）
        if (!$this->isMyTurn && !$this->isQuestioningTurn) {
            return;
        }

        $this->validate();

        $message = DebateMessage::create([
            'debate_id' => $this->debate->id,
            'user_id' => Auth::id(),
            'message' => $this->newMessage,
            'turn' => $this->debate->current_turn,
        ]);

        $this->dispatch('message-sent');
        broadcast(new DebateMessageSent($this->debate->id))->toOthers();
        // $this->dispatch('scroll-to-bottom');

        $this->newMessage = '';

        // フラッシュメッセージ表示
        $this->dispatch('showFlashMessage', 'メッセージを送信しました', 'info');
    }

    public function render()
    {
        return view('livewire.debates.message-input');
    }
}

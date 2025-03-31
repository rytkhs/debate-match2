<?php

namespace App\Livewire\Debates;

use Livewire\Component;
use App\Models\Debate;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Participants extends Component
{
    public Debate $debate;
    public string $currentTurnName = '';
    public string $nextTurnName = '';
    public ?string $currentSpeaker;
    public bool $isMyTurn = false;
    public array $onlineUsers = [];

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

    #[On('member-online')]
    public function handleMemberOnline($data): void
    {
        if (isset($data['id'])) {
            $this->onlineUsers[$data['id']] = true;
        }
    }

    #[On('member-offline')]
    public function handleMemberOffline($data): void
    {
        if (isset($data['id'])) {
            $this->onlineUsers[$data['id']] = false;
        }
    }

    private function syncTurnState(): void
    {
        $turns = $this->debate->getFormat();
        $currentTurn = $this->debate->current_turn;

        $this->currentTurnName = $turns[$currentTurn]['name'] ?? '終了';
        $this->nextTurnName = $turns[$currentTurn + 1]['name'] ?? '終了';
        $this->currentSpeaker = $turns[$currentTurn]['speaker'] ?? null;

        $this->isMyTurn = $this->checkIfUsersTurn(Auth::id());
    }

    private function checkIfUsersTurn(int $userId): bool
    {
        return ($this->currentSpeaker === 'affirmative' && $this->debate->affirmativeUser->id === $userId)
            || ($this->currentSpeaker === 'negative' && $this->debate->negativeUser->id === $userId);
    }

    public function isUserOnline($userId): bool
    {
        return $this->onlineUsers[$userId] ?? false;
    }

    public function advanceTurnManually(): void
    {
        $this->debate->advanceToNextTurn();
        $this->dispatch('showFlashMessage', 'パートを終了しました', 'success');
    }

    public function render()
    {
        return view('livewire.debates.participants');
    }
}

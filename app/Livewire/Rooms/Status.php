<?php

namespace App\Livewire\Rooms;

use App\Models\Room;
use Livewire\Component;
use Livewire\Attributes\On;

class Status extends Component
{
    public Room $room;

    public function mount(Room $room)
    {
        $this->room = $room;
    }

    #[On('echo:rooms.{room.id},UserJoinedRoom')]
    #[On('echo:rooms.{room.id},UserLeftRoom')]
    public function updateStatus($data)
    {
        $this->room->status = $data['room']['status'];
    }

    public function render()
    {
        return view('livewire.rooms.status');
    }
}

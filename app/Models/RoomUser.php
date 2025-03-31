<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoomUser extends Pivot
{
    protected $table = 'room_users';

    // サイドの定数
    public const SIDE_AFFIRMATIVE = 'affirmative';
    public const SIDE_NEGATIVE = 'negative';

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ユーザーがルーム作成者かどうかを判定
     */
    public function isCreator()
    {
        return $this->room->created_by === $this->user_id;
    }
}

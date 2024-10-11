<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebateMessage extends Model
{
    use HasFactory;

    protected $fillable = ['debate_id', 'user_id', 'message', 'turn', 'speaking_time'];

    public function debate()
    {
        return $this->belongsTo(Debate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
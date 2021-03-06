<?php

namespace App\Models;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameReview extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'user_id', 'rating', 'comment'];

    public function game () {
        return $this->belongsTo(Game::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}

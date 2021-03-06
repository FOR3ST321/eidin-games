<?php

namespace App\Models;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Developer extends Model
{
    use HasFactory;

    public $timestamps = true;

    public function user () {
        return $this->hasOne(User::class);
    }

    public function games () {
        return $this->hasMany(Game::class);
    }
}

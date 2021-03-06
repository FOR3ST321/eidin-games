<?php

namespace App\Models;

use App\Models\Wishlist;
use App\Models\Developer;
use App\Models\GameReview;
use App\Models\GameLibrary;
use App\Models\GamePayment;
use App\Models\GameDonation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function developer () {
        return $this->hasOne(Developer::class);
    }

    public function wishlists () {
        return $this->hasMany(Wishlist::class);
    }

    public function gameLibraries () {
        return $this->hasMany(GameLibrary::class);
    }

    public function gameReviews () {
        return $this->hasMany(GameReview::class);
    }

    public function gamePayments () {
        return $this->hasMany(GamePayment::class);
    }

    public function gameDonations () {
        return $this->hasMany(GameDonation::class);
    }
}

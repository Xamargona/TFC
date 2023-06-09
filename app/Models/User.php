<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'bio',
        'avatar',
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

    /**
     * Get the bookings for the user.
     */
    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the publications for the user.
     */
    public function publications() {
        return $this->hasMany(Publication::class);
    }

    /**
     * Get the chats for the user.
     */
    public function chats() {
        return $this->hasMany(Chat::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_user', 'artist_id', 'user_id');
    }

    public function following() {
        return $this->belongsToMany(User::class, 'user_user', 'user_id', 'artist_id');
    }
}

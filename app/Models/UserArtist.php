<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArtist extends Model
{
    protected $table = 'user_artist';
    use HasFactory;
}

public function followers()
{
    return $this->hasMany(User::class, 'id', 'user_id');
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    /**
     * Get the user chats.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the chat messages.
     */
    public function messages() {
        return $this->hasMany(ChatMessage::class);
    }

}

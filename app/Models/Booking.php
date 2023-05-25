<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    use HasFactory;

	protected $fillable = [
		'title', 'start', 'end'
	];

    /**
     * Get the user bookings.
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

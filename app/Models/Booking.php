<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'package_id', 'photographer_id',
        'booking_date', 'start_time', 'end_time',
        'status', 'total_price', 'notes',
    ];

    protected $casts = ['booking_date' => 'date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function photographer(): BelongsTo
    {
        return $this->belongsTo(Photographer::class);
    }
}
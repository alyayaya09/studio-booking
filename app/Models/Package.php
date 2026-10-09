<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $fillable = ['name', 'description', 'price', 'duration_minutes', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
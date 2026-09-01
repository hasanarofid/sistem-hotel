<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'badge',
        'description',
        'price_per_night',
        'size_sqm',
        'capacity',
        'bed_type',
        'image_url',
        'amenities',
        'total_units',
        'is_available',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'amenities' => 'array',
        'is_available' => 'boolean',
        'total_units' => 'integer',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

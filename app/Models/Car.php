<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Car extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'car_type_id', 'name', 'brand', 'license_plate', 'price_per_day', 'year', 'description', 'status'
    ];

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

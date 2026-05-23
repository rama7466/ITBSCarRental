<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Payment extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'booking_id', 'amount', 'payment_date', 'status'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}

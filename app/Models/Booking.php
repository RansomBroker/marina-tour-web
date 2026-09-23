<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'tour_package_id',
        'full_name',
        'whatsapp_number',
        'email',
        'travel_date',
        'number_of_pax',
        'pickup_location',
        'special_request',
        'total_price',
        'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'number_of_pax' => 'integer',
        'total_price' => 'decimal:2',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class, 'tour_package_id');
    }
}

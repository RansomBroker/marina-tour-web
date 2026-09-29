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
        'deposit_amount',
        'remaining_balance',
        'payment_status',
        'payment_method',
        'payment_link_url',
        'xendit_invoice_id',
        'xendit_payment_status',
        'webhook_response',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'number_of_pax' => 'integer',
        'total_price' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'remaining_balance' => 'decimal:2',
        'webhook_response' => 'array',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class, 'tour_package_id');
    }

    // Booking Statuses
    public const STATUS_NEW = 'new';
    public const STATUS_FOLLOW_UP = 'follow_up';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_ASSIGNED = 'assigned';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    // Payment Statuses
    public const PAYMENT_UNPAID = 'unpaid';
    public const PAYMENT_DEPOSIT_REQUESTED = 'deposit_requested';
    public const PAYMENT_DEPOSIT_PAID = 'deposit_paid';
    public const PAYMENT_FULLY_PAID = 'fully_paid';
    public const PAYMENT_CANCELLED = 'cancelled';

    public static function bookingStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_FOLLOW_UP => 'Follow Up',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_ASSIGNED => 'Assigned to Driver/Vendor',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    public static function paymentStatuses(): array
    {
        return [
            self::PAYMENT_UNPAID => 'Unpaid',
            self::PAYMENT_DEPOSIT_REQUESTED => 'Deposit Requested',
            self::PAYMENT_DEPOSIT_PAID => 'Deposit Paid',
            self::PAYMENT_FULLY_PAID => 'Fully Paid',
            self::PAYMENT_CANCELLED => 'Cancelled',
        ];
    }
}

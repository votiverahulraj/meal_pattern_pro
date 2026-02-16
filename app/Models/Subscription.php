<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'district_id',
        'stripe_subscription_id',
        'stripe_customer_id',
        'tier', // free, standard, enterprise
        'status', // active, cancelled, past_due, trialing, paused
        'current_period_start',
        'current_period_end',
        'cancel_at_period_end',
        'payment_method',
        'next_billing_date',
        'amount',
    ];

    protected $casts = [
        'current_period_start' => 'datetime',
        'current_period_end' => 'datetime',
        'cancel_at_period_end' => 'boolean',
        'next_billing_date' => 'datetime',
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the district that owns the subscription.
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}

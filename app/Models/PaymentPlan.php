<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentPlan extends Model
{
    protected $fillable = [
        'family_id',
        'plan_name',
        'total_amount',
        'remaining_balance',
        'monthly_payment',
        'start_date',
        'end_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'remaining_balance' => 'decimal:2',
        'monthly_payment' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the family that the payment plan belongs to.
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'family_id',
        'amount',
        'payment_method',
        'transaction_id',
        'payment_date',
        'notes',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the family that the payment belongs to.
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}

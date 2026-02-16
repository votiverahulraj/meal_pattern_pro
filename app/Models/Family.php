<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    protected $fillable = [
        'district_id',
        'school_id',
        'primary_contact_name',
        'student_names',
        'outstanding_balance',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'notes',
        'do_not_contact',
        'date_added',
        'last_contact_date',
        'account_number',
        'grade_levels',
        'recovery_status', // active, payment_plan, paid, inactive
        'collection_status', // received, in_collections
        'recovery_priority', // high, normal, low (admin only)
        'status',
    ];

    protected $casts = [
        'outstanding_balance' => 'decimal:2',
        'date_added' => 'datetime',
        'last_contact_date' => 'datetime',
        'do_not_contact' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the district that owns the family record.
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the communications associated with the family.
     */
    public function communications(): HasMany
    {
        return $this->hasMany(Communication::class);
    }

    /**
     * Get the payments associated with the family.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the payment plans associated with the family.
     */
    public function paymentPlans(): HasMany
    {
        return $this->hasMany(PaymentPlan::class);
    }
}

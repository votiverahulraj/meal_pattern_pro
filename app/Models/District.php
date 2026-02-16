<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class District extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip_code',
        'contact_person',
        'contact_email',
        'contact_phone',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the subscription for the district.
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    /**
     * Get the families associated with the district.
     */
    public function families(): HasMany
    {
        return $this->hasMany(Family::class, 'district_id');
    }

    /**
     * Get the products associated with the district.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

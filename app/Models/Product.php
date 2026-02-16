<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'district_id',
        'manufacturer_id',
        'name',
        'brand',
        'category',
        'product_code',
        'description',
        'ingredients',
        'allergens',
        'nutritional_info',
        'packaging',
        'storage_requirements',
        'preparation_instructions',
        'certifications',
        'meal_pattern_contributions',
        'cn_statements',
        'status',
    ];

    protected $casts = [
        'nutritional_info' => 'array',
        'meal_pattern_contributions' => 'array',
        'cn_statements' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the district that owns the product.
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the manufacturer of the product.
     */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manufacturer_id');
    }

    /**
     * Get the files associated with the product.
     */
    public function files(): HasMany
    {
        return $this->hasMany(ProductFile::class);
    }
}

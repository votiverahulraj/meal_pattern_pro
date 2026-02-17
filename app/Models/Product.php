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

        'nutri_code',
        'manufacturer',
        'product_number',
        'unit_size',
        'serving_size',
        'case_pack',
        'shift_life',
        'product_specification_sheet',
        'product_formulation_statement',
        'buy_american_complaince',
        'calories',
        'protein',
        'carbs',
        'fat',
        'sat_fat',
        'trans_fat',
    ];

    protected $casts = [
        'nutritional_info' => 'array',
        'meal_pattern_contributions' => 'array',
        'cn_statements' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',

         'calories' => 'float',
        'protein' => 'float',
        'carbs' => 'float',
        'fat' => 'float',
        'sat_fat' => 'float',
        'trans_fat' => 'float',
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

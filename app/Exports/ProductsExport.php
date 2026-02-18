<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::select(
            'district_id',
            'manufacturer_id',
            'name',
            'nutri_code',
            'manufacturer',
            'product_number',
            'brand',
            'category',
            'product_code',
            'unit_size',
            'serving_size',
            'case_pack',
            'shift_life',
            'calories',
            'protein',
            'carbs',
            'fat',
            'sat_fat',
            'trans_fat',
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
            'status'
        )->get();
    }

    public function headings(): array
    {
        return [
            'district_id',
            'manufacturer_id',
            'name',
            'nutri_code',
            'manufacturer',
            'product_number',
            'brand',
            'category',
            'product_code',
            'unit_size',
            'serving_size',
            'case_pack',
            'shift_life',
            'calories',
            'protein',
            'carbs',
            'fat',
            'sat_fat',
            'trans_fat',
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
            'status'
        ];
    }
}

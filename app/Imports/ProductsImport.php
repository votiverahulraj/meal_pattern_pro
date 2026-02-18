<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {

        foreach ($rows as $row)
        {


            // skip if district or manufacturer missing
            if(empty($row['district_id']) || empty($row['manufacturer_id']))
            {
                continue;
            }

            $status = strtolower(trim($row['status'] ?? 'active'));

            if(!in_array($status,['active','inactive','pending']))
            {
                $status = 'active';
            }

            Product::create([

                'district_id' => $row['district_id'],

                'manufacturer_id' => $row['manufacturer_id'],

                'name' => $row['name'] ?? '',

                'nutri_code' => $row['nutri_code'] ?? '',

                'manufacturer' => $row['manufacturer'] ?? '',

                'product_number' => $row['product_number'] ?? '',

                'brand' => $row['brand'] ?? '',

                'category' => $row['category'] ?? '',

                'product_code' => $row['product_code'] ?? '',

                'unit_size' => $row['unit_size'] ?? '',

                'serving_size' => $row['serving_size'] ?? '',

                'case_pack' => $row['case_pack'] ?? '',

                'shift_life' => $row['shift_life'] ?? '',

                'calories' => $row['calories'] ?? 0,

                'protein' => $row['protein'] ?? 0,

                'carbs' => $row['carbs'] ?? 0,

                'fat' => $row['fat'] ?? 0,

                'sat_fat' => $row['sat_fat'] ?? 0,

                'trans_fat' => $row['trans_fat'] ?? 0,

                'description' => $row['description'] ?? '',

                'ingredients' => $row['ingredients'] ?? '',

                'allergens' => $row['allergens'] ?? '',

                'nutritional_info' => $row['nutritional_info'] ?? '',

                'packaging' => $row['packaging'] ?? '',

                'storage_requirements' => $row['storage_requirements'] ?? '',

                'preparation_instructions' => $row['preparation_instructions'] ?? '',

                'certifications' => $row['certifications'] ?? '',

                'meal_pattern_contributions' => $row['meal_pattern_contributions'] ?? '',

                'cn_statements' => $row['cn_statements'] ?? '',

                'status' => $status,

            ]);

        }

    }

}

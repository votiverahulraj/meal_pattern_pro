<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
    'user_id',
    'name',
    'email',
    'phone',
    'address',
    'state',
    'city',
    'pincode',
    'job_title',
    'federal_programs',
    'student_enrollment',
    'meal_per_day',
    'annual_budget',
    'main_distributor',
    'building_served',
    'software_provider',
    'monthly_hours',
    'collection_method',
    'commodity_diverted',
    'foodcoop_member',
];

    protected $casts = [
        'federal_programs' => 'array',
        'collection_method' => 'array',
    ];
}

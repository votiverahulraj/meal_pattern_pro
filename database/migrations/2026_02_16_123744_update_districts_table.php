<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('districts', function (Blueprint $table) {

            // Operations Section
            $table->string('job_title')->nullable()->after('contact_phone');
            $table->integer('federal_programs')->default(0);
            $table->string('student_enrollment')->nullable();
            $table->string('meal_per_day')->nullable();

            // Supply Chain Section
            $table->string('annual_budget')->nullable();
            $table->string('main_distributor')->nullable();
            $table->integer('building_served')->nullable();
            $table->string('software_provider')->nullable();
            $table->integer('monthly_hours')->nullable();
            $table->integer('collection_method')->default(0);
            $table->integer('commodity_diverted')->nullable();
            $table->string('foodcoop_member')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn([
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
                'foodcoop_member'
            ]);
        });
    }
};

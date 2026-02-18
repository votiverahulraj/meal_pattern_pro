<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('job_title')->nullable();
            $table->json('federal_programs')->nullable();
            $table->string('student_enrollment')->nullable();
            $table->string('meal_per_day')->nullable();

            // Supply Chain Section
            $table->string('annual_budget')->nullable();
            $table->string('main_distributor')->nullable();
            $table->integer('building_served')->nullable();
            $table->string('software_provider')->nullable();
            $table->integer('monthly_hours')->nullable();
            $table->json('collection_method')->nullable();
            $table->integer('commodity_diverted')->nullable();
            $table->string('foodcoop_member')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};

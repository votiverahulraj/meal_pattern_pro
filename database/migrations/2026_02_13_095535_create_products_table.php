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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->foreignId('manufacturer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->string('product_code')->nullable();
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('allergens')->nullable();
            $table->json('nutritional_info')->nullable();
            $table->text('packaging')->nullable();
            $table->text('storage_requirements')->nullable();
            $table->text('preparation_instructions')->nullable();
            $table->text('certifications')->nullable();
            $table->json('meal_pattern_contributions')->nullable();
            $table->json('cn_statements')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

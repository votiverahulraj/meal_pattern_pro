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
        Schema::table('products', function (Blueprint $table) {
            $table->string("nutri_code")->nullable();
            $table->string("manufacturer")->nullable();
            $table->string("product_number")->nullable();
            $table->text("unit_size")->nullable();
            $table->text("serving_size")->nullable();
            $table->text("case_pack")->nullable();
            $table->text("shift_life")->nullable();

            $table->text("product_specification_sheet")->nullable();
            $table->text("product_formulation_statement")->nullable();
            $table->text("buy_american_complaince")->nullable();

            $table->text("calories")->nullable();
            $table->text("protein")->nullable();
            $table->text("carbs")->nullable();
            $table->text("fat")->nullable();
            $table->text("sat_fat")->nullable();
            $table->text("trans_fat")->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('primary_contact_name');
            $table->text('student_names'); // comma-separated
            $table->decimal('outstanding_balance', 10, 2)->default(0.00);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('do_not_contact')->default(false);
            $table->timestamp('date_added')->nullable();
            $table->timestamp('last_contact_date')->nullable();
            $table->string('account_number')->nullable();
            $table->text('grade_levels')->nullable(); // comma-separated
            $table->enum('recovery_status', ['active', 'payment_plan', 'paid', 'inactive'])->default('active');
            $table->enum('collection_status', ['received', 'in_collections'])->default('received');
            $table->enum('recovery_priority', ['high', 'normal', 'low'])->default('normal'); // admin only
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};

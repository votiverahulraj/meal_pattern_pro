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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('recipient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('messages')->onDelete('cascade');
            $table->string('subject')->nullable();
            $table->text('content');
            $table->enum('category', ['general', 'billing', 'technical', 'compliance', 'other'])->default('general');
            $table->boolean('is_read')->default(false);
            $table->boolean('deleted_by_sender')->default(false);
            $table->boolean('deleted_by_recipient')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->enum('status', ['draft', 'sent', 'archived'])->default('sent');
            $table->timestamps();
            
            $table->index(['sender_id', 'recipient_id']);
            $table->index('parent_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};

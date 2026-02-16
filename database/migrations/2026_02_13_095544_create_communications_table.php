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
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_id')->constrained()->onDelete('cascade');
            $table->foreignId('sent_by')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('communication_type', ['email', 'sms', 'mail', 'phone']);
            $table->string('subject')->nullable();
            $table->text('content');
            $table->timestamp('sent_at')->nullable();
            $table->boolean('response_received')->default(false);
            $table->text('response_content')->nullable();
            $table->boolean('follow_up_required')->default(false);
            $table->timestamp('follow_up_date')->nullable();
            $table->enum('status', ['sent', 'delivered', 'failed', 'read'])->default('sent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communications');
    }
};

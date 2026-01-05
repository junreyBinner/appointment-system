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
     Schema::create('appointments', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->constrained()->onDelete('cascade');
         $table->foreignId('service_id')->constrained()->onDelete('cascade');
         $table->date('date');
         $table->time('start_time');
         $table->time('end_time')->nullable();
         $table->enum('status', ['pending', 'approved', 'cancelled', 'completed'])->default('pending');
         $table->text('notes')->nullable();
         $table->timestamps();

            // Indexes for better query performance
         $table->index(['date', 'status']);
         $table->index(['user_id', 'date']);
         $table->index(['service_id', 'date']);
    
         $table->index(['date', 'start_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

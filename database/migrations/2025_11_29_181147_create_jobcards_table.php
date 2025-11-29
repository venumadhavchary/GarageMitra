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
        Schema::create('jobcards', function (Blueprint $table) {
            $table->id();
            $table->string('jobcard_id')->unique();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('bill_id')->nullable();
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');

            $table->unsignedBigInteger('vehicle_id')->nullable(); // Add this instead
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');

            $table->string('mechanic_name');
            $table->string('vehicle_number');
            $table->string('vehicle_type');
            
            $table->json('services');
            $table->text('remarks')->nullable();
            $table->integer('paid_amount')->nullable();
            $table->bigInteger('odometer_reading')->nullable();
            $table->integer('fuel_level')->default(0);
            $table->string('vehicle_received_from')->default('customer');
            $table->string('vehicle_returned_to')->default('customer');
            $table->date('assigned_date');
            $table->date('estimated_completion_date')->nullable();
            $table->text('vehicle_condition')->nullable();
            $table->json('vehicle_images')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobcards');
    }
};

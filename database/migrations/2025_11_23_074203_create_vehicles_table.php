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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->constrained('users')->onDelete('cascade');
            $table->string('vehicle_number')->unique();
            $table->string('make');
            $table->string('model'); 
            $table->string('fuel_type');
            $table->string('vehicle_image')->nullable();
            $table->string('owner_name');
            $table->string('owner_contact');
            $table->string('secondary_contact')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

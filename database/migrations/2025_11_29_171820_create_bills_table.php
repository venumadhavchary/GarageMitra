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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobcard_id'); 
            $table->json('spare_parts');
            $table->json('services_to_do');
            $table->json('labour_charges');
            $table->integer('total_amount');
            $table->integer('paid_amount')->default(0);
            $table->integer('discount')->default(0);
            $table->string('status')->default('unpaid');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('bills');
        Schema::enableForeignKeyConstraints();
    }
};

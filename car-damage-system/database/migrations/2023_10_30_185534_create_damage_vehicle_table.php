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
        Schema::create('damage_vehicle', function (Blueprint $table) {
            $table->primary(['damage_id', 'vehicle_id']);

            $table->unsignedBigInteger('damage_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('damage_id')->references('id')->on('damages')->onDelete('cascade');
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_vehicle');
    }
};

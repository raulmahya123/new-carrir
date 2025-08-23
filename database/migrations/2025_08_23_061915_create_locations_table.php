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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // Bandung, Jakarta, dll
            $table->string('region')->nullable(); // opsional
            $table->string('country')->default('ID');
            $table->decimal('lat', 10, 7)->nullable(); // Latitude
            $table->decimal('lng', 10, 7)->nullable(); // Longitude
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};

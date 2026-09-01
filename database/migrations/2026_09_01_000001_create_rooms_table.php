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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->default('SUITE'); // BEACHFRONT SANCTUARY, BOTANICAL HIDEAWAY, FAMILY ESTATE
            $table->string('badge')->nullable(); // Signature Residence, Intimate Luxury
            $table->text('description')->nullable();
            $table->decimal('price_per_night', 12, 2);
            $table->string('size_sqm')->default('120 m²');
            $table->string('capacity')->default('2 Guests');
            $table->string('bed_type')->default('King Bed');
            $table->string('image_url')->nullable();
            $table->json('amenities')->nullable();
            $table->integer('total_units')->default(3);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

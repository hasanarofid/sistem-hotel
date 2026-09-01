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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_phone');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guests_count')->default(2);
            $table->integer('nights_count')->default(1);
            $table->decimal('total_price', 12, 2);
            $table->enum('payment_status', ['pending', 'paid', 'cancelled', 'checked_in', 'checked_out', 'expired'])->default('pending');
            $table->string('payment_method')->nullable(); // QRIS, VA_BCA, CREDIT_CARD
            $table->string('snap_token')->nullable();
            $table->text('special_requests')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

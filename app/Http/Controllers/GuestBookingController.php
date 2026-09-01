<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GuestBookingController extends Controller
{
    /**
     * Store a direct booking reservation from the public landing page (#booking).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:50',
            'guests_count' => 'nullable|integer|min:1',
            'payment_method' => 'required|string',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        $room = Room::findOrFail($validated['room_id']);

        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $nightsCount = max(1, $checkIn->diffInDays($checkOut));

        // Server-side price calculation
        $totalPrice = $nightsCount * (float) $room->price_per_night;

        // Generate unique booking code: VBR-YYYYMM-XXXX
        $bookingCode = 'VBR-' . Carbon::now()->format('Ym') . '-' . strtoupper(Str::random(4));

        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'user_id' => auth()->id(), // null if guest
            'room_id' => $room->id,
            'guest_name' => $validated['guest_name'],
            'guest_email' => $validated['guest_email'],
            'guest_phone' => $validated['guest_phone'],
            'check_in' => $checkIn->format('Y-m-d'),
            'check_out' => $checkOut->format('Y-m-d'),
            'guests_count' => $validated['guests_count'] ?? 2,
            'nights_count' => $nightsCount,
            'total_price' => $totalPrice,
            'payment_status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'special_requests' => $validated['special_requests'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dibuat! Silakan selesaikan pembayaran.',
            'booking' => $booking->load('room'),
        ]);
    }
}

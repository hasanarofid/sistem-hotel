<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('room')->latest();

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhere('guest_name', 'like', "%{$search}%")
                  ->orWhere('guest_email', 'like', "%{$search}%");
            });
        }

        $bookings = $query->paginate(10)->withQueryString();
        $rooms = Room::all();

        return Inertia::render('Admin/Bookings/Index', [
            'bookings' => $bookings,
            'rooms' => $rooms,
            'filters' => $request->only(['status', 'search']),
        ]);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid,cancelled,checked_in,checked_out,expired',
        ]);

        $booking->update($validated);

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the Quiet Luxury Hotel Management Dashboard for Vije Boutique Resort.
     */
    public function index()
    {
        $totalRooms = Room::count();
        $totalUnits = Room::sum('total_units');
        
        $totalBookings = Booking::count();
        $paidBookings = Booking::whereIn('payment_status', ['paid', 'checked_in', 'checked_out']);
        
        $totalRevenue = (float) $paidBookings->sum('total_price');
        $pendingBookingsCount = Booking::where('payment_status', 'pending')->count();
        $checkedInCount = Booking::where('payment_status', 'checked_in')->count();

        // Calculate Occupancy Rate % based on occupied units vs total units
        $occupiedUnits = Booking::whereIn('payment_status', ['checked_in', 'paid'])
            ->whereDate('check_in', '<=', Carbon::today())
            ->whereDate('check_out', '>=', Carbon::today())
            ->count();

        $occupancyRate = $totalUnits > 0 ? round(($occupiedUnits / $totalUnits) * 100) : 0;

        $recentBookings = Booking::with('room')
            ->latest()
            ->take(6)
            ->get();

        $roomsOverview = Room::withCount(['bookings' => function($q) {
            $q->whereIn('payment_status', ['paid', 'checked_in']);
        }])->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'total_rooms' => $totalRooms,
                'total_units' => $totalUnits,
                'total_bookings' => $totalBookings,
                'occupancy_rate' => $occupancyRate,
                'total_revenue' => $totalRevenue,
                'pending_payments' => $pendingBookingsCount,
                'checked_in_guests' => $checkedInCount,
            ],
            'recent_bookings' => $recentBookings,
            'rooms_overview' => $roomsOverview,
        ]);
    }
}

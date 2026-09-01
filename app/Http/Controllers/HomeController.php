<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display Vije Boutique Resort Public Landing Page with active rooms & booking engine.
     */
    public function index()
    {
        $settings = [
            'site_name' => 'Vije Boutique Resort',
            'site_description' => 'Quiet Luxury Boutique Resort in Bali with Exclusive Suites, Private Pool Villas, and Direct Booking Engine',
            'whatsapp_number' => '628814959247',
        ];

        $rooms = Room::where('is_available', true)->get();

        return Inertia::render('Welcome', [
            'settings' => $settings,
            'rooms' => $rooms,
            'navigation' => [],
        ]);
    }
}

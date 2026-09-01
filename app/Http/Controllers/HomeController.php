<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Redirect root access: directly to dashboard if authenticated, or to login if guest.
     */
    public function index()
    {
        $settings = [
            'site_name' => 'Vije Boutique Resort',
            'site_description' => 'Quiet Luxury Boutique Resort in Bali with Exclusive Suites, Private Pool Villas, and Direct Booking Engine',
            'site_logo_url' => null,
            'whatsapp_number' => '628814959247',
        ];

        return Inertia::render('Welcome', [
            'settings' => $settings,
            'navigation' => [],
        ]);
    }
}

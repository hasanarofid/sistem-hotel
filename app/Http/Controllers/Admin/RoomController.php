<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::withCount('bookings')->latest()->get();

        return Inertia::render('Admin/Rooms/Index', [
            'rooms' => $rooms
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'size_sqm' => 'required|string|max:100',
            'capacity' => 'required|string|max:100',
            'bed_type' => 'required|string|max:100',
            'image_url' => 'nullable|string|max:500',
            'total_units' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(4);

        Room::create($validated);

        return redirect()->back()->with('success', 'Kamar / Villa berhasil ditambahkan!');
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'size_sqm' => 'required|string|max:100',
            'capacity' => 'required|string|max:100',
            'bed_type' => 'required|string|max:100',
            'image_url' => 'nullable|string|max:500',
            'total_units' => 'required|integer|min:1',
            'is_available' => 'boolean',
        ]);

        $room->update($validated);

        return redirect()->back()->with('success', 'Detail Kamar berhasil diperbarui!');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->back()->with('success', 'Kamar / Villa telah dihapus.');
    }
}

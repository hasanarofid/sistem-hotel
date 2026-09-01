<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HotelSeeder extends Seeder
{
    /**
     * Run the Hotel Domain seeds for Vije Boutique Resort.
     */
    public function run(): void
    {
        $roomsData = [
            [
                'name' => 'Grand Ocean Pool Villa',
                'slug' => 'grand-ocean-pool-villa',
                'category' => 'BEACHFRONT SANCTUARY',
                'badge' => 'Signature Residence',
                'description' => 'Perched along the serene coast, this grand sanctuary features a private infinity plunge pool, open-air pavilion, and panoramic Indian Ocean views framed by native teak architecture.',
                'price_per_night' => 4500000.00,
                'size_sqm' => '220 m²',
                'capacity' => '2-3 Guests',
                'bed_type' => 'Super King Bed',
                'image_url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1200&q=80',
                'amenities' => [
                    'Private Infinity Plunge Pool',
                    'Panoramic Ocean Sunset View',
                    'Personal Butler Service 24/7',
                    'Marble Bath & Outdoor Rain Shower',
                    'Gourmet Daily Breakfast Included',
                    'Complimentary High-Speed WiFi'
                ],
                'total_units' => 4,
                'is_available' => true,
            ],
            [
                'name' => 'Sanctuary Garden Suite',
                'slug' => 'sanctuary-garden-suite',
                'category' => 'BOTANICAL HIDEAWAY',
                'badge' => 'Intimate Luxury',
                'description' => 'Surrounded by fragrant frangipani trees and whispering lotus ponds, offering deep relaxation with a private outdoor terrazzo bathtub and expansive lounge veranda.',
                'price_per_night' => 3200000.00,
                'size_sqm' => '140 m²',
                'capacity' => '2 Guests',
                'bed_type' => 'King Bed',
                'image_url' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80',
                'amenities' => [
                    'Private Tropical Garden Patio',
                    'Outdoor Sunken Terrazzo Bathtub',
                    'Artisan Espresso & Organic Tea Bar',
                    'Handcrafted Teak Furniture',
                    'Evening Aromatherapy Turndown',
                    'Yoga Mat & Wellness Accessories'
                ],
                'total_units' => 6,
                'is_available' => true,
            ],
            [
                'name' => 'Royal Two-Bedroom Residence',
                'slug' => 'royal-two-bedroom-residence',
                'category' => 'FAMILY & GROUP ESTATE',
                'badge' => 'Ultimate Haven',
                'description' => 'The pinnacle of boutique hospitality. Features two lavish master suites, an expansive 12-meter private swimming pool, and dedicated living and dining pavilions.',
                'price_per_night' => 7800000.00,
                'size_sqm' => '380 m²',
                'capacity' => '4-5 Guests',
                'bed_type' => '2 Super King Beds',
                'image_url' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=1200&q=80',
                'amenities' => [
                    '12-Meter Private Pool & Sun Deck',
                    'Two Independent Master Suites',
                    'Private Chef On Request',
                    'Roundtrip Airport Transfer Included',
                    'Spacious Open-Air Living Pavilion',
                    'Exclusive Sunset Cocktail Hour'
                ],
                'total_units' => 2,
                'is_available' => true,
            ],
            [
                'name' => 'Cliffside Horizon Villa',
                'slug' => 'cliffside-horizon-villa',
                'category' => 'CLIFFSIDE RETREAT',
                'badge' => 'Exclusive View',
                'description' => 'Suspended over lush jungle cliffs with unobstructed sunset views. Features floor-to-ceiling glass walls, plunge pool, and bespoke luxury interiors.',
                'price_per_night' => 5200000.00,
                'size_sqm' => '200 m²',
                'capacity' => '2 Guests',
                'bed_type' => 'King Bed',
                'image_url' => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?auto=format&fit=crop&w=1200&q=80',
                'amenities' => [
                    'Panoramic Cliff Plunge Pool',
                    'Floor-to-Ceiling Glass Walls',
                    'Freestanding Soaking Tub',
                    'Personalized Concierge',
                    'Complementary Sunset Wine & Cheese'
                ],
                'total_units' => 3,
                'is_available' => true,
            ],
        ];

        foreach ($roomsData as $rData) {
            Room::updateOrCreate(['slug' => $rData['slug']], $rData);
        }

        // Get created rooms
        $oceanVilla = Room::where('slug', 'grand-ocean-pool-villa')->first();
        $gardenSuite = Room::where('slug', 'sanctuary-garden-suite')->first();
        $royalResidence = Room::where('slug', 'royal-two-bedroom-residence')->first();

        // Seed realistic reservations
        $dummyBookings = [
            [
                'booking_code' => 'VBR-202609-001',
                'room_id' => $oceanVilla->id,
                'guest_name' => 'Elena Rostova',
                'guest_email' => 'elena.rostova@zurich.ch',
                'guest_phone' => '+41 79 123 4567',
                'check_in' => Carbon::now()->addDays(2),
                'check_out' => Carbon::now()->addDays(5),
                'guests_count' => 2,
                'nights_count' => 3,
                'total_price' => 13500000.00,
                'payment_status' => 'paid',
                'payment_method' => 'CREDIT_CARD',
                'special_requests' => 'Honeymoon setup with fresh lotus flowers and champagne.',
            ],
            [
                'booking_code' => 'VBR-202609-002',
                'room_id' => $gardenSuite->id,
                'guest_name' => 'Julian Vance',
                'guest_email' => 'julian.vance@london.uk',
                'guest_phone' => '+44 20 7946 0912',
                'check_in' => Carbon::now()->subDays(1),
                'check_out' => Carbon::now()->addDays(3),
                'guests_count' => 2,
                'nights_count' => 4,
                'total_price' => 12800000.00,
                'payment_status' => 'checked_in',
                'payment_method' => 'VA_BCA',
                'special_requests' => 'Quiet corner suite near lotus pond.',
            ],
            [
                'booking_code' => 'VBR-202609-003',
                'room_id' => $royalResidence->id,
                'guest_name' => 'Dr. Bambang Suryo',
                'guest_email' => 'bambang.suryo@jakarta.id',
                'guest_phone' => '+62 812 9876 5432',
                'check_in' => Carbon::now()->addDays(10),
                'check_out' => Carbon::now()->addDays(13),
                'guests_count' => 4,
                'nights_count' => 3,
                'total_price' => 23400000.00,
                'payment_status' => 'pending',
                'payment_method' => 'QRIS',
                'special_requests' => 'Airport transfer pick up at 14:00 WITA.',
            ],
            [
                'booking_code' => 'VBR-202609-004',
                'room_id' => $oceanVilla->id,
                'guest_name' => 'Sarah Jenkins',
                'guest_email' => 's.jenkins@sydney.au',
                'guest_phone' => '+61 412 345 678',
                'check_in' => Carbon::now()->subDays(5),
                'check_out' => Carbon::now()->subDays(2),
                'guests_count' => 2,
                'nights_count' => 3,
                'total_price' => 13500000.00,
                'payment_status' => 'checked_out',
                'payment_method' => 'CREDIT_CARD',
                'special_requests' => 'Late check out requested.',
            ],
        ];

        foreach ($dummyBookings as $bData) {
            Booking::updateOrCreate(['booking_code' => $bData['booking_code']], $bData);
        }
    }
}

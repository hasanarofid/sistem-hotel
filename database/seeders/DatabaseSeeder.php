<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database for Vije Boutique Resort.
     */
    public function run(): void
    {
        // 1. Seed Roles and Permissions
        $this->call(RoleAndPermissionSeeder::class);

        // 2. Seed Default Super Admin User
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@vijeboutiqueresort.com'],
            [
                'name' => 'Super Administrator Vije',
                'username' => 'superadmin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('super_admin');

        // 3. Seed Default Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@vijeboutiqueresort.com'],
            [
                'name' => 'General Manager Admin',
                'username' => 'admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // 4. Seed Reservation Staff
        $reservationStaff = User::updateOrCreate(
            ['email' => 'reservation@vijeboutiqueresort.com'],
            [
                'name' => 'Reservation Frontdesk Staff',
                'username' => 'reservation',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $reservationStaff->assignRole('reservation_staff');

        // 5. Seed Finance Officer
        $financeUser = User::updateOrCreate(
            ['email' => 'finance@vijeboutiqueresort.com'],
            [
                'name' => 'Finance & Accounting Lead',
                'username' => 'finance',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $financeUser->assignRole('finance');

        // Assign 'admin' role to any legacy admin users
        User::where('email', 'admin@hotel.com')->get()->each(function ($u) {
            $u->assignRole('admin');
        });

        // Ensure all admin users have email_verified_at set
        User::role('admin')->update(['email_verified_at' => now()]);
        User::role('super_admin')->update(['email_verified_at' => now()]);

        // 6. Seed Hotel Domain Data (Rooms, Villas, Bookings)
        $this->call(HotelSeeder::class);

        // 7. Seed Settings & Pages
        $this->call(SettingSeeder::class);
        $this->call(PageAndSectionSeeder::class);
    }
}

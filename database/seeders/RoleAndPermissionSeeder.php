<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds for Vije Boutique Resort RBAC.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Hotel System Permissions
        $permissions = [
            'manage settings',
            'manage pages',
            'manage posts',
            'manage users',
            'manage rooms',
            'manage bookings',
            'manage finance',
            'manage cms',
            'view audit logs',
            'process checkin',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // PRD Defined Roles
        $superAdmin = Role::findOrCreate('super_admin');
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::findOrCreate('admin');
        $admin->givePermissionTo(Permission::all());

        $reservationStaff = Role::findOrCreate('reservation_staff');
        $reservationStaff->givePermissionTo(['manage bookings', 'process checkin', 'manage rooms']);

        $finance = Role::findOrCreate('finance');
        $finance->givePermissionTo(['manage finance', 'manage bookings', 'view audit logs']);

        $contentManager = Role::findOrCreate('content_manager');
        $contentManager->givePermissionTo(['manage cms', 'manage pages', 'manage posts']);

        // Legacy compatibility roles
        $userRole = Role::findOrCreate('user');
        $clientRole = Role::findOrCreate('client');
    }
}

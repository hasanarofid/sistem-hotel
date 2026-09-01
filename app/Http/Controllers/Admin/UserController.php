<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of resort staff & users with RBAC role management.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = User::with('roles');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();
        $availableRoles = Role::pluck('name')->toArray();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'available_roles' => $availableRoles,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    /**
     * Update user RBAC role.
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:super_admin,admin,reservation_staff,finance,content_manager,user,client',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', "Peran akses user {$user->name} berhasil diperbarui menjadi {$request->role}.");
    }
}

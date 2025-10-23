<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserService
{

    public function __construct()
    {
        // Constructor can be used for dependency injection if needed
    }

    public function getAllUsers(array $filters = [])
    {
        $query = User::query();

        // Apply status filter
        if (isset($filters['status']) && $filters['status']) {
            $query->where('status', $filters['status']);
        }

        // Apply role filter
        if (isset($filters['role']) && $filters['role']) {
            $query->where('role', $filters['role']);
        }

        // Apply search filter
        if (isset($filters['search']) && $filters['search']) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $sortField = $filters['sort_field'] ?? 'created_at';
        $sortDirection = $filters['sort_direction'] ?? 'desc';
        $query->orderBy($sortField, $sortDirection);

        return $query->get();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function getAllRoles()
    {
        return Role::all();
    }

    public function updateUser($userId, $data)
    {
        $user = User::findOrFail($userId);
        $user->update($data);

        return $user;
    }

   public function updateUserRoles($userId, $roles)
    {
        $user = User::findOrFail($userId);

        // Optionally create new roles if they don't exist
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $user->syncRoles($roles); // $roles is an array of role names
    }
}
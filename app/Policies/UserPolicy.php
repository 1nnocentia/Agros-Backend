<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Hanya Admin, Bulog, dan Aparat Desa yang bisa lihat list users
        return in_array($user->role?->role_name, ['Admin', 'Bulog', 'Aparat Desa']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Hanya Admin, Bulog, dan Aparat Desa yang bisa lihat detail user
        return in_array($user->role?->role_name, ['Admin', 'Bulog', 'Aparat Desa']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya Admin yang bisa create user baru
        return $user->role?->role_name === 'Admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Admin bisa update semua user
        if ($user->role?->role_name === 'Admin') {
            return true;
        }
        
        // User bisa update profile sendiri
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Hanya Admin yang bisa delete user (kecuali diri sendiri)
        return $user->role?->role_name === 'Admin' && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        // Hanya Admin yang bisa restore user
        return $user->role?->role_name === 'Admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // Hanya Admin yang bisa permanently delete user (kecuali diri sendiri)
        return $user->role?->role_name === 'Admin' && $user->id !== $model->id;
    }
}

<?php

namespace App\Policies;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Sadece super_admin ve admin rol yönetimini görebilir
        return $user->hasRole(['super_admin', 'admin']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        // Sadece super_admin ve admin rolleri görebilir
        return $user->hasRole(['super_admin', 'admin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Sadece super_admin yeni rol oluşturabilir
        return $user->hasRole('super_admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        // Super_admin hepsini, admin sadece editor ve student'ı düzenleyebilir
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('admin')) {
            return in_array($role->name, ['editor', 'student']);
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        // Super_admin hepsini, admin sadece student rolünü silebilir
        if ($user->hasRole('super_admin')) {
            // Super admin rolü silinemez
            return $role->name !== 'super_admin';
        }

        if ($user->hasRole('admin')) {
            return $role->name === 'student';
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $user->hasRole('super_admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return $user->hasRole('super_admin');
    }
}

<?php

namespace App\Policies;

use App\Models\EmailLog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmailLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('email_logs.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EmailLog $emailLog): bool
    {
        return $user->can('email_logs.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false; // Email logları otomatik oluşturulur
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EmailLog $emailLog): bool
    {
        return false; // Email logları değiştirilemez
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EmailLog $emailLog): bool
    {
        return $user->can('email_logs.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EmailLog $emailLog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EmailLog $emailLog): bool
    {
        return false;
    }
}

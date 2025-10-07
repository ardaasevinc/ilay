<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Faq;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any faqs.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('faq.viewAny');
    }

    /**
     * Determine whether the user can view the faq.
     */
    public function view(User $user, Faq $faq)
    {
        return $user->hasPermissionTo('faq.view');
    }

    /**
     * Determine whether the user can create faqs.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('faq.create');
    }

    /**
     * Determine whether the user can update the faq.
     */
    public function update(User $user, Faq $faq)
    {
        return $user->hasPermissionTo('faq.update');
    }

    /**
     * Determine whether the user can delete the faq.
     */
    public function delete(User $user, Faq $faq)
    {
        return $user->hasPermissionTo('faq.delete');
    }
}

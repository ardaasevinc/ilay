<?php

namespace App\Policies;

use App\Models\BrandBrief;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BrandBriefPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('brand_briefs.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BrandBrief $brandBrief): bool
    {
        return $user->can('brand_briefs.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('brand_briefs.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BrandBrief $brandBrief): bool
    {
        return $user->can('brand_briefs.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BrandBrief $brandBrief): bool
    {
        return $user->can('brand_briefs.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BrandBrief $brandBrief): bool
    {
        return $user->can('brand_briefs.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BrandBrief $brandBrief): bool
    {
        return $user->can('brand_briefs.forceDelete');
    }
}

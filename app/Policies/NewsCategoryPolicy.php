<?php

namespace App\Policies;

use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NewsCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('news_categories.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NewsCategory $newsCategory): bool
    {
        return $user->can('news_categories.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('news_categories.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NewsCategory $newsCategory): bool
    {
        return $user->can('news_categories.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NewsCategory $newsCategory): bool
    {
        return $user->can('news_categories.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, NewsCategory $newsCategory): bool
    {
        return $user->can('news_categories.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, NewsCategory $newsCategory): bool
    {
        return $user->can('news_categories.forceDelete');
    }
}

<?php

namespace App\Policies;

use App\Models\Reference;
use App\Models\User;

class ReferencePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('references.index');
    }

    public function view(User $user, Reference $reference): bool
    {
        return $user->can('references.view');
    }

    public function create(User $user): bool
    {
        return $user->can('references.create');
    }

    public function update(User $user, Reference $reference): bool
    {
        return $user->can('references.update');
    }

    public function delete(User $user, Reference $reference): bool
    {
        return $user->can('references.delete');
    }

    public function restore(User $user, Reference $reference): bool
    {
        return $user->can('references.restore');
    }

    public function forceDelete(User $user, Reference $reference): bool
    {
        return $user->can('references.forceDelete');
    }
}

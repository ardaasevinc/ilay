<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subscription;

class SubscriptionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('subscription.viewAny');
    }

    public function view(User $user, Subscription $subscription): bool
    {
        return $user->hasPermissionTo('subscription.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('subscription.create');
    }

    public function update(User $user, Subscription $subscription): bool
    {
        return $user->hasPermissionTo('subscription.update');
    }

    public function delete(User $user, Subscription $subscription): bool
    {
        return $user->hasPermissionTo('subscription.delete');
    }

    public function exportExcel(User $user): bool
    {
        return $user->hasPermissionTo('subscription.export.excel');
    }

    public function exportPdf(User $user): bool
    {
        return $user->hasPermissionTo('subscription.export.pdf');
    }
}

<?php

namespace App\Policies;

use App\Models\ServiceGallery;
use App\Models\User;

class ServiceGalleryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('service_galleries.index');
    }

    public function view(User $user, ServiceGallery $serviceGallery): bool
    {
        return $user->can('service_galleries.view');
    }

    public function create(User $user): bool
    {
        return $user->can('service_galleries.create');
    }

    public function update(User $user, ServiceGallery $serviceGallery): bool
    {
        return $user->can('service_galleries.update');
    }

    public function delete(User $user, ServiceGallery $serviceGallery): bool
    {
        return $user->can('service_galleries.delete');
    }

    public function restore(User $user, ServiceGallery $serviceGallery): bool
    {
        return $user->can('service_galleries.restore');
    }

    public function forceDelete(User $user, ServiceGallery $serviceGallery): bool
    {
        return $user->can('service_galleries.forceDelete');
    }
}

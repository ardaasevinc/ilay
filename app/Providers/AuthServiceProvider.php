<?php

namespace App\Providers;

use App\Models\Faq;
use App\Models\Reference;
use App\Models\User;
use App\Policies\FaqPolicy;
use App\Policies\ReferencePolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\ServicePolicy;
use App\Policies\ServiceCategoryPolicy;
use App\Policies\ServiceGalleryPolicy;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceGallery;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Reference::class => ReferencePolicy::class,
        Service::class => ServicePolicy::class,
        ServiceCategory::class => ServiceCategoryPolicy::class,
        Faq::class => FaqPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate tanımlamaları burada yapılabilir
    }
}

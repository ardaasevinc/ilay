<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // İzin grupları
        $permissions = [
            // Users permissions
            'users.index',
            'users.create',
            'users.view',
            'users.update',
            'users.delete',
            'users.restore',
            'users.forceDelete',
            'users.impersonate',

            // Roles permissions
            'roles.index',
            'roles.create',
            'roles.view',
            'roles.update',
            'roles.delete',

            // Pages permissions
            'pages.index',
            'pages.create',
            'pages.view',
            'pages.update',
            'pages.delete',
            'pages.restore',
            'pages.forceDelete',

            // Reference permissions
            'references.index',
            'references.create',
            'references.view',
            'references.update',
            'references.delete',
            'references.restore',
            'references.forceDelete',

            // Service permissions
            'services.index',
            'services.create',
            'services.view',
            'services.update',
            'services.delete',
            'services.restore',
            'services.forceDelete',

            // Service Category permissions
            'service_categories.index',
            'service_categories.create',
            'service_categories.view',
            'service_categories.update',
            'service_categories.delete',
            'service_categories.restore',
            'service_categories.forceDelete',

            // Settings permissions
            'settings.view',
            'settings.update',

            // Subscription permissions
            'subscription.viewAny',
            'subscription.view',
            'subscription.create',
            'subscription.update',
            'subscription.delete',
            'subscription.export.excel',
            'subscription.export.pdf',

            // FAQ permissions
            'faq.viewAny',
            'faq.view',
            'faq.create',
            'faq.update',
            'faq.delete',

            // Contact permissions
            'contacts.viewAny',
            'contacts.view',
            'contacts.create',
            'contacts.update',
            'contacts.delete',
            'contacts.restore',
            'contacts.forceDelete',

            // Brand Brief permissions
            'brand_briefs.viewAny',
            'brand_briefs.view',
            'brand_briefs.create',
            'brand_briefs.update',
            'brand_briefs.delete',
            'brand_briefs.restore',
            'brand_briefs.forceDelete',

            // Email Log permissions
            'email_logs.viewAny',
            'email_logs.view',
            'email_logs.create',
            'email_logs.update',
            'email_logs.delete',
            'email_logs.export',

            // News permissions
            'news.viewAny',
            'news.view',
            'news.create',
            'news.update',
            'news.delete',
            'news.restore',
            'news.forceDelete',

            // News Category permissions
            'news_categories.viewAny',
            'news_categories.view',
            'news_categories.create',
            'news_categories.update',
            'news_categories.delete',
            'news_categories.restore',
            'news_categories.forceDelete',

            // Slider permissions
            'sliders.viewAny',
            'sliders.view',
            'sliders.create',
            'sliders.update',
            'sliders.delete',
            'sliders.restore',
            'sliders.forceDelete',
        ];

        // İzinleri oluştur
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        // Rolleri oluştur
        $superAdmin = Role::updateOrCreate(['name' => 'super_admin']);
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $editor = Role::updateOrCreate(['name' => 'editor']);
        $student = Role::updateOrCreate(['name' => 'student']);

        // Super Admin - tüm izinler
        $superAdmin->syncPermissions(Permission::all());

        // Admin - user/role yönetiminin çoğu + content yönetimi
        $admin->syncPermissions([
            'users.index',
            'users.create',
            'users.view',
            'users.update',
            'users.delete',
            'roles.index',
            'roles.view',
            'pages.index',
            'pages.create',
            'pages.view',
            'pages.update',
            'pages.delete',
            'pages.restore',
            'settings.view',
            'contacts.viewAny',
            'contacts.view',
            'contacts.update',
            'contacts.delete',
            'brand_briefs.viewAny',
            'brand_briefs.view',
            'brand_briefs.update',
            'brand_briefs.delete',
            'email_logs.viewAny',
            'email_logs.view',
            'email_logs.export',
            'news.viewAny',
            'news.view',
            'news.create',
            'news.update',
            'news.delete',
            'news_categories.viewAny',
            'news_categories.view',
            'news_categories.create',
            'news_categories.update',
            'news_categories.delete',
            'sliders.viewAny',
            'sliders.view',
            'sliders.create',
            'sliders.update',
            'sliders.delete',
            'subscription.viewAny',
            'subscription.view',
            'subscription.create',
            'subscription.update',
            'subscription.delete',
            'faq.viewAny',
            'faq.view',
            'faq.create',
            'faq.update',
            'faq.delete',
        ]);

        // Editor - content creation/editing
        $editor->syncPermissions([
            'users.index',
            'users.view',
            'pages.index',
            'pages.create',
            'pages.view',
            'pages.update',
            'contacts.viewAny',
            'contacts.view',
            'brand_briefs.viewAny',
            'brand_briefs.view',
            'email_logs.viewAny',
            'email_logs.view',
            'news.viewAny',
            'news.view',
            'news.create',
            'news.update',
            'news_categories.viewAny',
            'news_categories.view',
            'news_categories.create',
            'news_categories.update',
            'sliders.viewAny',
            'sliders.view',
            'sliders.create',
            'sliders.update',
            'subscription.viewAny',
            'subscription.view',
            'faq.viewAny',
            'faq.view',
            'faq.create',
            'faq.update',
        ]);

        // Student - sadece sayfa görüntüleme
        $student->syncPermissions([
            'users.view',
            'pages.index',
            'pages.view',
        ]);

        $this->command->info('Roller ve izinler başarıyla oluşturuldu!');
    }
}

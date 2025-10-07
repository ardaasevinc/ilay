<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UsersSeeder::class,
            PageSeeder::class,
            SettingsSeeder::class,
            NewsSeeder::class,
            ServiceSeeder::class,
            ReferenceSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}

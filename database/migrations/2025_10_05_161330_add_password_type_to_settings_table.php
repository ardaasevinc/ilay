<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add password type to the enum
        DB::statement("ALTER TABLE settings MODIFY COLUMN type ENUM('text', 'textarea', 'email', 'url', 'number', 'boolean', 'select', 'image', 'password') DEFAULT 'text'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove password type from enum
        DB::statement("ALTER TABLE settings MODIFY COLUMN type ENUM('text', 'textarea', 'email', 'url', 'number', 'boolean', 'select', 'image') DEFAULT 'text'");
    }
};

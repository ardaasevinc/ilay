<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->onDelete('cascade');
            $table->string('image')->comment('Galeri görseli');
            $table->integer('sort_order')->default(0)->comment('Sıralama');
            $table->boolean('is_active')->default(true)->comment('Aktif/Pasif durumu');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['page_id', 'sort_order']);
            $table->index(['page_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_galleries');
    }
};

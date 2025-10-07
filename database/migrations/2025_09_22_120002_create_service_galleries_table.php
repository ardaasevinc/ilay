<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('img')->comment('Galeri görseli');
            $table->string('title')->nullable()->comment('Görsel başlığı');
            $table->integer('sort_order')->default(0)->comment('Sıralama');
            $table->boolean('is_active')->default(true)->comment('Aktif/Pasif durumu');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['service_id', 'is_active']);
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_galleries');
    }
};

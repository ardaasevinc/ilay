<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable()->comment('Kategori kapak görseli');
            $table->string('title')->comment('Kategori başlığı');
            $table->string('slug')->unique()->comment('SEO dostu URL');
            $table->text('desc')->nullable()->comment('Kategori açıklaması');
            $table->string('seo_title')->nullable()->comment('SEO başlık');
            $table->text('seo_key')->nullable()->comment('SEO anahtar kelimeler');
            $table->text('seo_desc')->nullable()->comment('SEO açıklama');
            $table->boolean('is_active')->default(true)->comment('Aktif/Pasif durumu');
            $table->integer('sort_order')->default(0)->comment('Sıralama');
            $table->timestamp('published_at')->nullable()->comment('Yayın tarihi');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_active', 'published_at']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_categories');
    }
};

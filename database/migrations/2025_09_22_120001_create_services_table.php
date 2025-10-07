<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->constrained('service_categories')->onDelete('cascade');
            $table->string('img')->nullable()->comment('Hizmet kapak görseli');
            $table->string('title')->comment('Hizmet başlığı');
            $table->string('slug')->unique()->comment('SEO dostu URL');
            $table->longText('desc')->comment('Hizmet içeriği');
            $table->string('seo_title')->nullable()->comment('SEO başlık');
            $table->text('seo_key')->nullable()->comment('SEO anahtar kelimeler');
            $table->text('seo_desc')->nullable()->comment('SEO açıklama');
            $table->boolean('is_active')->default(true)->comment('Aktif/Pasif durumu');
            $table->boolean('is_home')->default(false)->comment('Anasayfada göster');
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
        Schema::dropIfExists('services');
    }
};

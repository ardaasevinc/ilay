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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('img')->comment('Slider görseli');
            $table->string('title')->comment('Slider başlığı');
            $table->text('description')->comment('Slider açıklaması');
            $table->tinyInteger('type_id')->default(1)->comment('1: Direkt URL, 2: Sayfa, 3: Haber');
            $table->string('type_content')->nullable()->comment('URL veya ilgili model ID');
            $table->boolean('is_active')->default(true)->comment('Aktif durumu');
            $table->integer('order')->default(0)->comment('Sıralama');
            $table->timestamps();

            $table->index(['is_active', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};

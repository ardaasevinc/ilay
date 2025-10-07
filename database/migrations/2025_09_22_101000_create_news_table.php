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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_category_id')->constrained('news_categories')->onDelete('cascade');
            $table->string('img')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('desc');
            $table->string('seo_title')->nullable();
            $table->text('seo_key')->nullable();
            $table->text('seo_desc')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_home')->default(0);
            $table->timestamps();
            
            $table->index(['is_active', 'created_at']);
            $table->index(['news_category_id', 'is_active']);
            $table->index(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

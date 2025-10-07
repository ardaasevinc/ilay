<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('desc')->nullable();
            $table->string('url')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_key')->nullable();
            $table->string('seo_desc')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_home')->default(0);
            $table->integer('order')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('references');
    }
};

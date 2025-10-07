<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reference_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reference_id')->constrained('references')->onDelete('cascade');
            $table->string('img');
            $table->string('order_number')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reference_galleries');
    }
};

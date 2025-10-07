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
        Schema::create('brand_briefs', function (Blueprint $table) {
            $table->id();

            // 1. Marka Bilgileri
            $table->string('brand_name');
            $table->string('website')->nullable();
            $table->text('social_links')->nullable(); // çoklu linkleri satır satır/JSON tutabilirsin
            $table->string('sector')->nullable();
            $table->unsignedSmallInteger('years_active')->nullable();
            $table->text('brand_summary')->nullable();
            $table->text('target_audience')->nullable();

            // 2. Hedefler & Konumlama
            $table->json('priority_goals')->nullable(); // checkbox list
            $table->text('competitor_analysis')->nullable();
            $table->text('market_position')->nullable();

            // 3. Mevcut Durum
            $table->string('three_words')->nullable();
            $table->text('strength')->nullable();
            $table->text('edge_against_competitors')->nullable();
            $table->text('weakness')->nullable();
            $table->boolean('has_social_management')->nullable();
            $table->boolean('outsourced_social')->nullable();
            $table->json('marketing_tools')->nullable(); // checkbox + diğer

            // 4. Görsel Kimlik
            $table->string('logo_satisfaction')->nullable(); // Evet/Hayır/Kısmen
            $table->json('corporate_assets')->nullable();    // Logo/Renk/Tipografi/Kartvizit vb.
            $table->boolean('has_media_assets')->nullable(); // foto/video var mı
            $table->string('design_representation')->nullable(); // Evet/Hayır/Emin değilim

            // 5. Dijital
            $table->boolean('has_website')->nullable();
            $table->string('is_mobile_ready')->nullable(); // Evet/Hayır/Emin değilim
            $table->string('has_seo')->nullable();         // Evet/Hayır/Emin değilim
            $table->text('web_performance_feedback')->nullable();

            // 6. İletişim
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->string('preferred_contact')->nullable(); // Telefon/WhatsApp/E-posta
            $table->string('heard_from')->nullable();        // Instagram/Google/Öneri/Diğer

            // Admin alanları
            $table->string('status')->default('pending'); // pending|in_review|completed
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_briefs');
    }
};

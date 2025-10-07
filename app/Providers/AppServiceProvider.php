<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Production'da HTTPS'i zorla
        URL::forceScheme('https');

        // Global settings paylaşımı
        try {
            $settings = \App\Models\Setting::pluck('value', 'key');
            $pages = \App\Models\Page::active()->ordered()->get();
            $serviceCategories = \App\Models\ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();
            $services = \App\Models\Service::where('is_active', true)->orderBy('sort_order')->get();
            $news = \App\Models\News::where('is_active', true)->latest()->take(5)->get();
            $references = \App\Models\Reference::where('is_active', true)->orderBy('sort_order')->take(5)->get();

            view()->share('settings', $settings);
            view()->share('pages', $pages);
            view()->share('serviceCategories', $serviceCategories);
            view()->share('services', $services);
            view()->share('news', $news);
            view()->share('references', $references);
        } catch (\Exception $e) {
            // Migration sırasında tablolar henüz oluşturulmamışsa boş array'ler paylaş
            view()->share('settings', []);
            view()->share('pages', new \Illuminate\Database\Eloquent\Collection());
            view()->share('serviceCategories', new \Illuminate\Database\Eloquent\Collection());
            view()->share('services', new \Illuminate\Database\Eloquent\Collection());
            view()->share('news', new \Illuminate\Database\Eloquent\Collection());
            view()->share('references', new \Illuminate\Database\Eloquent\Collection());
        }
    }
}

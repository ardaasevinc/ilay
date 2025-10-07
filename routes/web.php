<?php

use App\Http\Controllers\BrandBriefController;
use App\Http\Controllers\BriefRequestController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReferenceController;
use Illuminate\Support\Facades\Route;

// SEO Routes (robots.txt, sitemap.xml)
Route::get('/robots.txt', [FrontendController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [FrontendController::class, 'sitemap'])->name('sitemap');

Route::name('frontend.')->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('/hakkimizda', [FrontendController::class, 'about'])->name('about');
    Route::get('/iletisim', [FrontendController::class, 'contact'])->name('contact');
    Route::get('/arama', [FrontendController::class, 'search'])->name('search');

    // Contact Routes
    Route::prefix('iletisim')->name('contact.')->group(function () {
        Route::post('/', [\App\Http\Controllers\ContactController::class, 'store'])->name('store');
    });

    // Subscription Routes
    Route::prefix('subscription')->name('subscription.')->group(function () {
        Route::post('/store', [SubscriptionController::class, 'store'])->name('store');
    });

    // FAQ Routes
    Route::prefix('sss')->name('faqs.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('/{slug}', [FaqController::class, 'show'])->name('show');
    });
    // Page (Sayfa) Routes
    Route::name('page.')->group(function () {
        Route::get('/sayfa/{slug}', [PageController::class, 'show'])->name('show');
    });

    // Brand Brief (Detaylı Marka Analizi) Routes
    Route::name('brand-brief.')->group(function () {
        Route::get('/marka-analizi', [BrandBriefController::class, 'create'])->name('create');
        Route::post('/marka-analizi', [BrandBriefController::class, 'store'])->name('store');
        Route::get('/marka-analizi/tesekkurler', [BrandBriefController::class, 'thankyou'])->name('thankyou');
        Route::get('/marka-analizi/sifirla', [BrandBriefController::class, 'clearSession'])->name('clear');
    });
    // News (Blog) Routes
    Route::name('news.')->group(function () {
        Route::get('/blog', [NewsController::class, 'index'])->name('index');
        Route::get('/kategori/{slug}', [NewsController::class, 'category'])->name('category');
        Route::get('/etiket/{slug}', [NewsController::class, 'tag'])->name('tag');
        Route::get('/blog/{slug}', [NewsController::class, 'show'])->name('show');
    });
    // Service (Hizmet) Routes
    Route::name('service.')->group(function () {
        Route::get('/hizmetler', [ServiceController::class, 'index'])->name('index');
        Route::get('/hizmet-kategori/{slug}', [ServiceController::class, 'category'])->name('category');
        Route::get('/hizmet/{slug}', [ServiceController::class, 'show'])->name('show');
    });

    // Reference (Referans) Routes
    Route::name('reference.')->group(function () {
        Route::get('/referanslar', [ReferenceController::class, 'index'])->name('index');
        Route::get('/referans/{slug}', [ReferenceController::class, 'show'])->name('show');
        Route::get('/referans-kategori/{categorySlug}', [ReferenceController::class, 'category'])->name('category');
    });
});

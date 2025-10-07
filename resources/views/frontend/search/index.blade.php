@extends('frontend.master')

@section('seo')
    <title>
        {{ $settings['site_title'] ?? ($settings['site_name'] ?? 'Bexon - Corporate Business HTML Template') }}
    </title>
    <meta name="description" content="{{ $settings['site_description'] ?? '' }}">
    <meta name="keywords" content="{{ $settings['site_keywords'] ?? '' }}">
    <meta name="robots" content="{{ $settings['site_robots'] ?? 'index,follow' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $settings['site_title'] ?? ($settings['site_name'] ?? '') }}">
    <meta property="og:description" content="{{ $settings['site_description'] ?? '' }}">
    <meta property="og:image"
        content="{{ asset($settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/og-default.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $settings['site_title'] ?? ($settings['site_name'] ?? '') }}">
    <meta name="twitter:description" content="{{ $settings['site_description'] ?? '' }}">
    <meta name="twitter:image"
        content="{{ asset($settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/og-default.jpg') }}">
@endsection
@section('content')
    <!-- start: Breadcrumb Section -->
    <section class="tj-page-header section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">Arama Sonuçları</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span><a href="{{ route('frontend.index') }}">Anasayfa</a></span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>Arama</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header-overlay" data-bg-image="{{ asset('frontend/assets/images/shape/pheader-overlay.webp') }}">
        </div>
    </section>
    <!-- end: Breadcrumb Section -->

    <!-- start: Search Results Section -->
    <section class="tj-blog-section section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-info mb-5">
                        <h3 class="search-title">"{{ $query }}" için arama sonuçları</h3>
                        <p class="search-count">Toplam {{ $totalResults }} sonuç bulundu</p>

                        <!-- Search Form -->
                        <div class="search-form-wrapper mt-4">
                            <form action="{{ route('frontend.search') }}" method="GET" class="search-form">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control"
                                        placeholder="Sayfa, haber, hizmet, referans arayın..." value="{{ $query }}">
                                    <button class="tj-primary-btn" type="submit">
                                        <span class="btn-text"><span>Ara</span></span>
                                        <span class="btn-icon"><i class="tji-search"></i></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($totalResults > 0)
                        <!-- Pages Results -->
                        @if($pages->count() > 0)
                            <div class="search-category mb-5">
                                <h4 class="category-title">Kurumsal Sayfalar ({{ $pages->count() }})</h4>
                                <div class="row">
                                    @foreach($pages as $page)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="search-result-item">
                                                <div class="result-content">
                                                    <span class="result-type">Sayfa</span>
                                                    <h5 class="result-title">
                                                        <a href="{{ route('frontend.page.show', $page->slug) }}">
                                                            {{ $page->title }}
                                                        </a>
                                                    </h5>
                                                    <p class="result-desc">
                                                        {{ Str::limit(strip_tags($page->desc), 120) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- News Results -->
                        @if($news->count() > 0)
                            <div class="search-category mb-5">
                                <h4 class="category-title">Blog Yazıları ({{ $news->count() }})</h4>
                                <div class="row">
                                    @foreach($news as $item)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="search-result-item">
                                                <div class="result-image">
                                                    <a href="{{ route('frontend.news.show', $item->slug) }}">
                                                        <img src="{{ asset('uploads/' . ($item->img ?? $settings['site_logo'] ?? 'default-image.jpg')) }}"
                                                            alt="{{ $item->title }}" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="result-content">
                                                    <span class="result-type">Blog</span>
                                                    <div class="result-meta">
                                                        <span>{{ $item->created_at->format('d.m.Y') }}</span>
                                                        @if($item->news_category)
                                                            <span>{{ $item->news_category->title }}</span>
                                                        @endif
                                                    </div>
                                                    <h5 class="result-title">
                                                        <a href="{{ route('frontend.news.show', $item->slug) }}">
                                                            {{ $item->title }}
                                                        </a>
                                                    </h5>
                                                    <p class="result-desc">
                                                        {{ Str::limit(strip_tags($item->desc), 120) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Services Results -->
                        @if($services->count() > 0)
                            <div class="search-category mb-5">
                                <h4 class="category-title">Hizmetler ({{ $services->count() }})</h4>
                                <div class="row">
                                    @foreach($services as $service)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="search-result-item">
                                                <div class="result-content">
                                                    <span class="result-type">Hizmet</span>
                                                    @if($service->service_category)
                                                        <div class="result-meta">
                                                            <span>{{ $service->service_category->title }}</span>
                                                        </div>
                                                    @endif
                                                    <h5 class="result-title">
                                                        <a href="{{ route('frontend.service.show', $service->slug) }}">
                                                            {{ $service->title }}
                                                        </a>
                                                    </h5>
                                                    <p class="result-desc">
                                                        {{ Str::limit(strip_tags($service->desc), 120) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- References Results -->
                        @if($references->count() > 0)
                            <div class="search-category mb-5">
                                <h4 class="category-title">Referanslar ({{ $references->count() }})</h4>
                                <div class="row">
                                    @foreach($references as $reference)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="search-result-item">
                                                <div class="result-image">
                                                    <a href="{{ route('frontend.reference.show', $reference->slug) }}">
                                                        <img src="{{ asset('uploads/' . ($reference->img ?? $settings['site_logo'] ?? 'default-image.jpg')) }}"
                                                            alt="{{ $reference->title }}" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="result-content">
                                                    <span class="result-type">Referans</span>
                                                    @if($reference->services->count() > 0)
                                                        <div class="result-meta">
                                                            <span>{{ $reference->services->first()->service_category->title ?? 'Genel' }}</span>
                                                        </div>
                                                    @endif
                                                    <h5 class="result-title">
                                                        <a href="{{ route('frontend.reference.show', $reference->slug) }}">
                                                            {{ $reference->title }}
                                                        </a>
                                                    </h5>
                                                    <p class="result-desc">
                                                        {{ Str::limit(strip_tags($reference->desc), 120) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Service Categories Results -->
                        @if($serviceCategories->count() > 0)
                            <div class="search-category mb-5">
                                <h4 class="category-title">Hizmet Kategorileri ({{ $serviceCategories->count() }})</h4>
                                <div class="row">
                                    @foreach($serviceCategories as $category)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="search-result-item">
                                                <div class="result-content">
                                                    <span class="result-type">Kategori</span>
                                                    <h5 class="result-title">
                                                        <a href="{{ route('frontend.service.category', $category->slug) }}">
                                                            {{ $category->title }}
                                                        </a>
                                                    </h5>
                                                    <p class="result-desc">
                                                        {{ Str::limit(strip_tags($category->desc), 120) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- News Categories Results -->
                        @if($newsCategories->count() > 0)
                            <div class="search-category mb-5">
                                <h4 class="category-title">Blog Kategorileri ({{ $newsCategories->count() }})</h4>
                                <div class="row">
                                    @foreach($newsCategories as $category)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="search-result-item">
                                                <div class="result-content">
                                                    <span class="result-type">Blog Kategorisi</span>
                                                    <h5 class="result-title">
                                                        <a href="{{ route('frontend.news.category', $category->slug) }}">
                                                            {{ $category->title }}
                                                        </a>
                                                    </h5>
                                                    <p class="result-desc">
                                                        {{ Str::limit(strip_tags($category->desc), 120) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    @else
                        <!-- No Results -->
                        <div class="no-results text-center py-5">
                            <div class="no-results-icon mb-4">
                                <i class="tji-search" style="font-size: 4rem; color: #ddd;"></i>
                            </div>
                            <h4>Sonuç bulunamadı</h4>
                            <p class="text-muted">"{{ $query }}" için herhangi bir sonuç bulunamadı. Farklı anahtar kelimeler
                                deneyin.</p>

                            <div class="search-suggestions mt-4">
                                <h6>Öneriler:</h6>
                                <ul class="list-unstyled">
                                    <li>• Yazım hatası olup olmadığını kontrol edin</li>
                                    <li>• Daha genel anahtar kelimeler kullanın</li>
                                    <li>• Farklı eş anlamlı kelimeler deneyin</li>
                                </ul>
                            </div>

                            <div class="quick-links mt-4">
                                <a href="{{ route('frontend.service.index') }}" class="tj-primary-btn me-3">
                                    <span class="btn-text"><span>Hizmetler</span></span>
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </a>
                                <a href="{{ route('frontend.reference.index') }}" class="tj-primary-btn">
                                    <span class="btn-text"><span>Referanslar</span></span>
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- end: Search Results Section -->
@endsection

<style>
    .search-result-item {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        height: 100%;
        transition: all 0.3s ease;
    }

    .search-result-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }

    .result-image {
        margin-bottom: 15px;
    }

    .result-image img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
    }

    .result-type {
        background: #007bff;
        color: white;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .result-meta {
        margin: 8px 0;
        font-size: 12px;
        color: #666;
    }

    .result-meta span {
        margin-right: 10px;
    }

    .result-title {
        margin: 10px 0;
    }

    .result-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .result-title a:hover {
        color: #007bff;
    }

    .result-desc {
        color: #666;
        font-size: 14px;
        line-height: 1.5;
    }

    .search-count {
        color: #666;
        margin-bottom: 20px;
    }

    .category-title {
        color: #333;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 30px;
    }

    .search-form-wrapper {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group .form-control {
        flex: 1;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        margin-right: 10px;
    }
</style>
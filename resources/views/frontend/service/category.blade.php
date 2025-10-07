@extends('frontend.master')
@section('seo')
    <title>{{ $category->seo_title ?? $category->title }}</title>
    <meta name="description" content="{{ $category->seo_desc ?? '' }}">
    <meta name="keywords" content="{{ $category->seo_key ?? '' }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $category->seo_title ?? $category->title }}">
    <meta property="og:description" content="{{ $category->seo_desc ?? '' }}">
    <meta property="og:image"
        content="{{ asset($category->img ? 'uploads/' . $category->img : 'uploads/' . $settings['site_logo']) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $category->seo_title ?? $category->title }}">
    <meta name="twitter:description" content="{{ $category->seo_desc ?? '' }}">
    <meta name="twitter:image"
        content="{{ asset($category->img ? 'uploads/' . $category->img : 'uploads/' . $settings['site_logo']) }}">
@endsection

@section('content')
    <section class="tj-page-header section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">{{ $category->title }}</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="{{ route('frontend.index') }}">Anasayfa</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <span>{{ $category->title }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header-overlay" data-bg-image="{{ asset('frontend/assets/images/shape/pheader-overlay.webp') }}">
        </div>
    </section>
    <!-- end: Breadcrumb Section -->

    <section class="tj-service-list section-gap">
        <div class="container">
            <div class="row row-gap-4">
                @forelse($servicesCat as $service)
                    <div class="col-xl-4 col-md-6">
                        <div class="service-item wow fadeInUp" data-wow-delay=".{{ $loop->iteration * 2 }}s">
                            <div class="service-img">
                                <img src="{{ asset($service->img ? 'uploads/' . $service->img : 'uploads/' . ($settings['site_logo'] ?? '')) }}"
                                    alt="{{ $service->title }}"
                                    onerror="this.onerror=null;this.src='{{ asset('uploads/' . ($settings['site_logo'] ?? '')) }}';">
                            </div>
                            <div class="service-content">
                                <h4 class="title">{{ $service->title }}</h4>
                                <p>{{ $service->short_desc }}</p>
                                <a class="service-btn" href="{{ route('frontend.service.show', $service->slug) }}">
                                    <i class="tji-arrow-right-big"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning">Bu kategoriye ait hizmet bulunamadı.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

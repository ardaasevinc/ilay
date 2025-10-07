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
        content="{{ asset($settings['site_logo'] ?? false ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/og-default.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $settings['site_title'] ?? ($settings['site_name'] ?? '') }}">
    <meta name="twitter:description" content="{{ $settings['site_description'] ?? '' }}">
    <meta name="twitter:image"
        content="{{ asset($settings['site_logo'] ?? false ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/og-default.jpg') }}">
@endsection


@section('content')
    <!-- start: Breadcrumb Section -->
    <section class="tj-page-header section-gap-x" data-bg-image="assets/images/bg/pheader-bg.webp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">Hizmetlerimiz</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="{{ route('frontend.index') }}">Anasayfa</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <span>Hizmetlerimiz</span>
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
    <!-- start: Project Section -->
    <section class="tj-project-section section-gap">
        <div class="container">
            <div class="row row-gap-4">
                @forelse($serviceCategories as $category)
                    <div class="col-xl-6 col-md-6">
                        <div class="project-item wow fadeInUp" data-wow-delay=".{{ $loop->iteration * 2 }}s">
                            <div class="project-img">
                                <img src="{{ asset($category->img ? 'uploads/' . $category->img : 'uploads/' . $settings['site_logo']) }}"
                                    alt="{{ $category->title }}">
                            </div>
                            <div class="project-content">
                                <span class="categories"><a
                                        href="{{ route('frontend.service.category', $category->slug) }}">Alt
                                        Hizmetlerimiz</a></span>
                                <div class="project-text">
                                    <h4 class="title"><a
                                            href="{{ route('frontend.service.category', $category->slug) }}">{{ $category->title }}</a>
                                    </h4>
                                    <a class="project-btn"
                                        href="{{ route('frontend.service.category', $category->slug) }}">
                                        <i class="tji-arrow-right-big"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning">Herhangi bir hizmet kategorisi bulunamadı.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- end: Project Section -->
@endsection

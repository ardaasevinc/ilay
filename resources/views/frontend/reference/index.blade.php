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
        content="{{ !empty($settings['site_logo']) ? asset('uploads/' . $settings['site_logo']) : asset('frontend/assets/images/og-default.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $settings['site_title'] ?? ($settings['site_name'] ?? '') }}">
    <meta name="twitter:description" content="{{ $settings['site_description'] ?? '' }}">
    <meta name="twitter:image"
        content="{{ !empty($settings['site_logo']) ? asset('uploads/' . $settings['site_logo']) : asset('frontend/assets/images/og-default.jpg') }}">
@endsection


@section('content')
    <!-- start: Breadcrumb Section -->
    <section class="tj-page-header section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">Referanslarımız</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="{{ route('frontend.index') }}">Anasayfa</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>Referanslar</span>
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
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading style-2 text-center">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">Başarı Hikayeleri</span>
                        <h2 class="sec-title text-anim">Gerçekleştirdiğimiz <span>Projeler</span></h2>
                        <p class="desc wow fadeInUp" data-wow-delay=".5s">
                            Müşterilerimizle birlikte hayata geçirdiğimiz başarılı projeler ve çözümler.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row row-gap-4">
                @forelse ($references as $reference)
                    <div class="col-lg-4 col-md-6">
                        <div class="project-item wow fadeInUp" data-wow-delay="{{ 0.1 * $loop->iteration }}s">
                            <div class="project-img">
                                <img src="{{ asset('uploads/' . ($reference->img ?? $settings['site_logo'] ?? 'default-image.jpg')) }}"
                                    alt="{{ $reference->title }}"
                                    onerror="this.onerror=null; this.src='{{ asset('uploads/' . ($settings['site_logo'] ?? 'frontend/assets/images/logos/logo-2.webp')) }}';">
                            </div>
                            <div class="project-content">
                                <span class="categories">
                                    @if($reference->services->count() > 0)
                                        <a
                                            href="{{ route('frontend.reference.show', $reference->slug) }}">{{ $reference->services->first()->service_category->title ?? 'Genel' }}</a>
                                    @else
                                        <a href="{{ route('frontend.reference.show', $reference->slug) }}">Referans</a>
                                    @endif
                                </span>
                                <div class="project-text">
                                    <h4 class="title">
                                        <a
                                            href="{{ route('frontend.reference.show', $reference->slug) }}">{{ $reference->title }}</a>
                                    </h4>
                                    <p class="desc">{!! Str::limit($reference->desc, 80) !!}</p>
                                    <a class="project-btn" href="{{ route('frontend.reference.show', $reference->slug) }}">
                                        <i class="tji-arrow-right-big"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center">
                            <p>Henüz referans bulunmamaktadır.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($references->hasPages())
                <div class="row">
                    <div class="col-12">
                        <div class="tj-pagination text-center mt-5 wow fadeInUp" data-wow-delay=".3s">
                            {{ $references->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- end: Project Section -->
@endsection
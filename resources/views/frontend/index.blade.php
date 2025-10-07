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
    <!-- start: Banner Slider -->
    <section class="tj-slider-section">
        <div class="swiper hero-slider">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide tj-slider-item">
                        <div class="slider-bg-image" data-bg-image="{{ asset('uploads/' . $slider->img) }}"></div>
                        <div class="container">
                            <div class="slider-wrapper">
                                <div class="slider-content">
                                    <h1 class="slider-title">{{ $slider->title }}</h1>
                                    <div class="slider-desc">{{ $slider->description }}</div>
                                    @if ($slider->type_id === 1 && $slider->type_content)
                                        <div class="slider-btn">
                                            <a class="tj-primary-btn" href="{{ $slider->type_content }}">
                                                <span class="btn-text"><span>Detaylı İncele</span></span>
                                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                            </a>
                                        </div>
                                    @elseif($slider->type_id === 2 && $slider->getRelatedContent())
                                        <div class="slider-btn">
                                            <a class="tj-primary-btn" href="{{ $slider->type_content }}">
                                                <span class="btn-text"><span>Detaylı İncele</span></span>
                                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                            </a>
                                        </div>
                                        {{-- @include('frontend.partials.brief-request-form') --}}
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="hero-navigation d-inline-flex wow fadeIn" data-wow-delay="1.5s">
                <div class="slider-prev">
                    <span class="anim-icon">
                        <i class="tji-arrow-left"></i>
                        <i class="tji-arrow-left"></i>
                    </span>
                </div>
                <div class="slider-next">
                    <span class="anim-icon">
                        <i class="tji-arrow-right"></i>
                        <i class="tji-arrow-right"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="swiper hero-thumb wow fadeIn" data-wow-delay="2s">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide thumb-item">
                        <img src="{{ asset('uploads/' . $slider->img) }}" alt="Thumbnail"
                            style="width:100%;height:100%;object-fit:cover;">
                    </div>
                @endforeach

            </div>
        </div>
        <div class="circle-text-wrap wow fadeInUp" data-wow-delay="1s">
            <span class="circle-text" data-bg-image="{{ asset('frontend/assets/images/hero/circle-text.webp') }}"></span>
            <a class="circle-icon" href="{{ route('frontend.service.index') }}"><i class="tji-arrow-down-big"></i></a>
        </div>
    </section>
    <!-- end: Banner Slider -->


    <!-- start: Working process Section -->
    <div class="tj-working-process section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">Marka Analiz Süreci</span>
                        <div class="heading-wrap-content">
                            <div class="sec-heading style-2">
                                <h2 class="sec-title text-anim">Marka Analizinde <span>Adım Adım Çözüm</span></h2>
                            </div>
                            <p class="desc wow fadeInUp" data-wow-delay=".5s">Markanız için özel analiz ve yol haritası:
                                Hedeflerinizi, sorunlarınızı ve dijital
                                varlıklarınızı birlikte değerlendiriyoruz.</p>
                            <div class="btn-wrap wow fadeInUp" data-wow-delay=".6s">
                                <a class="tj-primary-btn" href="#brief-form">
                                    <span class="btn-text"><span>Marka Analiz Formuna Git</span></span>
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="working-process-area">
                        <div class="process-item wow fadeInLeft" data-wow-delay=".5s">
                            <div class="process-step">
                                <span>01</span>
                            </div>
                            <div class="process-content">
                                <h4 class="title">Marka Bilgileri</h4>
                                <p class="desc">Markanızın temel bilgileri ve iletişim detayları alınır.</p>
                            </div>
                        </div>
                        <div class="process-item wow fadeInLeft" data-wow-delay=".6s">
                            <div class="process-step">
                                <span>02</span>
                            </div>
                            <div class="process-content">
                                <h4 class="title">Hedefler & Sorunlar</h4>
                                <p class="desc">Markanızın hedefleri ve mevcut sorunları belirlenir.</p>
                            </div>
                        </div>
                        <div class="process-item wow fadeInLeft" data-wow-delay=".7s">
                            <div class="process-step">
                                <span>03</span>
                            </div>
                            <div class="process-content">
                                <h4 class="title">Rakip Analizi</h4>
                                <p class="desc">Sektördeki rakipleriniz ve konumunuz analiz edilir.</p>
                            </div>
                        </div>
                        <div class="process-item wow fadeInLeft" data-wow-delay=".8s">
                            <div class="process-step">
                                <span>04</span>
                            </div>
                            <div class="process-content">
                                <h4 class="title">Görsel Kimlik</h4>
                                <p class="desc">Logo, kurumsal kimlik ve marka görselleriniz değerlendirilir.</p>
                            </div>
                        </div>
                        <div class="process-item wow fadeInLeft" data-wow-delay=".9s">
                            <div class="process-step">
                                <span>05</span>
                            </div>
                            <div class="process-content">
                                <h4 class="title">Dijital Varlıklar</h4>
                                <p class="desc">Web sitesi, sosyal medya ve dijital varlıklarınız incelenir.</p>
                            </div>
                        </div>
                        <div class="process-item wow fadeInLeft" data-wow-delay="1.0s">
                            <div class="process-step">
                                <span>06</span>
                            </div>
                            <div class="process-content">
                                <h4 class="title">Sonuç & İletişim</h4>
                                <p class="desc">Analiz tamamlanır ve size özel çözüm önerileri sunulur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-shape-1">
            <img src="{{ asset('frontend/assets/images/shape/pattern-2.svg') }}" alt="">
        </div>
        <div class="bg-shape-2">
            <img src="{{ asset('frontend/assets/images/shape/pattern-3.svg') }}" alt="">
        </div>
    </div>
    <!-- end: Working process Section -->

    <!-- start: Reference Section -->
    <section class="h9-service section-gap  section-gap-x tj-sticky-panel-container-2 tj-progress-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 ">
                    <div class="sec-heading style-8  tj-sticky-panel-2">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">REFERANSLARIMIZ</span>
                        <h2 class="sec-title title-anim">Başarılı Projelerimiz ve Çözümlerimiz</h2>
                        <div class="h9-service-more wow fadeInUp" data-wow-delay=".3s">
                            <a class="tj-primary-btn" href="{{ route('frontend.reference.index') }}">
                                <span class="btn-text"><span>Tüm Referanslar</span></span>
                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 ">
                    <div class="h9-service-scroll-progress tj-scroll-progress tj-sticky-panel-2">
                        @foreach($references->take(4) as $index => $reference)
                            <div class="tj-scroll-progress-item {{ $index === 0 ? 'active' : '' }}">
                                <h5 class="tj-scroll-progress-sln">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.</h5>
                                <div class="tj-scroll-progress-ind">
                                    <div class="tj-scroll-progress-ind-inner"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="service-wrapper h9-service-wrapper">
                        @foreach($references->take(4) as $reference)
                            <div class="service-item style-5 tj-progress-item">
                                <div class="service-content-area">
                                    <div class="service-icon">
                                        <i class="tji-chart"></i>
                                    </div>
                                    <div class="service-content">
                                        <h4 class="title">
                                            <a href="{{ route('frontend.reference.show', $reference->slug) }}">
                                                {{ $reference->title }}
                                            </a>
                                        </h4>
                                        <p class="desc">{{ Str::limit(strip_tags($reference->desc), 120) }}</p>
                                        @if($reference->services->count() > 0)
                                            <div class="reference-services" style="margin-top: 15px;">
                                                <span
                                                    style="font-size: 12px; color: #666; text-transform: uppercase; font-weight: 600;">
                                                    Hizmetler:
                                                </span>
                                                <div style="margin-top: 5px;">
                                                    @foreach($reference->services->take(3) as $service)
                                                        <span style="display: inline-block; background: #f8f9fa;
                                                                                     padding: 2px 8px; border-radius: 12px;
                                                                                     font-size: 11px; margin-right: 5px;
                                                                                     margin-bottom: 3px; color: #495057;">
                                                            {{ $service->title }}
                                                        </span>
                                                    @endforeach
                                                    @if($reference->services->count() > 3)
                                                        <span style="font-size: 11px; color: #6c757d;">
                                                            +{{ $reference->services->count() - 3 }} daha
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('frontend.reference.show', $reference->slug) }}" class="h9-service-nav">
                                        <i class="tji-arrow-right-long"></i>
                                    </a>
                                </div>
                                <div class="service-img">
                                    <img src="{{ asset('uploads/' . ($reference->img ?? $settings['site_logo'] ?? 'default-image.jpg')) }}"
                                        alt="{{ $reference->title }}"
                                        onerror="this.onerror=null; this.src='{{ asset('uploads/' . ($settings['site_logo'] ?? 'frontend/assets/images/logos/logo-2.webp')) }}';">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-shape-1">
            <img src="{{ asset('frontend/assets/images/shape/pattern-2.svg') }}" alt="">
        </div>
        <div class="bg-shape-2">
            <img src="{{ asset('frontend/assets/images/shape/pattern-3.svg') }}" alt="">
        </div>
        <div class="bg-shape-3">
            <img src="{{ asset('frontend/assets/images/shape/h7-testimonial-shape-blur.svg') }}" alt="">
        </div>
    </section>
    <!-- end: Reference Section -->


    <!-- start: Project Section -->
    <section class="tj-project-section-2 section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading style-2 text-center">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">Öne Çıkan Hizmetlerimiz</span>
                        <h2 class="sec-title text-anim">Markanız İçin <span>Gerçek Başarılar</span></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="project-wrapper wow fadeInUp" data-wow-delay=".5s">
                        <div class="swiper project-slider">
                            <div class="swiper-wrapper">
                                @foreach ($serviceCategories as $category)
                                    @if ($category)
                                        <div class="swiper-slide">
                                            <div class="project-item">
                                                <div class="project-img" data-bg-image="{{ asset('uploads/' . $category->img) }}">
                                                </div>
                                                <div class="project-content">
                                                    <span class="categories"><a
                                                            href="{{ route('frontend.service.category', $category->slug) }}">{{ $category->title }}</a></span>
                                                    <div class="project-text">
                                                        <h3 class="title"><a
                                                                href="{{ route('frontend.service.category', $category->slug) }}">{{ $category->title }}</a>
                                                        </h3>
                                                        <a class="project-btn"
                                                            href="{{ route('frontend.service.category', $category->slug) }}">
                                                            <i class="tji-arrow-right-big"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="swiper-pagination-area"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Project Section -->
    <!-- start: Our Solutions section -->
    <section class="tj-service-section service-2 section-gap section-gap-x slidebar-stickiy-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="content-wrap slidebar-stickiy">
                        <div class="sec-heading style-2">
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">Çözümlerimiz</span>
                            <h2 class="sec-title text-white text-anim">Sizin için özel iş çözümleri</h2>
                        </div>
                        <div class="wow fadeInUp" data-wow-delay=".6s">
                            <a class="tj-primary-btn" href="#">
                                <span class="btn-text"><span>Tüm Hizmetler</span></span>
                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="service-wrapper-2">
                        @foreach ($services->take(10) ?? [] as $service)
                            @if ($service)
                                <div class="service-item-wrapper tj-fadein-right-on-scroll">
                                    <div class="service-item style-2">
                                        <div class="title-area">
                                            <h4 class="title">{{ $service->title }}</h4>
                                        </div>
                                        <div class="service-content">
                                            <p class="text-white">{{ $service->desc }}</p>
                                            <a class="tj-primary-btn"
                                                href="{{ route('frontend.service.category', $service->slug) }}">
                                                <span class="btn-text"><span>Detaylı İncele</span></span>
                                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-shape-1">
            <img src="{{ asset('frontend/assets/images/shape/pattern-2.svg') }}" alt="">
        </div>
        <div class="bg-shape-2">
            <img src="{{ asset('frontend/assets/images/shape/pattern-3.svg') }}" alt="">
        </div>
        <div class="bg-shape-3">
            <img src="{{ asset('frontend/assets/images/shape/shape-blur.svg') }}" alt="">
        </div>
    </section>
    <!-- end: Our Solutions section -->
    <section class="tj-blog-section-2 section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">Blog & Haberler</span>
                        <div class="heading-wrap-content">
                            <div class="sec-heading style-2">
                                <h2 class="sec-title text-anim">Stratejiler ve <span>Güncel İçerikler</span></h2>
                            </div>
                            <div class="wow fadeInUp" data-wow-delay=".5s">
                                <p class="desc">Marka ve dijital dünyaya dair güncel haberler, ipuçları ve stratejiler.
                                </p>
                            </div>
                            <div class="slider-navigation d-none d-md-inline-flex wow fadeInUp" data-wow-delay=".7s">
                                <div class="slider-prev">
                                    <span class="anim-icon">
                                        <i class="tji-arrow-left"></i>
                                        <i class="tji-arrow-left"></i>
                                    </span>
                                </div>
                                <div class="slider-next">
                                    <span class="anim-icon">
                                        <i class="tji-arrow-right"></i>
                                        <i class="tji-arrow-right"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-wrapper wow fadeIn" data-wow-delay=".5s">
                        <div class="swiper blog-slider">
                            <div class="swiper-wrapper">
                                @foreach ($news as $item)
                                    <div class="swiper-slide">
                                        <div class="blog-item style-2">
                                            <div class="blog-thumb">
                                                <a href="{{ route('frontend.news.show', $item->slug) }}">
                                                    <img src="{{ asset($item->img ? 'uploads/' . $item->img : 'uploads/' . ($settings['favicon'] ?? 'default-favicon.ico')) }}"
                                                        alt="{{ $item->title }}">
                                                </a>
                                                <div class="blog-date">
                                                    <span class="date">{{ $item->created_at->format('d') }}</span>
                                                    <span class="month">{{ $item->created_at->translatedFormat('M') }}</span>
                                                </div>
                                            </div>
                                            <div class="blog-content">
                                                <div class="title-area">
                                                    <div class="blog-meta">
                                                        <span class="categories"><a
                                                                href="{{ route('frontend.news.show', $item->slug) }}">{{ $item->category->title ?? 'Genel' }}</a></span>
                                                        <span>By <a href="#">#ilayajans</a></span>
                                                    </div>
                                                    <h4 class="title"><a
                                                            href="{{ route('frontend.news.show', $item->slug) }}">{{ $item->title }}</a>
                                                    </h4>
                                                </div>
                                                <a class="text-btn" href="{{ route('frontend.news.show', $item->slug) }}">
                                                    <span class="btn-text"><span>Devamını Oku</span></span>
                                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination-area"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Blog Section -->
@endsection
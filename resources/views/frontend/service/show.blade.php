@extends('frontend.master')

@section('seo')
    <title>{{ $service->seo_title ?? ($service->title ?? 'Hizmet Detayı') }}</title>
    <meta name="description" content="{{ $service->seo_desc ?? '' }}">
    <meta name="keywords" content="{{ $service->seo_key ?? '' }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $service->seo_title ?? ($service->title ?? '') }}">
    <meta property="og:description" content="{{ $service->seo_desc ?? '' }}">
    <meta property="og:image"
        content="{{ asset($service->img ? 'uploads/' . $service->img : (isset($settings['site_logo']) && $settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/logos/logo-2.webp')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $service->seo_title ?? ($service->title ?? '') }}">
    <meta name="twitter:description" content="{{ $service->seo_desc ?? '' }}">
    <meta name="twitter:image"
        content="{{ asset($service->img ? 'uploads/' . $service->img : (isset($settings['site_logo']) && $settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/logos/logo-2.webp')) }}">
@endsection

@section('content')
    <!-- start: Breadcrumb Section -->
    <section class="tj-page-header section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">{{ $service->title }}</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="{{ route('frontend.index') }}">Ana Sayfa</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <a href="{{ route('frontend.service.index') }}">Hizmetler</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <span>{{ $service->title }}</span>
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

    <!-- start: Service Details Section -->
    <section class="tj-blog-section section-gap slidebar-stickiy-container">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-lg-8">
                    <div class="post-details-wrapper">
                        @if($service->img)
                            <div class="blog-images wow fadeInUp" data-wow-delay=".1s">
                                <img src="{{ asset('uploads/' . $service->img) }}" alt="{{ $service->title }}">
                            </div>
                        @endif

                        <h2 class="title title-anim">{{ $service->title }}</h2>

                        <div class="blog-text">
                            <div class="wow fadeInUp" data-wow-delay=".3s">
                                {!! $service->desc !!}
                            </div>

                            @if($service->galleries && count($service->galleries) > 0)
                                <div class="images-wrap">
                                    <div class="row">
                                        @foreach($service->galleries->take(4) as $gallery)
                                            <div class="col-sm-6 col-md-3">
                                                <div class="image-box wow fadeInUp" data-wow-delay=".3s">
                                                    <a class="gallery" data-gall="service-gallery"
                                                        href="{{ asset('uploads/' . $gallery->image) }}">
                                                        <img src="{{ asset('uploads/' . $gallery->image) }}" alt="Hizmet Galerisi">
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($service->service_category)
                                <h3 class="wow fadeInUp" data-wow-delay=".3s">{{ $service->service_category->title }}
                                    Hizmetlerimiz</h3>
                                <p class="wow fadeInUp" data-wow-delay=".3s">
                                    {{ $service->service_category->title }} kategorisinde sunduğumuz profesyonel hizmetler ile
                                    işletmenizin ihtiyaçlarına en uygun çözümleri üretiyoruz.
                                </p>
                            @endif

                            @if($service->faqs && count($service->faqs) > 0)
                                <h3 class="wow fadeInUp" data-wow-delay=".3s">Sıkça Sorulan Sorular</h3>
                                <div class="accordion tj-faq style-2" id="faqOne">
                                    @php $i = 1; @endphp
                                    @foreach($service->faqs as $faq)
                                        <div class="accordion-item {{ $i == 1 ? 'active' : '' }} wow fadeInUp" data-wow-delay=".3s">
                                            <button class="faq-title {{ $i == 1 ? '' : 'collapsed' }}" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-{{ $i }}"
                                                aria-expanded="{{ $i == 1 ? 'true' : 'false' }}">
                                                {{ $faq->question }}
                                            </button>
                                            <div id="faq-{{ $i }}" class="collapse {{ $i == 1 ? 'show' : '' }}"
                                                data-bs-parent="#faqOne">
                                                <div class="accordion-body faq-text">
                                                    <p>{{ $faq->answer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Navigation -->
                        <div style="margin-top:20px !important;" class="tj-post__navigation mb-0 wow fadeInUp"
                            data-wow-delay=".3s">
                            <div class="tj-nav__post previous">
                                <div class="tj-nav-post__nav prev_post">
                                    <a href="{{ route('frontend.service.index') }}">
                                        <span><i class="tji-arrow-left"></i></span>Hizmetler
                                    </a>
                                </div>
                            </div>
                            <div class="tj-nav-post__grid">
                                <a href="{{ route('frontend.service.index') }}"><i class="tji-window"></i></a>
                            </div>
                            <div class="tj-nav__post next">
                                <div class="tj-nav-post__nav next_post">
                                    <a href="{{ route('frontend.contact') }}">
                                        İletişim<span><i class="tji-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="tj-main-sidebar slidebar-stickiy">
                        <!-- Hizmet Kategorileri -->
                        <div class="tj-sidebar-widget service-categories wow fadeInUp" data-wow-delay=".1s">
                            <h4 class="widget-title">Hizmet Kategorileri</h4>
                            <ul>
                                @foreach($serviceCategories as $category)
                                    <li>
                                        <a href="{{ route('frontend.service.category', $category->slug) }}"
                                            class="{{ $service->service_category_id == $category->id ? 'active' : '' }}">
                                            {{ $category->title }}
                                            <span class="icon"><i class="tji-arrow-right"></i></span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- İletişim Widget -->
                        <div class="tj-sidebar-widget widget-feature-item wow fadeInUp" data-wow-delay=".3s">
                            <div class="feature-box">
                                <div class="feature-content">
                                    <h2 class="title">Ücretsiz</h2>
                                    <span>Marka Analizi</span>
                                    <a class="read-more feature-contact" href="{{ route('frontend.brand-brief.create') }}">
                                        <i class="tji-phone-3"></i>
                                        <span>Hemen Başvur</span>
                                    </a>
                                </div>
                                <div class="feature-images">
                                    <img src="{{ asset("uploads/" . $settings['favicon']) }}" alt="Marka Analizi">
                                </div>
                            </div>
                        </div>

                        <!-- Benzer Hizmetler -->
                        @if($service->service_category && $service->service_category->services->count() > 1)
                            <div class="tj-sidebar-widget service-categories wow fadeInUp" data-wow-delay=".5s">
                                <h4 class="widget-title">Benzer Hizmetler</h4>
                                <ul>
                                    @foreach($service->service_category->services->where('id', '!=', $service->id)->take(5) as $relatedService)
                                        <li>
                                            <a href="{{ route('frontend.service.show', $relatedService->slug) }}">
                                                {{ $relatedService->title }}
                                                <span class="icon"><i class="tji-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Service Details Section -->


@endsection

@push('scripts')
    <script>
        // Galeri için Venobox
        $(document).ready(function () {
            $('.gallery').venobox({
                numeratio: true,
                infinigall: true
            });
        });
    </script>
@endpush
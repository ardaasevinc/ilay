@extends('frontend.master')

@section('seo')
    <title>{{ $reference->seo_title ?? ($reference->title . ' - Referans Detayı') }}</title>
    <meta name="description" content="{{ $reference->seo_desc ?? Str::limit(strip_tags($reference->desc), 155) }}">
    <meta name="keywords" content="{{ $reference->seo_key ?? '' }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $reference->seo_title ?? $reference->title }}">
    <meta property="og:description" content="{{ $reference->seo_desc ?? Str::limit(strip_tags($reference->desc), 155) }}">
    <meta property="og:image"
        content="{{ asset($reference->img ? 'uploads/' . $reference->img : 'uploads/' . ($settings['site_logo'] ?? 'default-logo.png')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $reference->seo_title ?? $reference->title }}">
    <meta name="twitter:description" content="{{ $reference->seo_desc ?? Str::limit(strip_tags($reference->desc), 155) }}">
    <meta name="twitter:image"
        content="{{ asset($reference->img ? 'uploads/' . $reference->img : 'uploads/' . ($settings['site_logo'] ?? 'default-logo.png')) }}">
@endsection

@section('content')
    <!-- start: Breadcrumb Section -->
    <section class="tj-page-header section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">{{ Str::limit($reference->title, 60) }}</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="{{ route('frontend.index') }}">Anasayfa</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <a href="{{ route('frontend.reference.index') }}">Referanslar</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>Detay</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header-overlay" data-bg-image="{{ asset('frontend/assets/images/shape/pheader-overlay.webp') }}">
        </div>
    </section>
    <!-- end: Breadcrumb Section -->

    <!-- start: Reference Details Section -->
    <section class="tj-blog-section section-gap slidebar-stickiy-container">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-lg-8">
                    <div class="post-details-wrapper">
                        <div class="blog-images wow fadeInUp" data-wow-delay=".1s">
                            <img src="{{ asset('uploads/' . ($reference->img ?? $settings['site_logo'] ?? 'default-image.jpg')) }}"
                                alt="{{ $reference->title }}"
                                onerror="this.onerror=null; this.src='{{ asset('uploads/' . ($settings['site_logo'] ?? 'frontend/assets/images/logos/logo-2.webp')) }}';">
                        </div>

                        <h2 class="title title-anim">{{ $reference->title }}</h2>

                        <div class="blog-text">
                            <div class="wow fadeInUp" style="margin-bottom: 20px !important" data-wow-delay=".3s">
                                {!! $reference->desc !!}
                            </div>

                            @if($reference->services->count() > 0)
                                <h3 class="wow fadeInUp" data-wow-delay=".3s">Verilen Hizmetler</h3>
                                <hr>
                                <ul class="wow fadeInUp" data-wow-delay=".3s">
                                    @foreach($reference->services as $service)
                                        <li><span><i class="tji-check"></i></span>{{ $service->title }}</li>
                                    @endforeach
                                </ul>
                                <hr>
                            @endif

                            @if($reference->galleries && $reference->galleries->count() > 0)
                                <h3 class="wow fadeInUp" data-wow-delay=".3s">Proje Galerisi</h3>
                                <p class="wow fadeInUp" data-wow-delay=".3s">{{ $reference->title }} projesinden görüntüler</p>
                                <div class="images-wrap">
                                    <div class="row">
                                        @foreach($reference->galleries as $gallery)
                                            @if($loop->first)
                                                <div class="col-sm-12">
                                                    <div class="image-box wow fadeInUp" data-wow-delay=".3s">
                                                        <a class="gallery" data-gall="gallery"
                                                            href="{{ asset('uploads/' . $gallery->image) }}">
                                                            <img src="{{ asset('uploads/' . $gallery->image) }}"
                                                                alt="{{ $gallery->title ?? $reference->title }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-sm-6">
                                                    <div class="image-box wow fadeInUp"
                                                        data-wow-delay="{{ 0.3 + ($loop->iteration * 0.1) }}s">
                                                        <a class="gallery" data-gall="gallery"
                                                            href="{{ asset('uploads/' . $gallery->image) }}">
                                                            <img src="{{ asset('uploads/' . $gallery->image) }}"
                                                                alt="{{ $gallery->title ?? $reference->title }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Navigation -->
                        <div class="tj-post__navigation mb-0 wow fadeInUp" data-wow-delay=".3s">
                            @php
                                $prevReference = \App\Models\Reference::where('is_active', true)
                                    ->where('id', '<', $reference->id)
                                    ->orderBy('id', 'desc')
                                    ->first();

                                $nextReference = \App\Models\Reference::where('is_active', true)
                                    ->where('id', '>', $reference->id)
                                    ->orderBy('id', 'asc')
                                    ->first();
                            @endphp

                            <!-- previous post -->
                            <div class="tj-nav__post previous">
                                <div class="tj-nav-post__nav prev_post">
                                    @if($prevReference)
                                        <a href="{{ route('frontend.reference.show', $prevReference->slug) }}">
                                            <span><i class="tji-arrow-left"></i></span>Önceki
                                        </a>
                                    @else
                                        <span class="disabled">
                                            <span><i class="tji-arrow-left"></i></span>Önceki
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="tj-nav-post__grid">
                                <a href="{{ route('frontend.reference.index') }}"><i class="tji-window"></i></a>
                            </div>

                            <!-- next post -->
                            <div class="tj-nav__post next">
                                <div class="tj-nav-post__nav next_post">
                                    @if($nextReference)
                                        <a href="{{ route('frontend.reference.show', $nextReference->slug) }}">
                                            Sonraki<span><i class="tji-arrow-right"></i></span>
                                        </a>
                                    @else
                                        <span class="disabled">
                                            Sonraki<span><i class="tji-arrow-right"></i></span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- İlgili Referanslar -->
                        @if($relatedReferences && $relatedReferences->count() > 0)
                            <div class="related-projects-section wow fadeInUp" style="margin-top:20px !important"
                                data-wow-delay=".3s">
                                <h3>İlgili Projeler</h3>
                                <div class="row">
                                    @foreach($relatedReferences as $related)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="related-project-item">
                                                <div class="project-image">
                                                    <a href="{{ route('frontend.reference.show', $related->slug) }}">
                                                        <img src="{{ asset('uploads/' . ($related->img ?? $settings['site_logo'] ?? 'default-image.jpg')) }}"
                                                            alt="{{ $related->title }}" class="img-fluid"
                                                            style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;"
                                                            onerror="this.onerror=null; this.src='{{ asset('uploads/' . ($settings['site_logo'] ?? 'frontend/assets/images/logos/logo-2.webp')) }}';">
                                                    </a>
                                                </div>
                                                <div class="project-content mt-3">
                                                    <h5 class="project-title">
                                                        <a href="{{ route('frontend.reference.show', $related->slug) }}">
                                                            {{ Str::limit($related->title, 60) }}
                                                        </a>
                                                    </h5>
                                                    <p class="project-excerpt">
                                                        {{ Str::limit(strip_tags($related->desc), 80) }}
                                                    </p>
                                                    <div class="project-meta">
                                                        <span class="project-date">
                                                            <i class="tji-calendar"></i> {{ $related->created_at->format('d.m.Y') }}
                                                        </span>
                                                        @if($related->services->count() > 0)
                                                            <span class="project-category">
                                                                <i class="tji-tag"></i>
                                                                {{ $related->services->first()->service_category->title ?? 'Genel' }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="tj-main-sidebar slidebar-stickiy">
                        <div class="tj-sidebar-widget widget-categories wow fadeInUp" data-wow-delay=".1s">
                            <h4 class="widget-title">Proje Bilgileri</h4>

                            @if($reference->services->count() > 0)
                                <div class="infos-item">
                                    <div class="project-icons">
                                        <i class="tji-chart"></i>
                                    </div>
                                    <div class="project-text">
                                        <span>Kategori</span>
                                        <h6 class="title">
                                            {{ $reference->services->first()->service_category->title ?? 'Genel' }}
                                        </h6>
                                    </div>
                                </div>
                            @endif

                            <div class="infos-item">
                                <div class="project-icons">
                                    <i class="tji-calendar"></i>
                                </div>
                                <div class="project-text">
                                    <span>Tarih</span>
                                    <h6 class="title">{{ $reference->created_at->format('d.m.Y') }}</h6>
                                </div>
                            </div>

                            @if($reference->url)
                                <div class="infos-item">
                                    <div class="project-icons">
                                        <i class="tji-link"></i>
                                    </div>
                                    <div class="project-text">
                                        <span>Website</span>
                                        <h6 class="title">
                                            <a href="{{ $reference->url }}" target="_blank" rel="noopener">
                                                Siteyi Ziyaret Et
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            @endif

                            @if($reference->services->count() > 0)
                                <div class="infos-item">
                                    <div class="project-icons">
                                        <i class="tji-user"></i>
                                    </div>
                                    <div class="project-text">
                                        <span>Hizmet Sayısı</span>
                                        <h6 class="title">{{ $reference->services->count() }} Hizmet</h6>
                                    </div>
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Reference Details Section -->
@endsection
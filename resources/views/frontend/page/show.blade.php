@extends('frontend.master')
@section('seo')
    <title>{{ $page->seo_title ?? ($page->title ?? 'Kurumsal Sayfa') }}</title>
    <meta name="description" content="{{ $page->seo_desc ?? '' }}">
    <meta name="keywords" content="{{ $page->seo_key ?? '' }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $page->seo_title ?? ($page->title ?? '') }}">
    <meta property="og:description" content="{{ $page->seo_desc ?? '' }}">
    <meta property="og:image"
        content="{{ asset($page->img ? 'uploads/' . $page->img : (isset($settings['site_logo']) && $settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/logos/logo-2.webp')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page->seo_title ?? ($page->title ?? '') }}">
    <meta name="twitter:description" content="{{ $page->seo_desc ?? '' }}">
    <meta name="twitter:image"
        content="{{ asset($page->img ? 'uploads/' . $page->img : (isset($settings['site_logo']) && $settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/logos/logo-2.webp')) }}">
@endsection

@section('content')
<!-- start: Breadcrumb Section -->
<section class="tj-page-header section-gap-x">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tj-page-header-content text-center">
                    <h1 class="tj-page-title">{{ $page->title }}</h1>
                    <div class="tj-page-link">
                        <span><i class="tji-home"></i></span>
                        <span>
                            <a href="{{ route('frontend.index') }}">Anasayfa</a>
                        </span>
                        <span><i class="tji-arrow-right"></i></span>
                        <span>
                            <span>{{ $page->title }}</span>
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

<!-- start: About Section -->
<section class="tj-about-section-2 section-gap section-gap-x">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 order-lg-1 order-2">
                <div class="about-img-area style-2 wow fadeInLeft" data-wow-delay=".3s">
                    <div class="about-img overflow-hidden">
                        <img data-speed=".8"
                            src="{{ asset($page->img ? 'uploads/' . $page->img : 'frontend/assets/images/placeholder.jpg') }}"
                            alt="{{ $page->title }}">
                    </div>
                    <div class="images-wrap">
                        <div class="row mt-5">
                            @forelse ($page->galleries as $gallery)
                            <div class="col-sm-4">
                                <div class="image-box wow fadeInUp" data-wow-delay=".3s">
                                    <a class="gallery" data-gall="gallery"
                                        href="{{ asset('uploads/' . $gallery->image) }}">
                                        <img src="{{ asset('uploads/' . $gallery->image) }}" height="140"
                                            alt="Gallery Image">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-6 col-lg-6 order-lg-2 order-1">
                <div class="about-content-area">
                    <div class="sec-heading">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>Bizi Daha
                            Yakından Tanıyın</span>
                        <h2 class="sec-title title-anim">Sürdürülebilir Kurumsal Başarı İçin Yenilik ve Mükemmellikte
                            Öncü <span>Dünya Çapında.</span></h2>
                        <div class="slogan mt-3 wow fadeInUp" data-wow-delay=".4s">
                            "Birlikte Yarınları Şekillendiriyoruz. Güven, Vizyon ve Değerlerle Büyüyoruz."
                        </div>
                    </div>
                </div>
                <div class="about-bottom-area">
                    <div class="mission-vision-box col-md-12 wow fadeInLeft" data-wow-delay=".5s">
                        <h4 class="title">{{ $page->title }}</h4>
                        <p class="desc">{!! $page->desc !!}</p>
                    </div>

                </div>
                <div class="about-btn-area wow fadeInUp" data-wow-delay=".6s">
                    <a class="tj-primary-btn" href="{{ route('frontend.brand-brief.create') }}">
                        <span class="btn-text"><span>Ücretsiz Marka Analizi</span></span>
                        <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                    </a>
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
</section>
<!-- end: About Section -->

<!-- start: Faq Section -->
<section class="tj-faq-section section-gap">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4">
                <div class="content-wrap">
                    <div class="sec-heading">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>Sıkça Sorulan
                            Sorular</span>
                        <h2 class="sec-title title-anim">Yardıma mı ihtiyacınız var? <span>Buradan Başlayın...</span>
                        </h2>
                    </div>
                    <p class="desc wow fadeInUp" data-wow-delay=".6s">Aklınıza takılan soruların cevaplarını aşağıda
                        bulabilirsiniz. Daha fazla bilgi için bizimle iletişime geçebilirsiniz.</p>
                    <div class="wow fadeInUp" data-wow-delay=".8s">
                        <a class="tj-primary-btn" href="{{ route('frontend.contact') }}">
                            <span class="btn-text"><span>Bize Ulaşın</span></span>
                            <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="accordion tj-faq" id="faqOne">
                    @php $i = 1; @endphp
                    @forelse($page->faqs ?? [] as $faq)
                        <div class="accordion-item wow fadeInUp{{ $i == 1 ? ' active' : '' }}"
                            data-wow-delay=".{{ 2 + $i }}s">
                            <button class="faq-title{{ $i == 1 ? '' : ' collapsed' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq-{{ $i }}"
                                aria-expanded="{{ $i == 1 ? 'true' : 'false' }}">{{ $faq->question }}</button>
                            <div id="faq-{{ $i }}" class="collapse{{ $i == 1 ? ' show' : '' }}" data-bs-parent="#faqOne">
                                <div class="accordion-body faq-text">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                        @php $i++; @endphp
                    @empty
                        <div class="accordion-item active wow fadeInUp" data-wow-delay=".3s">
                            <button class="faq-title" type="button" data-bs-toggle="collapse" data-bs-target="#faq-1"
                                aria-expanded="true">Bu sayfaya ait SSS bulunamadı.</button>
                            <div id="faq-1" class="collapse show" data-bs-parent="#faqOne">
                                <div class="accordion-body faq-text">
                                    <p>Henüz bu sayfa için sıkça sorulan sorular eklenmemiştir.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: Faq Section -->
@endsection

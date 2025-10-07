@extends('frontend.master')

@section('seo')
    <title>{{ $news->seo_title ?? ($news->title ?? 'Haber Detayı') }}</title>
    <meta name="description" content="{{ $news->seo_desc ?? Str::limit(strip_tags($news->content), 155) }}">
    <meta name="keywords" content="{{ $news->seo_key ?? '' }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $news->seo_title ?? $news->title }}">
    <meta property="og:description" content="{{ $news->seo_desc ?? Str::limit(strip_tags($news->content), 155) }}">
    <meta property="og:image"
        content="{{ asset($news->featured_image ? 'uploads/' . $news->featured_image : 'uploads/' . ($settings['site_logo'] ?? 'default-logo.png')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $news->seo_title ?? $news->title }}">
    <meta name="twitter:description" content="{{ $news->seo_desc ?? Str::limit(strip_tags($news->content), 155) }}">
    <meta name="twitter:image"
        content="{{ asset($news->featured_image ? 'uploads/' . $news->featured_image : 'uploads/' . ($settings['site_logo'] ?? 'default-logo.png')) }}">
@endsection

@section('content')

    <!-- start: Breadcrumb Section -->
    <section class="tj-page-header section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">{{ Str::limit($news->title, 60) }}</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="{{ route('frontend.index') }}">Anasayfa</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <a href="{{ route('frontend.news.index') }}">Haberler</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <span>Detay</span>
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

    <!-- start: Blog Details Section -->
    <section class="tj-blog-section section-gap slidebar-stickiy-container">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-lg-8">
                    <div class="post-details-wrapper">
                        @if ($news->featured_image)
                            <div class="blog-images wow fadeInUp" data-wow-delay=".1s">
                                <img src="{{ asset('uploads/' . $news->featured_image) }}" alt="{{ $news->title }}">
                            </div>
                        @endif

                        <h2 class="title title-anim">{{ $news->title }}</h2>

                        <div class="blog-category-two wow fadeInUp" data-wow-delay=".3s">
                            @if ($news->author)
                                <div class="category-item">
                                    <div class="cate-images">
                                        @if ($news->author->avatar)
                                            <img src="{{ asset('uploads/' . $news->author->avatar) }}"
                                                alt="{{ $news->author->name }}">
                                        @else
                                            <img src="{{ asset('frontend/assets/images/testimonial/client-2.webp') }}"
                                                alt="{{ $news->author->name }}">
                                        @endif
                                    </div>
                                    <div class="cate-text">
                                        <span class="degination">Yazar</span>
                                        <h6 class="title"><a href="#">{{ $news->author->name }}</a></h6>
                                    </div>
                                </div>
                            @endif

                            <div class="category-item">
                                <div class="cate-icons">
                                    <i class="tji-calendar"></i>
                                </div>
                                <div class="cate-text">
                                    <span class="degination">Yayınlanma Tarihi</span>
                                    <h6 class="text">{{ $news->created_at->translatedFormat('d F Y') }}</h6>
                                </div>
                            </div>

                            @if ($news->category)
                                <div class="category-item">
                                    <div class="cate-icons">
                                        <i class="tji-folder"></i>
                                    </div>
                                    <div class="cate-text">
                                        <span class="degination">Kategori</span>
                                        <h6 class="text">{{ $news->category->name }}</h6>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="blog-text">
                            {!! $news->content !!}
                        </div>

                        <!-- Gallery -->
                        @if ($news->galleries && $news->galleries->count() > 0)
                            <div class="images-wrap wow fadeInUp" data-wow-delay=".3s">
                                <h4 class="gallery-title mb-3">Galeri</h4>
                                <div class="row">
                                    @foreach ($news->galleries as $gallery)
                                        <div class="col-sm-4 mb-3">
                                            <div class="image-box wow fadeInUp" data-wow-delay=".3s">
                                                <a class="gallery" data-gall="news-gallery"
                                                    href="{{ asset('uploads/' . $gallery->img) }}">
                                                    <img src="{{ asset('uploads/' . $gallery->img) }}" class="img-fluid rounded"
                                                        style="height: 140px; object-fit: cover; width: 100%;" alt="Galeri Resmi">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Tags and Share -->
                        <div class="tj-tags-post wow fadeInUp" data-wow-delay=".3s">
                            @if ($news->tags && $news->tags->count() > 0)
                                <div class="tagcloud">
                                    <span>Etiketler:</span>
                                    @foreach ($news->tags as $tag)
                                        <a href="{{ route('frontend.news.tag', $tag->slug) }}">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            @endif

                            <div class="post-share">
                                <ul>
                                    <li>Paylaş:</li>
                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                            target="_blank" rel="noopener">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($news->title) }}"
                                            target="_blank" rel="noopener">
                                            <i class="fa-brands fa-x-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                                            target="_blank" rel="noopener">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="whatsapp://send?text={{ urlencode($news->title . ' - ' . url()->current()) }}"
                                            target="_blank" rel="noopener">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tj-post__navigation wow fadeInUp" data-wow-delay=".3s">
                            <!-- previous post -->
                            <div class="tj-nav__post previous">
                                <div class="tj-nav-post__nav prev_post">
                                    @if ($previousNews)
                                        <a href="{{ route('frontend.news.show', $previousNews->slug) }}">
                                            <span><i class="tji-arrow-left"></i></span>Önceki Haber
                                        </a>

                                    @endif
                                </div>
                            </div>
                            <div class="tj-nav-post__grid">
                                <a href="{{ route('frontend.news.index') }}"><i class="tji-window"></i></a>
                            </div>
                            <!-- next post -->
                            <div class="tj-nav__post next">
                                <div class="tj-nav-post__nav next_post">
                                    @if ($nextNews)
                                        <a href="{{ route('frontend.news.show', $nextNews->slug) }}">
                                            Sonraki Haber<span><i class="tji-arrow-right"></i></span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Previous/Next Navigation -->


                        <!-- Related Posts -->
                        @if ($relatedNews && $relatedNews->count() > 0)
                            <div class="tj-related-posts wow fadeInUp" data-wow-delay=".3s">
                                <h3 class="related-posts-title">İlgili Haberler</h3>
                                <div class="row">
                                    @foreach ($relatedNews as $related)
                                        <div class="col-md-6">
                                            <div class="related-post-item">
                                                <div class="related-post-thumb">
                                                    <a href="{{ route('frontend.news.show', $related->slug) }}">
                                                        @if ($related->featured_image)
                                                            <img src="{{ asset('uploads/' . $related->featured_image) }}"
                                                                alt="{{ $related->title }}">
                                                        @else
                                                            <img src="{{ asset('frontend/assets/images/blog/blog-2.webp') }}"
                                                                alt="{{ $related->title }}">
                                                        @endif
                                                    </a>
                                                    <div class="blog-date">
                                                        <span class="date">{{ $related->created_at->format('d') }}</span>
                                                        <span class="month">{{ $related->created_at->translatedFormat('M') }}</span>
                                                    </div>
                                                </div>
                                                <div class="related-post-content">
                                                    <div class="blog-meta">
                                                        @if ($related->category)
                                                            <span class="categories">{{ $related->category->name }}</span>
                                                        @endif
                                                    </div>
                                                    <h4 class="related-post-title">
                                                        <a
                                                            href="{{ route('frontend.news.show', $related->slug) }}">{{ Str::limit($related->title, 60) }}</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="tj-main-sidebar slidebar-stickiy">
                        <!-- Search Widget -->
                        <div class="tj-sidebar-widget widget-search wow fadeInUp" data-wow-delay=".1s">
                            <h4 class="widget-title">Ara</h4>
                            <div class="search-box">
                                <form action="{{ route('frontend.news.index') }}" method="GET">
                                    <input type="search" name="search" id="searchTwo" placeholder="Ara...">
                                    <button type="submit" value="search">
                                        <i class="tji-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Recent Posts Widget -->
                        @if ($recentNews->count() > 0)
                            <div class="tj-sidebar-widget tj-recent-posts wow fadeInUp" data-wow-delay=".3s">
                                <h4 class="widget-title">Son Haberler</h4>
                                <ul>
                                    @foreach ($recentNews as $recent)
                                        <li>
                                            <div class="post-thumb">
                                                <a href="{{ route('frontend.news.show', $recent->slug) }}">
                                                    @if ($recent->featured_image)
                                                        <img src="{{ asset('uploads/' . $recent->featured_image) }}"
                                                            alt="{{ $recent->title }}">
                                                    @else
                                                        <img src="{{ asset('frontend/assets/images/blog/post-3.webp') }}"
                                                            alt="{{ $recent->title }}">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <h6 class="post-title">
                                                    <a
                                                        href="{{ route('frontend.news.show', $recent->slug) }}">{{ Str::limit($recent->title, 50) }}</a>
                                                </h6>
                                                <div class="blog-meta">
                                                    <ul>
                                                        <li>{{ $recent->created_at->translatedFormat('d M Y') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Categories Widget -->
                        @if (isset($categories) && $categories->count() > 0)
                            <div class="tj-sidebar-widget widget-categories wow fadeInUp" data-wow-delay=".5s">
                                <h4 class="widget-title">Kategoriler</h4>
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('frontend.news.category', $category->slug) }}">
                                                {{ $category->name }}
                                                <span class="number">({{ $category->news_count }})</span>
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

@endsection

@push('styles')
    <style>
        .related-post-item {
            margin-bottom: 30px;
        }

        .related-post-thumb {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .related-post-thumb img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .related-post-thumb:hover img {
            transform: scale(1.05);
        }

        .related-post-title a {
            color: var(--tj-heading-primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .related-post-title a:hover {
            color: var(--tj-theme-primary);
        }

        .tj-related-posts {
            margin-top: 50px;
            padding-top: 50px;
            border-top: 1px solid #eee;
        }

        .related-posts-title {
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 600;
        }

        .tj-nav-post__nav .disabled {
            color: #ccc;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .tj-nav-post__nav .disabled:hover {
            color: #ccc;
            text-decoration: none;
        }

        .images-wrap {
            margin: 30px 0;
            padding: 20px 0;
        }

        .gallery-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--tj-heading-primary);
            margin-bottom: 20px;
        }

        .image-box {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .image-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .image-box img {
            transition: transform 0.3s ease;
        }

        .image-box:hover img {
            transform: scale(1.05);
        }

        .image-box a::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .image-box:hover a::before {
            opacity: 1;
        }

        .image-box a::after {
            content: "🔍";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
        }

        .image-box:hover a::after {
            opacity: 1;
        }
    </style>
@endpush
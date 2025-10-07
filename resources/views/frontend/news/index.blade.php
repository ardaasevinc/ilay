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
        content="{{ asset($settings['og_image'] ?? false ? 'uploads/' . $settings['og_image'] : 'frontend/assets/images/og-default.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $settings['site_title'] ?? ($settings['site_name'] ?? '') }}">
    <meta name="twitter:description" content="{{ $settings['site_description'] ?? '' }}">
    <meta name="twitter:image"
        content="{{ asset($settings['og_image'] ?? false ? 'uploads/' . $settings['og_image'] : 'frontend/assets/images/og-default.jpg') }}">
@endsection

@section('content')

    <!-- start: Breadcrumb Section -->
    <section class="tj-page-header section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">Haberler ve Blog</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="{{ route('frontend.index') }}">Anasayfa</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <span>Haberler</span>
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

    <!-- start: Blog Section -->
    <!-- start: Blog Section -->
    <section class="tj-blog-section section-gap">
        <div class="container">
            <div class="row row-gap-5">
                <div class="col-lg-8">
                    <div class="row row-gap-4">
                        @forelse($news as $post)
                            <div class="col-md-6">
                                <div class="blog-item wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.1 }}s">
                                    <div class="blog-thumb">
                                        <a href="{{ route('frontend.news.show', $post->slug) }}">
                                            @if ($post->featured_image)
                                                <img src="{{ asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}">
                                            @else
                                                <img src="{{ asset('frontend/assets/images/blog/blog-' . (($loop->iteration % 3) + 1) . '.webp') }}"
                                                    alt="{{ $post->title }}">
                                            @endif
                                        </a>
                                        <div class="blog-date">
                                            <span class="date">{{ $post->created_at->format('d') }}</span>
                                            <span class="month">{{ $post->created_at->translatedFormat('M') }}</span>
                                        </div>
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            @if ($post->category)
                                                <span class="categories"><a
                                                        href="{{ route('frontend.news.category', $post->category->slug) }}">{{ $post->category->name }}</a></span>
                                            @endif
                                            @if ($post->author)
                                                <span>Yazar: <a href="#">{{ $post->author->name }}</a></span>
                                            @endif
                                        </div>
                                        <h4 class="title">
                                            <a
                                                href="{{ route('frontend.news.show', $post->slug) }}">{{ Str::limit($post->title, 60) }}</a>
                                        </h4>
                                        <a class="text-btn" href="{{ route('frontend.news.show', $post->slug) }}">
                                            <span class="btn-text"><span>Devamını Oku</span></span>
                                            <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center">
                                    <h3>Henüz haber bulunmuyor.</h3>
                                    <p>Yakında sizlerle paylaşacağımız haberler için takipte kalın.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($news->hasPages())
                        <div class="tj-pagination d-flex justify-content-center">
                            <ul>
                                @if ($news->onFirstPage())
                                    <li><span class="page-numbers disabled"><i class="tji-arrow-left-long"></i></span></li>
                                @else
                                    <li><a class="page-numbers" href="{{ $news->previousPageUrl() }}"><i
                                                class="tji-arrow-left-long"></i></a></li>
                                @endif

                                @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                    @if ($page == $news->currentPage())
                                        <li><span aria-current="page"
                                                class="page-numbers current">{{ $page < 10 ? '0' . $page : $page }}</span>
                                        </li>
                                    @else
                                        <li><a class="page-numbers" href="{{ $url }}">{{ $page < 10 ? '0' . $page : $page }}</a></li>
                                    @endif
                                @endforeach

                                @if ($news->hasMorePages())
                                    <li><a class="next page-numbers" href="{{ $news->nextPageUrl() }}"><i
                                                class="tji-arrow-right-long"></i></a></li>
                                @else
                                    <li><span class="page-numbers disabled"><i class="tji-arrow-right-long"></i></span></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="tj-main-sidebar p-0 slidebar-stickiy">
                        <!-- Search Widget -->
                        <div class="tj-sidebar-widget widget-search wow fadeInUp" data-wow-delay=".1s">
                            <h4 class="widget-title">Ara</h4>
                            <div class="search-box">
                                <form action="{{ route('frontend.news.index') }}" method="GET">
                                    <input type="search" name="search" id="searchTwo" placeholder="Ara..."
                                        value="{{ request('search') }}">
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
                                                        <img src="{{ asset('frontend/assets/images/blog/post-1.webp') }}"
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
                        @if ($categories->count() > 0)
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

                        <!-- Tags Widget -->
                        @if ($tags->count() > 0)
                            <div class="tj-sidebar-widget widget-tag-cloud wow fadeInUp" data-wow-delay=".7s">
                                <h4 class="widget-title">Etiketler</h4>
                                <nav>
                                    <div class="tagcloud">
                                        @foreach ($tags as $tag)
                                            <a href="{{ route('frontend.news.tag', $tag->slug) }}">{{ $tag->name }}</a>
                                        @endforeach
                                    </div>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Blog Section -->


@endsection

@push('styles')
    <style>
        .page-numbers.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
@endpush
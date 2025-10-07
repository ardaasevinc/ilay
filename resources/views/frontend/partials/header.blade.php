<header class="header-area header-2 header-absolute section-gap-x">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="header-wrapper">
                    <!-- site logo -->
                    <div class="site_logo">
                        <a class="logo" href="{{ route('frontend.index') }}">
                            <img src="{{ asset(isset($settings['site_logo']) && $settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/logos/logo-2.webp') }}"
                                alt="{{ $settings['site_name'] ?? 'Logo' }}">
                        </a>
                    </div>

                    <!-- navigation -->
                    <div class="menu-area d-none d-lg-inline-flex align-items-center">
                        <nav id="mobile-menu" class="mainmenu">
                            <ul>
                                <li class="current-menu-ancestor"><a href="{{ route('frontend.index') }}">Anasayfa</a>
                                </li>
                                <li class="has-dropdown"><a href="#">Kurumsal</a>
                                    <ul class="sub-menu">
                                        @foreach ($pages as $page)
                                            <li><a
                                                    href="{{ route('frontend.page.show', $page->slug) }}">{{ $page->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="has-dropdown"><a
                                        href="{{ route('frontend.service.index') }}">Hizmetlerimiz</a>
                                    <ul class="sub-menu header__mega-menu mega-menu mega-menu-pages">
                                        <li>
                                            <div class="mega-menu-wrapper">
                                                @foreach ($serviceCategories as $sCategory)
                                                    <div class="mega-menu-pages-single">
                                                        <div class="mega-menu-pages-single-inner">
                                                            <h6 class="mega-menu-title">
                                                                <a
                                                                    href="{{ route('frontend.service.category', $sCategory->slug) }}">{{ $sCategory->title }}</a>
                                                            </h6>
                                                            <div class="mega-menu-list">
                                                                @php
                                                                    $categoryServices = $services->where(
                                                                        'service_category_id',
                                                                        $sCategory->id,
                                                                    );
                                                                 @endphp
                                                                @foreach ($categoryServices as $service)
                                                                    @if ($service && $service->slug)
                                                                        <a
                                                                            href="{{ route('frontend.service.show', $service->slug) }}">{{ $service->title }}</a>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-12 col-lg-2 mega-menu-pages-single">
                                                    <div class="mega-menu-pages-single-inner">
                                                        <a href="{{ route('frontend.brand-brief.create') }}">
                                                            <div class="feature-box">
                                                                <div class="feature-content">
                                                                    <h2 class="title">Marka Analizi</h2>
                                                                    <span>Ücretsiz Formu Doldurunuz</span>
                                                                    <a class="read-more feature-contact"
                                                                        href="{{ route('frontend.brand-brief.create') }}">
                                                                        <span>Marka Analiz Formu</span>
                                                                    </a>
                                                                </div>
                                                                <div class="feature-images">
                                                                    <img src="{{ asset('uploads/' . ($settings['favicon'] ?? 'default-favicon.ico')) }}"
                                                                        alt="">
                                                                </div>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('frontend.reference.index') }}">Referanslarımız</a></li>
                                <li><a href="{{ route('frontend.news.index') }}">Blog</a></li>
                                <li><a href="{{ route('frontend.contact') }}">İletişim</a></li>
                            </ul>
                        </nav>
                    </div>

                    <!-- header right info -->
                    <div class="header-right-item d-none d-lg-inline-flex">
                        <div class="header-search">
                            <button class="search">
                                <i class="tji-search"></i>
                            </button>
                            <button type="button" class="search_close_btn">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="header-button">
                            <a class="tj-primary-btn" href="{{ route('frontend.brand-brief.create') }}">
                                <span class="btn-text"><span>Marka Analizi</span></span>
                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                            </a>
                        </div>
                        <div class="menu_bar menu_offcanvas d-none d-lg-inline-flex">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <!-- menu bar -->
                    <div class="menu_bar mobile_menu_bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Popup -->
    <div class="search_popup">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="tj_search_wrapper">
                        <div class="search_form">
                            <form action="{{ route('frontend.search') }}" method="GET">
                                <div class="search_input">
                                    <div class="search-box">
                                        <input class="search-form-input" type="text" name="q"
                                            placeholder="Sayfa, haber, hizmet, referans arayın..."
                                            value="{{ request('q') }}" required>
                                        <button type="submit">
                                            <i class="tji-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
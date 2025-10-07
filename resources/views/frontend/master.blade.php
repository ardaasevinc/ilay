<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Site Title -->
    @yield('seo')
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset($settings['favicon'] ? 'uploads/' . $settings['favicon'] : 'frontend/assets/images/fav.png') }}">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome-pro.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bexon-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/odometer-theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    @stack('styles')
</head>

<body>
    <div class="body-overlay"></div>

    <!-- Preloader Start -->
    <div class="tj-preloader is-loading">
        <div class="tj-preloader-inner">
            <div class="tj-preloader-ball-wrap">
                <div class="tj-preloader-ball-inner-wrap">
                    <div class="tj-preloader-ball-inner">
                        <div class="tj-preloader-ball"></div>
                    </div>
                    <div class="tj-preloader-ball-shadow"></div>
                </div>
                <div id="tj-weave-anim" class="tj-preloader-text">ilayAjans...</div>
            </div>
        </div>
        <div class="tj-preloader-overlay"></div>
    </div>
    <!-- Preloader end -->

    <!-- back to top start -->
    <div id="tj-back-to-top"><span id="tj-back-to-top-percentage"></span></div>
    <!-- back to top end -->

    <!-- start: Search Popup -->
    <div class="search-popup-overlay"></div>
    <!-- end: Search Popup -->

    <!-- start: Offcanvas Menu -->
    <div class="tj-offcanvas-area d-none d-lg-block">
        <div class="hamburger_bg"></div>
        <div class="hamburger_wrapper">
            <div class="hamburger_inner">
                <div class="hamburger_top d-flex align-items-center justify-content-between">
                    <div class="hamburger_logo">
                        <a href="{{ route('frontend.index') }}" class="mobile_logo">
                            <img src="{{ asset(isset($settings['site_logo']) && $settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/logos/logo-2.webp') }}"
                                alt="{{ $settings['site_name'] ?? 'Logo' }}">
                        </a>
                    </div>
                    <div class="hamburger_close">
                        <button class="hamburger_close_btn"><i class="fa-thin fa-times"></i></button>
                    </div>
                </div>
                <div class="offcanvas-text">
                    <p>{{ $settings['site_description'] ?? 'Müşteri yolculuklarınızı kişiselleştirerek memnuniyeti ve sadakati artırmaya odaklanıyoruz.' }}
                    </p>
                </div>
                <div class="hamburger-search-area">
                    <h5 class="hamburger-title">Hızlı Arama</h5>
                    <div class="hamburger_search">
                        <form method="get" action="{{ route('frontend.search') }}">
                            <button type="submit"><i class="tji-search"></i></button>
                            <input type="search" autocomplete="off" name="q" value="{{ request('q') }}"
                                placeholder="Sayfa, haber, hizmet arayın...">
                        </form>
                    </div>
                </div>
                <div class="hamburger-infos">
                    <h5 class="hamburger-title">İletişim Bilgileri</h5>
                    <div class="contact-info">
                        @if(isset($settings['contact_phone']) && $settings['contact_phone'])
                            <div class="contact-item">
                                <span class="subtitle">Telefon</span>
                                <a class="contact-link"
                                    href="tel:{{ $settings['contact_phone'] }}">{{ $settings['contact_phone'] }}</a>
                            </div>
                        @endif
                        @if(isset($settings['contact_email']) && $settings['contact_email'])
                            <div class="contact-item">
                                <span class="subtitle">E-posta</span>
                                <a class="contact-link"
                                    href="mailto:{{ $settings['contact_email'] }}">{{ $settings['contact_email'] }}</a>
                            </div>
                        @endif
                        @if(isset($settings['contact_address']) && $settings['contact_address'])
                            <div class="contact-item">
                                <span class="subtitle">Adres</span>
                                <span class="contact-link">{{ $settings['contact_address'] }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="hamburger-socials">
                <h5 class="hamburger-title">Bizi Takip Edin</h5>
                <div class="social-links style-3">
                    <ul>
                        @if(isset($settings['social_facebook']) && $settings['social_facebook'])
                            <li><a href="{{ $settings['social_facebook'] }}" target="_blank"><i
                                        class="fa-brands fa-facebook-f"></i></a></li>
                        @endif
                        @if(isset($settings['social_instagram']) && $settings['social_instagram'])
                            <li><a href="{{ $settings['social_instagram'] }}" target="_blank"><i
                                        class="fa-brands fa-instagram"></i></a></li>
                        @endif
                        @if(isset($settings['social_twitter']) && $settings['social_twitter'])
                            <li><a href="{{ $settings['social_twitter'] }}" target="_blank"><i
                                        class="fa-brands fa-x-twitter"></i></a></li>
                        @endif
                        @if(isset($settings['social_linkedin']) && $settings['social_linkedin'])
                            <li><a href="{{ $settings['social_linkedin'] }}" target="_blank"><i
                                        class="fa-brands fa-linkedin-in"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Offcanvas Menu -->

    <!-- start: Hamburger Menu -->
    <div class="hamburger-area d-lg-none">
        <div class="hamburger_bg"></div>
        <div class="hamburger_wrapper">
            <div class="hamburger_inner">
                <div class="hamburger_top d-flex align-items-center justify-content-between">
                    <div class="hamburger_logo">
                        <a href="index.html" class="mobile_logo">
                            <img src="assets/images/logos/logo-2.webp" alt="Logo">
                        </a>
                    </div>
                    <div class="hamburger_close">
                        <button class="hamburger_close_btn"><i class="fa-thin fa-times"></i></button>
                    </div>
                </div>
                <div class="hamburger-search-area">
                    <h5 class="hamburger-title">Search Now!</h5>
                    <div class="hamburger_search">
                        <form method="get" action="index.html">
                            <button type="submit"><i class="tji-search"></i></button>
                            <input type="search" autocomplete="off" name="s" value="" placeholder="Search here...">
                        </form>
                    </div>
                </div>
                <div class="hamburger_menu">
                    <div class="mobile_menu"></div>
                </div>
                <div class="hamburger-infos">
                    <h5 class="hamburger-title">Contact Info</h5>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="subtitle">Phone</span>
                            <a class="contact-link" href="tel:8089091313">808-909-1313</a>
                        </div>
                        <div class="contact-item">
                            <span class="subtitle">Email</span>
                            <a class="contact-link" href="mailto:info@bexon.com">info@bexon.com</a>
                        </div>
                        <div class="contact-item">
                            <span class="subtitle">Location</span>
                            <span class="contact-link">993 Renner Burg, West Rond, MT 94251-030</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hamburger-socials">
                <h5 class="hamburger-title">Follow Us</h5>
                <div class="social-links style-3">
                    <ul>
                        <li><a href="https://www.facebook.com/" target="_blank"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                        </li>
                        <li><a href="https://www.instagram.com/" target="_blank"><i
                                    class="fa-brands fa-instagram"></i></a>
                        </li>
                        <li><a href="https://x.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                        <li><a href="https://www.linkedin.com/" target="_blank"><i
                                    class="fa-brands fa-linkedin-in"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Hamburger Menu -->

    <!-- start: Header Area -->
    @include('frontend.partials.header')
    <!-- end: Header Area -->


    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main id="primary" class="site-main">
                @yield('content')
                <div class="top-space-15"></div>

            </main>
            <!-- start: Footer Section -->
            @include('frontend.partials.footer')
            <!-- end: Footer Section -->
        </div>
    </div>
    <!-- JS here -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/ScrollSmoother.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/gsap-scroll-to-plugin.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/gsap-scroll-trigger.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/gsap-split-text.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/appear.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/meanmenu.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
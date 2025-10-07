<footer class="tj-footer-section footer-2 section-gap-x">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-subscribe wow fadeInUp" data-wow-delay=".3s">
                        <div class="subscribe-logo">
                            <img src="{{ asset(isset($settings['site_logo']) && $settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/logos/logo-2.webp') }}"
                                alt="{{ $settings['site_name'] ?? 'Logo' }}">
                        </div>
                        <div id="subscription-message" style="display:none;margin-top:10px;color:white !important;">
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const form = document.getElementById('subscription-form');
                                const messageBox = document.getElementById('subscription-message');

                                function showMsg(html, ok = false) {
                                    messageBox.innerHTML = html;
                                    messageBox.style.display = 'block';
                                    setTimeout(() => messageBox.style.display = 'none', 3500);
                                    if (ok) form.reset();
                                }

                                if (form && messageBox) {
                                    form.addEventListener('submit', async function (e) {
                                        e.preventDefault();
                                        messageBox.style.display = 'none';

                                        const formData = new FormData(form);

                                        try {
                                            const res = await fetch(form.action, {
                                                method: 'POST',
                                                headers: {
                                                    'X-Requested-With': 'XMLHttpRequest',
                                                    'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                                                    'Accept': 'application/json',
                                                },
                                                body: formData,
                                                credentials: 'same-origin', // cookie/oturum için
                                            });

                                            const contentType = res.headers.get('content-type') || '';

                                            // Redirect yakalama (fetch default: follow). Birçok durumda res.redirected true olur.
                                            if (res.redirected || !contentType.includes('application/json')) {
                                                // Büyük ihtimalle HTML geldi (login ya da back redirect)
                                                showMsg(
                                                    '<div class="alert alert-danger">İstek yönlendirildi (302). Bu uç nokta JSON değil gibi davranıyor. Lütfen tekrar deneyin.</div>'
                                                );
                                                return;
                                            }

                                            const data = await res.json();

                                            // Başarı (senin mevcut controller'ında success string dönüyor)
                                            if ((res.ok || res.status === 201) && (data.success || data.ok)) {
                                                const msg = data.message || data.success ||
                                                    'Abonelik başarıyla kaydedildi!';
                                                showMsg('<div class="w-100 alert alert-success">' + msg + '</div>', true);
                                                return;
                                            }

                                            // Doğrulama / iş kuralı hataları
                                            const errMsg = data.error || data.message ||
                                                'Bir hata oluştu. Lütfen tekrar deneyin.';
                                            showMsg('<div class="w-100 alert alert-danger">' + errMsg + '</div>');
                                        } catch (e) {
                                            showMsg(
                                                '<div class="alert alert-danger">Bir hata oluştu. Lütfen tekrar deneyin.</div>'
                                            );
                                        }
                                    });
                                }
                            });
                        </script>
                        <div class="subscribe-form">
                            <form id="subscription-form" action="{{ route('frontend.subscription.store') }}"
                                method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="E-posta adresinizi girin" required>
                                <button class="tj-primary-btn" type="submit">
                                    <span class="btn-text"><span>Abone Ol</span></span>
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-main-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-md-6">
                    <div class="footer-widget footer-col-1 wow fadeInUp" data-wow-delay=".1s">
                        <div class="footer-logo">
                            <a href="{{ route('frontend.index') }}">
                                <img src="{{ asset(isset($settings['site_logo']) && $settings['site_logo'] ? 'uploads/' . $settings['site_logo'] : 'frontend/assets/images/logos/logo-2.webp') }}"
                                    alt="{{ $settings['site_name'] ?? 'Logo' }}">
                            </a>
                        </div>
                        <div class="footer-text">
                            <p>{{ $settings['meta_description'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="footer-widget footer-col-2 widget-nav-menu wow fadeInUp" data-wow-delay=".3s">
                        <h5 class="title">Kurumsal</h5>
                        <ul>
                            @foreach ($pages as $page)
                                <li><a href="{{ route('frontend.page.show', $page->slug) }}">{{ $page->title }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="footer-widget footer-col-3 widget-nav-menu wow fadeInUp" data-wow-delay=".5s">
                        <h5 class="title">Hizmetlerimiz</h5>
                        <ul>
                            @foreach ($serviceCategories as $category)
                                <li><a
                                        href="{{ route('frontend.service.category', $category->slug) }}">{{ $category->title }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="footer-widget widget-contact wow fadeInUp" data-wow-delay=".7s">
                        <h5 class="title">İletişim Bilgileri</h5>
                        <div class="footer-contact-info">
                            <div class="contact-item">
                                <span>{{ $settings['contact_address'] }}</span>
                            </div>
                            <div class="contact-item">
                                <a href="tel:{{ $settings['contact_phone'] }}">{{ $settings['contact_phone'] }}</a>
                                <a href="mailto:{{ $settings['contact_email'] }}">{{ $settings['contact_email'] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-marquee">
        <div class="swiper marquee-slider">
            <div class="swiper-wrapper">
                @foreach ($serviceCategories as $category)
                    <div class="swiper-slide marquee-item">
                        <h4 class="marquee-text">{{ $category->title }}</h4>
                        <div class="marquee-img">
                            <img src="{{ asset('uploads/' . $category->img) }}" alt="">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <div class="tj-copyright-area-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-content-area">
                        <div class="copyright-text">
                            <p>&copy; 2025 <a href="https://themeforest.net/user/theme-junction/portfolio"
                                    target="_blank">ilayajans</a>
                                Tüm Hakları Saklıdır</p>
                        </div>
                        <div class="social-links style-3">
                            <ul>
                                @if (isset($settings['social_facebook']))
                                    <li><a href="{{ $settings['social_facebook'] }}" target="_blank"><i
                                                class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                @endif
                                @if (isset($settings['social_instagram']))
                                    <li><a href="{{ $settings['social_instagram'] }}" target="_blank"><i
                                                class="fa-brands fa-instagram"></i></a>
                                    </li>
                                @endif
                                @if (isset($settings['social_twitter']))
                                    <li><a href="{{ $settings['social_twitter'] }}" target="_blank"><i
                                                class="fa-brands fa-x-twitter"></i></a></li>
                                @endif
                                @if (isset($settings['social_linkedin']))
                                    <li><a href="{{ $settings['social_linkedin'] }}" target="_blank"><i
                                                class="fa-brands fa-linkedin-in"></i></a>
                                    </li>
                                @endif
                                @if (isset($settings['social_youtube']))
                                    <li><a href="{{ $settings['social_youtube'] }}" target="_blank"><i
                                                class="fa-brands fa-youtube"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="copyright-menu">
                            <ul>
                                @foreach ($pages as $page)
                                    <li><a href="{{ route('frontend.page.show', $page->slug) }}">{{ $page->title }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-shape-1">
        <img src="assets/images/shape/pattern-2.svg" alt="">
    </div>
    <div class="bg-shape-2">
        <img src="assets/images/shape/pattern-3.svg" alt="">
    </div>
</footer>
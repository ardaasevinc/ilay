@extends('frontend.master')

@section('seo')
    <title>İletişim - {{ $settings['site_name'] ?? 'İlay Ajans' }}</title>
    <meta name="description" content="{{ $settings['site_description'] ?? 'İletişim sayfası' }}">
@endsection

@section('content')
    <!-- start: Breadcrumb Section -->
    <section class="tj-page-header section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">İletişim</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="{{ route('frontend.index') }}">Anasayfa</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <span>İletişim</span>
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


    <!-- start: Contact Top Section -->
    <div class="tj-contact-area section-gap">
        <div class="container">
            <div class="row row-gap-4">
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="contact-item style-2 wow fadeInUp" data-wow-delay=".3s">
                        <div class="contact-icon">
                            <i class="tji-location-3"></i>
                        </div>
                        <h3 class="contact-title">Adresimiz</h3>
                        <p>{{ $settings['company_address'] ?? 'Adres bilgisi güncellenecek' }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="contact-item style-2 wow fadeInUp" data-wow-delay=".5s">
                        <div class="contact-icon">
                            <i class="tji-envelop"></i>
                        </div>
                        <h3 class="contact-title">E-posta</h3>
                        <ul class="contact-list">
                            <li><a
                                    href="mailto:{{ $settings['contact_email'] ?? 'info@ilayajans.com' }}">{{ $settings['contact_email'] ?? 'info@ilayajans.com' }}</a>
                            </li>
                            @if (isset($settings['info_email']) && $settings['info_email'])
                                <li><a
                                        href="mailto:{{ $settings['info_email'] }}">{{ $settings['info_email'] }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="contact-item style-2 wow fadeInUp" data-wow-delay=".7s">
                        <div class="contact-icon">
                            <i class="tji-phone"></i>
                        </div>
                        <h3 class="contact-title">Telefon</h3>
                        <ul class="contact-list">
                            <li><a
                                    href="tel:{{ str_replace([' ', '(', ')', '-'], '', $settings['phone_number'] ?? '') }}">{{ $settings['phone_number'] ?? '+90 555 000 00 00' }}</a>
                            </li>
                            @if (isset($settings['whatsapp_number']) && $settings['whatsapp_number'])
                                <li><a href="https://wa.me/{{ str_replace([' ', '(', ')', '-', '+'], '', $settings['whatsapp_number']) }}"
                                        target="_blank">{{ $settings['whatsapp_number'] }} (WhatsApp)</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6">
                    <div class="contact-item style-2 wow fadeInUp" data-wow-delay=".9s">
                        <div class="contact-icon">
                            <i class="tji-chat"></i>
                        </div>
                        <h3 class="contact-title">Canlı Destek</h3>
                        <ul class="contact-list">
                            <li><a
                                    href="mailto:{{ $settings['support_email'] ?? ($settings['contact_email'] ?? 'destek@ilayajans.com') }}">{{ $settings['support_email'] ?? ($settings['contact_email'] ?? 'destek@ilayajans.com') }}</a>
                            </li>
                            <li class="active"><a href="{{ route('frontend.contact') }}">Yardıma mı ihtiyacınız var?</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Contact Top Section -->

    <!-- start: Contact Section -->
    <section class="tj-contact-section-2 section-bottom-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-form wow fadeInUp" data-wow-delay=".1s">
                        <h3 class="title">Bizimle İletişime Geçin veya Ofisimizi Ziyaret Edin.</h3>

                        <!-- Alert Messages Container -->
                        <div id="alert-container">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>

                        <form id="contact-form" method="POST" action="{{ route('frontend.contact.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <input type="text" name="name" value="{{ old('name') }}" required>
                                        <label class="cf-label">Ad Soyad <span>*</span></label>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <input type="email" name="email" value="{{ old('email') }}" required>
                                        <label class="cf-label">E-posta Adresi <span>*</span></label>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <input type="tel" name="phone" value="{{ old('phone') }}" minlength="10"
                                            maxlength="25" required>
                                        <label class="cf-label">Telefon Numarası <span>*</span></label>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-input">
                                        <div class="tj-nice-select-box">
                                            <div class="tj-select">
                                                <select name="subject" required>
                                                    <option value="">Bir seçenek seçin</option>
                                                    <option value="Marka Stratejisi"
                                                        {{ old('subject') == 'Marka Stratejisi' ? 'selected' : '' }}>Marka
                                                        Stratejisi
                                                    </option>
                                                    <option value="Müşteri Deneyimi"
                                                        {{ old('subject') == 'Müşteri Deneyimi' ? 'selected' : '' }}>
                                                        Müşteri Deneyimi
                                                    </option>
                                                    <option value="Sürdürülebilirlik ve ESG"
                                                        {{ old('subject') == 'Sürdürülebilirlik ve ESG' ? 'selected' : '' }}>
                                                        Sürdürülebilirlik ve ESG
                                                    </option>
                                                    <option value="Eğitim ve Geliştirme"
                                                        {{ old('subject') == 'Eğitim ve Geliştirme' ? 'selected' : '' }}>
                                                        Eğitim ve Geliştirme
                                                    </option>
                                                    <option value="IT Destek ve Bakım"
                                                        {{ old('subject') == 'IT Destek ve Bakım' ? 'selected' : '' }}>IT
                                                        Destek ve Bakım
                                                    </option>
                                                    <option value="Pazarlama Stratejisi"
                                                        {{ old('subject') == 'Pazarlama Stratejisi' ? 'selected' : '' }}>
                                                        Pazarlama Stratejisi
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        @error('subject')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-input message-input">
                                        <textarea name="message" id="message" required>{{ old('message') }}</textarea>
                                        <label class="cf-label">Mesajınızı yazın <span>*</span></label>
                                        @error('message')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="submit-btn">
                                    <button class="tj-primary-btn" type="submit" id="submit-btn">
                                        <span class="btn-text">
                                            <span class="btn-text-normal">Şimdi Gönder</span>
                                            <span class="btn-text-loading" style="display: none;">Gönderiliyor...</span>
                                        </span>
                                        <span class="btn-icon">
                                            <i class="tji-arrow-right-long btn-icon-normal"></i>
                                            <i class="fa fa-spinner fa-spin btn-icon-loading" style="display: none;"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-area wow fadeInUp" data-wow-delay=".3s">
                        @if (isset($settings['google_maps_iframe']) && $settings['google_maps_iframe'])
                            {!! $settings['google_maps_iframe'] !!}
                        @else
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24476.009868659067!2d32.8597457!3d39.933365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d3479c0c0e0e0f%3A0x0!2zQW5rYXJhLCBUw7xya2l5ZQ!5e0!3m2!1str!2str!4v1696345678901!5m2!1str!2str"
                                width="100%" height="450" style="border:0; border-radius: 10px;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Contact Section -->

    <!-- start: Cta Section -->
    <section class="tj-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-area">
                        <div class="cta-content">
                            <h2 class="title title-anim">Geleceği Birlikte İnşa Edelim.</h2>
                            <div class="cta-btn wow fadeInUp" data-wow-delay=".6s">
                                <a class="tj-primary-btn btn-dark" href="{{ route('frontend.brand-brief.create') }}">
                                    <span class="btn-text"><span>Hemen Başlayın</span></span>
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="cta-image">
                            <div class="cta-shape">
                                <i class="tji-arrow-right" style="font-size: 60px; color: #ff6b35;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Cta Section -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form input float label düzeltmesi
            const inputs = document.querySelectorAll('.form-input input, .form-input textarea');

            function checkInputValue(input) {
                const label = input.nextElementSibling;
                if (input.value.trim() !== '' || input === document.activeElement) {
                    if (label) label.classList.add('active');
                } else {
                    if (label) label.classList.remove('active');
                }
            }

            inputs.forEach(function(input) {
                // Sayfa yüklendiğinde kontrol et (old values için)
                checkInputValue(input);

                // Input eventi
                input.addEventListener('input', function() {
                    checkInputValue(this);
                });

                // Focus eventi
                input.addEventListener('focus', function() {
                    checkInputValue(this);
                });

                // Blur eventi
                input.addEventListener('blur', function() {
                    setTimeout(() => {
                        if (this.value.trim() === '') {
                            const label = this.nextElementSibling;
                            if (label) label.classList.remove('active');
                        }
                    }, 100);
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Float label düzeltmesi */
        .form-input {
            position: relative;
        }

        .form-input .cf-label {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 5px;
            color: #999;
            font-size: 16px;
        }

        .form-input .cf-label.active,
        .form-input input:focus+.cf-label,
        .form-input textarea:focus+.cf-label {
            top: 0;
            font-size: 14px;
            color: #333;
            transform: translateY(-50%);
            z-index: 1;
        }

        .form-input.message-input .cf-label {
            top: 20px;
            transform: none;
        }

        .form-input.message-input .cf-label.active,
        .form-input.message-input textarea:focus+.cf-label {
            top: 0;
            transform: translateY(-50%);
        }

        .text-danger {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }
    </style>
@endpush

@extends('frontend.master')

@section('seo')
    <title>Teşekkürler - Marka Analizi Formu | ilayAjans</title>
    <meta name="description"
        content="Marka analizi formunuzu başarıyla gönderdik. En kısa sürede sizinle iletişime geçeceğiz.">
    <meta name="robots" content="noindex,follow">
@endsection

@section('content')
    <!-- Breadcrumb Section -->
    <section class="tj-page-header section-gap-x" data-bg-image="assets/images/bg/pheader-bg.webp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">Teşekkürler!</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span><a href="{{ route('frontend.index') }}">Anasayfa</a></span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>Teşekkürler</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header-overlay" data-bg-image="{{ asset('frontend/assets/images/shape/pheader-overlay.webp') }}">
        </div>
    </section>

    <!-- Thank You Section -->
    <section class="thank-you-section section-gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- Success Card -->
                    <div class="thank-you-card text-center">
                        <div class="success-icon mb-4">
                            <i class="fas fa-check-circle"></i>
                        </div>

                        <h2 class="success-title mb-3">Teşekkürler! 🎉</h2>
                        <p class="success-message mb-4">
                            Marka analizi formunuz başarıyla alındı.
                            <strong>24-48 saat</strong> içinde sizinle iletişime geçeceğiz.
                        </p>


                        <!-- Contact Info -->
                        <div class="contact-note mt-4">
                            <p class="text-muted text-center mb-0">
                                <i class="fas fa-phone me-2"></i>
                                İletişim için telefon numarası:
                                <strong>{{ $settings->get('contact_phone')?->value ?? '+90 XXX XXX XX XX' }}</strong>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .thank-you-card {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }

        .success-icon {
            font-size: 3rem;
            color: #6c757d;
        }

        .success-title {
            font-size: 2rem;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .contact-info p {
            margin-bottom: 0.5rem;
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .thank-you-card {
                padding: 1.5rem;
            }

            .success-title {
                font-size: 1.5rem;
            }
        }
    </style>
@endpush

@extends('frontend.master')

@section('seo')
    <title>Detaylı Marka Analizi Formu | ilayAjans</title>
    <meta name="description"
        content="Markanız için kapsamlı analiz formu. Marka kimliği, dijital varlık ve pazarlama stratejiniz hakkında detaylı bilgi alın.">
    <meta name="keywords" content="marka analizi, brand brief, dijital pazarlama, marka stratejisi">
@endsection

@section('content')
    <!-- Breadcrumb Section -->
    <section class="tj-page-header section-gap-x" data-bg-image="assets/images/bg/pheader-bg.webp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">Detaylı Marka Analizi</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span><a href="{{ route('frontend.index') }}">Anasayfa</a></span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>Marka Analizi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Brief Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- Form Header -->
                    <div class="text-center mb-5">
                        <h2 class="display-6 fw-bold text-secondary mb-3">Marka Analizi Formu</h2>
                        <p class="lead text-muted mb-4">7 adımda markanız için kapsamlı analiz yapmamıza yardımcı olan
                            bilgileri paylaşın</p>
                        <div class="badge bg-secondary fs-6 py-2 px-3">
                            <i class="fas fa-clock me-2"></i>
                            Yaklaşık 10 dakika
                        </div>
                    </div>

                    <!-- Step Progress -->
                    <div class="mb-5">
                        <div class="step-wizard-container">
                            <div class="step-progress-bar d-none d-md-flex">
                                <div class="step-item active" data-step="1">
                                    <div class="step-circle">1</div>
                                    <div class="step-label">Marka Bilgileri</div>
                                </div>
                                <div class="step-item" data-step="2">
                                    <div class="step-circle">2</div>
                                    <div class="step-label">Hedefler</div>
                                </div>
                                <div class="step-item" data-step="3">
                                    <div class="step-circle">3</div>
                                    <div class="step-label">Mevcut Durum</div>
                                </div>
                                <div class="step-item" data-step="4">
                                    <div class="step-circle">4</div>
                                    <div class="step-label">Pazarlama</div>
                                </div>
                                <div class="step-item" data-step="5">
                                    <div class="step-circle">5</div>
                                    <div class="step-label">Görsel Kimlik</div>
                                </div>
                                <div class="step-item" data-step="6">
                                    <div class="step-circle">6</div>
                                    <div class="step-label">Dijital Varlık</div>
                                </div>
                                <div class="step-item" data-step="7">
                                    <div class="step-circle">7</div>
                                    <div class="step-label">İletişim</div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Step Counter -->
                        <div class="d-md-none text-center">
                            <div class="mobile-step-counter">
                                <span class="current-step-text">Adım <span id="current-step-mobile">1</span> / 7</span>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 14.28%"
                                        id="step-progress"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alert Messages -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Lütfen aşağıdaki hataları düzeltin:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Multi-Step Form -->
                    <form name="brand_brief_form" method="POST" action="{{ route('frontend.brand-brief.store') }}"
                        class="needs-validation" novalidate>
                        @csrf

                        <!-- Step 1: Marka Bilgileri -->
                        <div class="step-content" id="step-1">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-building me-2"></i>1. Marka Bilgileri
                                    </h5>
                                    <p class="card-text mb-0 mt-2 opacity-75">Markanız hakkında temel bilgiler</p>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Marka Adı <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="brand_name" class="form-control form-control-lg"
                                                value="{{ old('brand_name') }}" placeholder="Marka adınızı giriniz"
                                                required>
                                            <div class="invalid-feedback">Lütfen marka adınızı giriniz.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Website</label>
                                            <input type="url" name="website" class="form-control"
                                                value="{{ old('website') }}" placeholder="https://example.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Sektör</label>
                                            <input type="text" name="sector" class="form-control"
                                                value="{{ old('sector') }}" placeholder="Teknoloji, Sağlık, vb.">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Kaç Yıldır Aktif</label>
                                            <input type="number" name="years_active" class="form-control"
                                                value="{{ old('years_active') }}" placeholder="5" min="0"
                                                max="150">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Sosyal Medya Linkleri</label>
                                            <textarea name="social_links" class="form-control" rows="3" placeholder="Her satıra bir link giriniz">{{ old('social_links') }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Marka Özeti</label>
                                            <textarea name="brand_summary" class="form-control" rows="3"
                                                placeholder="Markanızın hikayesi, misyonu ve vizyonu">{{ old('brand_summary') }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Hedef Kitle</label>
                                            <textarea name="target_audience" class="form-control" rows="3"
                                                placeholder="Yaş aralığı, demografik özellikler, ilgi alanları">{{ old('target_audience') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Hedefler & Konumlama -->
                        <div class="step-content d-none" id="step-2">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-bullseye me-2"></i>2. Hedefler & Konumlama
                                    </h5>
                                    <p class="card-text mb-0 mt-2 opacity-75">Markanızın hedef ve konumlandırması</p>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Öncelik Hedefleriniz</label>
                                            <div class="row g-2">
                                                @foreach (App\Models\BrandBrief::getPriorityGoalsOptions() as $key => $label)
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="priority_goals[]"
                                                                value="{{ $key }}" class="form-check-input"
                                                                id="goal_{{ $key }}"
                                                                {{ in_array($key, old('priority_goals', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="goal_{{ $key }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Rakip Analizi</label>
                                            <textarea name="competitor_analysis" class="form-control" rows="3"
                                                placeholder="Ana rakipleriniz ve farklı yanlarınız">{{ old('competitor_analysis') }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Pazar Konumu</label>
                                            <textarea name="market_position" class="form-control" rows="3"
                                                placeholder="Pazardaki konumunuz ve hedeflediğiniz konum">{{ old('market_position') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Mevcut Durum -->
                        <div class="step-content d-none" id="step-3">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-chart-line me-2"></i>3. Mevcut Durum
                                    </h5>
                                    <p class="card-text mb-0 mt-2 opacity-75">Markanızın mevcut durumu ve analizi</p>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Markanızı 3 Kelimeyle Tanımlayın</label>
                                            <input type="text" name="three_words" class="form-control"
                                                value="{{ old('three_words') }}"
                                                placeholder="Güvenilir, Yenilikçi, Kaliteli">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Güçlü Yanlarınız</label>
                                            <textarea name="strength" class="form-control" rows="3" placeholder="Markanızın güçlü yönleri">{{ old('strength') }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Rakiplerinize Karşı Üstünlüğünüz</label>
                                            <textarea name="edge_against_competitors" class="form-control" rows="3"
                                                placeholder="Rakiplerinizden farklı olan yanlarınız">{{ old('edge_against_competitors') }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Zayıf Yanlarınız</label>
                                            <textarea name="weakness" class="form-control" rows="3" placeholder="Geliştirilmesi gereken alanlar">{{ old('weakness') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Pazarlama & Sosyal Medya -->
                        <div class="step-content d-none" id="step-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-share-alt me-2"></i>4. Pazarlama & Sosyal Medya
                                    </h5>
                                    <p class="card-text mb-0 mt-2 opacity-75">Mevcut pazarlama stratejileriniz</p>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Sosyal Medya Yönetiminiz Var mı?</label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input type="radio" name="has_social_management" value="1"
                                                        class="form-check-input" id="social_yes"
                                                        {{ old('has_social_management') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="social_yes">Evet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="has_social_management" value="0"
                                                        class="form-check-input" id="social_no"
                                                        {{ old('has_social_management') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="social_no">Hayır</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Dışarıdan Sosyal Medya Desteği Alıyor
                                                musunuz?</label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input type="radio" name="outsourced_social" value="1"
                                                        class="form-check-input" id="outsourced_yes"
                                                        {{ old('outsourced_social') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="outsourced_yes">Evet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="outsourced_social" value="0"
                                                        class="form-check-input" id="outsourced_no"
                                                        {{ old('outsourced_social') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="outsourced_no">Hayır</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Pazarlama Araçlarınız</label>
                                            <div class="row g-2">
                                                @foreach (App\Models\BrandBrief::getMarketingToolsOptions() as $key => $label)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="marketing_tools[]"
                                                                value="{{ $key }}" class="form-check-input"
                                                                id="tool_{{ $key }}"
                                                                {{ in_array($key, old('marketing_tools', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="tool_{{ $key }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Görsel Kimlik -->
                        <div class="step-content d-none" id="step-5">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-palette me-2"></i>5. Görsel Kimlik
                                    </h5>
                                    <p class="card-text mb-0 mt-2 opacity-75">Markanızın görsel kimlik durumu</p>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Logonuzdan Memnun musunuz?</label>
                                            <div class="d-flex gap-3 flex-wrap">
                                                <div class="form-check">
                                                    <input type="radio" name="logo_satisfaction" value="yes"
                                                        class="form-check-input" id="logo_yes"
                                                        {{ old('logo_satisfaction') == 'yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="logo_yes">Evet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="logo_satisfaction" value="no"
                                                        class="form-check-input" id="logo_no"
                                                        {{ old('logo_satisfaction') == 'no' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="logo_no">Hayır</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="logo_satisfaction" value="partially"
                                                        class="form-check-input" id="logo_partially"
                                                        {{ old('logo_satisfaction') == 'partially' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="logo_partially">Kısmen</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Kurumsal Varlıklarınız</label>
                                            <div class="row g-2">
                                                @foreach (App\Models\BrandBrief::getCorporateAssetsOptions() as $key => $label)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="corporate_assets[]"
                                                                value="{{ $key }}" class="form-check-input"
                                                                id="asset_{{ $key }}"
                                                                {{ in_array($key, old('corporate_assets', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="asset_{{ $key }}">
                                                                {{ $label }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Foto/Video Arşiviniz Var mı?</label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input type="radio" name="has_media_assets" value="1"
                                                        class="form-check-input" id="media_yes"
                                                        {{ old('has_media_assets') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="media_yes">Evet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="has_media_assets" value="0"
                                                        class="form-check-input" id="media_no"
                                                        {{ old('has_media_assets') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="media_no">Hayır</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Tasarımlarınız Markanızı Doğru Temsil
                                                Ediyor mu?</label>
                                            <div class="d-flex gap-3 flex-wrap">
                                                <div class="form-check">
                                                    <input type="radio" name="design_representation" value="yes"
                                                        class="form-check-input" id="design_yes"
                                                        {{ old('design_representation') == 'yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="design_yes">Evet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="design_representation" value="no"
                                                        class="form-check-input" id="design_no"
                                                        {{ old('design_representation') == 'no' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="design_no">Hayır</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="design_representation" value="not_sure"
                                                        class="form-check-input" id="design_not_sure"
                                                        {{ old('design_representation') == 'not_sure' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="design_not_sure">Emin
                                                        Değilim</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Dijital Varlık -->
                        <!-- Step 6: Dijital Varlık -->
                        <div class="step-content d-none" id="step-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-globe me-2"></i>6. Dijital Varlık
                                    </h5>
                                    <p class="card-text mb-0 mt-2 opacity-75">Dijital varlıklarınızın durumu</p>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Websiteniz Var mı?</label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input type="radio" name="has_website" value="1"
                                                        class="form-check-input" id="website_yes"
                                                        {{ old('has_website') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="website_yes">Evet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="has_website" value="0"
                                                        class="form-check-input" id="website_no"
                                                        {{ old('has_website') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="website_no">Hayır</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Websiteniz Mobil Uyumlu mu?</label>
                                            <div class="d-flex gap-3 flex-wrap">
                                                <div class="form-check">
                                                    <input type="radio" name="is_mobile_ready" value="yes"
                                                        class="form-check-input" id="mobile_yes"
                                                        {{ old('is_mobile_ready') == 'yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="mobile_yes">Evet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="is_mobile_ready" value="no"
                                                        class="form-check-input" id="mobile_no"
                                                        {{ old('is_mobile_ready') == 'no' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="mobile_no">Hayır</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="is_mobile_ready" value="not_sure"
                                                        class="form-check-input" id="mobile_not_sure"
                                                        {{ old('is_mobile_ready') == 'not_sure' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="mobile_not_sure">Emin
                                                        Değilim</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">SEO Çalışmanız Var mı?</label>
                                            <div class="d-flex gap-3 flex-wrap">
                                                <div class="form-check">
                                                    <input type="radio" name="has_seo" value="yes"
                                                        class="form-check-input" id="seo_yes"
                                                        {{ old('has_seo') == 'yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="seo_yes">Evet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="has_seo" value="no"
                                                        class="form-check-input" id="seo_no"
                                                        {{ old('has_seo') == 'no' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="seo_no">Hayır</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="has_seo" value="not_sure"
                                                        class="form-check-input" id="seo_not_sure"
                                                        {{ old('has_seo') == 'not_sure' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="seo_not_sure">Emin
                                                        Değilim</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Web Performansınız Hakkında
                                                Değerlendirme</label>
                                            <textarea name="web_performance_feedback" class="form-control" rows="3"
                                                placeholder="Websitenizin hızı, kullanıcı deneyimi vb.">{{ old('web_performance_feedback') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 7: İletişim Bilgileri -->
                        <div class="step-content d-none" id="step-7">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-address-book me-2"></i>7. İletişim Bilgileri
                                    </h5>
                                    <p class="card-text mb-0 mt-2 opacity-75">İletişim bilgileriniz ve tercihleriniz</p>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Ad Soyad <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control"
                                                value="{{ old('full_name') }}" placeholder="Adınız ve soyadınız"
                                                required>
                                            <div class="invalid-feedback">Lütfen ad soyad giriniz.</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Telefon <span
                                                    class="text-danger">*</span></label>
                                            <input type="tel" name="phone" class="form-control"
                                                value="{{ old('phone') }}" placeholder="0532 123 45 67" required>
                                            <div class="invalid-feedback">Lütfen telefon numarası giriniz.</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">E-posta <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="ornek@email.com" required>
                                            <div class="invalid-feedback">Lütfen geçerli bir e-posta adresi giriniz.</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Tercih Ettiğiniz İletişim Yöntemi</label>
                                            <div class="d-flex gap-4">
                                                <div class="form-check">
                                                    <input type="radio" name="preferred_contact" value="phone"
                                                        class="form-check-input" id="contact_phone"
                                                        {{ old('preferred_contact') == 'phone' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="contact_phone">
                                                        <i class="fas fa-phone me-1"></i>Telefon
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="preferred_contact" value="whatsapp"
                                                        class="form-check-input" id="contact_whatsapp"
                                                        {{ old('preferred_contact') == 'whatsapp' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="contact_whatsapp">
                                                        <i class="fab fa-whatsapp me-1"></i>WhatsApp
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="preferred_contact" value="email"
                                                        class="form-check-input" id="contact_email"
                                                        {{ old('preferred_contact') == 'email' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="contact_email">
                                                        <i class="fas fa-envelope me-1"></i>E-posta
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Bizi Nasıl Duydunuz?</label>
                                            <select name="heard_from" class="form-select">
                                                <option value="">Seçiniz</option>
                                                <option value="instagram"
                                                    {{ old('heard_from') == 'instagram' ? 'selected' : '' }}>
                                                    Instagram
                                                </option>
                                                <option value="google"
                                                    {{ old('heard_from') == 'google' ? 'selected' : '' }}>
                                                    Google
                                                </option>
                                                <option value="referral"
                                                    {{ old('heard_from') == 'referral' ? 'selected' : '' }}>
                                                    Tavsiye
                                                </option>
                                                <option value="other"
                                                    {{ old('heard_from') == 'other' ? 'selected' : '' }}>
                                                    Diğer
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step Navigation -->
                        <div class="step-navigation mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-outline-secondary" id="prevBtn"
                                    onclick="changeStep(-1)" style="display: none;">
                                    <i class="fas fa-arrow-left me-2"></i>Önceki
                                </button>
                                <div class="mx-auto">
                                    <small class="text-muted">Adım <span id="current-step">1</span> / 7</small>
                                </div>
                                <button type="button" class="btn btn-secondary" id="nextBtn" onclick="changeStep(1)">
                                    Sonraki<i class="fas fa-arrow-right ms-2"></i>
                                </button>
                                <button type="submit" class="btn btn-success btn-lg" id="submitBtn"
                                    style="display: none;" onclick="console.log('Submit button clicked')">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    <span class="submit-text">Formu Gönder</span>
                                </button>
                            </div>
                        </div>

                </div>
                </form>

            </div>
        </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Step Wizard Container */
        .step-wizard-container {
            padding: 1.5rem;
            background-color: #6c757d;
            border-radius: 15px;
            margin-bottom: 2rem;
        }

        /* Desktop Step Progress */
        .step-progress-bar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            max-width: 100%;
            margin: 0 auto;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            flex: 1;
        }

        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 20px;
            left: 60%;
            width: calc(100% - 60px);
            height: 2px;
            background-color: rgba(255, 255, 255, 0.3);
            z-index: 1;
        }

        .step-item.completed:not(:last-child)::after {
            background-color: #28a745;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .step-item.active .step-circle {
            background-color: white;
            color: #6c757d;
        }

        .step-item.completed .step-circle {
            background-color: #28a745;
            color: white;
        }

        .step-label {
            font-size: 12px;
            color: white;
            font-weight: 500;
            max-width: 80px;
            line-height: 1.2;
        }

        .step-item.active .step-label {
            font-weight: 600;
        }

        /* Mobile Step Counter */
        .mobile-step-counter {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 10px;
        }

        .current-step-text {
            color: white;
            font-weight: 600;
            font-size: 14px;
        }



        /* Card Styles */
        .card {
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border: none;
            font-weight: 600;
            background-color: #6c757d !important;
            color: white;
            padding: 1rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Form Controls */
        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 10px 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.15);
        }

        .form-check-input:checked {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
            transform: translateY(-1px);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: translateY(-1px);
        }

        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        /* Navigation Buttons */
        .step-navigation {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 1px solid #dee2e6;
        }

        #prevBtn,
        #nextBtn,
        #submitBtn {
            min-width: 120px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .step-wizard-container {
                padding: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .step-navigation {
                padding: 1rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .step-item {
                min-width: 50px;
            }

            .step-circle {
                width: 35px;
                height: 35px;
                font-size: 12px;
            }

            .step-label {
                font-size: 10px;
                max-width: 60px;
            }

            .step-item:not(:last-child)::after {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .display-6 {
                font-size: 1.5rem;
            }

            .lead {
                font-size: 0.9rem;
            }

            .step-circle {
                width: 30px;
                height: 30px;
                font-size: 11px;
            }

            .step-label {
                font-size: 9px;
                max-width: 50px;
            }
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        /* Step Content */
        .step-content {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .step-progress {
                gap: 0.5rem;
            }

            .step-circle {
                width: 35px;
                height: 35px;
                font-size: 12px;
            }

            .step-label {
                font-size: 10px;
                max-width: 60px;
            }

            .card-body {
                padding: 1.5rem;
            }

            .d-flex.gap-3.flex-wrap {
                flex-direction: column !important;
            }

            .d-flex.gap-4 {
                flex-direction: column !important;
                gap: 1rem !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        let currentStep = 1;
        const totalSteps = 7;

        // Initialize form
        document.addEventListener('DOMContentLoaded', function() {
            updateStepDisplay();
            updateButtonStates();

            // Form validation
            const form = document.querySelector('form[name="brand_brief_form"]');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Validate all required fields
                    let isFormValid = true;
                    const requiredInputs = form.querySelectorAll(
                        'input[required], select[required], textarea[required]');

                    requiredInputs.forEach(input => {
                        if (!input.value.trim()) {
                            input.classList.add('is-invalid');
                            isFormValid = false;
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    });

                    if (!isFormValid) {
                        e.preventDefault();
                        e.stopPropagation();
                        goToFirstInvalidStep();
                    } else {
                        // Show loading state
                        const submitBtn = document.getElementById('submitBtn');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML =
                                '<i class="fas fa-spinner fa-spin me-2"></i>Gönderiliyor...';
                        }

                        // Clear saved data on successful submit
                        clearSavedData();

                        // Form will submit normally here
                        console.log('Form is being submitted...');
                    }
                    form.classList.add('was-validated');
                });
            }
        });

        // Step navigation function
        function changeStep(direction) {
            const newStep = currentStep + direction;

            console.log('changeStep called:', {
                currentStep,
                direction,
                newStep
            });

            if (newStep >= 1 && newStep <= totalSteps) {
                // Validate current step before proceeding
                if (direction > 0 && !validateCurrentStep()) {
                    console.log('Validation failed, staying on current step');
                    return;
                }

                // Hide current step
                const currentStepEl = document.getElementById(`step-${currentStep}`);
                if (currentStepEl) {
                    currentStepEl.classList.add('d-none');
                }

                // Update current step
                currentStep = newStep;

                // Show new step
                const newStepEl = document.getElementById(`step-${currentStep}`);
                if (newStepEl) {
                    newStepEl.classList.remove('d-none');
                } else {
                    console.error('New step element not found:', `step-${currentStep}`);
                }

                // Update displays
                updateStepDisplay();
                updateButtonStates();

                // Auto-save progress
                autoSave();

                // Scroll to top of form
                try {
                    const scrollTarget = document.querySelector('.step-wizard-container') || document.querySelector(
                        '.container');
                    if (scrollTarget) {
                        scrollTarget.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                } catch (error) {
                    console.error('Scroll error:', error);
                }
            }
        }

        // Validate current step
        function validateCurrentStep() {
            const currentStepElement = document.getElementById(`step-${currentStep}`);
            if (!currentStepElement) {
                console.log('Step element not found:', `step-${currentStep}`);
                return false;
            }

            const requiredInputs = currentStepElement.querySelectorAll(
                'input[required], select[required], textarea[required]');
            let isValid = true;

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                console.log('Step validation failed for step:', currentStep);
            }

            return isValid;
        }

        // Go to first invalid step
        function goToFirstInvalidStep() {
            for (let step = 1; step <= totalSteps; step++) {
                const stepElement = document.getElementById(`step-${step}`);
                const invalidInputs = stepElement.querySelectorAll('.is-invalid');

                if (invalidInputs.length > 0) {
                    // Hide current step
                    document.getElementById(`step-${currentStep}`).classList.add('d-none');

                    // Go to invalid step
                    currentStep = step;
                    document.getElementById(`step-${currentStep}`).classList.remove('d-none');

                    updateStepDisplay();
                    updateButtonStates();

                    // Focus first invalid input
                    invalidInputs[0].scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    invalidInputs[0].focus();
                    break;
                }
            }
        }

        // Update step display
        function updateStepDisplay() {
            // Update progress steps
            for (let i = 1; i <= totalSteps; i++) {
                const stepItem = document.querySelector(`.step-item[data-step="${i}"]`);

                if (stepItem) {
                    if (i < currentStep) {
                        stepItem.classList.add('completed');
                        stepItem.classList.remove('active');
                    } else if (i === currentStep) {
                        stepItem.classList.add('active');
                        stepItem.classList.remove('completed');
                    } else {
                        stepItem.classList.remove('active', 'completed');
                    }
                }
            }

            // Update step counter
            const stepCounter = document.getElementById('current-step');
            if (stepCounter) {
                stepCounter.textContent = currentStep;
            }

            // Update mobile step counter
            const mobileStepCounter = document.getElementById('current-step-mobile');
            if (mobileStepCounter) {
                mobileStepCounter.textContent = currentStep;
            }

            // Update mobile progress bar
            const progressBar = document.getElementById('step-progress');
            if (progressBar) {
                const progressPercentage = (currentStep / totalSteps) * 100;
                progressBar.style.width = progressPercentage + '%';
            }
        }

        // Update button states
        function updateButtonStates() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');

            // Previous button
            if (prevBtn) {
                prevBtn.style.display = currentStep === 1 ? 'none' : 'inline-block';
            }

            // Next/Submit button
            if (currentStep === totalSteps) {
                if (nextBtn) nextBtn.style.display = 'none';
                if (submitBtn) submitBtn.style.display = 'inline-block';
            } else {
                if (nextBtn) nextBtn.style.display = 'inline-block';
                if (submitBtn) submitBtn.style.display = 'none';
            }
        }

        // Auto-save form data
        function autoSave() {
            const formData = new FormData(document.querySelector('form[name="brand_brief_form"]'));
            const data = Object.fromEntries(formData.entries());
            localStorage.setItem('brand_brief_draft', JSON.stringify(data));
        }

        // Clear saved data
        function clearSavedData() {
            localStorage.removeItem('brand_brief_draft');
        }
    </script>
@endpush

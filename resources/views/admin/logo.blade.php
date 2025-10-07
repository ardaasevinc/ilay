{{-- Admin Panel Logo --}}
<style>
    /* Reset all possible spacing from Filament sidebar */
    .fi-sidebar-header,
    .fi-sidebar-header-heading,
    .fi-logo,
    .fi-topbar-start,
    .fi-brand {
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1 !important;
        height: auto !important;
        min-height: auto !important;
        max-height: none !important;
    }

    /* Specifically target the fi-logo wrapper */
    .fi-logo {
        height: auto !important;
        width: auto !important;
        display: block !important;
        overflow: visible !important;
    }

    /* Reset any inherited styles */
    .fi-logo>* {
        height: auto !important;
        width: auto !important;
    }

    /* Override Filament's specific height constraint */
    div[style*="height: 1.5rem"] {
        height: auto !important;
    }

    .fi-logo[style*="height"] {
        height: auto !important;
    }
</style>

@php
    // Get logos from Settings
    $lightLogoPath = \App\Models\Setting::getValue('admin_logo_light');
    $darkLogoPath = \App\Models\Setting::getValue('admin_logo_dark');

    $lightLogo = null;
    $darkLogo = null;

    // Check if light logo exists
    if ($lightLogoPath && file_exists(public_path('uploads/' . $lightLogoPath))) {
        $lightLogo = asset('uploads/' . $lightLogoPath);
    }

    // Check if dark logo exists
    if ($darkLogoPath && file_exists(public_path('uploads/' . $darkLogoPath))) {
        $darkLogo = asset('uploads/' . $darkLogoPath);
    }

    // Check if we have separate dark logo
    $hasSeparateDarkLogo = $darkLogoPath && $darkLogo && $darkLogo !== $lightLogo;

    // Get logo height from settings
    $logoHeight = \App\Models\Setting::getValue('admin_logo_height', '2.5rem');

    // Ensure the height value has a unit (px, rem, em, etc.)
    if (is_numeric($logoHeight)) {
        $logoHeight = $logoHeight . 'px';
    }
@endphp

@if ($lightLogo)
    @if ($hasSeparateDarkLogo)
        {{-- Light Mode Logo --}}
        <img src="{{ $lightLogo }}"
            alt="{{ \App\Models\Setting::getValue('site_name', config('app.name', 'CMS Admin')) }}"
            style="max-height: {{ $logoHeight }}; width: auto; margin: 0; padding: 0; display: block; vertical-align: top;"
            x-show="!($store.theme?.isDark ?? false)" x-cloak>

        {{-- Dark Mode Logo --}}
        <img src="{{ $darkLogo }}"
            alt="{{ \App\Models\Setting::getValue('site_name', config('app.name', 'CMS Admin')) }}"
            style="max-height: {{ $logoHeight }}; width: auto; margin: 0; padding: 0; display: block; vertical-align: top;"
            x-show="$store.theme?.isDark ?? false" x-cloak>
    @else
        {{-- Single Logo (works for both modes) --}}
        <img src="{{ $lightLogo }}"
            alt="{{ \App\Models\Setting::getValue('site_name', config('app.name', 'CMS Admin')) }}"
            style="max-height: {{ $logoHeight }}; width: auto; margin: 0; padding: 0; display: block; vertical-align: top;">
    @endif
@else
    {{-- Fallback Text Logo --}}
    <span style="font-size: 1.25rem; font-weight: 700; margin: 0; padding: 0; line-height: 1; display: block;"
        class="text-gray-800 dark:text-white">
        {{ \App\Models\Setting::getValue('site_name', config('app.name', 'CMS Admin')) }}
    </span>
@endif

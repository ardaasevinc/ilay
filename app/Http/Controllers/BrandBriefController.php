<?php

namespace App\Http\Controllers;

use App\Models\BrandBrief;
use App\Models\Setting;
use App\Models\EmailLog;
use App\Mail\NewBrandBriefNotification;
use App\Mail\BrandBriefThankYouMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class BrandBriefController extends Controller
{
    /**
     * Show the brand brief form
     */
    public function create(Request $request)
    {
        // Önceki form verilerini session'dan al (hata durumunda form dolu gelsin)
        $data = Session::get('brand_brief_temp_data', []);

        return view('frontend.brand-brief.form', [
            'data' => $data,
        ]);
    }

    /**
     * Store the brand brief form data
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // 1. Marka Bilgileri
                'brand_name'   => ['required', 'string', 'max:255'],
                'website'      => ['nullable', 'url'],
                'social_links' => ['nullable', 'string'],
                'sector'       => ['nullable', 'string', 'max:255'],
                'years_active' => ['nullable', 'integer', 'min:0', 'max:150'],
                'brand_summary' => ['nullable', 'string'],
                'target_audience' => ['nullable', 'string'],

                // 2. Hedefler & Konumlama
                'priority_goals' => ['nullable', 'array'],
                'priority_goals.*' => ['string'],
                'competitor_analysis' => ['nullable', 'string'],
                'market_position' => ['nullable', 'string'],

                // 3. Mevcut Durum
                'three_words' => ['nullable', 'string', 'max:255'],
                'strength' => ['nullable', 'string'],
                'edge_against_competitors' => ['nullable', 'string'],
                'weakness' => ['nullable', 'string'],
                'has_social_management' => ['nullable', 'in:0,1'],
                'outsourced_social' => ['nullable', 'in:0,1'],
                'marketing_tools' => ['nullable', 'array'],
                'marketing_tools.*' => ['string'],

                // 4. Görsel Kimlik
                'logo_satisfaction' => ['nullable', Rule::in(['yes', 'no', 'partially'])],
                'corporate_assets' => ['nullable', 'array'],
                'corporate_assets.*' => ['string'],
                'has_media_assets' => ['nullable', 'in:0,1'],
                'design_representation' => ['nullable', Rule::in(['yes', 'no', 'not_sure'])],

                // 5. Dijital Varlık
                'has_website' => ['nullable', 'in:0,1'],
                'is_mobile_ready' => ['nullable', Rule::in(['yes', 'no', 'not_sure'])],
                'has_seo' => ['nullable', Rule::in(['yes', 'no', 'not_sure'])],
                'web_performance_feedback' => ['nullable', 'string'],

                // 6. İletişim Bilgileri
                'full_name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email', 'max:255'],
                'preferred_contact' => ['nullable', Rule::in(['phone', 'whatsapp', 'email'])],
                'heard_from' => ['nullable', Rule::in(['instagram', 'google', 'referral', 'other'])],
            ], [
                // Custom error messages
                'brand_name.required' => 'Marka adı zorunludur.',
                'full_name.required' => 'Ad soyad zorunludur.',
                'phone.required' => 'Telefon numarası zorunludur.',
                'email.required' => 'E-posta adresi zorunludur.',
                'email.email' => 'Geçerli bir e-posta adresi giriniz.',
                'website.url' => 'Geçerli bir website adresi giriniz.',
            ]);

            // Boolean alanları düzelt
            $validated['has_social_management'] = $request->boolean('has_social_management');
            $validated['outsourced_social'] = $request->boolean('outsourced_social');
            $validated['has_media_assets'] = $request->boolean('has_media_assets');
            $validated['has_website'] = $request->boolean('has_website');

            // IP address ve user agent bilgilerini ekle
            $validated['ip_address'] = $request->ip();
            $validated['user_agent'] = $request->userAgent();

            // Veritabanına kaydet
            $brandBrief = BrandBrief::create($validated);

            // Admin e-posta bildirimi gönder
            try {
                $adminEmail = Setting::where('key', 'admin_email')->value('value') ?? 'admin@example.com';
                $notification = new NewBrandBriefNotification($brandBrief);

                Mail::to($adminEmail)->send($notification);

                // Log successful admin email
                EmailLog::create([
                    'type' => 'brand_brief_admin',
                    'to_email' => $adminEmail,
                    'subject' => 'Yeni Marka Analizi Talebi',
                    'content' => null,
                    'data' => $brandBrief->toArray(),
                    'status' => 'sent',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Log failed admin email
                EmailLog::create([
                    'type' => 'brand_brief_admin',
                    'to_email' => $adminEmail ?? 'unknown',
                    'subject' => 'Yeni Marka Analizi Talebi',
                    'content' => null,
                    'data' => $brandBrief->toArray(),
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => null,
                ]);

                Log::error('Brand brief admin notification email failed: ' . $e->getMessage());
            }

            // Kullanıcıya teşekkür maili gönder
            try {
                $thankYouMail = new BrandBriefThankYouMail($brandBrief);
                Mail::to($brandBrief->email)->send($thankYouMail);

                // Log successful thank you email
                EmailLog::create([
                    'type' => 'brand_brief_thank_you',
                    'to_email' => $brandBrief->email,
                    'subject' => Setting::getValue('brand_brief_thank_you_subject', 'Marka Brief Başvurunuz Alındı'),
                    'content' => null,
                    'data' => $brandBrief->toArray(),
                    'status' => 'sent',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Log failed thank you email
                EmailLog::create([
                    'type' => 'brand_brief_thank_you',
                    'to_email' => $brandBrief->email,
                    'subject' => Setting::getValue('brand_brief_thank_you_subject', 'Marka Brief Başvurunuz Alındı'),
                    'content' => null,
                    'data' => $brandBrief->toArray(),
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => null,
                ]);

                Log::error('Brand brief thank you email failed: ' . $e->getMessage());
            }

            // Geçici session'ı temizle
            Session::forget('brand_brief_temp_data');

            // AJAX request ise JSON response döndür
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Form başarıyla gönderildi!',
                    'redirect' => route('frontend.brand-brief.thankyou')
                ]);
            }

            // Normal request ise teşekkür sayfasına yönlendir
            return redirect()->route('frontend.brand-brief.thankyou')
                ->with('success', 'Form başarıyla gönderildi! En kısa sürede size dönüş yapacağız.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Hata durumunda form verilerini session'a kaydet
            Session::put('brand_brief_temp_data', $request->all());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                    'message' => 'Lütfen gerekli alanları doldurun.'
                ], 422);
            }

            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Show thank you page
     */
    public function thankyou()
    {
        return view('frontend.brand-brief.thankyou');
    }

    /**
     * Clear session data
     */
    public function clearSession(Request $request)
    {
        Session::forget('brand_brief_temp_data');
        return redirect()->route('frontend.brand-brief.create')->with('success', 'Form sıfırlandı.');
    }
}

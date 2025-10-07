<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use App\Models\EmailLog;
use App\Mail\NewContactNotification;
use App\Mail\ContactThankYouMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:25',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'Ad Soyad alanı zorunludur.',
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'phone.required' => 'Telefon alanı zorunludur.',
            'phone.min' => 'Telefon numarası en az 10 karakter olmalıdır.',
            'phone.max' => 'Telefon numarası en fazla 25 karakter olabilir.',
            'subject.required' => 'Konu alanı zorunludur.',
            'message.required' => 'Mesaj alanı zorunludur.',
            'message.max' => 'Mesaj en fazla 2000 karakter olabilir.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Send admin notification email
            try {
                $adminEmail = Setting::getValue('admin_email', 'info@ilayajans.com');
                $notification = new NewContactNotification($contact);

                Mail::to($adminEmail)->send($notification);

                // Log successful admin email
                EmailLog::create([
                    'type' => 'contact_admin',
                    'to_email' => $adminEmail,
                    'subject' => 'Yeni İletişim Formu Mesajı',
                    'content' => null, // İçerik template'den gelir
                    'data' => $contact->toArray(),
                    'status' => 'sent',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => now(),
                ]);
            } catch (\Exception $mailException) {
                // Log failed admin email
                EmailLog::create([
                    'type' => 'contact_admin',
                    'to_email' => $adminEmail ?? 'unknown',
                    'subject' => 'Yeni İletişim Formu Mesajı',
                    'content' => null,
                    'data' => $contact->toArray(),
                    'status' => 'failed',
                    'error_message' => $mailException->getMessage(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => null,
                ]);

                Log::error('Contact admin notification email failed: ' . $mailException->getMessage());
            }

            // Send thank you email to user
            try {
                $thankYouMail = new ContactThankYouMail($contact);
                Mail::to($contact->email)->send($thankYouMail);

                // Log successful thank you email
                EmailLog::create([
                    'type' => 'contact_thank_you',
                    'to_email' => $contact->email,
                    'subject' => Setting::getValue('contact_thank_you_subject', 'Mesajınız Alındı - Teşekkürler'),
                    'content' => null,
                    'data' => $contact->toArray(),
                    'status' => 'sent',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => now(),
                ]);
            } catch (\Exception $mailException) {
                // Log failed thank you email
                EmailLog::create([
                    'type' => 'contact_thank_you',
                    'to_email' => $contact->email,
                    'subject' => Setting::getValue('contact_thank_you_subject', 'Mesajınız Alındı - Teşekkürler'),
                    'content' => null,
                    'data' => $contact->toArray(),
                    'status' => 'failed',
                    'error_message' => $mailException->getMessage(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => null,
                ]);

                Log::error('Contact thank you email failed: ' . $mailException->getMessage());
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.'
                ]);
            }

            return redirect()->route('frontend.contact')
                ->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mesaj gönderilirken bir hata oluştu. Lütfen tekrar deneyiniz.'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Mesaj gönderilirken bir hata oluştu. Lütfen tekrar deneyiniz.')
                ->withInput();
        }
    }
}

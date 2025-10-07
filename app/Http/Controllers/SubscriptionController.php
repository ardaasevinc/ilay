<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Setting;
use App\Models\EmailLog;
use App\Mail\NewSubscriptionNotification;
use App\Mail\SubscriptionThankYouMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email:rfc,dns|unique:subscriptions,email',
            ]);

            $sub = Subscription::create(['email' => $validated['email']]);

            // Admin e-posta bildirimi gönder
            try {
                $adminEmail = Setting::where('key', 'admin_email')->value('value') ?? 'admin@example.com';
                $notification = new NewSubscriptionNotification($sub);

                Mail::to($adminEmail)->send($notification);

                // Log successful admin email
                EmailLog::create([
                    'type' => 'subscription_admin',
                    'to_email' => $adminEmail,
                    'subject' => 'Yeni E-bülten Aboneliği',
                    'content' => null,
                    'data' => $sub->toArray(),
                    'status' => 'sent',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Log failed admin email
                EmailLog::create([
                    'type' => 'subscription_admin',
                    'to_email' => $adminEmail ?? 'unknown',
                    'subject' => 'Yeni E-bülten Aboneliği',
                    'content' => null,
                    'data' => $sub->toArray(),
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => null,
                ]);

                Log::error('Subscription admin notification email failed: ' . $e->getMessage());
            }

            // Kullanıcıya teşekkür maili gönder
            try {
                $thankYouMail = new SubscriptionThankYouMail($sub);
                Mail::to($sub->email)->send($thankYouMail);

                // Log successful thank you email
                EmailLog::create([
                    'type' => 'subscription_thank_you',
                    'to_email' => $sub->email,
                    'subject' => Setting::getValue('subscription_thank_you_subject', 'Bülten Aboneliğiniz Onaylandı'),
                    'content' => null,
                    'data' => $sub->toArray(),
                    'status' => 'sent',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Log failed thank you email
                EmailLog::create([
                    'type' => 'subscription_thank_you',
                    'to_email' => $sub->email,
                    'subject' => Setting::getValue('subscription_thank_you_subject', 'Bülten Aboneliğiniz Onaylandı'),
                    'content' => null,
                    'data' => $sub->toArray(),
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'sent_at' => null,
                ]);

                Log::error('Subscription thank you email failed: ' . $e->getMessage());
            }

            return response()->json([
                'ok' => true,
                'message' => 'Abonelik başarıyla kaydedildi!',
                'data' => ['id' => $sub->id],
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'ok' => false,
                'message' => $e->validator->errors()->first('email') ?: 'Bir hata oluştu.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Throwable $e) {
            Log::error('subscription.store', ['ex' => $e]);
            return response()->json([
                'ok' => false,
                'message' => 'Bir hata oluştu. Lütfen tekrar deneyin.',
            ], 500);
        }
    }
}

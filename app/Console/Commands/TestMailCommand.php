<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Models\BrandBrief;
use App\Models\Subscription;
use App\Mail\ContactThankYouMail;
use App\Mail\BrandBriefThankYouMail;
use App\Mail\SubscriptionThankYouMail;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:mail {type} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test mail gönderimi - kullanım: test:mail contact test@example.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $email = $this->argument('email');

        $this->info("Mail testi başlatılıyor...");
        $this->info("Tip: {$type}");
        $this->info("E-posta: {$email}");

        try {
            switch ($type) {
                case 'contact':
                    $contact = new Contact([
                        'name' => 'Test Kullanıcı',
                        'email' => $email,
                        'phone' => '+90 555 123 45 67',
                        'subject' => 'Test İletişim Mesajı',
                        'message' => 'Bu bir test mesajıdır.',
                    ]);
                    $contact->created_at = now();

                    Mail::to($email)->send(new ContactThankYouMail($contact));
                    $this->info("✅ Contact teşekkür maili gönderildi!");
                    break;

                case 'brand-brief':
                    $brandBrief = new BrandBrief([
                        'company_name' => 'Test Şirketi',
                        'email' => $email,
                        'phone' => '+90 555 123 45 67',
                        'website' => 'https://test.com',
                        'project_type' => 'Logo Tasarımı',
                        'budget_range' => '10.000 - 25.000 TL',
                        'timeline' => '2-4 hafta',
                    ]);
                    $brandBrief->created_at = now();

                    Mail::to($email)->send(new BrandBriefThankYouMail($brandBrief));
                    $this->info("✅ Brand Brief teşekkür maili gönderildi!");
                    break;

                case 'subscription':
                    $subscription = new Subscription([
                        'email' => $email,
                        'name' => 'Test Kullanıcı',
                    ]);
                    $subscription->created_at = now();

                    Mail::to($email)->send(new SubscriptionThankYouMail($subscription));
                    $this->info("✅ Subscription teşekkür maili gönderildi!");
                    break;

                default:
                    $this->error("Geçersiz mail tipi. Kullanılabilir tipler: contact, brand-brief, subscription");
                    return 1;
            }

            $this->info("🎉 Mail başarıyla gönderildi!");
            return 0;
        } catch (\Exception $e) {
            $this->error("❌ Mail gönderimi başarısız: " . $e->getMessage());
            return 1;
        }
    }
}

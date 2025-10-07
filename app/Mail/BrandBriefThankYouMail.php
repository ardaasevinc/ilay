<?php

namespace App\Mail;

use App\Models\BrandBrief;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BrandBriefThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $brandBrief;

    /**
     * Create a new message instance.
     */
    public function __construct(BrandBrief $brandBrief)
    {
        $this->brandBrief = $brandBrief;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = Setting::where('key', 'mail_brand_brief_thank_you_subject')->value('value')
            ?? 'Marka Analizi Talebiniz Alındı';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.brand-brief-thank-you',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

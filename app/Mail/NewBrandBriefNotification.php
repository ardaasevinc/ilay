<?php

namespace App\Mail;

use App\Models\BrandBrief;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBrandBriefNotification extends Mailable
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
        return new Envelope(
            subject: 'Yeni Marka Analizi Talebi - ' . $this->brandBrief->company_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new-brand-brief',
            with: [
                'brandBrief' => $this->brandBrief,
            ],
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

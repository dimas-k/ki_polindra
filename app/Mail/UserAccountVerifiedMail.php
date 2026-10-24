<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserAccountVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $namaLengkap,
        public string $loginUrl,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Akun Anda Telah Diverifikasi - SIKI Polindra',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user-account-verified',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

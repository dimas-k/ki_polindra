<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $namaLengkap,
        public string $email,
        public string $role,
        public string $verifUrl,
        public ?string $noTelepon = null,
        public ?string $username = null,
        public ?string $nip = null,
        public ?string $alamat = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Akun Baru Menunggu Verifikasi - SIKI Polindra',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-user-registered',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

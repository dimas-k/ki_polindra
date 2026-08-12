<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KiSubmissionReceivedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $namaPengaju,
        public string $jenisKi,      // Paten | Hak Cipta | Desain Industri
        public string $judul,
        public string $status,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengajuan ' . $this->jenisKi . ' Anda Telah Diterima - SIKI Polindra',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ki-submission-received',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

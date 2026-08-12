<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KiStatusChangedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $namaPengaju,
        public string $jenisKi,
        public string $judul,
        public string $statusLama,
        public string $statusBaru,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update Status ' . $this->jenisKi . ': ' . $this->statusBaru . ' - SIKI Polindra',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ki-status-changed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

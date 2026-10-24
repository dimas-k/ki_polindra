<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KiPaymentReceivedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Payment $payment,
        public string $namaPengaju,
        public string $judul,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pembayaran ' . $this->payment->jenis_pengajuan . ' Berhasil Diterima - SIKI Polindra',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ki-payment-received',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

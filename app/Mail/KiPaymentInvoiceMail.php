<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KiPaymentInvoiceMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Payment $payment,
        public string $namaPengaju,
        public string $judul,
        public string $paymentUrl,
        public bool $isReminder = false,
    ) {}

    public function envelope(): Envelope
    {
        $subject = $this->isReminder
            ? 'Pengingat: Tagihan ' . $this->payment->jenis_pengajuan . ' Segera Jatuh Tempo - SIKI Polindra'
            : 'Tagihan Pembayaran ' . $this->payment->jenis_pengajuan . ' - SIKI Polindra';

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ki-payment-invoice',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

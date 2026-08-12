<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    protected Client $http;
    protected string $snapBaseUrl;

    public function __construct()
    {
        $this->snapBaseUrl = config('midtrans.is_production')
            ? 'https://app.midtrans.com/snap/v1'
            : 'https://app.sandbox.midtrans.com/snap/v1';

        $this->http = new Client([
            'base_uri' => $this->snapBaseUrl . '/',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode(config('midtrans.server_key') . ':'),
            ],
            'timeout' => 15,
        ]);
    }

    /**
     * Buat transaksi Snap baru dan kembalikan token + redirect_url.
     *
     * @param  string  $orderId
     * @param  int  $nominal
     * @param  array{name: string, email: string, phone?: string}  $customer
     * @param  string  $itemName
     * @return array{token: string, redirect_url: string}
     */
    public function createSnapTransaction(string $orderId, int $nominal, array $customer, string $itemName): array
    {
        $payload = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $nominal,
            ],
            'customer_details' => [
                'first_name' => $customer['name'],
                'email' => $customer['email'],
                'phone' => $customer['phone'] ?? null,
            ],
            'item_details' => [
                [
                    'id' => $orderId,
                    'price' => $nominal,
                    'quantity' => 1,
                    'name' => substr($itemName, 0, 50),
                ],
            ],
        ];

        try {
            $response = $this->http->post('transactions', ['json' => $payload]);
            $data = json_decode((string) $response->getBody(), true);

            return [
                'token' => $data['token'] ?? null,
                'redirect_url' => $data['redirect_url'] ?? null,
            ];
        } catch (\Throwable $e) {
            Log::error('Midtrans createSnapTransaction gagal: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Verifikasi signature_key dari payload notifikasi/webhook Midtrans.
     */
    public function verifySignature(array $payload): bool
    {
        $expected = hash('sha512',
            ($payload['order_id'] ?? '') .
            ($payload['status_code'] ?? '') .
            ($payload['gross_amount'] ?? '') .
            config('midtrans.server_key')
        );

        return hash_equals($expected, $payload['signature_key'] ?? '');
    }

    /**
     * Terjemahkan transaction_status dari Midtrans ke status internal aplikasi.
     */
    public function mapStatus(string $transactionStatus, ?string $fraudStatus = null): ?string
    {
        return match ($transactionStatus) {
            'capture' => ($fraudStatus === 'accept') ? \App\Models\Payment::STATUS_DIBAYAR : null,
            'settlement' => \App\Models\Payment::STATUS_DIBAYAR,
            'expire' => \App\Models\Payment::STATUS_KADALUARSA,
            'cancel', 'deny' => \App\Models\Payment::STATUS_DIBATALKAN,
            default => null,
        };
    }
}
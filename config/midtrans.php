<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    // Batas waktu pembayaran default (jam) jika admin tidak menentukan tenggat
    'default_expiry_hours' => env('MIDTRANS_DEFAULT_EXPIRY_HOURS', 48),
];

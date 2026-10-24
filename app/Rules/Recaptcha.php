<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Validates the Google reCAPTCHA v2 ("I'm not a robot") response token
 * sent by the browser in the hidden "g-recaptcha-response" field.
 *
 * Uses the site/secret keys already defined in config/recaptcha.php
 * (RECAPTCHA_SITE_KEY / RECAPTCHA_SECRET_KEY in .env).
 */
class Recaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $secret = config('recaptcha.api_secret_key');

        // If no secret key is configured (e.g. local dev without keys set),
        // don't hard-fail the whole app — just skip remote verification.
        if (empty($secret)) {
            Log::warning('RECAPTCHA_SECRET_KEY is not set; skipping captcha verification.');
            return;
        }

        if (empty($value)) {
            $fail('Silakan verifikasi bahwa Anda bukan robot.');
            return;
        }

        try {
            $response = Http::asForm()
                ->timeout(config('recaptcha.curl_timeout', 10))
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret'   => $secret,
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ]);

            $result = $response->json();
        } catch (\Throwable $e) {
            Log::error('reCAPTCHA verification request failed: ' . $e->getMessage());
            $fail('Tidak dapat memverifikasi captcha saat ini. Silakan coba lagi.');
            return;
        }

        if (empty($result['success'])) {
            $fail('Verifikasi captcha gagal. Silakan coba lagi.');
        }
    }
}

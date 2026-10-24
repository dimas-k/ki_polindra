{{-- Google reCAPTCHA v2 checkbox widget.
     Requires RECAPTCHA_SITE_KEY to be set in .env (see config/recaptcha.php). --}}
@if (config('recaptcha.api_site_key'))
    <div class="mb-3">
        <div class="g-recaptcha" data-sitekey="{{ config('recaptcha.api_site_key') }}"></div>
        @error('g-recaptcha-response')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
    @once
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endonce
@endif

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - SIKI Polindra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/polindra21.png') }}">
    <script type="text/javascript"
        src="{{ $isProduction ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ $clientKey }}"></script>
</head>
<body style="background:#f8f9fa;">
    @include('layout.nav')

    <div class="container" style="padding-top:100px; padding-bottom:60px; max-width:520px;">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-1">Pembayaran {{ $payment->jenis_pengajuan }}</h5>
                <p class="text-muted small mb-4">{{ $payment->deskripsi }}</p>

                <div class="bg-light rounded-3 p-3 mb-3">
                    <div class="text-muted small">Jumlah Tagihan</div>
                    <div class="fs-3 fw-bold">Rp{{ number_format($payment->nominal, 0, ',', '.') }}</div>
                </div>

                <div class="d-flex justify-content-between small mb-4">
                    <span class="text-muted">Batas waktu pembayaran</span>
                    <span class="fw-semibold text-danger">{{ $payment->tenggat_pembayaran->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>

                @if ($payment->status === \App\Models\Payment::STATUS_DIBAYAR)
                    <div class="alert alert-success mb-0">
                        <i class="bi bi-check-circle-fill me-2"></i>Tagihan ini sudah lunas.
                    </div>
                @elseif ($payment->status === \App\Models\Payment::STATUS_KADALUARSA)
                    <div class="alert alert-secondary mb-0">
                        Tagihan ini sudah kedaluwarsa. Silakan hubungi admin untuk membuat tagihan baru.
                    </div>
                @else
                    <button id="pay-button" class="btn w-100 py-2 fw-semibold text-white"
                        style="background:linear-gradient(135deg, rgb(255,99,132), #f83600); border:none;">
                        Bayar Sekarang
                    </button>
                @endif
            </div>
        </div>
    </div>

    @include('layout.footer')

    <script>
        document.getElementById('pay-button')?.addEventListener('click', function () {
            snap.pay(@json($payment->snap_token), {
                onSuccess: function () { window.location.reload(); },
                onPending: function () { window.location.reload(); },
                onError: function () { alert('Terjadi kesalahan saat memproses pembayaran.'); },
                onClose: function () {}
            });
        });
    </script>
</body>
</html>

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
                @elseif ($payment->status === \App\Models\Payment::STATUS_MENUNGGU_VERIFIKASI)
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-hourglass-split me-2"></i>Bukti transfer Anda sudah diunggah dan sedang
                        menunggu diverifikasi admin.
                    </div>
                @else
                    @if (session()->has('success'))
                        <div class="alert alert-success small">{{ session('success') }}</div>
                    @endif

                    @if ($payment->catatan_verifikasi && $payment->status === \App\Models\Payment::STATUS_MENUNGGU)
                        <div class="alert alert-danger small">
                            <strong>Bukti transfer sebelumnya ditolak:</strong> {{ $payment->catatan_verifikasi }}.
                            Silakan unggah ulang bukti transfer yang valid.
                        </div>
                    @endif

                    <button id="pay-button" class="btn w-100 py-2 fw-semibold text-white mb-3"
                        style="background:linear-gradient(135deg, rgb(255,99,132), #f83600); border:none;">
                        Bayar Sekarang (Otomatis via Midtrans)
                    </button>

                    @if ($bankAccounts->isNotEmpty())
                        <div class="text-center text-muted small mb-3">atau</div>

                        <button class="btn btn-outline-dark w-100 py-2 fw-semibold mb-2" type="button"
                            data-bs-toggle="collapse" data-bs-target="#manualPaymentForm">
                            <i class="bi bi-bank me-2"></i>Bayar via Transfer Manual / QRIS
                        </button>

                        <div class="collapse" id="manualPaymentForm">
                            <form method="post" action="{{ route('payment.manual', $payment->order_id) }}"
                                enctype="multipart/form-data" class="border rounded-3 p-3 mt-2">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">Pilih Kanal Pembayaran</label>
                                    <select name="bank_account_id" class="form-select form-select-sm" required>
                                        <option value="" disabled selected>-- Pilih rekening/kanal --</option>
                                        @foreach ($bankAccounts as $bank)
                                            <option value="{{ $bank->id }}">
                                                {{ $bank->nama_bank }}
                                                @if ($bank->nomor_rekening)
                                                    - {{ $bank->nomor_rekening }}
                                                @endif
                                                @if ($bank->atas_nama)
                                                    a.n. {{ $bank->atas_nama }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">Unggah Bukti Transfer</label>
                                    <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf"
                                        class="form-control form-control-sm" required>
                                    <div class="form-text">Format JPG, PNG, atau PDF. Maksimal 2MB.</div>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    <i class="bi bi-upload me-1"></i>Kirim Bukti Transfer
                                </button>
                            </form>
                        </div>
                    @endif
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

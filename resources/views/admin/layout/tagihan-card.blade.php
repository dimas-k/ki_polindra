{{--
    Partial kartu Tagihan Pembayaran untuk halaman detail admin.
    Wajib passing variabel:
    - $pembayaran   : relasi payment() dari model (Paten/HakCipta/DesainIndustri), boleh null
    - $jenisSlug    : 'paten' | 'hak-cipta' | 'desain-industri'
    - $pengajuanId  : id data pengajuan
    - $namaPengaju  : nama_lengkap pengajuan (untuk judul modal)
--}}
<div class="container bg-light rounded border pt-3 mt-3">
    <h5 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-credit-card me-2"></i>Tagihan Pembayaran</h5>

    <div class="p-3">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($pembayaran)
            <div class="table-responsive">
<table class="table table-borderless mb-3">
                <tr>
                    <th style="width:220px;">Nominal</th>
                    <td>: Rp{{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>:
                        @php
                            $badge = match($pembayaran->status) {
                                'Dibayar' => 'success',
                                'Kadaluarsa' => 'secondary',
                                'Dibatalkan' => 'danger',
                                default => 'warning',
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $pembayaran->status }}</span>
                    </td>
                </tr>
                <tr>
                    <th>Batas Waktu</th>
                    <td>: {{ $pembayaran->tenggat_pembayaran->translatedFormat('d F Y, H:i') }} WIB</td>
                </tr>
                @if ($pembayaran->paid_at)
                    <tr>
                        <th>Dibayar Pada</th>
                        <td>: {{ $pembayaran->paid_at->translatedFormat('d F Y, H:i') }} WIB</td>
                    </tr>
                @endif
                <tr>
                    <th>Tautan Pembayaran</th>
                    <td>:
                        <a href="{{ route('payment.show', $pembayaran->order_id) }}" target="_blank">
                            Lihat Halaman Pembayaran
                        </a>
                    </td>
                </tr>
            </table>
</div>
        @else
            <p class="text-muted">Belum ada tagihan pembayaran untuk pengajuan ini.</p>
        @endif

        @if (!$pembayaran || in_array($pembayaran->status, ['Kadaluarsa', 'Dibatalkan']))
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTagihan">
                <i class="bi bi-receipt me-1"></i>Buat Tagihan Pembayaran
            </button>
        @endif
    </div>

    {{-- Modal Buat Tagihan --}}
    <div class="modal fade" id="modalTagihan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin_payment.store', ['jenis' => $jenisSlug, 'id' => $pengajuanId]) }}"
                    method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Buat Tagihan - {{ $namaPengaju }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nominal (Rp)</label>
                            <input type="number" name="nominal" class="form-control" min="1000" step="1000"
                                placeholder="Contoh: 500000" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan (opsional)</label>
                            <input type="text" name="deskripsi" class="form-control"
                                placeholder="Contoh: Biaya pendaftaran paten">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Batas Waktu Pembayaran (opsional)</label>
                            <input type="datetime-local" name="tenggat_pembayaran" class="form-control">
                            <div class="form-text">Kosongkan untuk memakai batas waktu default sistem.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim Tagihan ke Email Pengaju</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

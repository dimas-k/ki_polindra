<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Payment - Riwayat</title>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
</head>

<body>
    <div class="container-fluid border">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img class="navbar-brand" src={{ asset('assets/polindra2.jpg') }}>
                <a class="navbar-brand fs-6 fw-normal font-family-Kokoro brand-text-responsive" href="#">
                    <span class="d-inline d-md-none">SIKI POLINDRA</span>
                    <span class="d-none d-md-inline">Sistem Informasi Kekayaan
                        Intelektual<br>Politeknik Negeri Indramayu</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Selamat datang, {{ auth()->user()->nama_lengkap }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/admin/dashboard"><i class="bi bi-grid me-2"></i>Pilih Aplikasi</a></li>
                                <li><a class="dropdown-item" href="/logout"><i
                                            class="bi bi-arrow-bar-left me-2"></i>Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row">
            @include('admin.layout.sidenav')
            <div class="col-12 col-lg-10 mt-2">
                <div class="container bg-light rounded border pt-3 pb-4">
                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-clock-history me-3"></i>Riwayat
                        Pembayaran</h3>

                    <form method="get" class="row g-2 mb-3">
                        <div class="col-auto">
                            <select name="status" class="form-select form-select-sm">
                                <option value="">Semua Status</option>
                                @foreach ([
                                        \App\Models\Payment::STATUS_MENUNGGU,
                                        \App\Models\Payment::STATUS_MENUNGGU_VERIFIKASI,
                                        \App\Models\Payment::STATUS_DIBAYAR,
                                        \App\Models\Payment::STATUS_KADALUARSA,
                                        \App\Models\Payment::STATUS_DIBATALKAN,
                                    ] as $status)
                                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <select name="tipe_pembayaran" class="form-select form-select-sm">
                                <option value="">Semua Metode</option>
                                <option value="midtrans" @selected(request('tipe_pembayaran') === 'midtrans')>Midtrans</option>
                                <option value="manual" @selected(request('tipe_pembayaran') === 'manual')>Manual (Transfer/VA/QRIS)</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                            <a href="{{ url('/admin/payment/riwayat') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover font-family-Kokoro align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Pengaju</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Metode</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Dibuat</th>
                                    <th scope="col">Dibayar Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $p)
                                    <tr>
                                        <td>{{ $p->order_id }}</td>
                                        <td>{{ $p->user->nama_lengkap ?? '-' }}</td>
                                        <td>{{ $p->jenis_pengajuan }}</td>
                                        <td>Rp{{ number_format($p->nominal, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($p->tipe_pembayaran === 'manual')
                                                Manual - {{ $p->bankAccount->nama_bank ?? '-' }}
                                            @else
                                                Midtrans{{ $p->metode_pembayaran ? ' - ' . $p->metode_pembayaran : '' }}
                                            @endif
                                        </td>
                                        <td>
                                            <span @class([
                                                'badge',
                                                'text-bg-success' => $p->status === \App\Models\Payment::STATUS_DIBAYAR,
                                                'text-bg-warning' => in_array($p->status, [\App\Models\Payment::STATUS_MENUNGGU, \App\Models\Payment::STATUS_MENUNGGU_VERIFIKASI]),
                                                'text-bg-secondary' => in_array($p->status, [\App\Models\Payment::STATUS_KADALUARSA, \App\Models\Payment::STATUS_DIBATALKAN]),
                                            ])>{{ $p->status }}</span>
                                        </td>
                                        <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $p->paid_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">Belum ada data
                                            pembayaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src={{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}></script>
</body>

</html>

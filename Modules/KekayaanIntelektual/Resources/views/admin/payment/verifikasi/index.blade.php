<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Payment - Verifikasi</title>
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
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-patch-check me-3"></i>Verifikasi
                        Pembayaran Manual</h3>
                    <p class="text-muted small">Daftar pembayaran transfer/VA/QRIS yang buktinya sudah diunggah
                        pengaju dan menunggu diperiksa.</p>

                    <div class="table-responsive">
                        <table class="table table-hover font-family-Kokoro align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Kanal</th>
                                    <th scope="col">Bukti</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $i => $p)
                                    <tr>
                                        <th scope="row">{{ $i + 1 }}</th>
                                        <td>{{ $p->order_id }}</td>
                                        <td>{{ $p->jenis_pengajuan }}</td>
                                        <td>Rp{{ number_format($p->nominal, 0, ',', '.') }}</td>
                                        <td>{{ $p->bankAccount->nama_bank ?? '-' }}</td>
                                        <td>
                                            @if ($p->bukti_pembayaran)
                                                <a href="{{ route('admin_payment_verifikasi.bukti', $p->id) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-image"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#setujuiModal{{ $p->id }}"><i
                                                    class="bi bi-check-lg"></i> Setujui</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#tolakModal{{ $p->id }}"><i
                                                    class="bi bi-x-lg"></i> Tolak</button>

                                            {{-- Modal Setujui --}}
                                            <div class="modal fade" id="setujuiModal{{ $p->id }}" tabindex="-1"
                                                data-bs-backdrop="static" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">Setujui Pembayaran</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post"
                                                            action="{{ route('admin_payment_verifikasi.setujui', $p->id) }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p>Tandai pembayaran <strong>{{ $p->order_id }}</strong>
                                                                    sebesar <strong>Rp{{ number_format($p->nominal, 0, ',', '.') }}</strong>
                                                                    sebagai lunas?</p>
                                                                <div class="mb-2">
                                                                    <label class="form-label">Catatan (opsional)</label>
                                                                    <textarea name="catatan_verifikasi" class="form-control" rows="2"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-success">Ya,
                                                                    Setujui</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Modal Tolak --}}
                                            <div class="modal fade" id="tolakModal{{ $p->id }}" tabindex="-1"
                                                data-bs-backdrop="static" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">Tolak Bukti Pembayaran</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post"
                                                            action="{{ route('admin_payment_verifikasi.tolak', $p->id) }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-2">
                                                                    <label class="form-label">Alasan penolakan
                                                                        (wajib diisi, akan dilihat pengaju)</label>
                                                                    <textarea name="catatan_verifikasi" class="form-control" rows="3" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Tolak
                                                                    Bukti</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Tidak ada pembayaran
                                            yang menunggu verifikasi saat ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src={{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}></script>
</body>

</html>

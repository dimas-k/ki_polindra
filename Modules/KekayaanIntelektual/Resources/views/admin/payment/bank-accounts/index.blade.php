<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Payment - Daftar Bank</title>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
</head>

<body>
    {{-- Top nav bar --}}
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
                                <li><a class="dropdown-item" href="/logout"><i
                                            class="bi bi-arrow-bar-left me-2"></i>Log
                                        Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    {{-- end of top navbar --}}
    <div class="container-fluid">
        <div class="row">
            {{-- Side bar --}}
            @include('admin.layout.sidenav')
            {{-- end of sidebar --}}
            <div class="col-12 col-lg-10 mt-2">
                <div class="container bg-light rounded border pt-3 pb-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fw-normal font-family-Kokoro mb-0"><i class="bi bi-credit-card me-3"></i>Daftar
                            Kanal Pembayaran</h3>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#tambahBankModal"><i class="bi bi-plus-circle me-1"></i>Tambah
                            Kanal</button>
                    </div>
                    <p class="text-muted small">Kelola rekening bank, virtual account, dan QRIS yang bisa dipilih
                        admin saat membuat tagihan pembayaran manual (tanpa melalui Midtrans).</p>

                    <div class="table-responsive">
                        <table class="table table-hover font-family-Kokoro align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Nama Bank / Kanal</th>
                                    <th scope="col">No. Rekening / VA</th>
                                    <th scope="col">Atas Nama</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bankAccounts as $i => $b)
                                    <tr>
                                        <th scope="row">{{ $i + 1 }}</th>
                                        <td><span class="badge text-bg-secondary">{{ $b->tipe_label }}</span></td>
                                        <td>
                                            {{ $b->nama_bank }}
                                            @if ($b->is_default)
                                                <span class="badge text-bg-primary ms-1">Default</span>
                                            @endif
                                        </td>
                                        <td>{{ $b->nomor_rekening ?? '-' }}</td>
                                        <td>{{ $b->atas_nama ?? '-' }}</td>
                                        <td>
                                            <form method="post"
                                                action="{{ url('/admin/payment/bank-accounts/' . $b->id . '/toggle-aktif') }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-sm {{ $b->is_active ? 'btn-outline-success' : 'btn-outline-secondary' }}">
                                                    {{ $b->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editBankModal{{ $b->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusBankModal{{ $b->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>

                                            @include('kekayaanintelektual::admin.payment.bank-accounts.edit-modal', ['b' => $b])
                                            @include('kekayaanintelektual::admin.payment.bank-accounts.delete-modal', ['b' => $b])
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Belum ada kanal
                                            pembayaran. Tambahkan minimal satu rekening/VA/QRIS agar admin bisa
                                            membuat tagihan pembayaran manual.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Kanal Pembayaran --}}
    <div class="modal fade" id="tambahBankModal" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="tambahBankModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahBankModalLabel">Tambah Kanal Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('kekayaanintelektual::admin.payment.bank-accounts.form', [
                        'formId' => 'tambah',
                        'action' => url('/admin/payment/bank-accounts'),
                        'method' => 'POST',
                        'b' => null,
                        'submitLabel' => 'Tambah',
                    ])
                </div>
            </div>
        </div>
    </div>

    <script src={{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <script>
        // Tampilkan/sembunyikan field sesuai tipe kanal pembayaran yang dipilih
        document.querySelectorAll('[data-tipe-select]').forEach(function (select) {
            var suffix = select.dataset.tipeSelect;
            var toggle = function () {
                var isQris = select.value === 'qris';
                var rekeningWrap = document.querySelector('[data-rekening-wrap="' + suffix + '"]');
                var qrisWrap = document.querySelector('[data-qris-wrap="' + suffix + '"]');
                if (rekeningWrap) rekeningWrap.classList.toggle('d-none', isQris);
                if (qrisWrap) qrisWrap.classList.toggle('d-none', !isQris);
            };
            select.addEventListener('change', toggle);
            toggle();
        });
    </script>
</body>

</html>

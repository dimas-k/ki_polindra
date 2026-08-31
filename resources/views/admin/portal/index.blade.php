<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA | Pilih Aplikasi</title>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
    <style>
        body {
            background-color: #f2f4f9;
        }

        .portal-card {
            border: 1px solid var(--polindra-border, #d7e0f0);
            border-radius: 10px;
            background: #fff;
            height: 100%;
            transition: box-shadow .15s ease;
        }

        .portal-card:hover {
            box-shadow: 0 0.35rem 0.75rem rgba(0, 15, 86, 0.12);
        }

        .portal-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--polindra-blue-light, #e8edfa);
            color: var(--polindra-blue, #0d3b8c);
            font-size: 1.6rem;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-white border-bottom py-3">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/polindra2.jpg') }}" height="36" class="me-2">
                <span class="fw-semibold" style="color: var(--polindra-navy, #000f56);">SIKI POLINDRA</span>
            </div>
            <div class="dropdown">
                <a class="text-decoration-none text-dark dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    Sebagai <strong>{{ auth()->user()->role }}</strong> &middot; {{ auth()->user()->nama_lengkap }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/logout"><i class="bi bi-arrow-bar-left me-2"></i>Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h4 class="mb-1">Selamat datang, <strong>{{ auth()->user()->nama_lengkap }}</strong>!</h4>
        <p class="text-muted mb-5">Pilih aplikasi yang ingin kamu buka.</p>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="portal-card p-4">
                    <div class="portal-icon mb-3">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Kekayaan Intelektual</h5>
                    <p class="text-muted mb-4">Pengelolaan Paten, Hak Cipta, dan Desain Industri</p>
                    <a href="/admin/dashboard/kekayaan-intelektual" class="btn btn-outline-primary w-100">Masuk</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="portal-card p-4">
                    <div class="portal-icon mb-3">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Produk Inovasi &amp; Penelitian</h5>
                    <p class="text-muted mb-4">Pengelolaan Produk Inovasi, Penelitian, dan Kelompok Bidang Keahlian</p>
                    <a href="/admin/kelompok-bidang-keahlian" class="btn btn-outline-primary w-100">Masuk</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
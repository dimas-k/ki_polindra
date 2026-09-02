<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Paten | Kirim ke Dashboard</title>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
</head>

<body>
    <div class="container-fluid border">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img class="navbar-brand" src={{ asset('assets/polindra2.jpg') }}>
                <a class="navbar-brand fs-6 fw-normal" href="#">
                    Sistem Informasi Kekayaan Intelektual<br>Politeknik Negeri Indramayu
                </a>
            </div>
        </nav>
    </div>

    <div class="container mt-4">
        <h4 class="mb-4">Kirim ke Dashboard Produk Inovasi</h4>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($paten->dikirim_ke)
            <div class="alert alert-warning">
                Data ini sudah pernah dikirim sebagai <strong>{{ ucfirst($paten->dikirim_ke) }}</strong>.
            </div>
        @else
            <form action="{{ route('admin_paten.kirim', $paten->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" value="{{ $paten->judul_paten }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kirim sebagai</label>
                    <select name="tujuan" class="form-select" required>
                        <option value="">-- Pilih Tujuan --</option>
                        <option value="produk">Produk Inovasi</option>
                        <option value="penelitian">Penelitian</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelompok Bidang Keahlian (KBK)</label>
                    <select name="kbk_id" class="form-select" required>
                        <option value="">-- Pilih KBK --</option>
                        @foreach ($kbk as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kbk }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Kirim ke Dashboard</button>
                <a href="{{ route('admin_paten.show', $paten->id) }}" class="btn btn-secondary">Batal</a>
            </form>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
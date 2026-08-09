<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/polindra21.png') }}">
    <title>SIKI POLINDRA | Lihat Data Paten</title>
    <style>
        body { background-color: #f8f9fa; }

        .detail-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .detail-card-header {
            background: linear-gradient(135deg, rgb(255, 99, 132), #f83600);
            padding: 28px 32px;
            color: #1f2937;
        }

        .detail-card-header h4 {
            font-weight: 700;
            margin: 0;
            font-size: 1.3rem;
        }

        .detail-card-header p {
            margin: 4px 0 0;
            opacity: .7;
            font-size: .9rem;
        }

        .detail-row {
            display: flex;
            align-items: flex-start;
            padding: 14px 0;
            border-bottom: 1px solid #f0f0f0;
            gap: 16px;
        }

        .detail-row:last-child { border-bottom: none; }

        .detail-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(255, 99, 132, 0.12), rgba(248, 54, 0, 0.12));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #f83600;
            font-size: 1rem;
        }

        .detail-label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #9ca3af;
            margin-bottom: 3px;
        }

        .detail-value {
            font-size: .95rem;
            color: #1f2937;
            font-weight: 500;
            line-height: 1.5;
        }

        .badge-status {
            font-size: .8rem;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
        }

        .btn-doc {
            font-size: .82rem;
            padding: 5px 14px;
            border-radius: 20px;
            font-weight: 500;
            border: 1.5px solid rgb(255, 99, 132);
            color: #f83600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all .2s;
            margin: 3px 4px 3px 0;
        }

        .btn-doc:hover {
            background: linear-gradient(135deg, rgb(255, 99, 132), #f83600);
            color: #1f2937;
            border-color: transparent;
        }

        .docs-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 6px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .9rem;
            font-weight: 500;
            color: #f83600;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 10px;
            border: 1.5px solid rgba(255, 99, 132, 0.13);
            background: #fff;
            transition: all .2s;
        }

        .back-btn:hover {
            background: rgb(255, 99, 132);
            color: #fff;
            border-color: #f83600;
        }

        @media (max-width: 576px) {
            .detail-card-header { padding: 20px; }
        }
    </style>
</head>

<body>
    @include('layout.nav')

    <div class="container" style="padding-top: 100px; padding-bottom: 60px; max-width: 780px;">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/paten" class="text-decoration-none text-muted">Paten</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width:200px">{{ $paten->judul_paten }}</li>
            </ol>
        </nav>

        {{-- Back button --}}
        <a href="/paten" class="back-btn mb-4 d-inline-flex">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="detail-card mt-3">
            {{-- Card Header --}}
            <div class="detail-card-header d-flex align-items-center gap-3">
                <div style="background:rgba(0,0,0,.1);border-radius:12px;width:52px;height:52px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-lightbulb fs-4"></i>
                </div>
                <div>
                    <h4>{{ $paten->judul_paten }}</h4>
                    <p>Data Paten &mdash; {{ $paten->jenis_paten }}</p>
                </div>
            </div>

            {{-- Card Body --}}
            <div class="card-body p-4">

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-person"></i></div>
                    <div>
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value">{{ $paten->nama_lengkap }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-envelope"></i></div>
                    <div>
                        <div class="detail-label">Email</div>
                        <div class="detail-value">
                            <a href="mailto:{{ $paten->email }}" class="text-decoration-none" style="color:#f83600">{{ $paten->email }}</a>
                        </div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-tag"></i></div>
                    <div>
                        <div class="detail-label">Jenis Paten</div>
                        <div class="detail-value">{{ $paten->jenis_paten }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-file-earmark-pdf"></i></div>
                    <div>
                        <div class="detail-label">Dokumen Publik</div>
                        <div class="docs-grid">
                            <a href="{{ route('public_paten_guest', ['filename' => basename($paten->abstrak_paten)]) }}"
                                target="_blank" class="btn-doc">
                                <i class="bi bi-file-text"></i> Abstrak
                            </a>
                            <a href="{{ route('public_paten_guest', ['filename' => basename($paten->deskripsi_paten)]) }}"
                                target="_blank" class="btn-doc">
                                <i class="bi bi-file-earmark-text"></i> Deskripsi
                            </a>
                            <a href="{{ route('public_paten_guest', ['filename' => basename($paten->gambar_paten)]) }}"
                                target="_blank" class="btn-doc">
                                <i class="bi bi-image"></i> Gambar Paten
                            </a>
                            <a href="{{ route('public_paten_guest', ['filename' => basename($paten->gambar_tampilan)]) }}"
                                target="_blank" class="btn-doc">
                                <i class="bi bi-display"></i> Gambar Tampilan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-calendar3"></i></div>
                    <div>
                        <div class="detail-label">Tanggal Pengajuan</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($paten->tanggal_permohonan)->translatedFormat('d F Y') }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-patch-check"></i></div>
                    <div>
                        <div class="detail-label">Status Paten</div>
                        <div class="detail-value mt-1">
                            @php
                                $statusMap = [
                                    'Tercatat'  => 'success',
                                    'Proses'    => 'warning',
                                    'Ditolak'   => 'danger',
                                    'Menunggu'  => 'secondary',
                                ];
                                $color = $statusMap[$paten->status] ?? 'primary';
                            @endphp
                            <span class="badge badge-status bg-{{ $color }}">{{ $paten->status }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
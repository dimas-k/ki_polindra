<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/logo-polindra.png') }}">
    <title>SIKI POLINDRA | Lihat Data Hak Cipta</title>
    <style>
        body { background-color: #f8f9fa; }

        .detail-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .detail-card-header {
            background: linear-gradient(135deg, #667eea);
            padding: 28px 32px;
            color: #fff;
        }

        .detail-card-header h4 {
            font-weight: 700;
            margin: 0;
            font-size: 1.3rem;
        }

        .detail-card-header p {
            margin: 4px 0 0;
            opacity: .8;
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
            background: linear-gradient(135deg, #667eea22, #764ba222);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #667eea;
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
            font-size: .85rem;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 500;
            border: 1.5px solid #667eea;
            color: #667eea;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s;
        }

        .btn-doc:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border-color: transparent;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .9rem;
            font-weight: 500;
            color: #667eea;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 10px;
            border: 1.5px solid #667eea22;
            background: #fff;
            transition: all .2s;
        }

        .back-btn:hover {
            background: #667eea;
            color: #fff;
            border-color: #667eea;
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
                <li class="breadcrumb-item"><a href="/hak-cipta" class="text-decoration-none text-muted">Hak Cipta</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width:200px">{{ $hc->judul_ciptaan }}</li>
            </ol>
        </nav>

        {{-- Back button --}}
        <a href="/hak-cipta" class="back-btn mb-4 d-inline-flex">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="detail-card mt-3">
            {{-- Card Header --}}
            <div class="detail-card-header d-flex align-items-center gap-3">
                <div style="background:rgba(255,255,255,.2);border-radius:12px;width:52px;height:52px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-c-circle fs-4"></i>
                </div>
                <div>
                    <h4>{{ $hc->judul_ciptaan }}</h4>
                    <p>Data Hak Cipta &mdash; {{ $hc->jenis_ciptaan }}</p>
                </div>
            </div>

            {{-- Card Body --}}
            <div class="card-body p-4">

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-person"></i></div>
                    <div>
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value">{{ $hc->nama_lengkap }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-envelope"></i></div>
                    <div>
                        <div class="detail-label">Email</div>
                        <div class="detail-value">
                            <a href="mailto:{{ $hc->email }}" class="text-decoration-none" style="color:#667eea">{{ $hc->email }}</a>
                        </div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-tag"></i></div>
                    <div>
                        <div class="detail-label">Jenis Ciptaan</div>
                        <div class="detail-value">{{ $hc->jenis_ciptaan }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-card-text"></i></div>
                    <div>
                        <div class="detail-label">Uraian Singkat</div>
                        <div class="detail-value" style="white-space:pre-line">{{ $hc->uraian_singkat }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-file-earmark-pdf"></i></div>
                    <div>
                        <div class="detail-label">Dokumen Invensi</div>
                        <div class="detail-value mt-1">
                            <a href="{{ route('public_hc_guest', ['filename' => basename($hc->dokumen_invensi)]) }}"
                                target="_blank" class="btn-doc">
                                <i class="bi bi-eye"></i> Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-calendar3"></i></div>
                    <div>
                        <div class="detail-label">Tanggal Pengajuan</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($hc->tanggal_permohonan)->translatedFormat('d F Y') }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon"><i class="bi bi-patch-check"></i></div>
                    <div>
                        <div class="detail-label">Status</div>
                        <div class="detail-value mt-1">
                            @php
                                $statusMap = [
                                    'Tercatat'  => 'success',
                                    'Proses'    => 'warning',
                                    'Ditolak'   => 'danger',
                                    'Menunggu'  => 'secondary',
                                ];
                                $color = $statusMap[$hc->status] ?? 'primary';
                            @endphp
                            <span class="badge badge-status bg-{{ $color }}">{{ $hc->status }}</span>
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
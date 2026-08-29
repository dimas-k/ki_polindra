<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href={{ asset('assets/logo-polindra.png') }}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>SIKI POLINDRA | Beranda</title>
</head>

<body>
    <style>
        :root {
            --polindra-navy: #002a57;
            --polindra-blue: #003d7a;
            --polindra-blue-light: #0066cc;
            --polindra-sky: #eef4fb;
            --polindra-line: #dde5ee;
        }

        body {
            background-color: #fff;
        }

        /* ===== Split hero ===== */
        .ki-hero {
            background: var(--polindra-navy);
            background: linear-gradient(120deg, var(--polindra-navy) 0%, var(--polindra-blue) 100%);
            border-radius: 0 0 24px 24px;
            padding: 130px 0 60px;
            margin-top: 0;
            position: relative;
            overflow: hidden;
        }

        @media (max-width: 991px) {
            .ki-hero {
                padding-top: 150px;
            }
        }

        .ki-hero::before {
            content: '';
            position: absolute;
            right: -80px;
            top: -80px;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .ki-hero::after {
            content: '';
            position: absolute;
            left: -60px;
            bottom: -100px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        .ki-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #cfe0f5;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 999px;
            padding: 5px 14px;
            margin-bottom: 16px;
        }

        .ki-hero h1 {
            color: #fff;
            font-size: 1.9rem;
            font-weight: 700;
            line-height: 1.35;
            margin-bottom: 14px;
        }

        .ki-hero p {
            color: #cfe0f5;
            font-size: 0.92rem;
            line-height: 1.75;
            margin-bottom: 22px;
        }

        .ki-hero .btn-hero-primary {
            background: #fff;
            color: var(--polindra-navy);
            font-weight: 600;
            font-size: 0.88rem;
            border-radius: 8px;
            padding: 10px 22px;
            border: none;
        }

        .ki-hero .btn-hero-primary:hover {
            background: var(--polindra-sky);
            color: var(--polindra-navy);
        }

        .ki-hero .btn-hero-ghost {
            background: transparent;
            color: #fff;
            font-weight: 600;
            font-size: 0.88rem;
            border-radius: 8px;
            padding: 10px 22px;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .ki-hero .btn-hero-ghost:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .ki-hero-frame {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
            border: 6px solid rgba(255, 255, 255, 0.12);
        }

        .ki-hero-frame img {
            display: block;
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        @media (max-width: 767px) {
            .ki-hero h1 {
                font-size: 1.4rem;
            }

            .ki-hero-frame {
                margin-top: 24px;
            }
        }

        /* ===== Stat strip (angka besar dengan garis pemisah) ===== */
        .ki-stat-strip {
            background: #fff;
            border: 1px solid var(--polindra-line);
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 42, 87, 0.06);
            margin-top: -42px;
            position: relative;
            z-index: 3;
        }

        .ki-stat-item {
            padding: 26px 20px;
            text-align: center;
            text-decoration: none;
            display: block;
            position: relative;
        }

        .ki-stat-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 20%;
            bottom: 20%;
            width: 1px;
            background: var(--polindra-line);
        }

        .ki-stat-item .bi {
            font-size: 1.4rem;
            color: var(--polindra-blue-light);
            margin-bottom: 8px;
            display: inline-block;
        }

        .ki-stat-item .ki-num {
            font-size: 2.1rem;
            font-weight: 700;
            color: var(--polindra-navy);
            line-height: 1.1;
        }

        .ki-stat-item .ki-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: #6c7a89;
            margin-top: 4px;
        }

        .ki-stat-item:hover .ki-label {
            color: var(--polindra-blue);
        }

        @media (max-width: 767px) {
            .ki-stat-item:not(:last-child)::after {
                display: none;
            }

            .ki-stat-item {
                border-bottom: 1px solid var(--polindra-line);
            }

            .ki-stat-item:last-child {
                border-bottom: none;
            }
        }

        /* ===== Section heading ===== */
        .ki-section-eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--polindra-blue-light);
            margin-bottom: 4px;
        }

        .ki-section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--polindra-navy);
            margin-bottom: 0;
        }

        .ki-section-sub {
            font-size: 0.85rem;
            color: #6c7a89;
        }

        .ki-chart-card {
            background: #fff;
            border: 1px solid var(--polindra-line);
            border-radius: 16px;
        }

        .ki-jurusan-filter-wrap {
            gap: 10px;
        }

        .ki-jurusan-btn {
            background: var(--polindra-blue);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 18px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .ki-jurusan-btn:hover,
        .ki-jurusan-btn:focus {
            color: #fff;
            background: var(--polindra-navy);
        }

        .ki-jurusan-menu {
            max-height: 280px;
            overflow-y: auto;
            border: 1px solid var(--polindra-line);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            padding: 6px;
            min-width: 230px;
        }

        .ki-jurusan-menu .dropdown-item {
            border-radius: 6px;
            padding: 8px 14px;
            font-size: 0.85rem;
            color: #495057;
        }

        .ki-jurusan-menu .dropdown-item:hover,
        .ki-jurusan-menu .dropdown-item:focus {
            background: var(--polindra-sky);
            color: var(--polindra-blue);
        }

        .ki-jurusan-menu .dropdown-item.active {
            background: var(--polindra-blue);
            color: #fff;
        }
    </style>
    {{-- nav --}}
    @include('layout.nav')
    {{-- end nav --}}

    <section class="ki-hero">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="ki-hero-badge"><i class="bi bi-shield-check"></i> Politeknik Negeri Indramayu</span>
                    <h1>Sistem Informasi<br>Kekayaan Intelektual <span style="white-space:nowrap;">(SIKI
                            POLINDRA)</span></h1>
                    <p>
                        Media informasi perkembangan permohonan Kekayaan Intelektual yang dikelola oleh Politeknik Negeri Indramayu.
                        Pemangku kepentingan, inventor, dan masyarakat luas dapat memantau status permohonan,
                        mengunduh berkas KI, serta mengajukan permohonan KI secara daring melalui unit pengelola KI
                        Politeknik Negeri Indramayu.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="/paten" class="btn btn-hero-primary">Lihat Data KI</a>
                        <a href="/panduan" class="btn btn-hero-ghost">Panduan Pengajuan</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ki-hero-frame">
                        <img src="{{ asset('assets/gedung.jpg') }}" alt="Gedung Politeknik Negeri Indramayu">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="ki-stat-strip">
            <div class="row g-0">
                <div class="col-md-4 col-sm-12">
                    <a href="/paten" class="ki-stat-item">
                        <i class="bi bi-file-earmark-lock2"></i>
                        <div class="ki-num">{{ $paten }}</div>
                        <div class="ki-label">Paten</div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="/hak-cipta" class="ki-stat-item">
                        <i class="bi bi-c-circle"></i>
                        <div class="ki-num">{{ $hc }}</div>
                        <div class="ki-label">Hak Cipta</div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="/desain-industri" class="ki-stat-item">
                        <i class="bi bi-gem"></i>
                        <div class="ki-num">{{ $di }}</div>
                        <div class="ki-label">Desain Industri</div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="ki-chart-card">
                    <div class="p-3 p-md-4">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 ki-jurusan-filter-wrap">
                            <div>
                                <div class="ki-section-eyebrow">Rekap Tahunan</div>
                                <div class="ki-section-title">Jumlah Kekayaan Intelektual per Tahun</div>
                            </div>
                            <div class="dropdown">
                                <button class="btn ki-jurusan-btn dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-funnel"></i>
                                    {{ $jurusanTerpilih->nama_jurusan ?? 'Semua Jurusan' }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end ki-jurusan-menu">
                                    <li>
                                        <a class="dropdown-item {{ !$jurusanTerpilih ? 'active' : '' }}"
                                            href="/">Semua Jurusan</a>
                                    </li>
                                    @foreach ($jurusanList as $j)
                                        <li>
                                            <a class="dropdown-item {{ optional($jurusanTerpilih)->id == $j->id ? 'active' : '' }}"
                                                href="/?jurusan={{ $j->id }}">{{ $j->nama_jurusan }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div id="barChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    @include('layout.footer')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 400,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                        name: 'Paten',
                        data: @json($data_paten_per_tahun)
                    },
                    {
                        name: 'Hak Cipta',
                        data: @json($data_hakCipta_per_tahun)
                    },
                    {
                        name: 'Desain Industri',
                        data: @json($data_desainIndustri_per_tahun)
                    }
                ],
                xaxis: {
                    categories: @json($tahun),
                    title: {
                        text: 'Tahun'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Kekayaan Intelektual'
                    },
                    min: 1,
                },
                colors: ['#c73232', '#0066cc', '#8ec6ff'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        borderRadius: 4
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    position: 'bottom'
                },
                grid: {
                    borderColor: '#eef1f5'
                }
            };

            var chart = new ApexCharts(document.querySelector("#barChart"), options);
            chart.render();
        });
    </script>
</body>

</html>
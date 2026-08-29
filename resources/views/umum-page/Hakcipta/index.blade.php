<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="shortcut icon" href={{ asset('assets/logo-polindra.png') }}>
    <title>SIKI POLINDRA | Hak-Cipta</title>
</head>

<body>
    <style>
        /* Membuat chart lebih fleksibel */
        .chart-container {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            /* Untuk memastikan jika ada konten meluas, tetap bisa di-scroll */
            height: auto;
        }

        @media (max-width: 576px) {

            /* Penyesuaian di layar kecil */
            .chart-container {
                padding: 10px;
                /* Tambahkan padding agar chart tidak terlalu menempel */
            }
        }

        .ki-jurusan-filter-wrap {
            gap: 10px;
        }

        .ki-jurusan-btn {
            background: linear-gradient(135deg, #003d7a, #0066cc);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 8px 18px;
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 61, 122, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .ki-jurusan-btn:hover,
        .ki-jurusan-btn:focus {
            color: #fff;
            background: linear-gradient(135deg, #002a57, #0055aa);
            box-shadow: 0 3px 10px rgba(0, 61, 122, 0.4);
        }

        .ki-jurusan-menu {
            max-height: 280px;
            overflow-y: auto;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 6px;
            min-width: 230px;
        }

        .ki-jurusan-menu .dropdown-item {
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 0.85rem;
            color: #495057;
        }

        .ki-jurusan-menu .dropdown-item:hover,
        .ki-jurusan-menu .dropdown-item:focus {
            background: #eaf2ff;
            color: #003d7a;
        }

        .ki-jurusan-menu .dropdown-item.active {
            background: linear-gradient(135deg, #003d7a, #0066cc);
            color: #fff;
        }
    </style>
    @include('layout.nav')
    <br><br><br><br>

    <div class="container">
        <div class="row g-3">
            <!-- Total Permohonan Card -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-auto" style="min-height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="card-title text-center mb-2 fw-normal">Total Permohonan Hak Cipta</h5>
                        <p class="card-text text-center fs-1 fw-normal m-0">{{ $itung }}</p>
                    </div>
                </div>
            </div>


            <!-- Search Card -->
            <div class="col-12 col-lg-8 mx-auto">
                <div class="card shadow-sm h-auto w-80 mx-auto">
                    <div class="card-body">
                        <h5 class="card-title mb-3 mt-3 fw-normal text-center">Cari Hak Cipta</h5>
                        <form action="/hak-cipta/cari/data" method="POST">
                            @csrf
                            <!-- Judul Hak Cipta -->
                            <div class="mb-3 row align-items-center">
                                <label for="cari_hc" class="col-md-4 col-form-label">Judul Hak Cipta</label>
                                <div class="col-md-8">
                                    <input type="search" class="form-control form-control-sm" id="cari_hc"
                                        name="cari_hc">
                                </div>
                            </div>
                            <!-- Nama Invensi -->
                            <div class="mb-3 row align-items-center">
                                <label for="cari_nama" class="col-md-4 col-form-label">Nama Invensi</label>
                                <div class="col-md-8">
                                    <input type="search" class="form-control form-control-sm" id="cari_nama"
                                        name="cari_nama">
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="text-end me-3">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container mt-4">
        <div class="row g-3">
            <!-- Status Cards -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/hak-cipta/tercatat" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-square me-3" style="font-size: 2.5rem;"></i>
                                <div>
                                    <h3 class="mb-1">{{ $tercatat }}</h3>
                                    <span>Tercatat</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/hak-cipta/ditolak" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-x-square me-3" style="font-size: 2.5rem;"></i>
                                <div>
                                    <h3 class="mb-1">{{ $tolak }}</h3>
                                    <span>Ditolak</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/hak-cipta/keterangan-belum-lengkap" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-question-square me-3" style="font-size: 2.5rem;"></i>
                                <div>
                                    <h3 class="mb-1">{{ $null }}</h3>
                                    <span>Keterangan Belum lengkap</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/hak-cipta/menunggu-verifikasi" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-question-square me-3" style="font-size: 2.5rem;"></i>
                                <div>
                                    <h3 class="mb-1">{{ $mvdov }}</h3>
                                    <span>Menunggu Verifikasi</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <hr class="border border-black border-2 opacity-75 rounded my-4">

        <!-- Navigation Cards -->
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm text-center h-100">
                    <a href="/hak-cipta/list/pegawai/" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <i class="bi bi-person-circle mb-2" style="font-size: 2rem;"></i>
                            <h5 class="card-title mb-0">Pegawai</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm text-center h-100">
                    <a href="/hak-cipta/list/jurusan/" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <i class="bi bi-bank mb-2" style="font-size: 2rem;"></i>
                            <h5 class="card-title mb-0">Jurusan</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm text-center h-100">
                    <a href="/hak-cipta/list/prodi" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <i class="bi bi-bank mb-2" style="font-size: 2rem;"></i>
                            <h5 class="card-title mb-0">Prodi</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="container mt-4">
        <h3 class="fw-normal mb-3"><i class="bi bi-table me-2"></i>Daftar Hak Cipta</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama lengkap</th>
                        <th>Jenis Ciptaan</th>
                        <th>Judul Ciptaan</th>
                        <th>Tanggal pengajuan</th>
                        <th>Status Hak Cipta</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hc as $i => $p)
                        <tr>
                            <th>{{ ($hc->currentPage() - 1) * $hc->perPage() + $loop->iteration }}</th>
                            <td>{{ $p->nama_lengkap }}</td>
                            <td>{{ $p->jenis_ciptaan }}</td>
                            <td>{{ $p->judul_ciptaan }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_permohonan)->format('d-m-Y') }}</td>
                            <td>{{ $p->status }}</td>
                        </tr>
                        @empty
                            <td colspan="10" class="text-center">
                                <img src="{{ asset('assets/no-data.png') }}" style="width:30%; height:auto">
                            </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mb-3">
            {{ $hc->links() }}
        </div>
        <br>
        <!-- Chart Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 ki-jurusan-filter-wrap">
                            <h6 class="fw-semibold mb-2 mb-md-0 text-secondary">
                                <i class="bi bi-bar-chart-line me-1"></i>Jumlah Hak Cipta per Tahun
                            </h6>
                            <div class="dropdown">
                                <button class="btn ki-jurusan-btn dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-funnel"></i>
                                    {{ $jurusanTerpilih->nama_jurusan ?? 'Semua Jurusan' }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end ki-jurusan-menu">
                                    <li>
                                        <a class="dropdown-item {{ !$jurusanTerpilih ? 'active' : '' }}"
                                            href="/hak-cipta">Semua Jurusan</a>
                                    </li>
                                    @foreach ($jurusanList as $j)
                                        <li>
                                            <a class="dropdown-item {{ optional($jurusanTerpilih)->id == $j->id ? 'active' : '' }}"
                                                href="/hak-cipta?jurusan={{ $j->id }}">{{ $j->nama_jurusan }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="areaChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    responsive: [{
                        breakpoint: 576,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                },
                series: [{
                    name: 'Jumlah Hak Cipta',
                    data: @json($jumlah)
                }],
                xaxis: {
                    categories: @json($tahun),
                    title: {
                        text: 'Tahun'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Hak Cipta'
                    }
                },
                title: {
                    text: 'Jumlah Hak Cipta Berdasarkan Tahun',
                    align: 'center'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                }
            };

            var chart = new ApexCharts(document.querySelector("#areaChart"), options);
            chart.render();
        });
    </script>
</body>

</html>

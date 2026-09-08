<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('assets/css/index.css') }}>
    <link rel="shortcut icon" href={{ asset('assets/logo-polindra.png') }}>
    <title>SIKI POLINDRA | Paten</title>
</head>

<body>
    <style>
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
    {{-- nav --}}
    @include('layout.nav')
    <br>
    <br>
    <br>
    <br>
    {{-- end nav --}}
    <div class="container">
        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-auto" style="min-height: 150px;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="card-title text-center mb-2 fw-normal">Total Permohonan
                            Paten</h5>
                        <p class="card-text text-center fs-1 fw-normal m-0">
                            {{ $hitung }}</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 mx-auto">
                <div class="card shadow-sm h-auto w-80 mx-auto">
                    <div class="card-body">
                        <h5 class="card-title mb-3 mt-3 fw-normal text-center">Cari Paten</h5>

                        <form action="/cari" method="POST">
                            @csrf
                            <div class="mb-3 row align-items-center">
                                <label for="" class="col-md-4 col-form-label">Judul
                                    Paten</label>
                                <div class="col-md-8">
                                    <input type="search" class="form-control form-control-sm" name="cari_judul">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label for="" class="col-md-4 col-form-label">Nama
                                    Invensi</label>
                                <div class="col-md-8">
                                    <input type="search" class="form-control form-control-sm" id=""
                                        name="cari_nama">
                                </div>
                            </div>

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
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/paten/pemeriksaan-formalitas" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center mt-2">
                                <i class="bi bi-search me-3" style="font-size: 2.5rem;"></i>
                                <div>
                                    <h3 class="mb-1">{{ $pf }}</h3>
                                    <span>Pemeriksaan Formalitas</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/paten/menunggu-tanggapan-formalitas" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-search me-3" style="font-size: 2.5rem;"></i>
                                <div>
                                    <h3 class="mb-1">{{ $mt }}</h3>
                                    <span>Menunggu Tanggapan Formalitas</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/paten/masa-pengumuman" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center mt-2">
                                <i class="bi bi-exclamation-circle me-3" style="font-size: 2.5rem;"></i>
                                <div>
                                    <h3 class="mb-1">{{ $mp }}</h3>
                                    <span>Masa Pengumuman</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/paten/meunggu-pembayaran-substansif" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-question-square me-3" style="font-size: 2.5rem;"></i>
                                <div>
                                    <h3 class="mb-1">{{ $mps }}
                                    </h3>
                                    <span>Menunggu Pembayaran Substansif</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mt-4">
                <div class="card shadow-sm h-100">
                    <a href="/paten/substansif-tahap-awal" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center mt-2">

                                <i class="bi bi-clipboard-data me-3" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $staw }}
                                    </h3>
                                    <span>Substansif Tahap Awal</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mt-4">
                <div class="card shadow-sm h-100">
                    <a href="/paten/substansif-tahap-lanjut" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center mt-2">
                                <i class="bi bi-clipboard-data me-3" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $stl }}
                                    </h3>
                                    <span class="">Substasif Tahap Lanjut</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mt-4">
                <div class="card shadow-sm h-100">
                    <a href="/paten/substansif-tahap-akhir" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center mt-2">
                                <i class="bi bi-clipboard-data float-start me-3" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $stak }}
                                    </h3>
                                    <span class="">Substasif Tahap Akhir</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mt-4">
                <div class="card shadow-sm h-100">
                    <a href="/paten/menunggu-tanggapan-substansif" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center">

                                <i class="bi bi-question-square me-3" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $mts }}
                                    </h3>
                                    <span class="">Menunggu Tanggapan Substansif</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mt-4">
                <div class="card shadow-sm h-100">
                    <a href="/paten/menunggu-verifikasi" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center">

                                <i class="bi bi-question-square me-3" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $mvdov }}
                                    </h3>
                                    <span class="">Menunggu Verifikasi Data Oleh
                                        Verifikator</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mt-4">
                <div class="card shadow-sm h-100">
                    <a href="/paten/diberi" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center mt-2">

                                <i class="bi bi-check-square  me-3" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $catat }}
                                    </h3>
                                    <span class="">Diberi</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mt-4">
                <div class="card shadow-sm h-100">
                    <a href="/paten/ditolak" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center mt-2">
                                <div class="">
                                    <i class="bi bi-x-square  me-3" style="font-size: 2.5rem;"></i>
                                </div>
                                <div class="">
                                    <h3 class="mb-1">{{ $tolak }}
                                    </h3>
                                    <span class="">Ditolak</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <hr class="border border-black border-2 opacity-75 rounded my-4">
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm text-center h-100">
                    <a href="/paten/list/perorangan/" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <i class="bi bi-person-circle mb-2" style="font-size: 2rem;"></i>
                            <h5 class="card-title mb-0">Pegawai</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm text-center h-100">
                    <a href="/paten/list/jurusan/" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <i class="bi bi-bank mb-2" style="font-size: 2rem;"></i>
                            <h5 class="card-title mb-0">Jurusan</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm text-center h-100">
                    <a href="/paten/list/prodi/" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <i class="bi bi-bank mb-2" style="font-size: 2rem;"></i>
                            <h5 class="card-title mb-0">Prodi</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h3 class="fw-normal mb-3"><i class="bi bi-table me-2"></i>Daftar Paten</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama lengkap</th>
                        <th scope="col">Jenis Paten</th>
                        <th scope="col">Judul paten</th>
                        <th scope="col">Tanggal pengajuan</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paten1 as $i => $p)
                        <tr>
                            <th scope="row">
                                {{ ($paten1->currentPage() - 1) * $paten1->perPage() + $loop->iteration }}
                            </th>
                            <td>{{ $p->nama_lengkap }}</td>
                            <td>{{ $p->jenis_paten }}</td>
                            <td>{{ $p->judul_paten }}</td>
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
            {{ $paten1->links() }}
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 ki-jurusan-filter-wrap">
                            <h6 class="fw-semibold mb-2 mb-md-0 text-secondary">
                                <i class="bi bi-bar-chart-line me-1"></i>Jumlah Paten per Tahun
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
                                            href="/paten">Semua Jurusan</a>
                                    </li>
                                    @foreach ($jurusanList as $j)
                                        <li>
                                            <a class="dropdown-item {{ optional($jurusanTerpilih)->id == $j->id ? 'active' : '' }}"
                                                href="/paten?jurusan={{ $j->id }}">{{ $j->nama_jurusan }}</a>
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
    <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
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
                    name: 'Jumlah Paten',
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
                        text: 'Jumlah Paten'
                    }
                },
                title: {
                    text: 'Jumlah Paten Berdasarkan Tahun',
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

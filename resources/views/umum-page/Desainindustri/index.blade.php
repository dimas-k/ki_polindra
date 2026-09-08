<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA | desain-industri</title>
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
                            Desain Industri</h5>
                        <p class="card-text text-center fs-1 fw-normal m-0">
                            {{ $di->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 mx-auto">
                <div class="card shadow-sm h-auto w-80 mx-auto">
                    <div class="card-body">
                        <h5 class="card-title mb-3 mt-3 fw-normal text-center">Cari Desain industri</h5>
                        <form action="/desain-industri/cari/data" method="POST">
                            @csrf
                            <div class="mb-3 row align-items-center">
                                <label for="" class="col-md-4 col-form-label">Judul
                                    Desain Industri</label>
                                <div class="col-md-8">
                                    <input type="search" class="form-control form-control-sm" name="cari_di">
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
                    <a href="/desain-industri/diberi" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-square me-3" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $beri }}
                                    </h3>
                                    <span class="">Diberi</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/desain-industri/dalam-proses-usulan" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center">

                                <i class="bi bi-recycle me-3" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $proses }}
                                    </h3>
                                    <span class="">Dalam Proses Usulan</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/desain-industri/pemeriksaan" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center">

                                <i class="bi bi-search float-start me-4" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $priksa }}
                                    </h3>
                                    <span class="">Pemeriksaan</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/desain-industri/keterangan-belum-lengkap" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center">

                                <i class="bi bi-question-square me-3" style="font-size: 2.5rem;"></i>

                                <div class="">
                                    <h3 class="mb-1">{{ $null }}
                                    </h3>
                                    <span class="">Keterangan belum Lengkap</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/desain-industri/menunggu-verifikasi" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center">

                                <i class="bi bi-question-square  me-3" style="font-size: 2.5rem;"></i>

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
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <a href="/desain-industri/ditolak" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <div class="d-flex align-self-center mt-2">

                                <i class="bi bi-x-square me-3" style="font-size: 2.5rem;"></i>

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
                    <a href="/desain-industri/list/pegawai" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <i class="bi bi-person-circle mb-2" style="font-size: 2rem;"></i>
                            <h5 class="card-title mb-0">Pegawai</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm text-center h-100">
                    <a href="/desain-industri/list/jurusan" class="text-decoration-none text-dark">
                        <div class="card-body">
                            <i class="bi bi-bank mb-2" style="font-size: 2rem;"></i>
                            <h5 class="card-title mb-0">Jurusan</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm text-center h-100">
                    <a href="/desain-industri/list/prodi" class="text-decoration-none text-dark">
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
        <h3 class="fw-normal mb-3"><i class="bi bi-table me-2"></i>Daftar Desain Industri</h3>
        <div class="table-responsive">
            <table class="table table-hover font-family-Kokoro">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama lengkap</th>
                        <th scope="col">Jenis Desain</th>
                        <th scope="col">Judul Desain</th>
                        <th scope="col">Tanggal pengajuan</th>
                        <th scope="col">Status Desain Industri</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($di as $i => $d)
                        <tr>
                            <th scope="row">{{ ($di->currentPage() - 1) * $di->perPage() + $loop->iteration }}</th>
                            <td>{{ $d->nama_lengkap }}</td>
                            <td>{{ $d->jenis_di }}</td>
                            <td>{{ $d->judul_di }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->tanggal_permohonan)->format('d-m-Y') }}</td>
                            <td>{{ $d->status }}</td>
                        </tr>
                        @empty
                            <td colspan="10" class="text-center">
                                <img src="{{ asset('assets/no-data.png') }}" style="width:30%; height:auto">
                            </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <span class="d-flex justify-content-end mb-3 me-3">
            {{ $di->links() }}
        </span>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 ki-jurusan-filter-wrap">
                            <h6 class="fw-semibold mb-2 mb-md-0 text-secondary">
                                <i class="bi bi-bar-chart-line me-1"></i>Jumlah Desain Industri per Tahun
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
                                            href="/desain-industri">Semua Jurusan</a>
                                    </li>
                                    @foreach ($jurusanList as $j)
                                        <li>
                                            <a class="dropdown-item {{ optional($jurusanTerpilih)->id == $j->id ? 'active' : '' }}"
                                                href="/desain-industri?jurusan={{ $j->id }}">{{ $j->nama_jurusan }}</a>
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
                    name: 'Jumlah Desain Industri',
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
                        text: 'Jumlah Desain Industri'
                    }
                },
                title: {
                    text: 'Jumlah Desain Industri Berdasarkan Tahun',
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

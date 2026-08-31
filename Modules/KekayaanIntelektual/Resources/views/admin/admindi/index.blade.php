<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Desain Industri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom styles for this template -->
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                                <li><a class="dropdown-item" href="/logout"><i class="bi bi-arrow-bar-left me-2"></i>Log
                                        Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    {{-- end of top naavbar --}}
    <div class="container-fluid">
        <div class="row">
            {{-- Side bar --}}
            @include('admin.layout.sidenav')
            {{-- end of sidebar --}}
            <div class="col-12 col-lg-10 mt-2">
                <div class="container bg-light rounded border pt-3">
                    <div class="card mb-3">
                        <div class="card-header text-center">
                            Rincian Desain Industri
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow-sm p-2 h-100">
                                        <a href="/admin/desain-industri/diberi"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center me-5">
                                                        <i class="bi bi-check-square float-start me-5"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class="ms-5 d-flex justify-content-end">{{ $beri }}
                                                        </h3>
                                                        <span class="ms-5 d-flex justify-content-end">Diberi</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow-sm  h-100">
                                        <a href="/admin/desain-industri/dalam-proses-usulan"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center ">
                                                        <i class="bi bi-recycle float-start me-4"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class="ms-5 d-flex justify-content-end">{{ $proses }}
                                                        </h3>
                                                        <span class="ms-5 d-flex justify-content-end">Dalam Proses
                                                            Usulan</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow-sm p-2 h-100">
                                        <a href="/admin/desain-industri/pemeriksaan"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center me-5">
                                                        <i class="bi bi-search float-start me-4"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class="ms-5 d-flex justify-content-end">{{ $priksa }}
                                                        </h3>
                                                        <span class="ms-4 d-flex justify-content-end">Pemeriksaan</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow-sm h-100">
                                        <a href="/admin/desain-industri/keterangan-belum-lengkap"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-question-square float-start me-3"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class="ms-5 d-flex justify-content-end">{{ $null }}
                                                        </h3>
                                                        <span class="ms-3 d-flex justify-content-end">Keterangan belum
                                                            Lengkap</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-xl-4 col-sm-6 col-12 mt-3">
                                    <div class="card shadow-sm p-2 h-100">
                                        <a href="/admin/desain-industri/ditolak"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-x-square float-start me-5 pe-5"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class="ms-5 d-flex justify-content-end">{{ $mvdov }}
                                                        </h3>
                                                        <span class="ms-5 d-flex justify-content-end">Menunggu
                                                            Verifikasi Data Oleh Verifikator</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12 mt-3 ms-3">
                                    <div class="card shadow-sm p-2 h-100">
                                        <a href="/admin/desain-industri/ditolak"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-x-square float-start me-5 pe-5"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class="ms-5 d-flex justify-content-end">{{ $tolak }}
                                                        </h3>
                                                        <span class="ms-5 d-flex justify-content-end">Ditolak</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container bg-light rounded border pt-3 mt-3">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-table me-3"></i>Daftar Desain
                        Industri</h3>
                    <div class="d-flex justify-content-start">
                        <a class="btn btn-success mb-2" href="/admin/desain-industri/tambah/dosen/"><i
                                class="bi bi-plus-circle me-2"></i>Tambah Desain Industri Dosen</a>
                    </div>
                    <div class="d-flex justify-content-start">
                        <a class="btn btn-outline-secondary" href="/admin/desain-industri/tambah/umum/"><i
                                class="bi bi-plus-circle me-2"></i>Tambah Desain Industri Umum</a>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <form action="/admin/desain-industri/cari" method="GET">
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    <label for="" class="col-form-label">Cari Desain Industri</label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" id="" class="form-control" aria-describedby=""
                                        name="cari">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary ">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover font-family-Kokoro">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama lengkap</th>
                                    <th scope="col">Jenis Ciptaan</th>
                                    <th scope="col">Judul Ciptaan</th>
                                    <th scope="col">Tanggal pengajuan</th>
                                    <th scope="col">Desain Milik</th>
                                    <th scope="col">Status </th>
                                    <th scope="col">Status Cek Data </th>
                                    <th scope="col">Keterangan </th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($desain as $i => $di)
                                    <tr>
                                        <th scope="row">
                                            {{ ($desain->currentPage() - 1) * $desain->perPage() + $loop->iteration }}
                                        </th>
                                        <td>{{ $di->nama_lengkap }}</td>
                                        <td>{{ $di->jenis_di }}</td>
                                        <td>{{ $di->judul_di }}</td>
                                        <td>{{ \Carbon\Carbon::parse($di->tanggal_permohonan)->format('d-m-Y ') }}</td>
                                        <td>{{ $di->institusi }}</td>
                                        <td>{{ $di->status }}</td>
                                        <td>
                                            @if ($di->cekhc?->cek_data == 'Valid')
                                                <i class="bi bi-check-circle-fill" style="color: green"></i>
                                            @elseif($di->cekhc?->cek_data == 'Tidak Valid')
                                                <i class="bi bi-times-circle" style="color: red"></i>
                                            @else
                                                <i class="bi bi-dash-circle-fill"
                                                    style="color: yellow"></i>{{ $di->cekhc?->cek_data }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($di->cekhc?->keterangan == '')
                                                Data Desain Industri Belum Dicek
                                            @else
                                                {{ $di->cekhc?->keterangan }}
                                            @endif
                                        </td>
                                        <td><a href={{ Route('admin_desainindustri.show', $di->id) }}
                                                class="btn btn-info"><i class="bi bi-eye me-1"></i>Lihat</a>
                                            <a href={{ Route('admin_desainindustri.edit', $di->id) }}
                                                class="btn btn-outline-warning"><i class="bi bi-pencil me-1"></i>Edit
                                                Desain Industri</a>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $di->id }}">
                                                <i class="bi bi-pencil me-1"></i>Edit Status
                                            </button>
                                            <div class="modal fade" id="exampleModal{{ $di->id }}"
                                                tabindex="-1" data-bs-backdrop="static"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content p-2">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel"> Edit
                                                                Desain {{ $di->nama_lengkap }}</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form enctype="multipart/form-data" method="post"
                                                                action={{ Route('admin_desainindustri.update', $di->id) }}>
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Status
                                                                        Desain Industri</label>
                                                                    <select
                                                                        class="form-select @error('status') is-invalid @enderror"
                                                                        aria-label="Default select example"
                                                                        name="status">
                                                                        <option selected>Pilih Status Desain
                                                                        </option>
                                                                        <option value="Dalam Proses Usulan">Dalam
                                                                            Proses Usulan</option>
                                                                        <option value="Pemeriksaan">Pemeriksaan
                                                                        </option>
                                                                        <option value="Diberi">Diberi</option>
                                                                        <option value="Ditolak">Ditolak</option>
                                                                        <option value="Keterangam Belum Lengkap">
                                                                            Keterangam Belum Lengkap</option>
                                                                        <option
                                                                            value="Menunggu Verifikasi Data Oleh Verifikator">
                                                                            Menunggu Verifikasi Data Oleh Verifikator
                                                                        </option>
                                                                    </select>
                                                                    @error('status')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Serifikat
                                                                        Desain Industri</label>
                                                                    <input type="file"
                                                                        class="form-control @error('sertifikat_desain') is-invalid @enderror"
                                                                        id="" placeholder=""
                                                                        name="sertifikat_desain">
                                                                    @error('sertifikat_desain')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop{{ $di->id }}">
                                                <i class="bi bi-trash3 me-1"></i>Hapus
                                            </button>
                                            <div class="modal fade" id="staticBackdrop{{ $di->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                Peringatan</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Anda yakin akan menghapus hak cipta milik
                                                            {{ $di->nama_lengkap }},
                                                            dengan judul Desain "{{ $di->judul_di }}" ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <a href={{ Route('admin_desainindustri.delete', $di->id) }}
                                                                class="btn btn-danger">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <a href={{ Route('admin_desainindustri.delete', $di->id) }}
                                            class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin?')"><i
                                                class="bi bi-trash3"></i></a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span class="d-flex justify-content-end mb-3 me-3">
                            {{ $desain->links() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"
            integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous">
        </script>
</body>

</html>

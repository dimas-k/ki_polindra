<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Hak Cipta</title>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
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
                            Rincian Hak Cipta
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow-sm p-2 h-100">
                                        <a href="/admin/hak-cipta/tercatat"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-check-square float-start pe-5 me-5"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class="ms-4 d-flex justify-content-end">{{ $tercatat }}
                                                        </h3>
                                                        <span class="ms-5  d-flex justify-content-end">Dicatat</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow-sm p-2 h-100">
                                        <a href="/admin/hak-cipta/ditolak"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-x-square float-start pe-5 me-5"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class=" d-flex justify-content-end ms-5">
                                                            {{ $tolak }}</h3>
                                                        <span class=" d-flex justify-content-end ms-5">Ditolak</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow-sm h-100">
                                        <a href="/admin/hak-cipta/keterangan-belum-lengkap"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-question-square float-start me-2"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class="d-flex justify-content-end ms-5">
                                                            {{ $null }}</h3>
                                                        <span class=" d-flex justify-content-end ms-5">Keterarangan
                                                            Belum lengkap</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="card shadow-sm h-100">
                                        <a href="/admin/hak-cipta/mvdov"
                                            class="link-dark link-underline link-underline-opacity-0">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-question-square float-start me-2"
                                                            style="font-size: 50px;"></i>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <h3 class="d-flex justify-content-end ms-5">
                                                            {{ $mvdov }}</h3>
                                                        <span class=" d-flex justify-content-end ms-5">Menunggu
                                                            Verifikasi Data Oleh Verifikator</span>
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
                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-table me-3"></i>Daftar Hak Cipta
                    </h3>
                    <div class="d-flex justify-content-start">
                        <a class="btn btn-success mb-2" href="/admin/hak-cipta/tambah/dosen/"><i
                                class="bi bi-plus-circle me-2"></i>Tambah Hak Cipta Dosen</a>
                    </div>
                    <div class="d-flex justify-content-start">
                        <a class="btn btn-outline-secondary" href="/admin/hak-cipta/tambah/umum/"><i
                                class="bi bi-plus-circle me-2"></i>Tambah Hak Cipta Umum</a>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <form action="/admin/hak-cipta/cari" method="GET">
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    <label for="" class="col-form-label">Cari Hak Cipta</label>
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
                                <th scope="col">Hak Cipta Milik</th>
                                <th scope="col">Status Hak Cipta</th>
                                <th scope="col">Status Cek Data</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hak_cipta as $i => $hk)
                                <tr>
                                    <th scope="row">
                                        {{ ($hak_cipta->currentPage() - 1) * $hak_cipta->perPage() + $loop->iteration }}
                                    </th>
                                    <td>{{ $hk->nama_lengkap }}</td>
                                    <td>{{ $hk->jenis_ciptaan }}</td>
                                    <td>{{ $hk->judul_ciptaan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($hk->tanggal_permohonan)->format('d-m-Y ') }}</td>
                                    <td>{{ $hk->institusi }}</td>
                                    <td>{{ $hk->status }}</td>
                                    <td>
                                        @if ($hk->cekhc?->cek_data == 'Valid')
                                            <i class="bi bi-check-circle-fill" style="color: green"></i>
                                        @elseif($hk->cekhc?->cek_data == 'Tidak Valid')
                                            <i class="bi bi-times-circle" style="color: red"></i>
                                        @else
                                            <i class="bi bi-dash-circle-fill"
                                                style="color: yellow"></i>{{ $hk->cekhc?->cek_data }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($hk->cekhc?->keterangan == '')
                                            Data Hak Cipta Belum Dicek
                                        @else
                                            {{ $hk->cekhc?->keterangan }}
                                        @endif
                                    </td>
                                    <td><a href={{ Route('admin_hakcipta.show', $hk->id) }} class="btn btn-info"><i
                                                class="bi bi-eye me-1"></i>Lihat</a>
                                        <a href={{ Route('admin_hakcipta.edit', $hk->id) }}
                                            class="btn btn-outline-warning"><i class="bi bi-pencil me-1"></i>Edit
                                            Hak Cipta</a>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $hk->id }}">
                                            <i class="bi bi-pencil me-1"></i> Edit Status
                                        </button>
                                        <div class="modal fade" id="exampleModal{{ $hk->id }}" tabindex="-1"
                                            data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content p-2">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel"> Edit
                                                            status
                                                            Hak Cipta {{ $hk->nama_lengkap }}</h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form enctype="multipart/form-data" method="post"
                                                            action={{ Route('admin_hakcipta.update', $hk->id) }}>
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Status
                                                                    Hak Cipta</label>
                                                                <select
                                                                    class="form-select @error('status') is-invalid @enderror"
                                                                    aria-label="Default select example" name="status"
                                                                    required>
                                                                    <option value="">Pilih Status Hak Cipta
                                                                    </option>
                                                                    <option value="Keterangan Belum Lengkap"
                                                                        @if ((old('status', $hk->status) ?? '') == 'Keterangan Belum Lengkap') selected @endif>
                                                                        Keterangan Belum Lengkap
                                                                    </option>
                                                                    <option value="Ditolak"
                                                                        @if ((old('status', $hk->status) ?? '') == 'Ditolak') selected @endif>
                                                                        Ditolak
                                                                    </option>
                                                                    <option value="Tercatat"
                                                                        @if ((old('status', $hk->status) ?? '') == 'Tercatat') selected @endif>
                                                                        Tercatat
                                                                    </option>
                                                                </select>
                                                                @error('status')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Sertifikat
                                                                    Hak Cipta</label><br>
                                                                    File :
                                                                {{ basename($hk->sertifikat_hakcipta) }}
                                                                <input type="file"
                                                                    class="form-control @error('sertifikat_hakcipta') is-invalid @enderror"
                                                                    placeholder="Masukkan sertifikat"
                                                                    name="sertifikat_hakcipta"
                                                                    value="{{ $hk->sertifikat_hakcipta }}">
                                                                @error('sertifikat_hakcipta')
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
                                            data-bs-target="#staticBackdrop{{ $hk->id }}">
                                            <i class="bi bi-trash3 me-1"></i>Hapus
                                        </button>
                                        <div class="modal fade" id="staticBackdrop{{ $hk->id }}"
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
                                                        {{ $hk->nama_lengkap }},
                                                        dengan judul ciptaan "{{ $hk->judul_ciptaan }}" ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <a href={{ Route('admin_hakcipta.delete', $hk->id) }}
                                                            class="btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
</div>
                    <span class="d-flex justify-content-end mb-3 me-3">
                        {{ $hak_cipta->links() }}
                    </span>
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

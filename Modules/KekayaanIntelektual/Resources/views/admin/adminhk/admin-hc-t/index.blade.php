<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Hak Cipta</title>
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
            @include('admin.layout.sidenav')
            {{-- end of sidebar --}}
            <div class="col-12 col-lg-10 mt-2">
                <div class="container bg-light rounded border pt-3">
                    <a href="/admin/hak-cipta" class="link-dark link-underline link-underline-opacity-0 mb-3 "><i class="bi bi-arrow-left-circle mb-3" style="font-size: 30px;"></i></a>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <h3 class="fw-normal font-family-Kokoro mb-3 mt-3"><i class="bi bi-table me-3"></i>Daftar Hak Cipta
                    </h3>
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
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cek as $i => $hk)
                                <tr>
                                    <th scope="row">{{ ($cek->currentPage() - 1) * $cek->perPage() + $loop->iteration }}</th>
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
                                                class="bi bi-eye"></i></a>

                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $hk->id }}">
                                            <i class="bi bi-pencil"></i>
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
                                                                    aria-label="Default select example"
                                                                    name="status">
                                                                    <option selected>Pilih Status Hak Cipta</option>
                                                                    <option value="Tercatat">Tercatat</option>
                                                                    <option value="Ditolak">Ditolak</option>
                                                                    <option value="Keterangan Belum Lengkap">
                                                                        Keterangan Belum Lengkap</option>
                                                                </select>
                                                                @error('status')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Sertifikat
                                                                    Hak Cipta</label>
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
                                            <i class="bi bi-trash3"></i>
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
                        {{ $cek->links() }}
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

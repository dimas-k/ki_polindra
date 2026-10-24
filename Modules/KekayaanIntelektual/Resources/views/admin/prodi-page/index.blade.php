<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Prodi</title>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
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
    {{-- end of top navbar --}}
    <div class="container-fluid">
        <div class="row">
            {{-- Side bar --}}
            @include('admin.layout.sidenav')
            {{-- end of sidebar --}}
            <div class="col-12 col-lg-10 mt-2">
                <div class="container bg-light rounded border pt-3">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#tambahProdiModal"><i class="bi bi-plus-circle me-1"></i>Tambah
                            Prodi</button>

                        {{-- Modal Tambah Prodi --}}
                        <div class="modal fade" id="tambahProdiModal" tabindex="-1" data-bs-backdrop="static"
                            aria-labelledby="tambahProdiModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content p-4">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="tambahProdiModalLabel">Tambah Prodi</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ url('/admin/prodi') }}" class="mt-3">
                                            @csrf
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="nama_prodi">Nama Prodi</label>
                                                <input type="text" id="nama_prodi"
                                                    class="form-control @error('nama_prodi') is-invalid @enderror"
                                                    name="nama_prodi" value="{{ old('nama_prodi') }}" />
                                                @error('nama_prodi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="kode_prodi">Kode Prodi</label>
                                                <input type="text" id="kode_prodi"
                                                    class="form-control @error('kode_prodi') is-invalid @enderror"
                                                    name="kode_prodi" value="{{ old('kode_prodi') }}" />
                                                @error('kode_prodi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-table me-3"></i>Daftar Prodi</h3>
                    <div class="table-responsive">
<table class="table table-hover font-family-Kokoro">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Prodi</th>
                                <th scope="col">Kode Prodi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prodi as $i => $p)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $p->nama_prodi }}</td>
                                    <td>{{ $p->kode_prodi }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editProdiModal{{ $p->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        {{-- Modal Edit Prodi --}}
                                        <div class="modal fade" id="editProdiModal{{ $p->id }}" tabindex="-1"
                                            data-bs-backdrop="static" aria-labelledby="editProdiModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content p-2">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editProdiModalLabel">Edit
                                                            Prodi {{ $p->nama_prodi }}</h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="{{ url('/admin/prodi/' . $p->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-outline form-white mb-3">
                                                                <label class="form-label"
                                                                    for="nama_prodi_{{ $p->id }}">Nama
                                                                    Prodi</label>
                                                                <input type="text" id="nama_prodi_{{ $p->id }}"
                                                                    class="form-control" name="nama_prodi"
                                                                    value="{{ $p->nama_prodi }}" required>
                                                            </div>
                                                            <div class="form-outline form-white mb-3">
                                                                <label class="form-label"
                                                                    for="kode_prodi_{{ $p->id }}">Kode
                                                                    Prodi</label>
                                                                <input type="text" id="kode_prodi_{{ $p->id }}"
                                                                    class="form-control" name="kode_prodi"
                                                                    value="{{ $p->kode_prodi }}" required>
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
                                            data-bs-target="#hapusProdiModal{{ $p->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>

                                        {{-- Modal Hapus Prodi --}}
                                        <div class="modal fade" id="hapusProdiModal{{ $p->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="hapusProdiModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusProdiModalLabel">
                                                            Peringatan</h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Anda yakin akan menghapus prodi
                                                        {{ $p->nama_prodi }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form method="post"
                                                            action="{{ url('/admin/prodi/' . $p->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data prodi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src={{ asset('assets/bootstrap/js/dist/dropdown.js.map') }}></script>
        <script src={{ asset('assets/bootstrap/js/dist/collapse.js.map') }}></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
</body>

</html>

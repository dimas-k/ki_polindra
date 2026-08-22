<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    {{-- <script src="../assets/js/color-modes.js"></script> --}}

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Umum</title>
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
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="d-flex justify-content-end">
                        {{-- <a href={{ Route('admin.tambah') }}
                        class="btn btn-success mb-2"><i class="bi bi-plus-circle me-1"></i>Tambah Dosen</a> --}}
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="bi bi-plus-circle me-1"></i>Tambah akun
                            umum</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content p-4">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah akun umum</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/admin/pengguna/umum/tambah" enctype="multipart/form-data"
                                            method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="" class="col-form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id=""
                                                    name="nama_lengkap" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="col-form-label">No Telepon</label>
                                                <input type="number" class="form-control" id=""
                                                    name="no_telepon" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="">Email</label>
                                                <input type="text" id="" name="email"
                                                    class="form-control form-control @error('email') is-invalid @enderror"
                                                    required>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="">Alamat</label>
                                                <input type="text" id="" name="alamat"
                                                    class="form-control form-control @error('alamat') is-invalid @enderror"
                                                    required>
                                                @error('alamat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="pass">Bekerja Sebagai</label>
                                                <input type="text" id="" name="kerjaan"
                                                    class="form-control form-control @error('kerjaan') is-invalid @enderror"
                                                    required>
                                                @error('kerjaan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="">Username</label>
                                                <input type="text" id="" name="username"
                                                    class="form-control form-control @error('username') is-invalid @enderror"
                                                    required>
                                                @error('username')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="pass">password</label>
                                                <input type="password" id="pass" name="password"
                                                    class="form-control form-control @error('password') is-invalid @enderror"
                                                    required>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <input type="text" value="Umum" name="role" class="form-control"
                                                hidden>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Buat</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-table me-3"></i>Daftar Akun Non
                        POLINDRA
                    </h3>
                    <div class="table-responsive">
<table class="table table-hover font-family-Kokoro">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama lengkap</th>
                                <th scope="col">Email</th>
                                <th scope="col">Bekerja Sebagai</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No telepon</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($umum as $i => $a)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $a->nama_lengkap }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->kerjaan }}</td>
                                    <td>{{ $a->alamat }}</td>
                                    <td>{{ $a->no_telepon }}</td>
                                    <td><a href={{ Route('umum.detail', $a->id) }} class="btn btn-primary"><i
                                                class="bi bi-eye"></i></a>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $a->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <div class="modal fade" id="exampleModal{{ $a->id }}" tabindex="-1"
                                            data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content p-4">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Akun Dosen
                                                            {{ $a->nama_lengkap }}</h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('umum.akun.update', $a->id) }}"
                                                            enctype="multipart/form-data" method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="" class="col-form-label">Nama
                                                                    Lengkap</label>
                                                                <input type="text" class="form-control"
                                                                    id="" name="nama_lengkap"
                                                                    value="{{ $a->nama_lengkap }}" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="" class="col-form-label">No
                                                                    Telepon</label>
                                                                <input type="number" class="form-control"
                                                                    id="" name="no_telepon"
                                                                    value="{{ $a->no_telepon }}" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="col-form-label"
                                                                    for="">Email</label>
                                                                <input type="text" id="" name="email"
                                                                    class="form-control form-control @error('email') is-invalid @enderror"
                                                                    value="{{ $a->email }}" required>
                                                                @error('email')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="col-form-label"
                                                                    for="">Alamat</label>
                                                                <input type="text" id="" name="alamat"
                                                                    class="form-control form-control @error('alamat') is-invalid @enderror"
                                                                    value="{{ $a->alamat }}" required>
                                                                @error('alamat')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="col-form-label" for="pass">Bekerja
                                                                    Sebagai</label>
                                                                <input type="text" id="" name="kerjaan"
                                                                    class="form-control form-control @error('kerjaan') is-invalid @enderror"
                                                                    value="{{ $a->kerjaan }}" required>
                                                                @error('kerjaan')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="col-form-label"
                                                                    for="">Username</label>
                                                                <input type="text" id="" name="username"
                                                                    class="form-control form-control @error('username') is-invalid @enderror"
                                                                    value="{{ $a->username }}" required>
                                                                @error('username')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="col-form-label"
                                                                    for="pass">password</label>
                                                                <input type="password" id="pass" name="password"
                                                                    class="form-control form-control @error('password') is-invalid @enderror"
                                                                    required>
                                                                <p class="text-danger"><i
                                                                        class="bi bi-exclamation-triangle-fill"></i>Harap
                                                                    isi password dengan benar dan atau masukkan password
                                                                    baru</p>
                                                                @error('password')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <input type="text" value="Umum" name="role"
                                                                class="form-control" hidden>

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
                                            data-bs-target="#staticBackdrop{{ $a->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                        <div class="modal fade" id="staticBackdrop{{ $a->id }}"
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
                                                        Anda yakin akan menghapus akun {{ $a->nama_lengkap }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <a href={{ Route('dosen.hapus', $a->id) }}
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

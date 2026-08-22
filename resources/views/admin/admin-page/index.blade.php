<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Desain Industri</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
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
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="d-flex justify-content-end">
                        {{-- <a href={{ Route('admin.tambah') }} class="btn btn-success mb-2"><i
                                class="bi bi-plus-circle me-1"></i>Tambah Admin</a> --}}
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="bi bi-plus-circle me-1"></i>Tambah Admin</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content p-4">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah akun admin</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/simpan" class="mt-3">
                                            @csrf
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="">Nama Lengkap</label>
                                                <input type="text" id="" class="form-control" name="nama_lengkap" />
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="">Jabatan</label>
                                                <input type="text" id="" class="form-control" name="jabatan" />
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="">Alamat</label>
                                                <input type="text" id="" class="form-control" name="alamat"/>
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="">No Telepon</label>
                                                <input type="text" id="" class="form-control" name="no_telepon"/>
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="">Username</label>
                                                <input type="text" id="" class="form-control @error('username') is-invalid @enderror" name="username"/>
                                                @error('username')
                                                    <div class="invalid-feedback">
                                                      {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label" for="typePasswordX">Password</label>
                                                <input type="Password" id="" class="form-control @error('password') is-invalid @enderror" name="password"/>
                                                @error('password')
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
                                                    class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-table me-3"></i>Daftar Admin</h3>
                    <div class="table-responsive">
<table class="table table-hover font-family-Kokoro">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama lengkap</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No telepon</th>
                                <th scope="col">Username</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $i => $a)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $a->nama_lengkap }}</td>
                                    <td>{{ $a->jabatan }}</td>
                                    <td>{{ $a->alamat }}</td>
                                    <td>{{ $a->no_telepon }}</td>
                                    <td>{{ $a->username }}</td>
                                    <td><a href={{ Route('admin.show', $a->id) }} class="btn btn-info"><i
                                        class="bi bi-eye"></i></a>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $a->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <div class="modal fade" id="exampleModal{{ $a->id }}" tabindex="-1"
                                            data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content p-2">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel"> Edit
                                                            admin {{ $a->nama_lengkap }}</h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action={{ Route('admin.update', $a->id) }}>
                                                            @csrf
                                                            <div class="form-outline form-white mb-3">
                                                                <label class="form-label" for="">Nama
                                                                    Lengkap</label>
                                                                <input type="text" id=""
                                                                    class="form-control" name="nama_lengkap"
                                                                    value="{{ $a->nama_lengkap }}" required>
                                                            </div>
                                                            <div class="form-outline form-white mb-3">
                                                                <label class="form-label"
                                                                    for="">Jabatan</label>
                                                                <input type="text" id=""
                                                                    class="form-control" name="jabatan"
                                                                    value="{{ $a->jabatan }}">
                                                            </div>
                                                            <div class="form-outline form-white mb-3">
                                                                <label class="form-label"
                                                                    for="">Alamat</label>
                                                                <input type="text" id=""
                                                                    class="form-control" name="alamat"
                                                                    value="{{ $a->alamat }}">
                                                            </div>
                                                            <div class="form-outline form-white mb-3">
                                                                <label class="form-label" for="">No
                                                                    Telepon</label>
                                                                <input type="text" id=""
                                                                    class="form-control" name="no_telepon"
                                                                    value="{{ $a->no_telepon }}">
                                                            </div>
                                                            <div class="form-outline form-white mb-3">
                                                                <label class="form-label"
                                                                    for="">Username</label>
                                                                <input type="text" id=""
                                                                    class="form-control" name="username"
                                                                    value="{{ $a->username }}" required>
                                                            </div>
                                                            <div class="form-outline form-white mb-3">
                                                                <label class="form-label"
                                                                    for="typePasswordX">Password</label>
                                                                <input type="Password" id=""
                                                                    class="form-control" name="password" required>
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
                                        {{-- <a href={{ Route('admin.delete', $a->id) }} class="btn btn-danger"
                                            onclick="return confirm('Apakah Kamu Yakin?')"><i
                                                class="bi bi-trash3"></i></a> --}}
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
                                                        Anda yakin akan menghapus akun admin
                                                        {{ $a->nama_lengkap }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <a href={{ Route('admin.delete', $a->id) }}
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
        <script src={{ asset('assets/bootstrap/js/dist/dropdown.js.map') }}></script>
        <script src={{ asset('assets/bootstrap/js/dist/collapse.js.map') }}></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"
            integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous">
        </script>
</body>

</html>

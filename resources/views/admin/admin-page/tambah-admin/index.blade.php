<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href={{ URL('storage/polindra21.png') }}>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
    <title>SIKI-Admin | Tambah Admin</title>
</head>
<body>
    <div class="container-fluid border">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img class="navbar-brand" src={{ asset('assets/polindra2.jpg') }}>
                <a class="navbar-brand fs-6 fw-normal" href="#">
                    Sistem Informasi Kekayaan Intelektual<br>Politeknik Negeri Indramayu
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
                                <li><a class="dropdown-item" href="/admin/dashboard"><i class="bi bi-grid me-2"></i>Pilih Aplikasi</a></li>
                                <li><a class="dropdown-item" href="/logout"><i class="bi bi-arrow-bar-left me-2"></i>Log
                                        Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <a href="/admin/listadmin" class="link-dark link-underline link-underline-opacity-0 mb-3 "><i class="bi bi-arrow-left-circle mb-3" style="font-size: 35px;"></i></a>
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
                <label class="form-label" for="">Email</label>
                <input type="email" id="" class="form-control @error('email') is-invalid @enderror" name="email"/>
                @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                <div class="form-text">Email ini digunakan untuk menerima notifikasi verifikasi akun baru.</div>
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
            <button class="btn bg-black text-white" type="submit">Tambah</button>
        </form>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
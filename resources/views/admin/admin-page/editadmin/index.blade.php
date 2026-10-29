<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
    <title>SIKI POLINDRA-Admin | Edit Admin</title>
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
    <div class="container mt-4 p-5 border rounded bg-light">
        <form method="post" action={{ Route('admin.update', $user->id) }}>
            @csrf
            <div class="form-outline form-white mb-3">
                <label class="form-label" for="">Nama Lengkap</label>
                <input type="text" id="" class="form-control" name="nama_lengkap" value={{ $user->nama_lengkap }} required>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="">Jabatan</label>
                <input type="text" id="" class="form-control" name="jabatan" value={{ $user->jabatan }}>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="">Alamat</label>
                <input type="text" id="" class="form-control" name="alamat" value={{ $user->alamat }}>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="">No Telepon</label>
                <input type="text" id="" class="form-control" name="no_telepon" value={{ $user->no_telepon }}>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="">Email</label>
                <input type="email" id="" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                <div class="form-text">Email ini digunakan untuk menerima notifikasi verifikasi akun baru.</div>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="">Username</label>
                <input type="text" id="" class="form-control" name="username" value={{ $user->username }} required>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="typePasswordX">Password</label>
                <input type="Password" id="" class="form-control" name="password" required>
              </div>
              <div class=" mt-4">
                <button class="btn bg-black btn-lg px-4 text-white" type="submit">Update</button>
              </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>

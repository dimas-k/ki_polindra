<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Login</title>
</head>
<body>
    <div class="container mt-4">
        <img class="float-start mt-2 me-1" src={{ asset('assets/polindra2.jpg') }} alt="">
        <p class="fs-6 fw-normal font-family-Kokoro">Sistem Informasi Kekayaan Intelektual<br>Politeknik Negeri Indramayu</p>
    </div>
    <br>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
              {{ session('loginError') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-light text-black" style="border-radius: 1rem;">
              <div class="card-body p-5">
                <form class="mb-md-5 mt-md-4 pb-5" method="post" action="/autentikasi">
                  @csrf
                  <h2 class="fw-bold mb-2 text-uppercase text-center">Login Admin<br>SIKI POLINDRA</h2>
                  <p class="text-black-50 mb-5">Masukkan Username dan password Anda!</p>
    
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="username">username</label>
                    <input type="text" id="username" name="username" class="form-control form-control-lg @error('username') is-invalid @enderror" required value={{ old('username') }}>
                    @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
    
                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="pass">Password</label>
                    <input type="password" id="pass" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required>
                    @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <button class="btn bg-black btn-lg px-5 text-white" type="submit">Login</button>
                  </div>
                </form>
                {{-- <div>
                  <p class="mb-0 text-center">Belum Punya Akun? <a href="/register" class="text-black-50 fw-bold">Registrasi</a>
                  </p>
                </div> --}}
    
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
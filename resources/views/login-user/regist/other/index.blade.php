<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/logo-polindra.png') }}">
    <title>SIKI POLINDRA || Register Umum</title>
    <style>
        :root {
            --polindra-navy: #002a57;
            --polindra-blue: #003d7a;
            --polindra-blue-light: #0066cc;
            --polindra-line: #dde5ee;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        .auth-wrap {
            min-height: 100vh;
            display: flex;
        }

        .auth-side {
            background-color: var(--polindra-navy);
            color: #fff;
            width: 38%;
            padding: 48px 44px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .auth-side-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .auth-side-brand img {
            height: 42px;
            width: 42px;
        }

        .auth-side-brand span {
            font-size: 0.85rem;
            font-weight: 600;
            line-height: 1.3;
        }

        .auth-side h1 {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.4;
            margin: 40px 0 14px;
        }

        .auth-side p {
            font-size: 0.9rem;
            line-height: 1.75;
            color: #b9c9dd;
            max-width: 320px;
        }

        .auth-side-foot {
            font-size: 0.78rem;
            color: #8098b8;
        }

        @media (max-width: 900px) {
            .auth-side {
                display: none;
            }
        }

        .auth-form-panel {
            flex: 1;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 48px 20px;
            background-color: #fff;
        }

        .auth-form-box {
            width: 100%;
            max-width: 460px;
        }

        .auth-form-box h4 {
            font-weight: 700;
            color: var(--polindra-navy);
            margin-bottom: 4px;
        }

        .auth-form-box .subtitle {
            font-size: 0.88rem;
            color: #6c7a89;
            margin-bottom: 24px;
        }

        .form-control {
            border-color: var(--polindra-line);
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: var(--polindra-blue-light);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.15);
        }

        .btn-primary {
            background-color: var(--polindra-blue);
            border-color: var(--polindra-blue);
        }

        .btn-primary:hover {
            background-color: var(--polindra-navy);
            border-color: var(--polindra-navy);
        }

        .auth-form-box a {
            color: var(--polindra-blue);
        }

        .password-wrapper {
            position: relative;
        }
    </style>
</head>

<body>
    <div class="auth-wrap">
        <div class="auth-side">
            <div class="auth-side-brand">
                <img src="{{ asset('assets/logo-polindra.png') }}" alt="Logo Polindra">
                <span>Sistem Informasi<br>Kekayaan Intelektual</span>
            </div>
            <div>
                <h1>Registrasi Umum</h1>
                <p>
                    Daftar sebagai masyarakat umum untuk mengajukan dan memantau permohonan Kekayaan Intelektual di
                    SIKI POLINDRA.
                </p>
            </div>
            <div class="auth-side-foot">
                &copy; {{ date('Y') }} Politeknik Negeri Indramayu
            </div>
        </div>

        <div class="auth-form-panel">
            <div class="auth-form-box">
                <h4>Registrasi Umum</h4>
                <p class="subtitle">Masukkan data Anda dengan benar.</p>

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="post" action="{{ route('simpan.akun') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
                            value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="number" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}">
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bekerja Sebagai</label>
                        <input type="text" name="kerjaan" class="form-control @error('kerjaan') is-invalid @enderror" value="{{ old('kerjaan') }}">
                        @error('kerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 password-wrapper">
                        <label class="form-label" for="pass">Password</label>
                        <div class="input-group">
                            <input type="password" id="pass" name="password" class="form-control" required>
                            <span class="input-group-text toggle-password" onclick="togglePassword()">
                                <i class="bi bi-eye-slash" id="toggle-icon"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg" type="submit">Register</button>
                    </div>
                </form>
                <p class="text-center mt-3">Ingin login? <a href="/login" class="fw-bold">Login</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('pass');
            const toggleIcon = document.getElementById('toggle-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>

</html>
{{-- @extends("layout/nav")
@section("content") --}}

{{-- @endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/polindra21.png') }}">
    <title>SIKI POLINDRA || Buat Password Baru</title>
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
            width: 42%;
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
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1.4;
            margin: 40px 0 14px;
        }

        .auth-side p {
            font-size: 0.9rem;
            line-height: 1.75;
            color: #b9c9dd;
            max-width: 340px;
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
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background-color: #fff;
        }

        .auth-form-box {
            width: 100%;
            max-width: 380px;
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
                <h1>Buat Password Baru</h1>
                <p>
                    Masukkan email akun Anda beserta password baru untuk mengatur ulang akses ke SIKI POLINDRA.
                </p>
            </div>
            <div class="auth-side-foot">
                &copy; {{ date('Y') }} Politeknik Negeri Indramayu
            </div>
        </div>

        <div class="auth-form-panel">
            <div class="auth-form-box">
                <h4>Password Baru</h4>
                <p class="subtitle">Kami akan mengirimkan konfirmasi ke email Anda.</p>

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('reset.password.post') }}" method="POST">
                    @csrf
                    <input type="text" name="token" hidden value="{{ $token }}">
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" name="email" placeholder="nama@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="submit">Simpan Password</button>
                    </div>
                </form>
                <p class="text-center mt-3"><a href="/login" class="fw-bold">Kembali ke Login</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
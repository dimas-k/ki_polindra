<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/logo-polindra.png') }}">
    <link rel="stylesheet" href="{{ asset('assets-login-user/login.css') }}">
    <title>SIKI POLINDRA || Register</title>
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

        .form-select {
            border-color: var(--polindra-line);
        }

        .role-option {
            display: block;
            border: 1px solid var(--polindra-line);
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #33465c;
            transition: border-color .15s ease, background-color .15s ease;
        }

        .role-option:hover {
            border-color: var(--polindra-blue-light);
            background-color: #eef4fb;
            color: var(--polindra-navy);
        }

        .role-option i {
            color: var(--polindra-blue-light);
            margin-right: 8px;
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
                <h1>Buat Akun SIKI POLINDRA</h1>
                <p>
                    Daftar sebagai Dosen/Tendik atau masyarakat umum untuk mulai mengajukan permohonan Kekayaan
                    Intelektual secara daring.
                </p>
            </div>
            <div class="auth-side-foot">
                &copy; {{ date('Y') }} Politeknik Negeri Indramayu
            </div>
        </div>

        <div class="auth-form-panel">
            <div class="auth-form-box">
                <h4>Pilih Sesuai Diri Anda</h4>
                <p class="subtitle">Tentukan jenis akun yang ingin Anda daftarkan.</p>

                <a href="register/dosen/" class="role-option">
                    <i class="bi bi-person-badge"></i>Dosen / Tendik POLINDRA
                </a>
                <a href="register/umum/" class="role-option">
                    <i class="bi bi-person"></i>Umum
                </a>

                <div class="text-center mt-3">
                    <p>Sudah punya akun? <a href="/login" class="fw-bold">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('assets/css/index.css') }}>
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <title>SIKI POLINDRA || Struktur SIKI POLINDRA</title>
</head>

<body>
    <style>
        :root {
            --polindra-navy: #002a57;
            --polindra-blue: #003d7a;
            --polindra-line: #dde5ee;
        }

        body {
            background-color: #fff;
        }

        .page-header {
            background-color: var(--polindra-navy);
            padding: 130px 0 40px;
            color: #fff;
        }

        @media (max-width: 991px) {
            .page-header {
                padding-top: 150px;
            }
        }

        .page-header .eyebrow {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #9fb8d6;
            margin-bottom: 6px;
        }

        .page-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .ki-card {
            background: #fff;
            border: 1px solid var(--polindra-line);
            border-radius: 10px;
            padding: 24px;
        }
    </style>

    {{-- nav --}}
    @include('layout.nav')
    {{-- end of nav --}}

    <section class="page-header">
        <div class="container">
            <div class="eyebrow">Tentang SIKI</div>
            <h1>Struktur Organisasi SIKI POLINDRA</h1>
        </div>
    </section>

    <div class="container my-5">
        <div class="ki-card text-center">
            <img class="img-fluid" src="{{ asset('assets/struktur.png') }}" alt="Struktur Organisasi SIKI POLINDRA">
        </div>
    </div>

    {{-- footer --}}
    @include('layout.footer')
    {{-- end of footer --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
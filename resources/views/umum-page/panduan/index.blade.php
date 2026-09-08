<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('assets/css/index.css') }}>
    <link rel="shortcut icon" href={{ asset('assets/logo-polindra.png') }}>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <title>SIKI POLINDRA || Panduan SIKI POLINDRA</title>
</head>

<body>
    <style>
        :root {
            --polindra-navy: #002a57;
            --polindra-blue: #003d7a;
            --polindra-sky: #eef4fb;
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

        .ki-download-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--polindra-blue);
            color: #fff;
            font-size: 0.88rem;
            font-weight: 500;
            border-radius: 8px;
            padding: 10px 18px;
            text-decoration: none;
        }

        .ki-download-btn:hover {
            background: var(--polindra-navy);
            color: #fff;
        }

        /* ===== Accordion flat, biru Polindra ===== */
        .accordion-item {
            border: 1px solid var(--polindra-line);
            border-radius: 10px !important;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .accordion-button {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--polindra-navy);
            background: #fff;
        }

        .accordion-button:not(.collapsed) {
            background: var(--polindra-sky);
            color: var(--polindra-blue);
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: var(--polindra-line);
        }

        .accordion-button::after {
            filter: none;
        }

        .accordion-body {
            font-size: 0.88rem;
            line-height: 1.75;
            color: #45505c;
        }

        /* ===== Sub-bagian di dalam tiap accordion ===== */
        .ki-sub {
            padding: 16px 0;
            border-bottom: 1px solid var(--polindra-line);
        }

        .ki-sub:first-child {
            padding-top: 4px;
        }

        .ki-sub-last {
            border-bottom: none;
        }

        .ki-sub-title {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            color: var(--polindra-blue);
            margin-bottom: 8px;
        }

        .ki-sub p {
            margin-bottom: 0;
        }

        .ki-list {
            margin: 0;
            padding-left: 20px;
        }

        .ki-list li {
            margin-bottom: 8px;
        }

        .ki-list li::marker {
            color: var(--polindra-blue);
            font-weight: 700;
        }

        .ki-list li:last-child {
            margin-bottom: 0;
        }

        .ki-download-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ki-download-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--polindra-sky);
            color: var(--polindra-blue);
            font-size: 0.82rem;
            font-weight: 500;
            border-radius: 8px;
            padding: 8px 14px;
            text-decoration: none;
            line-height: 1.3;
        }

        .ki-download-chip:hover {
            background: var(--polindra-blue);
            color: #fff;
        }
    </style>

    {{-- nav --}}
    @include('layout.nav')
    {{-- end of nav --}}

    <section class="page-header">
        <div class="container">
            <div class="eyebrow">Tentang SIKI</div>
            <h1>Panduan KI POLINDRA</h1>
        </div>
    </section>

    <div class="container my-5">
        @include('umum-page.panduan.list')
        <div class="mt-3">
            <a class="ki-download-btn" href="{{ asset('modul-kilat-djki.pdf') }}" target="_blank">
                <i class="bi bi-file-earmark-pdf"></i>Download Panduan Kekayaan Intelektual
            </a>
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
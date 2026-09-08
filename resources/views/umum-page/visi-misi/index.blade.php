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
    <title>SIKI POLINDRA || Visi Misi SIKI POLINDRA</title>
</head>

<body>
    <style>
        :root {
            --polindra-navy: #002a57;
            --polindra-blue: #003d7a;
            --polindra-blue-light: #0066cc;
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

        .ki-card {
            background: #fff;
            border: 1px solid var(--polindra-line);
            border-left: 4px solid var(--polindra-blue);
            border-radius: 10px;
            padding: 26px 28px;
            height: 100%;
        }

        .ki-card .ki-card-icon {
            width: 46px;
            height: 46px;
            border-radius: 9px;
            background: var(--polindra-sky);
            color: var(--polindra-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 14px;
        }

        .ki-card h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--polindra-navy);
            margin-bottom: 10px;
        }

        .ki-card p,
        .ki-card li {
            font-size: 0.9rem;
            line-height: 1.75;
            color: #45505c;
        }

        .ki-tujuan-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .ki-tujuan-list li {
            display: flex;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid var(--polindra-line);
        }

        .ki-tujuan-list li:last-child {
            border-bottom: none;
        }

        .ki-tujuan-num {
            flex-shrink: 0;
            width: 26px;
            height: 26px;
            border-radius: 6px;
            background: var(--polindra-sky);
            color: var(--polindra-blue);
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    {{-- nav --}}
    @include('layout.nav')
    {{-- end of nav --}}

    <section class="page-header">
        <div class="container">
            <div class="eyebrow">Tentang SIKI</div>
            <h1>Visi, Misi, dan Tujuan P3M</h1>
        </div>
    </section>

    <div class="container my-5">
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <div class="ki-card">
                    <div class="ki-card-icon"><i class="bi bi-binoculars"></i></div>
                    <h2>Visi</h2>
                    <p>Pusat Penelitian dan Pengabdian Masyarakat terdepan dalam penelitian terapan dan pengabdian
                        masyarakat di tingkat nasional.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ki-card">
                    <div class="ki-card-icon"><i class="bi bi-signpost-split"></i></div>
                    <h2>Misi</h2>
                    <p>Memandu pelaksanaan penelitian terapan dan pengabdian masyarakat di Polindra guna
                        menyelesaikan persoalan industri dan masyarakat pada tingkat lokal dan nasional.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="ki-card">
                    <div class="ki-card-icon"><i class="bi bi-flag"></i></div>
                    <h2>Tujuan</h2>
                    <ul class="ki-tujuan-list">
                        <li>
                            <span class="ki-tujuan-num">1</span>
                            <span>Mewujudkan tata kelola pusat penelitian dan pengabdian masyarakat yang
                                bermutu.</span>
                        </li>
                        <li>
                            <span class="ki-tujuan-num">2</span>
                            <span>Meningkatkan kualitas dan kuantitas penelitian terapan dan pengabdian masyarakat
                                para dosen.</span>
                        </li>
                        <li>
                            <span class="ki-tujuan-num">3</span>
                            <span>Bersama-sama industri dan masyarakat dalam menyelesaikan persoalan bidang ketahanan
                                pangan, kemaritiman, ketahanan energi, teknologi industri, serta teknologi informasi
                                dan komunikasi pada tingkat lokal dan nasional sesuai dengan kepakaran para
                                dosen.</span>
                        </li>
                        <li>
                            <span class="ki-tujuan-num">4</span>
                            <span>Mendorong dan memfasilitasi publikasi ilmiah para dosen di tingkat nasional dan
                                internasional.</span>
                        </li>
                    </ul>
                </div>
            </div>
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
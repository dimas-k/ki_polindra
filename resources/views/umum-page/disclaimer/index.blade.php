<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA | Disclaimer</title>
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

        .ki-card {
            background: #fff;
            border: 1px solid var(--polindra-line);
            border-radius: 10px;
            padding: 26px 28px;
        }

        .ki-disclaimer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .ki-disclaimer-list li {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--polindra-line);
            font-size: 0.9rem;
            line-height: 1.75;
            color: #45505c;
        }

        .ki-disclaimer-list li:last-child {
            border-bottom: none;
        }

        .ki-disclaimer-list i {
            flex-shrink: 0;
            color: var(--polindra-blue);
            font-size: 1.05rem;
            margin-top: 3px;
        }
    </style>

    @include('layout.nav')

    <section class="page-header">
        <div class="container">
            <div class="eyebrow">Tentang SIKI</div>
            <h1>Disclaimer</h1>
        </div>
    </section>

    <div class="container my-5">
        <div class="ki-card">
            <ul class="ki-disclaimer-list">
                <li>
                    <i class="bi bi-shield-check"></i>
                    <span>Disclaimer atau sangkalan ini berguna bagi kami sebagai perlindungan terhadap tuntutan
                        hukum dari pihak-pihak yang kurang bertanggung jawab.</span>
                </li>
                <li>
                    <i class="bi bi-shield-check"></i>
                    <span>Semua informasi yang dimuat dalam Sistem Informasi Kekayaan Intelektual Politeknik Negeri
                        Indramayu (Sistem Informasi KI POLINDRA) sudah diusahakan seakurat mungkin. Walau demikian,
                        tidak menutup kemungkinan adanya kesalahan yang tidak disengaja baik oleh administrator
                        maupun karena kesalahan sistem.</span>
                </li>
                <li>
                    <i class="bi bi-shield-check"></i>
                    <span>Susunan (urutan) nama-nama inventor pada Sistem Informasi KI POLINDRA kemungkinan tidak
                        sesuai karena kendala teknis pada sistem. Susunan (urutan) nama-nama inventor yang benar
                        terdapat pada Formulir Permohonan Pendaftaran Paten yang jika diperlukan dapat menghubungi
                        Direktorat Inovasi dan Kekayaan Intelektual POLINDRA.</span>
                </li>
                <li>
                    <i class="bi bi-shield-check"></i>
                    <span>Gunakan situs ini sebagai referensi pengetahuan, bukan sebagai rujukan absolut/mutlak.</span>
                </li>
                <li>
                    <i class="bi bi-shield-check"></i>
                    <span>Dengan menggunakan situs ini, Anda mengakui dan menyetujui bahwa POLINDRA tidak bertanggung
                        jawab dan tidak dapat disalahkan ataupun dituntut atas hasil apapun yang terjadi sebagai
                        akibat dari penggunaan situs ini.</span>
                </li>
            </ul>
        </div>

        <div class="text-center mt-5">
            <img src="{{ asset('assets/illustrations/disclaimer.svg') }}" class="img-fluid" alt="Ilustrasi Disclaimer"
                style="max-height:260px;">
        </div>
    </div>

    @include('layout.footer')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
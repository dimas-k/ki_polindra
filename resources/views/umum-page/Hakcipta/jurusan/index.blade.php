<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA || Hak Cipta Jurusan</title>
</head>

<body>
    <style>
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
                /* Elemen menjadi vertikal */
                align-items: stretch;
                /* Elemen memenuhi lebar kontainer */
            }

            .select2-container {
                width: 100% !important;
                /* Pastikan Select2 penuh lebar */
            }

            .select2-dropdown {
                width: auto !important;
                /* Pastikan dropdown menyesuaikan dengan kontainer */
                max-width: 100% !important;
                
            }

            .search-form>button {
                width: 80%;
                margin-left: 0;
                margin-top: 20px;
            }

        }

        /* Default footer is not fixed */
        footer {
            position: static;
        }

        /* Fixed footer on larger screens */
        @media (min-width: 992px) {
            footer {
                position: fixed;
                bottom: 0;
                width: 100%;
            }
        }
    </style>
    @include('layout.nav')
    <br>
    <br>
    <br>
    <br>
    <div class="container search-container">
        <a href="/hak-cipta" class="link-dark link-underline link-underline-opacity-0 mb-3">
            <i class="bi bi-arrow-left-circle" style="font-size: 2rem;"></i>
        </a>
        <div class="rounded border shadow-sm p-3 mb-4 mt-3">
            <form action="/hak-cipta/list/jurusan/cari" method="POST" class="search-form d-flex align-items-center">
                @csrf
                <label for="jurusan" class="form-label me-3">Jurusan</label>
                <select id="jurusan" class="form-select form-select-sm select2 flex-grow-1" name="jurusan"
                    style="width: 100%;" title="Pilih Jurusan">
                <option></option>
                @foreach($jurusanOptions as $j)
                    <option value="{{ $j->nama_jurusan }}">{{ $j->nama_jurusan }}</option>
                @endforeach
            </select>
                <span class="ms-3"></span>
                <button type="submit" class="btn btn-sm btn-primary">Cari</button>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-secondary-subtle text-muted shadow-inner">
        <!-- Section: Links  -->
        <section class="pt-1 mt-5">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            POLITEKNIK NEGERI INDRAMAYU
                        </h6>
                        <p>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.8880908169504!2d108.27887677495575!3d-6.408414693582335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb87d1fcaf97d%3A0x4fc15b3c8407ada4!2sPoliteknik%20Negeri%20Indramayu!5e0!3m2!1sid!2sid!4v1728365465003!5m2!1sid!2sid"
                                width="280" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Link terkait
                        </h6>
                        <p>
                            <a href="https://p3m.polindra.ac.id/" class="text-reset" target="_blank">P3M POLINDRA</a>
                        </p>
                        <p>
                            <a href="https://www.dgip.go.id/" class="text-reset" target="_blank">DJKI</a>
                        </p>
                        <p>
                            <a href="https://worldwide.espacenet.com/" class="text-reset" target="_blank">Espacenet</a>
                        </p>
                        <p>
                            <a href="https://patents.google.com/" class="text-reset" target="_blank">Google Patent</a>
                        </p>
                        <p>
                            <a href="https://pdki-indonesia.dgip.go.id/" class="text-reset" target="_blank">Penelusuran
                                PDKI</a>
                        </p>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Kontak</h6>
                        <p><i class="bi bi-house-door me-2"></i>Jl. Raya Lohbener Lama No. 08 Indramayu 45252
                        </p>
                        <p><i class="bi bi-telephone me-1"></i>(0234)5746464</p>
                        <p><i class="bi bi-envelope me-1"></i> <a
                                class="link-dark link-underline link-underline-opacity-0"
                                href="mailto:sentra_ki@polindra.ac.id">sentra_ki@polindra.ac.id</a>d
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-reset fw-bold" href="https://polindra.ac.id/">Politeknik Negeri Indramayu</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#jurusan').select2({
                placeholder: "Pilih Jurusan",
                allowClear: true,
                // width: 'resolve', // Pastikan lebar sesuai elemen
                // dropdownParent: $('.container'), // Atur dropdown agar tidak keluar dari container
            });
        });
    </script>
</body>

</html>

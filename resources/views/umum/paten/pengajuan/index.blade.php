<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/polindra21.png') }}" />

    <!-- TITLE -->
    <title>SIKI POLINDRA | Umum | Dashbord</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('assets-user/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('assets-user/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-user/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-user/css/transparent-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-user/css/skin-modes.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets-user/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets-user/colors/color1.css') }}" />
    @yield('css')
    <base href="{{ asset('assets-user') }}/">

</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    {{-- <div id="global-loader">
        <img src={{ asset('assets-user/images/loader.svg') }} class="loader-img" alt="Loader">
    </div> --}}
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            @include('umum.layout.header')
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            @include('umum.layout.sidebar')

            <!--app-content open-->
            @include('umum.paten.pengajuan.content') 
            <!--app-content close-->

        </div>
        <!-- FOOTER -->
        @include('dosen.layout.footer')
        <!-- FOOTER END -->

    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="{{ asset('assets-user/js/jquery.min.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('assets-user/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- SPARKLINE JS-->
    <script src="{{ asset('assets-user/js/jquery.sparkline.min.js') }}"></script>

    <!-- Sticky js -->
    <script src="{{ asset('assets-user/js/sticky.js') }}"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="{{ asset('assets-user/js/circle-progress.min.js') }}"></script>

    <!-- PIETY CHART JS-->
    <script src="{{ asset('assets-user/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/peitychart/peitychart.init.js') }}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{ asset('assets-user/plugins/sidebar/sidebar.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ asset('assets-user/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/p-scroll/pscroll.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/p-scroll/pscroll-1.js') }}"></script>

    <!-- INTERNAL CHARTJS CHART JS-->
    <script src="{{ asset('assets-user/plugins/chart/Chart.bundle.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/chart/rounded-barchart.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/chart/utils.js') }}"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="{{ asset('assets-user/plugins/select2/select2.full.min.js') }}"></script>

    <!-- INTERNAL Data tables js-->
    <script src="{{ asset('assets-user/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/datatable/dataTables.responsive.min.js') }}"></script>

    <!-- INTERNAL APEXCHART JS -->
    <script src="{{ asset('assets-user/js/apexcharts.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/apexchart/irregular-data-series.js') }}"></script>

    <!-- C3 CHART JS -->
    <script src="{{ asset('assets-user/plugins/charts-c3/d3.v5.min.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/charts-c3/c3-chart.js') }}"></script>

    <!-- CHART-DONUT JS -->
    <script src="{{ asset('assets-user/js/charts.js') }}"></script>

    <!-- INTERNAL Flot JS -->
    <script src="{{ asset('assets-user/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/flot/chart.flot.sampledata.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/flot/dashboard.sampledata.js') }}"></script>

    <!-- INTERNAL Vector js -->
    <script src="{{ asset('assets-user/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets-user/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- SIDE-MENU JS-->
    <script src="{{ asset('assets-user/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- INTERNAL INDEX JS -->
    <script src="{{ asset('assets-user/js/index1.js') }}"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('assets-user/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('assets-user/js/custom.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#uploadForm').submit(function(e) {
                e.preventDefault(); // Mencegah form terkirim secara otomatis

                // non file
                var nama = $('#nama_lengkap').val();
                var alamat = $('#alamat').val();
                var telepon = $('#no_telepon').val();
                var tl = $('#tanggal_lahir').val();
                var email = $('#email').val();
                var warga = $('#warga').val();
                var pos = $('#pos').val();
                var judul_paten = $('#judul_paten').val();
                var tanggal_pengajuan = $('#tanggalpengajuan').val();

                var jenis_paten = $('input[name="jenis_paten"]:checked').val();

                //file
                var ktp = $('#ktp')[0].files[0];
                var abstrak = $('#abstrak')[0].files[0];
                var deskripsi = $('#deskripsi')[0].files[0];
                var pengalihan_hak = $('#pengalihan_hak')[0].files[0];
                var klaim = $('#klaim')[0].files[0];
                var kepemilikan = $('#kepemilikan')[0].files[0];
                var kuasa = $('#kuasa')[0].files[0];
                var g_paten = $('#g_paten')[0].files[0];
                var g_tampilan = $('#g_tampilan')[0].files[0];

                // var errorMessage = ''; // Variabel untuk menyimpan pesan error

                // Validasi Nama Lengkap
                if (!nama) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Nama Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Validasi Tanggal Lahir
                if (!alamat) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Alamat Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!telepon) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan No Telepon Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!tl) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Tangal Lahir Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!email) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Tangal Lahir Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!warga) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Kewarganegaraan Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!pos) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Kode Pos Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!jenis_paten) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Jenis Paten Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!judul_paten) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Judul Ciptaan Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!tanggal_pengajuan) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Tanggal Pengajuan!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Validasi File
                if (!ktp) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan KTP Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!abstrak) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Abstrak Paten Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!deskripsi) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Deskripsi Paten Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!pengalihan_hak) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Surat Pengalihan Hak Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!klaim) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Klaim Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!kepemilikan) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Pernyataan Kepemilikan Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!kuasa) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Surat Kuasa Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!g_paten) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Gambar Paten Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }
                if (!g_tampilan) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Tolong Masukkan Gambar Tampilan Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                } else {
                    var allowedExtension = /(\.pdf)$/i; // Hanya memperbolehkan file berformat PDF
                    var maxSize = 10 * 1024 * 1024; // Maksimal ukuran file adalah 2 MB

                    // Validasi ekstensi file
                    // Cek apakah file diinputkan
                    if (!allowedExtension.exec(ktp.name)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan KTP Dengan Ekstensi .pdf!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!allowedExtension.exec(abstrak.name)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Abstrak Paten Dengan Ekstensi .pdf!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!allowedExtension.exec(deskripsi.name)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Deskripsi Paten Dengan Ekstensi .pdf!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!allowedExtension.exec(pengalihan_hak.name)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Surat Pengalihan hak Dengan Ekstensi .pdf!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!allowedExtension.exec(klaim.name)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Klaim Dengan Ekstensi .pdf!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!allowedExtension.exec(kepemilikan.name)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Pernyataan Kepemilikan Dengan Ekstensi .pdf!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!allowedExtension.exec(kuasa.name)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Surat Kuasa Dengan Ekstensi .pdf!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!/(\.pdf)$/i.exec(g_paten.name)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Gambar Paten Dengan Ekstensi .pdf!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!/(\.(pdf|jpe?g|png))$/i.exec(g_tampilan.name)) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Gambar Tampilan Paten Dengan Ekstensi .pdf/.jpg/.jpeg/.png!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }

                    // Validasi ukuran file
                    if (ktp.size > maxSize) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Ukuran File KTP Lebih Dari 10mb!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (abstrak.size > maxSize) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Ukuran File Abstrak Paten Lebih Dari 10mb!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (deskripsi.size > maxSize) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Ukuran Deskripsi paten Lebih Dari 10mb!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (pengalihan_hak.size > maxSize) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Ukuran File Surat Pengalihan Hak Lebih Dari 10mb!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (klaim.size > maxSize) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Ukuran File Klaim Lebih Dari 10mb!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (kepemilikan.size > maxSize) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Ukuran File Pernyataan Kepemilikan Lebih Dari 10mb!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (kuasa.size > maxSize) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Ukuran File Surat Kuasa Lebih Dari 10mb!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (g_paten.size > maxSize) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Ukuran File Gambar Paten Lebih Dari 10mb!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (g_tampilan.size > maxSize) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Ukuran File Gambar Tampilan Lebih Dari 10mb!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }

                }

                // // Jika ada error, tampilkan pesan melalui alert dan cegah pengiriman form
                // if (errorMessage !== '') {
                //     alert(errorMessage);
                //     return false; // Mencegah pengiriman form
                // }
                this.submit();
            });
        });
    </script>

</body>

</html>
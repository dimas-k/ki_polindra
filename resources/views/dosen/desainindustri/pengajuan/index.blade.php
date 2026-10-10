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
    <title>SIKI POLINDRA | Dosen | Dashbord</title>

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
            @include('dosen.layout.header')
            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            @include('dosen.layout.sidebar')

            <!--app-content open-->
            @include('dosen.desainindustri.pengajuan.content') 
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
                e.preventDefault(); // Prevent automatic form submission
    
                // Non-file inputs
                const fields = {
                    nama: $('#nama_lengkap').val(),
                    alamat: $('#alamat').val(),
                    telepon: $('#no_telepon').val(),
                    tl: $('#tanggal_lahir').val(),
                    email: $('#email').val(),
                    warga: $('#warga').val(),
                    pos: $('#pos').val(),
                    judul_desain: $('#judul_desain').val(),
                    tanggal_pengajuan: $('#tanggalpengajuan').val(),
                    jenis_desain: $('input[name="jenis_di"]:checked').val()
                };
    
                // File inputs
                const files = {
                    ktp: $('#ktp')[0].files[0],
                    anggota_inventor: $('#pengaju2')[0].files[0],
                    gambar_desain: $('#gambar_desain')[0].files[0],
                    uraian_desain: $('#uraian_desain')[0].files[0],
                    pernyataan_kepemilikan: $('#pernyataan_kepemilikan')[0].files[0],
                    pengalihan: $('#pengalihan')[0].files[0]
                };
    
                const maxSize = 10 * 1024 * 1024; // Max size: 10MB
                const allowedExtensionPDF = /(\.pdf)$/i;
                const allowedExtensionExcel = /(\.xlsx)$/i;
    
                // Validation function
                function showError(message) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: message,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
    
                // Validate non-file inputs
                for (var field in fields) {
                    if (!fields[field]) {
                        showError("Tolong Masukkan " + field.replace('_', ' ').toUpperCase() + " Anda!");
                        return false;
                    }
                }
    
                // List of mandatory file fields
                const mandatoryFiles = ['ktp', 'abstrak', 'deskripsi', 'pengalihan_hak', 'klaim', 'kepemilikan', 'kuasa', 'g_paten', 'g_tampilan'];
    
                // Validate file inputs
                for (var file in files) {
                    // Check mandatory files that are empty
                    if (mandatoryFiles.includes(file) && !files[file]) {
                        showError("File " + file.replace('_', ' ').toUpperCase() + " Wajib Diisi!");
                        return false;
                    }
    
                    // Check file type for anggota inventor only
                    if (file === 'anggota_inventor' && files[file]) {
                        if (!allowedExtensionExcel.exec(files[file].name)) {
                            showError("Tolong Masukkan Data anggota inventor Dengan Ekstensi .xlsx!");
                            return false;
                        }
                    } else if (files[file]) {
                        // Validate other files
                        if (!(['g_tampilan','gambar_desain','gambar_di'].includes(file) ? /(\.(pdf|jpe?g|png))$/i : allowedExtensionPDF).exec(files[file].name)) {
                            showError("Tolong Masukkan " + file.replace('_', ' ').toUpperCase() + " Dengan Ekstensi .pdf!");
                            return false;
                        }
    
                        // Validate file size
                        if (files[file].size > maxSize) {
                            showError("Ukuran File " + file.replace('_', ' ').toUpperCase() + " Lebih Dari 10 MB!");
                            return false;
                        }
                    }
                }
    
                // If all validations pass, submit the form
                this.submit();
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#uploadForm').submit(function(e) {
                e.preventDefault(); // Prevent automatic form submission
    
                // Gather non-file inputs
                const fields = {
                    nama: $('#nama_lengkap').val(),
                    alamat: $('#alamat').val(),
                    telepon: $('#no_telepon').val(),
                    tl: $('#tanggal_lahir').val(),
                    email: $('#email').val(),
                    warga: $('#warga').val(),
                    pos: $('#pos').val(),
                    judul_desain: $('#judul_desain').val(),
                    tanggal_pengajuan: $('#tanggalpengajuan').val(),
                    jenis_desain: $('input[name="jenis_di"]:checked').val()
                };
    
                // Gather file inputs
                const files = {
                    ktp: $('#ktp')[0].files[0],
                    anggota_inventor: $('#pengaju2')[0].files[0],
                    gambar_desain: $('#gambar_desain')[0].files[0],
                    uraian_desain: $('#uraian_desain')[0].files[0],
                    pernyataan_kepemilikan: $('#pernyataan_kepemilikan')[0].files[0],
                    pengalihan: $('#pengalihan')[0].files[0]
                };
                
                const maxSize = 10 * 1024 * 1024; // Max size: 10MB
                const allowedExtensionPDF = /(\.pdf)$/i;
                const allowedExtensionExcel = /(\.xlsx)$/i;
    
                // Validation function
                function showError(message) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: message,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
    
                // Validate non-file inputs
                for (var field in fields) {
                    if (!fields[field]) {
                        showError("Tolong Masukkan " + field.replace('_', ' ').toUpperCase() + " Anda!");
                        return false;
                    }
                }
    
                // Validate file inputs
                for (var file in files) {
                    if (file === 'anggota_inventor') {
                        // Only validate if the file is provided
                        if (files[file]) {
                            if (!allowedExtensionExcel.exec(files[file].name)) {
                                showError("Tolong Masukkan Data Anggota Inventor Dengan Ekstensi .xlsx!");
                                return false;
                            }
                        }
                    } else if (files[file]) {
                        // Validate other files
                        if (!(['g_tampilan','gambar_desain','gambar_di'].includes(file) ? /(\.(pdf|jpe?g|png))$/i : allowedExtensionPDF).exec(files[file].name)) {
                            showError("Tolong Masukkan " + file.replace('_', ' ').toUpperCase() + " Dengan Ekstensi .pdf!");
                            return false;
                        }
    
                        // Validate file size
                        if (files[file].size > maxSize) {
                            showError("Ukuran File " + file.replace('_', ' ').toUpperCase() + " Lebih Dari 10 MB!");
                            return false;
                        }
                    }
                }
    
                // If all validations pass, submit the form
                this.submit();
            });
        });
    </script> --}}
    

</body>

</html>
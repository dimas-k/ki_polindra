<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets-admin/') }}" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom CSS for z-index -->
    <style>
        .swal2-container {
            z-index: 2000 !important;
            /* SweetAlert z-index lebih tinggi dari Bootstrap modal */
        }
    </style>



    <title>Admin D-PROIN | Kelompok Keahlian</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets-admin/img/logo-polindra.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets-admin/css/demo.css') }}" />
    {{-- <link rel="stylesheet" href="sweetalert2.min.css"> --}}

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets-admin/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets-admin/js/config.js') }}"></script>

    <!-- link cdn CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('produkinovasi::admin.layouts.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('produkinovasi::admin.layouts.header')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @include('produkinovasi::admin.content.kbk')
                </div>
                <!-- / Content -->



                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets-admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- <script src="sweetalert2.all.min.js"></script> --}}


    <!-- Main JS -->
    <script src="{{ asset('assets-admin/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error =>{
            console.error( error );
        } )
    </script> --}}

    <script>
        document.querySelectorAll('#editor').forEach(textarea => {
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            // Saat form disubmit
            @foreach ($kbk as $k)

                $('#editForm_{{ $k->id }}').submit(function(e) {
                    e.preventDefault(); // Mencegah form terkirim secara langsung

                    // Ambil nilai dari inputan
                    var nama_kbk = $('#kbk_{{ $k->id }}').val().trim(); // Pastikan trim() untuk menghilangkan spasi
                    var jurusan = $('#jurusan_{{ $k->id }}').val().trim(); // Ambil value berdasarkan name
                    var deskripsi = $('textarea[name="deskripsi"]').val().trim();

                    // Validasi inputan (tidak boleh kosong)
                    if (!nama_kbk || !jurusan || !deskripsi) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Semua inputan harus diisi!',
                        });
                        return false;
                    }

                    // Submit form menggunakan AJAX
                    $.ajax({
                        url: $(this).attr('action'), // URL untuk update (dari atribut action form)
                        type: 'POST',
                        data: $(this).serialize(), // Ambil data dari form
                        success: function(response) {
                            // Tutup modal setelah submit sukses
                            $('#exampleModal{{ $k->id }}').modal('hide');

                            // Tampilkan alert setelah modal ditutup
                            setTimeout(function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Selamat, data KBK telah di-update!',
                                });
                            }, 500); // Penundaan sebelum alert muncul (menunggu modal tertutup)
                        },
                        error: function(xhr) {
                            // Tampilkan alert jika ada error saat menyimpan data
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat mengupdate data. Silakan coba lagi.',
                            });
                        }
                    });
                });
            @endforeach
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('#uploadForm').submit(function(e) {
                e.preventDefault(); // Mencegah form terkirim secara otomatis

                // Ambil nilai input
                var nama_kbk = $('#namaKbk').val();
                var jurusan = $('#jurusan').val();
                var editor = $('#editor').val();

                // Validasi input
                if (!nama_kbk || !jurusan || !editor) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Inputan tidak boleh kosong!",
                    });
                    return false;
                }

                // Kirim form menggunakan AJAX
                $.ajax({
                    url: $(this).attr(
                        'action'), // URL untuk mengirim data (dari atribut action form)
                    type: 'POST',
                    data: $(this).serialize(), // Mengambil semua input dari form
                    success: function(response) {
                        // Reload halaman terlebih dahulu
                        location.reload();
                        // Tampilkan notifikasi setelah halaman selesai dimuat
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil ditambahkan!',
                        });
                    },
                    error: function(xhr) {
                        // Menampilkan pesan error jika terjadi kesalahan
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Ada masalah saat menambahkan data. Silakan coba lagi.',
                        });
                    }
                });
            });
        });
    </script>


    <script>
        window.deleteConfirm = function(e) {
            e.preventDefault(); // Mencegah pengiriman form

            var form = $(e.target).closest('form'); // Mengambil form terkait dan membungkusnya dengan jQuery

            Swal.fire({
                title: "Apakah Kamu yakin ?",
                text: "KBK ini akan kamu hapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr('action'), // Mengambil URL dari atribut action
                        type: 'POST',
                        data: form.serialize() + '&_method=DELETE', // Menggunakan serialize dari jQuery
                        success: function(response) {
                            location.reload(); // Untuk memuat ulang halaman
                            // Tampilkan alert sukses
                            Swal.fire({
                                title: 'Dihapus!',
                                text: 'KBK Telah Berhasil dihapus.',
                                icon: 'success',
                                confirmButtonText: 'OKE'
                            }).then(() => {
                                // Reload halaman atau redirect ke halaman lain
                            });
                        },
                        error: function(xhr) {
                            // Tangkap pesan error dari server
                            var errorMessage = 'Terjadi masalah saat hapus kbk.';

                            // Jika server mengirimkan respons JSON dengan pesan error
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseText) {
                                // Jika tidak ada responseJSON, gunakan responseText
                                errorMessage = xhr.responseText;
                            }

                            // Tampilkan alert error dengan pesan kesalahan spesifik
                            Swal.fire({
                                title: 'Error!',
                                text: errorMessage, // Menampilkan pesan error dari server
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Selamat!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>


</body>

</html>

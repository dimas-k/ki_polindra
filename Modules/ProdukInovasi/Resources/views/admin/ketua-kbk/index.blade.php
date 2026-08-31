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



    <title>Admin D-PROIN | Ketua KBK</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets-admin/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets-admin/js/config.js') }}"></script>
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
                    @include('produkinovasi::admin.content.ketua-kbk')
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

    <!-- Main JS -->
    <script src="{{ asset('assets-admin/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




    <script>
        window.deleteConfirm = function(e) {
            e.preventDefault(); // Mencegah pengiriman form

            var form = $(e.target).closest('form'); // Mengambil form terkait dan membungkusnya dengan jQuery

            Swal.fire({
                title: "Apakah anda yakin ?",
                text: "Akun ini akan anda hapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: 'Batal'
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
                                text: 'Akun Telah Berhasil dihapus.',
                                icon: 'success',
                                confirmButtonText: 'OKE'
                            })
                        },
                        error: function(xhr) {
                            // Tangani kesalahan
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat hapus akun.',
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
            $('#uploadForm').submit(function(e) {
                e.preventDefault();

                var nama_lengkap = $('#nama_lengkap').val();
                var nip = $('#nip').val();
                var email = $('#email').val();

                // Fungsi untuk pengecekan unik
                function checkUnique(field, value, callback) {
                    $.ajax({
                        url: '/admin/ketua-kbk/store',
                        type: 'POST',
                        data: {
                            check_unique: true,
                            field: field,
                            value: value,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callback(response.exists);
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat memvalidasi data!',
                            });
                        }
                    });
                }

                // Pengecekan data unik sebelum submit
                checkUnique('nama_lengkap', nama_lengkap, function(exists) {
                    if (exists) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Oops...',
                            text: 'Nama lengkap sudah digunakan!',
                        });
                        return;
                    }

                    checkUnique('nip', nip, function(exists) {
                        if (exists) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Oops...',
                                text: 'NIP sudah digunakan!',
                            });
                            return;
                        }

                        checkUnique('email', email, function(exists) {
                            if (exists) {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Oops...',
                                    text: 'Email sudah digunakan!',
                                });
                                return;
                            }

                            // Semua validasi lolos, submit form
                            submitForm();
                        });
                    });
                });

                function submitForm() {
                    Swal.fire({
                        title: 'Simpan Data?',
                        text: "Apakah Anda yakin ingin menyimpan data ini?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/admin/ketua-kbk/store',
                                type: 'POST',
                                data: new FormData($('#uploadForm')[0]),
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                    }).then(() => {
                                        window.location.href =
                                            '/admin/ketua-kbk';
                                    });
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Terjadi kesalahan saat menyimpan data!',
                                    });
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.resetPasswordBtn').on('click', function(e) {
                e.preventDefault();

                var url = $(this).data('url'); // Ambil URL dari data-url
                console.log(url); // Debug untuk cek apakah URL sudah benar

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Apakah anda yakin ingin mereset password akun ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, reset!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url, // Gunakan URL dari atribut data-url
                            type: 'GET', // Atau sesuaikan dengan POST jika perlu
                            success: function(response) {
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: response
                                        .message, // Menampilkan pesan sukses dari controller
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location
                                        .reload(); // Reload halaman setelah alert
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: xhr.responseJSON.message ||
                                        'Terjadi kesalahan.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            @foreach ($kbk as $k)
                $('#editForm_{{ $k->id }}').on('submit', function(e) {
                    e.preventDefault(); // Mencegah submit form secara langsung

                    // Ambil ID pengguna untuk elemen yang sedang diproses
                    const id = '{{ $k->id }}';

                    // Ambil nilai input berdasarkan ID pengguna
                    const nama_lengkap = $('#nama_lengkap_' + id).val();
                    const nip = $('#nip_' + id).val();
                    const jabatan = $('#jabatan_' + id).val();
                    const no_hp = $('#no_hp_' + id).val();
                    const email = $('#email_' + id).val();
                    const foto = $('#foto_' + id)[0].files.length ? $('#foto_' + id)[0].files[0].name : '';

                    // Regex untuk validasi file extensions
                    const fotoExtensions = /(\.jpg|\.jpeg|\.png)$/i;

                    // Validasi input kosong
                    if (!nama_lengkap || !nip || !jabatan || !no_hp || !email) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Semua input harus diisi!',
                        });
                        return;
                    }

                    // Validasi format file pas foto
                    if (foto && !fotoExtensions.exec(foto)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Pas foto harus dalam format JPG, JPEG, atau PNG!',
                        });
                        return;
                    }

                    // Validasi unik untuk NIP dan Email
                    $.ajax({
                        url: '/admin/ketua-kbk/update/' + id,
                        type: 'POST',
                        data: {
                            nip: nip,
                            email: email,
                            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                            check_unique: true // Flag untuk memeriksa unique
                        },
                        success: function(response) {
                            if (response.exists) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Nama lengkap atau NIP atau email sudah digunakan!',
                                });
                            } else {
                                Swal.fire({
                                    title: 'Simpan Data?',
                                    text: "Apakah Anda yakin ingin mengupdate data ini?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, Simpan!',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Tutup modal sebelum submit form
                                        $('#basicModal{{ $k->id }}').modal(
                                            'hide');

                                        // Submit form yang terkait berdasarkan ID pengguna
                                        $.ajax({
                                            url: $(this).attr('action'),
                                            type: 'POST',
                                            data: new FormData(this),
                                            contentType: false,
                                            processData: false,
                                            success: function(response) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Berhasil',
                                                    text: response
                                                        .message, // Tampilkan pesan dari server
                                                }).then(() => {
                                                    location
                                                    .reload(); // Reload halaman setelah sukses
                                                });
                                            },
                                            error: function(xhr) {
                                                if (xhr.status === 422) {
                                                    const errors = xhr
                                                        .responseJSON
                                                        .errors;
                                                    let errorMessage = '';
                                                    for (const [key,
                                                        value] of Object
                                                        .entries(errors)) {
                                                        errorMessage +=
                                                            `${value[0]}\n`;
                                                    }
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Gagal',
                                                        text: errorMessage,
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error!',
                                                        text: 'Ada masalah saat mengupdate data.',
                                                    });
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan dalam memeriksa NIP dan email!',
                            });
                        }
                    });
                });
            @endforeach
        });
    </script>



</html>

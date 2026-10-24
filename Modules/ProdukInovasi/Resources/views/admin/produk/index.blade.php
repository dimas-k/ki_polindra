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



    <title>Admin D-PROIN | Admin</title>

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
    <style>
        .btn-checkbox {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            display: inline-block;
            width: 55px;
            height: 35px;
            background-color: #00ccff;
            /* Warna default (belum dicentang) */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            line-height: 40px;
        }

        .btn-checkbox:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Tambahkan bayangan */
            transform: translateY(-1px);
            /* Checkbox sedikit terangkat ke atas */
        }

    </style>
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
                    @include('produkinovasi::admin.content.produk')
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
        $(document).ready(function() {
            // Seleksi semua checkbox dengan id yang dimulai dengan "status_validasi-"
            $('input[type="checkbox"][id^="status_validasi-"]').on('change', function(e) {
                e.preventDefault(); // Mencegah aksi default checkbox
    
                let checkbox = $(this);
                let form = checkbox.closest('form'); // Mendapatkan form terdekat dari checkbox yang diklik
                let isChecked = checkbox.is(':checked');
    
                // Tampilkan konfirmasi SweetAlert
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Anda ingin memvalidasi produk ini.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Validasi',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika dikonfirmasi, tampilkan alert sukses
                        Swal.fire({
                            title: 'Selamat!',
                            text: 'Produk telah tervalidasi.',
                            icon: 'success'
                        }).then(() => {
                            // Ubah status checkbox dan submit form
                            checkbox.prop('checked', isChecked);
                            form.submit(); // Mengirimkan form terkait
                        });
                    } else {
                        // Jika dibatalkan, kembalikan status checkbox ke semula
                        checkbox.prop('checked', !isChecked);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#editForm').submit(function(e) {
                e.preventDefault(); // Mencegah form terkirim secara otomatis

                // Ambil nilai input
                var form = $(this); // Mendapatkan referensi form
                var nama = $('#nama_lengkap').val();
                var nip = $('#nip').val();
                var jabatan = $('#jabatan').val();
                var no_hp = $('#no_hp').val();
                var email = $('#email').val();
                var kbk = $('#exampleFormControlSelect1').val();
                var username = $('#username').val();
                var password = $('#password').val();

                // Fungsi untuk mengecek apakah input hanya berisi teks
                function isText(input) {
                    var textPattern = /^[a-zA-Z\s]+$/;
                    return textPattern.test(input);
                }

                // Fungsi untuk validasi panjang NIP
                function validateNIPLength(nip) {
                    return nip.length <= 20;
                }

                // Validasi Nama Lengkap
                if (!nama || !isText(nama)) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Nama Lengkap tidak boleh kosong & hanya boleh berisi huruf!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Validasi NIP (harus angka dan tidak lebih dari 20 digit)
                if (!nip || isNaN(nip)) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "NIP tidak boleh kosong & harus berupa angka!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                } else if (!validateNIPLength(nip)) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "NIP tidak boleh lebih dari 20 digit!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Validasi Jabatan (hanya teks)
                if (!jabatan || !isText(jabatan)) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Jabatan tidak boleh kosong & hanya boleh berisi huruf!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Validasi No Handphone (harus angka)
                if (!no_hp || isNaN(no_hp)) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "No Handphone tidak boleh kosong & harus berupa angka!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Validasi Email
                if (!email || !email.includes('@')) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Masukkan email yang valid!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Validasi KBK (tidak boleh kosong)
                if (kbk === "") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Pilih KBK yang tersedia!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Validasi Username (hanya teks)
                if (!username || !isText(username)) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Username tidak boleh kosong & hanya boleh berisi huruf!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Validasi Password (tidak boleh kosong)
                if (!password) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops... Ada yang salah...",
                        text: "Masukkan password Anda!",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    return false;
                }

                // Jika semua validasi lolos, kirim form menggunakan AJAX
                $.ajax({
                    url: form.attr('action'), // URL diambil dari atribut 'action' form
                    type: 'POST',
                    data: form.serialize(), // Kirim semua data form
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Data berhasil diupdate!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        // Redirect setelah berhasil
                        setTimeout(function() {
                            window.location.href = "/admin/ketua-kbk";
                        }, 2500);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Gagal mengupdate data!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
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
                text: "Akun ini akan kamu hapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
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
                            })
                        },
                        error: function(xhr) {
                            // Tangani kesalahan
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was a problem deleting the item.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.getElementById('status_validasi');

            checkbox.addEventListener('change', function() {
                var status = checkbox.checked ? 'sudah' : 'belum';

                // Kirim permintaan AJAX
                fetch('{{ route('produk.validasi', $data_produk->id) }}', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(data.message); // Tampilkan pesan sukses
                            // Jika Anda ingin mengalihkan pengguna ke halaman produk inovasi
                            window.location.href = '{{ route('admin.produk', $data_produk->id) }}';
                        } else {
                            console.error('Gagal memperbarui status validasi');
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                    });
            });
        });
    </script> --}}

</body>

</html>

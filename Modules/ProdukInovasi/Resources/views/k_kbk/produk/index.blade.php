<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets-admin/') }}" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> --}}

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <style type="text/css">
        .dropdown-toggle {
            height: 43px;
        }

        .selectpicker {
            max-height: 300px;
            /* Atur ketinggian maksimal dropdown */
            overflow-y: auto;
            /* Menambahkan scroll jika data melebihi tinggi */
        }
    </style>



    <!-- Custom CSS for z-index -->
    <style>
        .swal2-container {
            z-index: 2000 !important;
            /* SweetAlert z-index lebih tinggi dari Bootstrap modal */
        }
    </style>



    <title>DB-PRO | Ketua KBK | produk</title>

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
            @include('produkinovasi::k_kbk.layouts.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('produkinovasi::k_kbk.layouts.header')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @include('produkinovasi::k_kbk.content.produk')
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> --}}
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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        function toggleInventorInput1() {
            // Cek apakah pilihan 'Dosen' atau 'Non-Dosen' yang dipilih
            const isDosen = document.getElementById('inventorDosen').checked;
            // Tampilkan 'selectpicker' jika 'Dosen' dipilih, sembunyikan input teks
            document.getElementById('dosenInput').style.display = isDosen ? 'block' : 'none';
            document.getElementById('nonDosenInput').style.display = isDosen ? 'none' : 'block';
        }

        // Inisialisasi SelectPicker jika menggunakan plugin
        document.addEventListener('DOMContentLoaded', function() {
            $('#inventor').selectpicker();
        });
    </script>


    <script>
        // Fungsi untuk menampilkan input text jika "Ya" dipilih
        function toggleAnggotaLainnya1() {
            var anggotaLainnyaContainer = document.getElementById('anggotaLainnyaContainer');
            var radioYa = document.getElementById('inventorYes');

            // Menampilkan atau menyembunyikan input berdasarkan pilihan radio button
            if (radioYa.checked) {
                anggotaLainnyaContainer.style.display = 'block';
            } else {
                anggotaLainnyaContainer.style.display = 'none';
            }
        }

        // Memanggil fungsi untuk inisialisasi tampilan saat halaman pertama kali dimuat
        toggleAnggotaLainnya1();
    </script>

    <script>
        // Event delegation untuk menangani klik pada semua radio button
        document.addEventListener('click', function(event) {
            // Periksa apakah elemen yang diklik adalah radio button dengan ID tertentu
            if (event.target.name && event.target.name.startsWith('inventor_type_')) {
                // Ambil ID dari radio button yang diklik
                var id = event.target.name.replace('inventor_type_', ''); // Contoh: inventor_type_1 menjadi 1

                // Panggil fungsi toggleInventorInput untuk ID tersebut
                toggleInventorInput(id);
            }
        });

        // Fungsi untuk menampilkan/mengubah input berdasarkan radio yang dipilih
        function toggleInventorInput(id) {
            var dosenInput = document.getElementById('dosenInput_' + id);
            var nonDosenInput = document.getElementById('nonDosenInput_' + id);
            var radioDosen = document.getElementById('inventorDosen_' + id);
            var radioNonDosen = document.getElementById('inventorNonDosen_' + id);

            if (radioDosen && radioDosen.checked) {
                dosenInput.style.display = 'block';
                nonDosenInput.style.display = 'none';
            } else if (radioNonDosen && radioNonDosen.checked) {
                dosenInput.style.display = 'none';
                nonDosenInput.style.display = 'block';
            }
        }
    </script>

    <script>
        // Event delegation untuk menangani klik pada semua radio button "tipe_inventor"
        document.addEventListener('click', function(event) {
            if (event.target.name && event.target.name.startsWith('tipe_inventor_')) {
                // Ambil ID produk dari name radio button
                const id = event.target.name.replace('tipe_inventor_', ''); // Contoh: tipe_inventor_1 menjadi 1

                // Panggil fungsi untuk toggle input "Nama Anggota Lainnya"
                toggleAnggotaLainnya(id);
            }
        });

        // Fungsi untuk menampilkan/mengubah input berdasarkan radio yang dipilih
        function toggleAnggotaLainnya(id) {
            const anggotaLainnyaContainer = document.getElementById('anggotaLainnyaContainer_' + id);
            const radioYa = document.getElementById('inventorYes_' + id);

            if (radioYa && radioYa.checked) {
                anggotaLainnyaContainer.style.display = 'block';
            } else {
                anggotaLainnyaContainer.style.display = 'none';
            }
        }

        // Inisialisasi saat halaman pertama kali dimuat
        document.querySelectorAll('[name^="tipe_inventor_"]').forEach(radio => {
            const id = radio.name.replace('tipe_inventor_', '');
            toggleAnggotaLainnya(id);
        });
    </script>





    <script type="text/javascript">
        $(document).ready(function() {
            $('#anggota_inventor').selectpicker();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#anggota_inventor2').selectpicker();
        });
    </script>

    <script>
        window.deleteConfirm = function(e) {
            e.preventDefault(); // Mencegah pengiriman form

            var form = $(e.target).closest('form'); // Mengambil form terkait dan membungkusnya dengan jQuery

            Swal.fire({
                title: "Apakah Kamu yakin ?",
                text: "Produk ini akan kamu hapus!",
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
                                text: 'Produk Telah Berhasil dihapus.',
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

    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah submit default

                // Buat form data
                var formData = new FormData(this);
                Swal.fire({
                    title: 'Simpan Data?',
                    text: "Apakah Anda yakin ingin simpan data produk ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/k-kbk/produk/store',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if (response.success) {
                                    // Jika sukses, tutup modal dan tampilkan pesan success
                                    $('#basicModal').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                    }).then(() => {
                                        // Redirect atau reload halaman jika diperlukan
                                        window.location.reload();
                                    });
                                }
                            },
                            error: function(xhr) {
                                let errorMessage = 'Terjadi kesalahan.';

                                // Cek apakah ada pesan error yang lebih detail dari respons JSON
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                // Tampilkan alert error dengan pesan yang jelas
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: errorMessage,
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
            // Loop untuk setiap form berdasarkan ID produk
            @foreach ($produks as $p)
                $('#editForm_{{ $p->id }}').on('submit', function(e) {
                    e.preventDefault(); // Mencegah submit form secara langsung

                    // Ambil ID produk untuk elemen yang sedang diproses
                    const id = '{{ $p->id }}';

                    // Mengambil nilai input berdasarkan ID produk
                    const nama_produk = $('#nama_produk_' + id).val();
                    const deskripsi = $('#deskripsi_' + id).val();
                    // const anggota = $('#anggota_' + id).val();
                    const email = $('#email_' + id).val();
                    const inventor = $('#inventor_' + id).val();
                    const inventor_lainnya = $('#inventor_lainnya_' + id).val();
                    const gambar = $('#gambar_' + id)[0].files.length ? $('#gambar_' + id)[0].files[0] :
                        null;
                    const lampiran = $('#lampiran_' + id)[0].files.length ? $('#lampiran_' + id)[0].files[
                        0] : null;
                    const ts = $('#tanggal_submit_' + id).val();
                    const tg = $('#tanggal_granted_' + id).val();

                    // Regex untuk validasi file extensions
                    const gambarExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                    const lampiranExtensions = /(\.jpg|\.jpeg|\.png|\.pdf|\.docx)$/i;

                    const maxGambarSize = 10 * 1024 * 1024; // 10MB
                    const maxLampiranSize = 10 * 1024 * 1024; // 2MB

                    // Validasi input kosong
                    if (!nama_produk || !deskripsi || !email) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Semua input harus diisi!',
                        });
                        return;
                    }

                    // Validasi format dan ukuran file gambar
                    if (gambar) {
                        if (!gambarExtensions.exec(gambar.name)) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Gambar produk harus dalam format JPG, JPEG, atau PNG!',
                            });
                            return;
                        }
                        if (gambar.size > maxGambarSize) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Ukuran gambar tidak boleh lebih dari 10MB!',
                            });
                            return;
                        }
                    }

                    // Validasi format dan ukuran file lampiran
                    if (lampiran) {
                        if (!lampiranExtensions.exec(lampiran.name)) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Lampiran harus dalam format JPG, JPEG, PNG, PDF, atau DOCX!',
                            });
                            return;
                        }
                        if (lampiran.size > maxLampiranSize) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Ukuran lampiran tidak boleh lebih dari 10MB!',
                            });
                            return;
                        }
                    }

                    // Jika semua validasi lolos, submit form
                    Swal.fire({
                        title: 'Simpan Data?',
                        text: "Apakah Anda yakin ingin update data produk ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Tutup modal sebelum submit form
                            $('#basicModal_' + id).modal('hide');

                            // Submit form yang terkait berdasarkan ID produk
                            $('#editForm_' + id)[0].submit();

                            // Tampilkan alert setelah submit sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil diupdate!'
                            });
                        }
                    });
                });
            @endforeach
        });
    </script>

</body>

</html>

<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets-admin/') }}" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom CSS for z-index -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <style type="text/css">
        .dropdown-toggle {
            height: 43px;
        }
    </style>


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
                    @include('produkinovasi::k_kbk.content.penelitian')
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


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


    <script>
        function togglePenulisInput() {
            // Cek apakah pilihan 'Dosen' atau 'Non-Dosen' yang dipilih
            const isDosen = document.getElementById('penulisDosen').checked;

            // Tampilkan 'selectpicker' jika 'Dosen' dipilih, sembunyikan input teks
            document.getElementById('dosenInput').style.display = isDosen ? 'block' : 'none';
            document.getElementById('nonDosenInput').style.display = isDosen ? 'none' : 'block';
        }

        // Inisialisasi SelectPicker jika menggunakan plugin
        document.addEventListener('DOMContentLoaded', function() {
            $('#penulis').selectpicker();
        });
    </script>

    <script>
        function togglePenulisKorespondensiInput1() {
            // Cek apakah pilihan 'Dosen' atau 'Non-Dosen' yang dipilih
            const isDosen = document.getElementById('penulisKorespondensiDosen').checked;

            // Tampilkan 'selectpicker' jika 'Dosen' dipilih, sembunyikan input teks
            document.getElementById('dosenInput1').style.display = isDosen ? 'block' : 'none';
            document.getElementById('nonDosenInput1').style.display = isDosen ? 'none' : 'block';
        }

        // Inisialisasi SelectPicker jika menggunakan plugin
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi SelectPicker
            $('#penulis_korespondensi_select').selectpicker();
        });
    </script>

    <script>
        // Fungsi untuk menampilkan input text jika "Ya" dipilih
        function toggleAnggotaLainnya1() {
            var anggotaLainnyaContainer = document.getElementById('anggotaLainnyaContainer');
            var radioYa = document.getElementById('penulisYes');

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
        document.addEventListener('DOMContentLoaded', function() {
            // Event delegation untuk menangani klik pada semua radio button dengan name yang dimulai dari "penulis_type_"
            document.addEventListener('change', function(event) {
                if (event.target.name && event.target.name.startsWith('penulis_type_')) {
                    // Ambil ID dari radio button yang diklik
                    const id = event.target.name.replace('penulis_type_',
                        ''); // Contoh: penulis_type_1 menjadi 1

                    // Panggil fungsi togglepenulisInput untuk ID tersebut
                    togglepenulisInput(id);
                }

                if (event.target.name && event.target.name.startsWith('tipe_penulis_')) {
                    // Ambil ID dari radio button yang diklik
                    const id = event.target.name.replace('tipe_penulis_',
                        ''); // Contoh: tipe_penulis_1 menjadi 1

                    // Panggil fungsi untuk toggle input "Nama Anggota Lainnya"
                    toggleAnggotaLainnya(id);
                }
            });

            // Fungsi untuk menampilkan/mengubah input berdasarkan radio yang dipilih
            function togglepenulisInput(id) {
                const dosenInput = document.getElementById('dosenInput_' + id);
                const nonDosenInput = document.getElementById('nonDosenInput_' + id);
                const radioDosen = document.getElementById('penulisDosen_' + id);
                const radioNonDosen = document.getElementById('penulisNonDosen_' + id);

                if (radioDosen && radioDosen.checked) {
                    dosenInput.style.display = 'block';
                    nonDosenInput.style.display = 'none';
                } else if (radioNonDosen && radioNonDosen.checked) {
                    dosenInput.style.display = 'none';
                    nonDosenInput.style.display = 'block';
                }
            }

            // Fungsi untuk menampilkan/mengubah input berdasarkan radio yang dipilih
            function toggleAnggotaLainnya(id) {
                const anggotaLainnyaContainer = document.getElementById('anggotaLainnyaContainer_' + id);
                const radioYa = document.getElementById('penulisYes_' + id);

                if (radioYa && radioYa.checked) {
                    anggotaLainnyaContainer.style.display = 'block';
                } else {
                    anggotaLainnyaContainer.style.display = 'none';
                }
            }

            // Inisialisasi saat halaman pertama kali dimuat
            document.querySelectorAll('[name^="penulis_type_"]').forEach(radio => {
                const id = radio.name.replace('penulis_type_', '');
                togglepenulisInput(id);
            });

            document.querySelectorAll('[name^="tipe_penulis_"]').forEach(radio => {
                const id = radio.name.replace('tipe_penulis_', '');
                toggleAnggotaLainnya(id);
            });
        });
    </script>
    {{-- penulis korespondensi dan angota update --}}
    <script>
        function togglePenulisKorespondensiInput(event) {
            // Elemen input radio yang dipilih
            const selectedRadio = event.target;

            // Ambil ID unik berdasarkan atribut data-id
            const id = selectedRadio.dataset.id;

            // Cek apakah opsi yang dipilih adalah 'Dosen'
            const isDosen = selectedRadio.value === 'dosen';

            // Tampilkan input dosen, sembunyikan input non-dosen
            const dosenInput = document.getElementById(`dosenInput1_${id}`);
            const nonDosenInput = document.getElementById(`nonDosenInput1_${id}`);

            if (dosenInput && nonDosenInput) {
                dosenInput.style.display = isDosen ? 'block' : 'none';
                nonDosenInput.style.display = isDosen ? 'none' : 'block';
            } else {
                console.error(`Elemen dengan ID dosenInput1_${id} atau nonDosenInput1_${id} tidak ditemukan.`);
            }
        }

        function toggleAnggotaLainnya(id) {
            // Ambil elemen radio yang sedang dipilih berdasarkan ID dinamis
            const isBersamaMahasiswa = document.getElementById(`penulisYes_${id}`).checked;

            // Elemen yang akan ditampilkan/disebunyikan
            const anggotaLainnyaContainer = document.getElementById(`anggotaLainnyaContainer_${id}`);
            const anggotaPenulisSelect = document.getElementById(`anggota_penulis_${id}`);

            if (anggotaLainnyaContainer && anggotaPenulisSelect) {
                // Tampilkan atau sembunyikan inputan tambahan
                anggotaLainnyaContainer.style.display = isBersamaMahasiswa ? 'block' : 'none';

                // Toggle disabled state untuk select
                anggotaPenulisSelect.disabled = isBersamaMahasiswa;
            } else {
                console.error(`Elemen dengan ID anggotaLainnyaContainer_${id} atau anggota_penulis_${id} tidak ditemukan.`);
            }
        }
    </script>
    {{-- close penulis korespondensi dan anggota update --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#anggota_penulis').selectpicker();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#penulis_korespondensi').selectpicker();
        });
    </script>

    <script>
        window.deleteConfirm = function(e) {
            e.preventDefault(); // Mencegah pengiriman form

            var form = $(e.target).closest('form'); // Mengambil form terkait dan membungkusnya dengan jQuery

            Swal.fire({
                title: "Apakah Kamu yakin ?",
                text: "Penelitian ini akan kamu hapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
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
                                text: 'Penelitian Telah Berhasil dihapus.',
                                icon: 'success',
                                confirmButtonText: 'OKE'
                            })
                        },
                        error: function(xhr) {
                            // Tangani kesalahan
                            Swal.fire({
                                title: 'Error!',
                                text: 'Ada error nih, penelitian tidak bisa di hapus.',
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
        document.addEventListener("DOMContentLoaded", function() {
            const maxWords = 260;
            const textarea = document.getElementById('limitedTextarea');
            const wordCountDisplay = document.getElementById('wordCount');

            function updateWordCount() {
                // Pisahkan teks menjadi array kata
                let words = textarea.value.trim().split(/\s+/);
                let wordCount = words.filter(word => word).length;

                // Jika jumlah kata melebihi batas
                if (wordCount > maxWords) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Batas Terlampaui',
                        text: 'Abstrak tidak boleh lebih dari 260 kata!',
                        confirmButtonText: 'OK'
                    });

                    // Potong teks pada batas maksimum kata
                    words = words.slice(0, maxWords);
                    textarea.value = words.join(" ");
                    wordCount = maxWords;
                }

                // Update tampilan jumlah kata
                wordCountDisplay.textContent = `${wordCount}/${maxWords} kata`;
            }

            // Hitung kata awal jika ada teks bawaan saat halaman dimuat
            updateWordCount();

            // Hitung kata saat pengguna mengetik di textarea
            textarea.addEventListener('input', updateWordCount);

            // Cegah input tambahan setelah batas tercapai
            textarea.addEventListener('keydown', function(e) {
                let words = textarea.value.trim().split(/\s+/);
                if (words.filter(word => word).length >= maxWords && e.key !== "Backspace" && e.key !==
                    "Delete") {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Batas Terlampaui',
                        text: 'Abstrak tidak boleh lebih dari 260 kata!',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        function toggleTextarea() {
            var mahasiswaYa = document.getElementById('mahasiswa_ya');
            var textareaField = document.getElementById('nama_mahasiswa_field');

            if (mahasiswaYa.checked) {
                textareaField.style.display = "block";
            } else {
                textareaField.style.display = "none";
            }
        }

        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah submit default

                // Buat form data
                var formData = new FormData(this);
                Swal.fire({
                    title: 'Simpan Data?',
                    text: "Apakah Anda yakin ingin simpan data penelitian ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/k-kbk/penelitian/store',
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
        document.addEventListener("DOMContentLoaded", function() {
            const maxWords = 260;

            @foreach ($penelitians as $p)
                const textarea{{ $p->id }} = document.getElementById('limitedTextarea{{ $p->id }}');
                const wordCountDisplay{{ $p->id }} = document.getElementById(
                    'wordCount{{ $p->id }}');

                function updateWordCount{{ $p->id }}() {
                    // Pisahkan teks menjadi array kata
                    let words = textarea{{ $p->id }}.value.trim().split(/\s+/);
                    let wordCount = words.filter(word => word).length;

                    // Jika jumlah kata melebihi batas
                    if (wordCount > maxWords) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Batas Terlampaui',
                            text: 'Abstrak tidak boleh lebih dari 260 kata!',
                            confirmButtonText: 'OK'
                        });

                        // Potong teks pada batas maksimum kata
                        words = words.slice(0, maxWords);
                        textarea{{ $p->id }}.value = words.join(" ");
                        wordCount = maxWords;
                    }

                    // Update tampilan jumlah kata
                    wordCountDisplay{{ $p->id }}.textContent = `${wordCount}/${maxWords} kata`;
                }

                // Hitung kata awal saat halaman dimuat
                updateWordCount{{ $p->id }}();

                // Hitung kata saat pengguna mengetik di textarea
                textarea{{ $p->id }}.addEventListener('input', updateWordCount{{ $p->id }});

                // Tambahkan event untuk mencegah input tambahan saat mencapai batas
                textarea{{ $p->id }}.addEventListener('keydown', function(e) {
                    let words = textarea{{ $p->id }}.value.trim().split(/\s+/);
                    if (words.filter(word => word).length >= maxWords && e.key !== "Backspace" && e.key !==
                        "Delete") {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Batas Terlampaui',
                            text: 'Abstrak tidak boleh lebih dari 260 kata!',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            @endforeach
        });
        $(document).ready(function() {
            @foreach ($penelitians as $p)
                $('#editForm_{{ $p->id }}').on('submit', function(e) {
                    e.preventDefault(); // Mencegah submit default

                    // Buat form data
                    var formData = new FormData(this);
                    Swal.fire({
                        title: 'Simpan Data?',
                        text: "Apakah Anda yakin ingin simpan data penelitian ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/k-kbk/penelitian/update/{{ $p->id }}',
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
            @endforeach
        });
    </script>

</body>

</html>

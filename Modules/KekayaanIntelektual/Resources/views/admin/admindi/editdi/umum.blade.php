<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Paten | Edit</title>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
</head>

<body>
    {{-- Top nav bar --}}
    <div class="container-fluid border">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img class="navbar-brand" src={{ asset('assets/polindra2.jpg') }}>
                <a class="navbar-brand fs-6 fw-normal font-family-Kokoro brand-text-responsive" href="#">
                    <span class="d-inline d-md-none">SIKI POLINDRA</span>
                    <span class="d-none d-md-inline">Sistem Informasi Kekayaan
                        Intelektual<br>Politeknik Negeri Indramayu</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Selamat datang, {{ auth()->user()->nama_lengkap }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/logout"><i class="bi bi-arrow-bar-left me-2"></i>Log
                                        Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    {{-- end of top naavbar --}}
    <div class="container-fluid">
        <div class="row">
            {{-- Side bar --}}
            @include('admin.layout.sidenav')
            {{-- end of sidebar --}}
            <div class="col-12 col-lg-10 mt-2">
                <div class="container bg-light rounded border pt-3">
                    <h3 class="fw-normal font-family-Kokoro mb-3">
                        <i class="bi bi-file-earmark me-2"></i>Data Hak Cipta {{ $di->nama_lengkap }}
                    </h3>
                    <hr class="border border-black border-2 opacity-75">
                    <form enctype="multipart/form-data" method="post"
                        action={{ route('adm.update-di.umum', $di->id) }} id="uploadForm">
                        @csrf
                        <p class="fs-4 fw-normal font-family-Kokoro">I. IDENTITAS</p>
                        <div class="container">
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap"
                                    placeholder="Masukkan Nama"name="nama_lengkap" value="{{ $di->nama_lengkap }}">
                                {{-- @error('nama_lengkap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat"
                                    name="alamat" value="{{ $di->alamat }}">
                                {{-- @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No telepon</label>
                                <input type="number" class="form-control " id="no_telepon"
                                    placeholder="Masukkan No telepon" name="no_telepon" value="{{ $di->no_telepon }}">
                                {{-- @error('no_telepon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahie" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $di->tanggal_lahir }}">
                                {{-- @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="ktp" class="form-label">KTP Inventor</label>
                                <input type="file" class="form-control" id="ktp" name="ktp_inventor">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                    dari 2mb</span>
                                {{-- @error('ktp_inventor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control " id="email" placeholder="Masukkan Email"
                                    name="email" value="{{ $di->email }}">
                                {{-- @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="warga" class="form-label">Kewarganegaraan</label>
                                <input type="text" class="form-control" id="warga"
                                    placeholder="Masukkan Kewarganegaraan" name="kewarganegaraan" value="{{ $di->kewarganegaraan }}"
                                    >
                                {{-- @error('kewarganegaraan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="pos" class="form-label">Kode Pos</label>
                                <input type="number" class="form-control" id="pos"
                                    placeholder="Masukkan Kode Pos" name="kode_pos" value="{{ $di->kode_pos }}">
                                {{-- @error('kode_pos')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <input type="text" class="form-control @error('institusi') is-invalid @enderror"
                                id="" value="Umum" name="institusi" hidden>
                        </div>

                        <p class="fs-4 fw-normal font-family-Kokoro mt-5">II. FORMULIR DESAIN INDUSTRI</p>
                        <div class="container">
                            <label for="" class="form-label">Jenis Desain</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_di" id="satu_desain"
                                    value="Satu desain">
                                <label class="form-check-label" for="Satu desain" id="satu_desain">
                                    Satu Desain
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_di" id="p_satu_desain"
                                    value="Pecahan satu desain">
                                <label class="form-check-label" for="Pecahan satu desain" id="p_satu_desain">
                                    Pecahan Satu Desain
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_di" id="satu_kesatuan"
                                    value="Satu kesatuan desain">
                                <label class="form-check-label" for="Satu kesatuan desain" id="satu_kesatuan">
                                    Satu Kesatuan Desain
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_di" id="kesatuan_pecahan"
                                    value="Kesatuan pecahan satu desain">
                                <label class="form-check-label" for="Kesatuan pecahan satu desain"
                                    id="kesatuan_pecahan">
                                    Kesatuan Pecahan Satu Desain
                                </label>
                            </div>
                            <div class="mb-3">
                                <label for="judul_desain" class="form-label">Judul Desain Industri</label>
                                <input type="text" class="form-control"
                                    placeholder="Masukkan Judul Desain Industri" name="judul_di" id="judul_desain" value="{{ $di->judul_di }}">
                                {{-- @error('judul_di')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="gambar_desain" class="form-label">Gambar Desain Industri</label>
                                <input type="file" class="form-control" placeholder="" name="gambar_di"
                                    id="gambar_desain">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih dari
                                    2mb</span>
                                {{-- @error('gambar_di')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="uraian_desain" class="form-label">Uraian Desain Industri</label>
                                <input type="file" class="form-control" placeholder="" name="uraian_di"
                                    id="uraian_desain">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih dari
                                    2mb</span>
                                {{-- @error('uraian_di')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="pernyataan_kepemilikan" class="form-label">Surat Pernyataan
                                    Kepemilikan</label>
                                <input type="file" class="form-control" placeholder="" name="surat_kepemilikan"
                                    id="pernyataan_kepemilikan">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih dari
                                    2mb</span>
                                {{-- @error('surat_kepemilikan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="pengalihan" class="form-label">Surat Pengalihan Hak</label>
                                <input type="file" class="form-control" placeholder="" name="surat_pengalihan"
                                    id="pengalihan" value="{{ $di->surat_pengalihan }}">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih dari
                                    2mb</span>
                                {{-- @error('surat_pengalihan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="tanggalpengajuan" class="form-label">Tanggal Pengajuan</label>
                                <input type="date" name="tanggal_permohonan" id="tanggalpengajuan"
                                    class="form-control" value="{{ $di->tanggal_pengajuan }}">
                                @error('tanggal_permohonan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Harap
                                Isi semua Form Dengan Benar</p>
                            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Simpan
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin dengan data yang di inputkan ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger"
                                                data-bs-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-primary">Yakin</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"
            integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous">
        </script>
        <script src="{{ asset('assets-user/js/jquery.min.js') }}"></script>
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
                    var judul_desain = $('#judul_desain').val();
                    var tanggal_pengajuan = $('#tanggalpengajuan').val();
                    var jenis_desain = $('input[name="jenis_di"]:checked').val();
    
                    //file
                    var ktp = $('#ktp')[0].files[0];
                    var gambar_desain = $('#gambar_desain')[0].files[0];
                    var uraian_desain = $('#uraian_desain')[0].files[0];
                    var pernyataan_kepemilikan = $('#pernyataan_kepemilikan')[0].files[0];
                    var pengalihan = $('#pengalihan')[0].files[0];
    
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
                    if (!jenis_desain) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Jenis Desain Anda!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!judul_desain) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Judul Desain Anda!",
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
                    if (!gambar_desain) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Gambar Desain Anda!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!uraian_desain) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Uraian Anda!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    }
                    if (!pernyataan_kepemilikan) {
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
                    if (!pengalihan) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops... Ada yang salah...",
                            text: "Tolong Masukkan Surat Pengalihan hak Anda!",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        return false;
                    } else {
                        var allowedExtension = /(\.pdf)$/i; // Hanya memperbolehkan file berformat PDF
                        var allowedExtensionExel = /(\.xlsx)$/i; // Hanya memperbolehkan file berformat exel
                        var maxSize = 2 * 1024 * 1024; // Maksimal ukuran file adalah 2 MB
    
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
                        if (!allowedExtension.exec(gambar_desain.name)) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Tolong Masukkan Gambar Desain Dengan Ekstensi .pdf!",
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                        if (!allowedExtension.exec(uraian_desain.name)) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Tolong Masukkan Uraian Desain Dengan Ekstensi .pdf!",
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                        if (!allowedExtension.exec(pernyataan_kepemilikan.name)) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Tolong Masukkan Surat Pernyataan Kepemilikan Dengan Ekstensi .pdf!",
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                        if (!allowedExtension.exec(pengalihan.name)) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Tolong Masukkan Surat Pengalihan Hak Dengan Ekstensi .pdf!",
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
                                text: "Ukuran File KTP Lebih Dari 2mb!",
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                        if (gambar_desain.size > maxSize) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Ukuran File Gambar Desain Lebih Dari 2mb!",
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                        if (uraian_desain.size > maxSize) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Ukuran Uraian Desain Lebih Dari 2mb!",
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                        if (pernyataan_kepemilikan.size > maxSize) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Ukuran File Pernyataan Kepemilikan Lebih Dari 2mb!",
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                        if (pengalihan.size > maxSize) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Ukuran File Surat Pengalihan Hak Lebih Dari 2mb!",
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

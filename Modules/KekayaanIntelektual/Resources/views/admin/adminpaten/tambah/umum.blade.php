<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Paten | Pengajuan</title>
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
                        <i class="bi bi-file-earmark-plus me-2"></i>Pengajuan Paten Umum
                    </h3>
                    <hr class="border border-black border-2 opacity-75">
                    <form class="p-2" enctype="multipart/form-data" method="post"
                        action="/admin/paten/tambah/umum/store/" id="uploadForm">
                        @csrf
                        <p class="fs-4 fw-normal font-family-Kokoro">I. IDENTITAS</p>
                        <div class="container">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="user_id">Pilih Pemilik Paten</label>
                                    <select name="user_id" id="user_id" class="form-control" onchange="updateNamaLengkap()">
                                        <option value="" selected disabled>Pilih Nama</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" data-nama="{{ $user->nama_lengkap }}">
                                                {{ $user->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama akan terisi otomatis" readonly>
                                </div>
                                {{-- @error('nama_lengkap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat"
                                    name="alamat" >
                                {{-- @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No telepon</label>
                                <input type="number" class="form-control " id="no_telepon"
                                    placeholder="Masukkan No telepon" name="no_telepon"
                                    >
                                {{-- @error('no_telepon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahie" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                    >
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
                                    dari 10mb</span>
                                {{-- @error('ktp_inventor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control " id="email" placeholder="Masukkan Email"
                                    name="email" >
                                {{-- @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="warga" class="form-label">Kewarganegaraan</label>
                                <input type="text" class="form-control" id="warga"
                                    placeholder="Masukkan Kewarganegaraan" name="kewarganegaraan"
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
                                    placeholder="Masukkan Kode Pos" name="kode_pos" >
                                {{-- @error('kode_pos')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <input type="text" class="form-control @error('institusi') is-invalid @enderror"
                                id="" value="Umum" name="institusi" hidden>
                        </div>
                        <p class="fs-4 fw-normal font-family-Kokoro mt-5">II. FORMULIR PATEN</p>
                        <div class="container">
                            <label for="paten" class="form-label">Jenis Paten</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_paten" id="paten"
                                    value="Paten">
                                <label class="form-check-label" for="Paten">
                                    Paten
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_paten" id="paten_s"
                                    value="Paten sederhana">
                                <label class="form-check-label" for="Paten sederhana" for="paten_s">
                                    Paten Sederhana
                                </label>
                            </div>
                            <div class="mb-3">
                                <label for="judul_paten" class="form-label">Judul Paten</label>
                                <input type="text" class="form-control" id="judul_paten"
                                    placeholder="Masukkan Judul Paten" name="judul_paten"
                                    >
                                {{-- @error('judul_paten')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="abstrak" class="form-label">Abstrak Paten</label>
                                <input type="file" class="form-control" id="abstrak" placeholder=""
                                    name="abstrak_paten">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                    dari 10mb</span>
                                {{-- @error('abstrak_paten')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Paten</label>
                                <input type="file" class="form-control " id="deskripsi" placeholder=""
                                    name="deskripsi_paten">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                    dari 10mb</span>
                                {{-- @error('deskripsi_paten')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="pengalihan_hak" class="form-label">Pengalihan Hak Invensi</label>
                                <input type="file" class="form-control " id="pengalihan_hak" placeholder=""
                                    name="pengalihan_hak">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                    dari 10mb</span>
                                {{-- @error('pengalihan_hak')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="klaim" class="form-label">Klaim</label>
                                <input type="file" class="form-control " id="klaim" placeholder=""
                                    name="klaim">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                    dari 10mb</span>
                                {{-- @error('klaim')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="kepemilikan" class="form-label">Pernyataan kepemikikan
                                    Inventor</label>
                                <input type="file" class="form-control" id="kepemilikan" placeholder=""
                                    name="pernyataan_kepemilikan">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                    dari 10mb</span>
                                {{-- @error('pernyataan_kepemilikan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="kuasa" class="form-label">Surat kuasa</label>
                                <input type="file" class="form-control " id="kuasa" placeholder=""
                                    name="surat_kuasa">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                    dari 10mb</span>
                                {{-- @error('surat_kuasa')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="g_paten" class="form-label">gambar Paten</label>
                                <input type="file" class="form-control " id="g_paten" placeholder=""
                                    name="gambar_paten">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                    dari 10mb</span>
                                {{-- @error('gambar_paten')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="g_tampilan" class="form-label">gambar Tampilan</label>
                                <input type="file" class="form-control " id="g_tampilan" placeholder=""
                                    name="gambar_tampilan">
                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                    dari 10mb</span>
                                {{-- @error('gambar_tampilan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="tanggalpengajuan" class="form-label">Tanggal Pengajuan</label>
                                <input type="date" name="tanggal_permohonan" id="tanggalpengajuan"
                                    class="form-control ">
                                {{-- @error('tanggal_permohonan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Harap
                                Isi semua Form Dengan
                                Benar</p>
                            {{-- <button type="submit" class="btn btn-primary mt-3 ">Submit</button> --}}
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
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
            function updateNamaLengkap() {
                var select = document.getElementById("user_id");
                var selectedOption = select.options[select.selectedIndex];
                var namaLengkap = selectedOption.getAttribute("data-nama");
        
                document.getElementById("nama_lengkap").value = namaLengkap;
            }
        </script>
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
                        if (!allowedExtension.exec(g_paten.name)) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Tolong Masukkan Gambar Paten Paten Dengan Ekstensi .pdf!",
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2500
                            });
                            return false;
                        }
                        if (!allowedExtension.exec(g_tampilan.name)) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops... Ada yang salah...",
                                text: "Tolong Masukkan Gambar Tampilan Paten Dengan Ekstensi .pdf!",
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

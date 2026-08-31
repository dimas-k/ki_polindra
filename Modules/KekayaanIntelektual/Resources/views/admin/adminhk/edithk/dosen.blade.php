<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    {{-- <script src="../assets/js/color-modes.js"></script> --}}

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
                        <i class="bi bi-file-earmark me-2"></i>Data Hak Cipta {{ $hk->nama_lengkap }}
                    </h3>
                    <hr class="border border-black border-2 opacity-75">
                    <form enctype="multipart/form-data" method="post"
                        action={{ route('admin_hakcipta.update_dosen', $hk->id) }} id="uploadForm">
                        @csrf
                        <p class="fs-4 fw-normal font-family-Kokoro">I. IDENTITAS</p>
                        <div class="container">
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control " id="nama_lengkap"
                                    placeholder="Masukkan Nama"name="nama_lengkap" value="{{ $hk->nama_lengkap }}" readonly>
                                {{-- @error('nama_lengkap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control " id="alamat" placeholder="Masukkan Alamat"
                                    name="alamat" value="{{ $hk->alamat }}">
                                {{-- @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No telepon</label>
                                <input type="number" class="form-control" id="no_telepon"
                                    placeholder="Masukkan No telepon" name="no_telepon" value="{{ $hk->no_telepon }}">
                                {{-- @error('no_telepon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control "
                                    value="{{ $hk->tanggal_lahir }}">
                                {{-- @error('tanggal_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="ktp" class="form-label">KTP Inventor</label><br>
                                @if (!empty($hk->ktp_inventor))
                                    File : {{ basename($hk->ktp_inventor) }}
                                @else
                                    File : Tidak ada
                                @endif
                                <input type="file" class="form-control " id="ktp" name="ktp_inventor">

                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>masukan file jika ada perubahan</span>
                                {{-- @error('ktp_inventor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control " id="email" placeholder="Masukkan Email"
                                    name="email" value="{{ $hk->email }}">
                                {{-- @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="warga" class="form-label">Kewarganegaraan</label>
                                <input type="text" class="form-control " id="warga"
                                    placeholder="Masukkan Kewarganegaraan" name="kewarganegaraan"
                                    value="{{ $hk->kewarganegaraan }}">
                                {{-- @error('kewarganegaraan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="pos" class="form-label">Kode Pos</label>
                                <input type="number" class="form-control " id="pos"
                                    placeholder="Masukkan Kode Pos" name="kode_pos" value="{{ $hk->kode_pos }}">
                                {{-- @error('kode_pos')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <input type="text" class="form-control " id="" value="Dosen"
                                name="institusi" hidden>
                            <div class="mb-3">

                                <label for="data_pengaju2" class="form-label">Data Mahasiswa / Dosen <span
                                        class="text-danger">(masukan file jika ada perubahan)</span></label><br>
                                @if (!empty($hk->data_pengaju2))
                                    File : {{ basename($hk->data_pengaju2) }}
                                @else
                                    File : Tidak ada
                                @endif
                                <input type="file"
                                    class="form-control @error('data_pengaju2') is-invalid @enderror"
                                    name="data_pengaju2" id="data_pengaju2">

                                <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>File harus bertipe .xlsx</span>
                                {{-- @error('data_pengaju2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                {{-- @include('admin.layout.jurusan') --}}
                                <tr>
                                    <th>jurusan</th>
                                    <td>
                                        <select class="form-select" aria-label="Default select example"
                                            name="jurusan" id="jurusan">
                <option value="">Pilih Jurusan</option>
                @foreach($jurusanOptions as $j)
                    <option value="{{ $j->nama_jurusan }}" {{ old('jurusan', $hk->jurusan) == $j->nama_jurusan ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                @endforeach
            </select>
                                    </td>
                                </tr>
                                {{-- @error('jurusan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                {{-- @include('admin.layout.prodi') --}}
                                <tr>
                                    <th>prodi</th>
                                    <td>
                                        <select class="form-select" aria-label="Default select example"
                                            name="prodi" id="prodi">
                <option value="">Pilih Prodi</option>
                @foreach($prodiOptions as $pr)
                    <option value="{{ $pr->nama_prodi }}" {{ old('prodi', $hk->prodi) == $pr->nama_prodi ? 'selected' : '' }}>{{ $pr->nama_prodi }}</option>
                @endforeach
            </select>
                                    </td>
                                </tr>
                                {{-- @error('prodi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                        </div>
                        <p class="fs-4 fw-normal font-family-Kokoro mt-5">II. FORMULIR HAK CIPTA</p>
                        <div class="container">
                            <div class="mb-3">
                                {{-- @include('admin.layout.jenis-ciptaan') --}}
                                <tr>
                                    <th>Jenis Ciptaan</th>
                                    <td>
                                        <label for="jenis_ciptaan" class="form-label">Jenis Ciptaan</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="jenis_ciptaan" id="jenis_ciptaan">
                                            <option value="">Pilih Jenis Hak Cipta</option>
                                            <option value="Karya Tulis"
                                                {{ old('jenis_ciptaan', $hk->jenis_ciptaan) == 'Karya Tulis' ? 'selected' : '' }}>
                                                Karya Tulis</option>
                                            <option value="Program Komputer"
                                                {{ old('jenis_ciptaan', $hk->jenis_ciptaan) == 'Program Komputer' ? 'selected' : '' }}>
                                                Program Komputer</option>
                                            <option value="Karya Lainnya"
                                                {{ old('jenis_ciptaan', $hk->jenis_ciptaan) == 'Karya Lainnya' ? 'selected' : '' }}>
                                                Karya Lainnya</option>
                                        </select>
                                    </td>
                                </tr>
                                {{-- @error('jenis_ciptaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="judul_ciptaan" class="form-label">Judul Ciptaan</label>
                                <input type="text"
                                    class="form-control @error('judul_ciptaan') is-invalid @enderror"
                                    placeholder="Masukkan Judul Ciptaan" name="judul_ciptaan" id="judul_ciptaan"
                                    value="{{ $hk->judul_ciptaan }}">
                                {{-- @error('judul_ciptaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="uraian" class="form-label">Uraian Singkat Ciptaan</label>
                                <textarea class="form-control " placeholder="Masukkan Uraian Singkat" name="uraian_singkat" id="uraian"
                                    style="height: 150px">{{ $hk->uraian_singkat }}</textarea>
                                {{-- @error('uarian_singkat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="invensi" class="form-label">Dokumen Invensi (Manual
                                    Book/Buku/Dll)</label><br>
                                @if (!empty($hk->dokumen_invensi))
                                    File : {{ basename($hk->dokumen_invensi) }}
                                @else
                                    File : Tidak ada
                                @endif

                                <input type="file" class="form-control " placeholder="" name="dokumen_invensi"
                                    id="invensi">
                                    <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>masukan file jika ada perubahan</span>
                                {{-- @error('dokumen_invensi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">

                                <label class="form-label" for="surat_pengalihan">Surat Pengalihan Hak
                                    Cipta</label><br>
                                @if (!empty($hk->surat_pengalihan))
                                    File : {{ basename($hk->surat_pengalihan) }}
                                @else
                                    File : Tidak ada
                                @endif
                                <input type="file" class="form-control " placeholder="" name="surat_pengalihan"
                                    id="surat_pengalihan">
                                    <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>masukan file jika ada perubahan</span>
                                {{-- @error('surat_pengalihan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">

                                <label for="pernyataan" class="form-label">Surat Pernyataan</label><br>
                                @if (!empty($hk->surat_pernyataan))
                                    File : {{ basename($hk->surat_pernyataan) }}
                                @else
                                    File : Tidak ada
                                @endif
                                <input type="file" id="pernyataan" class="form-control " placeholder=""
                                    name="surat_pernyataan">
                                    <span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"
                                        data-bs-toggle="tooltip"></i>masukan file jika ada perubahan</span>
                                {{-- @error('surat_pernyataan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="tanggalpengajuan" class="form-label">Tanggal Pengajuan</label>
                                <input type="date" name="tanggal_permohonan" id="tanggalpengajuan"
                                    class="form-control" value="{{ $hk->tanggal_permohonan }}">
                                {{-- @error('tanggal_permohonan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Harap
                                Isi semua Form Dengan
                                Benar</p>
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
        {{-- <script>
            $(document).ready(function() {
                $('#uploadForm').submit(function(e) {
                    e.preventDefault(); // Prevent form from submitting automatically

                    // Non-file inputs
                    var fields = {
                        nama: $('#nama_lengkap').val(),
                        alamat: $('#alamat').val(),
                        telepon: $('#no_telepon').val(),
                        tl: $('#tanggal_lahir').val(),
                        email: $('#email').val(),
                        warga: $('#warga').val(),
                        pos: $('#pos').val(),
                        jurusan: $('#jurusan').val(),
                        prodi: $('#prodi').val(),
                        jenis_ciptaan: $('#jenis_ciptaan').val(),
                        judul_ciptaan: $('#judul_ciptaan').val(),
                        uraian: $('#uraian').val(),
                        tanggal_pengajuan: $('#tanggalpengajuan').val()
                    };

                    // File inputs
                    var files = {
                        ktp: $('#ktp')[0].files[0],
                        anggota_inventor: $('#data_pengaju2')[0].files[0],
                        dokumen_invensi: $('#invensi')[0].files[0],
                        surat_pengalihan: $('#surat_pengalihan')[0].files[0],
                        pernyataan: $('#pernyataan')[0].files[0]
                    };

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

                    if (!fields.jenis_ciptaan) {
                        showError("Tolong Masukkan Jenis Desain Anda!");
                        return false;
                    }

                    // Validate file inputs
                    var allowedExtension = /(\.pdf)$/i;
                    var allowedExtensionExcel = /(\.xlsx)$/i;
                    var maxSize = 10 * 1024 * 1024; // 2 MB

                    for (var file in files) {
                        if (!files[file]) {
                            showError("Tolong Masukkan " + file.replace('_', ' ').toUpperCase() + " Anda!");
                            return false;
                        }

                        // Validate file extension
                        if (['ktp', 'dokumen_invensi', 'surat_pengalihan', 'pernyataan'].includes(file)) {
                            if (!allowedExtension.exec(files[file].name)) {
                                showError("Tolong Masukkan " + file.replace('_', ' ').toUpperCase() +
                                    " Dengan Ekstensi .pdf!");
                                return false;
                            }
                        } else if (file === 'anggota_inventor') {
                            if (!allowedExtensionExcel.exec(files[file].name)) {
                                showError("Tolong Masukkan Data Pengaju Dengan Ekstensi .xlsx!");
                                return false;
                            }
                        }

                        // Validate file size
                        if (files[file].size > maxSize) {
                            showError("Ukuran File " + file.replace('_', ' ').toUpperCase() +
                                " Lebih Dari 10 MB!");
                            return false;
                        }
                    }

                    // If validation passes, submit the form
                    this.submit();
                });
            });
        </script> --}}
    </div>
</body>


</html>

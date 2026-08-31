<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Desain Industri | Edit</title>
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
                        action={{ route('adm.update-di.dosen', $di->id) }} id="uploadForm">
                        @csrf
                        <p class="fs-4 fw-normal font-family-Kokoro">I. IDENTITAS</p>
                        <div class="container">
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap"
                                    placeholder="Masukkan Nama"name="nama_lengkap" value="{{ $di->nama_lengkap }}"
                                    readonly>
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
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                    value="{{ $di->tanggal_lahir }}">
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
                                    placeholder="Masukkan Kewarganegaraan" name="kewarganegaraan"
                                    value="{{ $di->kewarganegaraan }}">
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
                                id="" value="Dosen" name="institusi" hidden>
                            <div class="mb-3">
                                <label for="data_pengaju2" class="form-label">Data Mahasiswa / Dosen <span
                                        class="text-danger">(Jika Bersama Dosen Yang Lain dan atau Bersama
                                        Mahasiswa Harap diisi)</span></label>
                                <input type="file" class="form-control " name="data_pengaju2" id="data_pengaju2">
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
                    <option value="{{ $j->nama_jurusan }}" {{ old('jurusan', $di->jurusan) == $j->nama_jurusan ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
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
                    <option value="{{ $pr->nama_prodi }}" {{ old('prodi', $di->prodi) == $pr->nama_prodi ? 'selected' : '' }}>{{ $pr->nama_prodi }}</option>
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
                        <p class="fs-4 fw-normal font-family-Kokoro mt-5">II. FORMULIR DESAIN INDUSTRI</p>
                        <div class="container">
                            <label for="" class="form-label">Jenis Desain</label>
                            <div class="form-check">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_di"
                                                value="Satu Desain" id="satu_desain"
                                                {{ old('jenis_di', $di->jenis_di) == 'Satu Desain' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="satu_desain">Satu Desain</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_di"
                                                value="Pecahan Satu Desain" id="pecahan_satu_desain"
                                                {{ old('jenis_di', $di->jenis_di) == 'Pecahan Satu Desain' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pecahan_satu_desain">Pecahan Satu
                                                Desain</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_di"
                                                value="Satu Kesatuan Desain" id="satu_kesatuan_desain"
                                                {{ old('jenis_di', $di->jenis_di) == 'Satu Kesatuan Desain' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="satu_kesatuan_desain">Satu Kesatuan
                                                Desain</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_di"
                                                value="Kesatuan Pecahan Satu Desain" id="kesatuan_pecahan_satu_desain"
                                                {{ old('jenis_di', $di->jenis_di) == 'Kesatuan Pecahan Satu Desain' ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="kesatuan_pecahan_satu_desain">Kesatuan Pecahan Satu Desain</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="judul_desain" class="form-label">Judul Desain Industri</label>
                                <input type="text" class="form-control"
                                    placeholder="Masukkan Judul Desain Industri" name="judul_di" id="judul_desain"
                                    value="{{ $di->judul_di }}">
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
                                    10mb</span>
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
                                    10mb</span>
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
                                    10mb</span>
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
                                    10mb</span>
                                {{-- @error('surat_pengalihan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="tanggalpengajuan" class="form-label">Tanggal Pengajuan</label>
                                <input type="date" name="tanggal_permohonan" id="tanggalpengajuan"
                                    class="form-control" value="{{ $di->tanggal_permohonan }}">

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
                    e.preventDefault(); // Mencegah submit otomatis

                    // Validasi input non-file
                    const fields = {
                        nama_lengkap: $('#nama_lengkap').val(),
                        alamat: $('#alamat').val(),
                        no_telepon: $('#no_telepon').val(),
                        tanggal_lahir: $('#tanggal_lahir').val(),
                        email: $('#email').val(),
                        kewarganegaraan: $('#warga').val(),
                        kode_pos: $('#pos').val(),
                        judul_di: $('#judul_desain').val(),
                        tanggal_permohonan: $('#tanggalpengajuan').val(),
                        jenis_di: $('input[name="jenis_di"]:checked').val()
                    };

                    // Fungsi untuk menampilkan pesan error menggunakan SweetAlert2
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

                    // Cek semua field non-file harus diisi
                    for (let key in fields) {
                        if (!fields[key]) {
                            showError("Tolong Masukkan " + key.replace('_', ' ').toUpperCase() + " Anda!");
                            return false;
                        }
                    }

                    // Mapping file inputs (sesuai name dan id di Blade)
                    const files = {
                        ktp_inventor: $('#ktp')[0].files[0],
                        data_pengaju2: $('#data_pengaju2')[0].files[0],
                        gambar_di: $('#gambar_desain')[0].files[0],
                        uraian_di: $('#uraian_desain')[0].files[0],
                        surat_kepemilikan: $('#pernyataan_kepemilikan')[0].files[0],
                        surat_pengalihan: $('#pengalihan')[0].files[0]
                    };

                    const maxSize = 10 * 1024 * 1024; // 10MB dalam byte
                    const allowedPDF = ['pdf'];
                    const allowedExcel = ['xls', 'xlsx'];

                    // Field yang seharusnya berformat PDF (jika diupload)
                    const pdfFields = ['ktp_inventor', 'gambar_di', 'uraian_di', 'surat_kepemilikan',
                        'surat_pengalihan'
                    ];
                    // Field untuk file Excel (opsional)
                    const excelFields = ['data_pengaju2'];

                    // Validasi untuk file PDF (hanya jika diupload)
                    for (let key of pdfFields) {
                        let fileData = files[key];
                        if (fileData) {
                            let fileName = fileData.name;
                            let fileExtension = fileName.split('.').pop().toLowerCase();
                            if (!allowedPDF.includes(fileExtension)) {
                                showError("Tolong Masukkan " + key.replace('_', ' ').toUpperCase() +
                                    " Dalam Format PDF!");
                                return false;
                            }
                            if (fileData.size > maxSize) {
                                showError("Ukuran File " + key.replace('_', ' ').toUpperCase() +
                                    " Melebihi 10MB!");
                                return false;
                            }
                        }
                    }

                    // Validasi untuk file Excel (hanya jika diupload)
                    for (let key of excelFields) {
                        let fileData = files[key];
                        if (fileData) {
                            let fileName = fileData.name;
                            let fileExtension = fileName.split('.').pop().toLowerCase();
                            if (!allowedExcel.includes(fileExtension)) {
                                showError("Tolong Masukkan " + key.replace('_', ' ').toUpperCase() +
                                    " Dalam Format Excel (.xls/.xlsx)!");
                                return false;
                            }
                            if (fileData.size > maxSize) {
                                showError("Ukuran File " + key.replace('_', ' ').toUpperCase() +
                                    " Melebihi 10MB!");
                                return false;
                            }
                        }
                    }

                    // Jika semua validasi lolos, submit form
                    this.submit();
                });
            });
        </script>



</body>

</html>

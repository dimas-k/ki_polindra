<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dosen/paten">Paten</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengajuan</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-2 -->
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-wpforms me-2" data-bs-toggle="tooltip">
                                Formulir
                                Pengajuan Paten
                            </i>
                            </h3>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Periksa kembali isian Anda:</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <span class="d-flex justify-content-end">
                                <a href="https://drive.google.com/drive/folders/19w54Oc_sAmZakE1NNBt5GD3Yg-qEa7XO?usp=drive_link"
                                    target="_blank" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fw-bolder"><b><i class="bi bi-download me-1 fw-bolder"></i></b>Berkas Yang
                                    Di
                                    Perlukan
                                </a>
                            </span>
                            <form class="p-2" enctype="multipart/form-data" method="post"
                                action="/dosen/pengajuan/paten/simpan" id="uploadForm">
                                @csrf
                                <p class="fs-4 fw-normal font-family-Kokoro">I. IDENTITAS</p>
                                <div class="container">
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}"
                                            class="form-control @error('nama_lengkap') is-invalid @enderror"
                                            id="nama_lengkap" placeholder="Masukkan Nama" name="nama_lengkap" required>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" placeholder="Masukkan Alamat" name="alamat"
                                            value="{{ old('alamat', auth()->user()->alamat) }}" required>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_telepon" class="form-label">No telepon</label>
                                        <input type="number"
                                            class="form-control @error('no_telepon') is-invalid @enderror"
                                            id="no_telepon" placeholder="Masukkan No telepon" name="no_telepon"
                                            value="{{ old('no_telepon', auth()->user()->no_telepon) }}" required>
                                        @error('no_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            value="{{ old('tanggal_lahir') }}" required>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="ktp" class="form-label">KTP Inventor</label>
                                        <input type="file"
                                            class="form-control @error('ktp_inventor') is-invalid @enderror"
                                            id="ktp" name="ktp_inventor" accept="application/pdf" required>
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                            dari 2mb</span>
                                        @error('ktp_inventor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" placeholder="Masukkan Email" name="email"
                                            value="{{ old('email', auth()->user()->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="warga" class="form-label">Kewarganegaraan</label>
                                        <input type="text"
                                            class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                            id="warga" placeholder="Masukkan Kewarganegaraan"
                                            name="kewarganegaraan" value="{{ old('kewarganegaraan') }}" required>
                                        @error('kewarganegaraan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pos" class="form-label">Kode Pos</label>
                                        <input type="number"
                                            class="form-control @error('kode_pos') is-invalid @enderror"
                                            id="pos" placeholder="Masukkan Kode Pos" name="kode_pos"
                                            value="{{ old('kode_pos') }}" required>
                                        @error('kode_pos')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="text"
                                        class="form-control @error('institusi') is-invalid @enderror" id=""
                                        value="Dosen" name="institusi" hidden>
                                    <div class="mb-3">
                                        <label for="data_pengaju2" class="form-label">Data Mahasiswa / Dosen <span
                                                class="text-danger">(Jika Bersama Dosen Yang Lain dan atau Bersama
                                                Mahasiswa Harap diisi)</span></label>
                                        <input type="file"
                                            class="form-control @error('data_pengaju2') is-invalid @enderror"
                                            name="data_pengaju2" id="data_pengaju2" accept=".xlsx">
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .xlsx</span>
                                        @error('data_pengaju2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        @include('dosen.layout.jurusan')
                                        @error('jurusan')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        @include('dosen.layout.prodi')
                                        @error('prodi')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br><br>
                                <p class="fs-4 fw-normal font-family-Kokoro mt-5">II. FORMULIR PATEN</p>
                                <div class="container">
                                    <label for="paten" class="form-label">Jenis Paten</label>
                                    <div class="form-check">
                                        <input class="form-check-input @error('jenis_paten') is-invalid @enderror"
                                            type="radio" name="jenis_paten"
                                            id="paten" value="Paten" {{ old('jenis_paten') == 'Paten' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="paten">
                                            Paten
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('jenis_paten') is-invalid @enderror"
                                            type="radio" name="jenis_paten"
                                            id="paten_s" value="Paten Sederhana" {{ old('jenis_paten') == 'Paten Sederhana' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="paten_s">
                                            Paten Sederhana
                                        </label>
                                    </div>
                                    @error('jenis_paten')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div class="mb-3">
                                        <label for="judul_paten" class="form-label">Judul Paten</label>
                                        <input type="text"
                                            class="form-control @error('judul_paten') is-invalid @enderror"
                                            id="judul_paten" placeholder="Masukkan Judul Paten" name="judul_paten"
                                            value="{{ old('judul_paten') }}" required>
                                        @error('judul_paten')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="abstrak" class="form-label">Abstrak Paten</label>
                                        <input type="file"
                                            class="form-control @error('abstrak_paten') is-invalid @enderror"
                                            id="abstrak" name="abstrak_paten" accept="application/pdf" required>
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                            dari 2mb</span>
                                        @error('abstrak_paten')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi Paten</label>
                                        <input type="file"
                                            class="form-control @error('deskripsi_paten') is-invalid @enderror"
                                            id="deskripsi" name="deskripsi_paten" accept="application/pdf" required>
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                            dari 2mb</span>
                                        @error('deskripsi_paten')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="pengalihan_hak" class="form-label">Pengalihan Hak Invensi</label>
                                        <input type="file"
                                            class="form-control @error('pengalihan_hak') is-invalid @enderror"
                                            id="pengalihan_hak" name="pengalihan_hak" accept="application/pdf" required>
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                            dari 2mb</span>
                                        @error('pengalihan_hak')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="klaim" class="form-label">Klaim</label>
                                        <input type="file"
                                            class="form-control @error('klaim') is-invalid @enderror"
                                            id="klaim" name="klaim" accept="application/pdf" required>
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                            dari 2mb</span>
                                        @error('klaim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="kepemilikan" class="form-label">Pernyataan kepemikikan
                                            Inventor</label>
                                        <input type="file"
                                            class="form-control @error('pernyataan_kepemilikan') is-invalid @enderror"
                                            id="kepemilikan" name="pernyataan_kepemilikan" accept="application/pdf" required>
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                            dari 2mb</span>
                                        @error('pernyataan_kepemilikan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="kuasa" class="form-label">Surat kuasa</label>
                                        <input type="file"
                                            class="form-control @error('surat_kuasa') is-invalid @enderror"
                                            id="kuasa" name="surat_kuasa" accept="application/pdf" required>
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                            dari 2mb</span>
                                        @error('surat_kuasa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="g_paten" class="form-label">gambar Paten</label>
                                        <input type="file"
                                            class="form-control @error('gambar_paten') is-invalid @enderror"
                                            id="g_paten" name="gambar_paten" accept="application/pdf" required>
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                            dari 2mb</span>
                                        @error('gambar_paten')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="g_tampilan" class="form-label">gambar Tampilan</label>
                                        <input type="file"
                                            class="form-control @error('gambar_tampilan') is-invalid @enderror"
                                            id="g_tampilan" name="gambar_tampilan" accept="application/pdf" required>
                                        <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih
                                            dari 2mb</span>
                                        @error('gambar_tampilan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggalpengajuan" class="form-label">Tanggal Pengajuan</label>
                                        <input type="date" name="tanggal_permohonan" id="tanggalpengajuan"
                                            class="form-control @error('tanggal_permohonan') is-invalid @enderror"
                                            value="{{ old('tanggal_permohonan') }}" required>
                                        @error('tanggal_permohonan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Harap
                                        Isi semua Form Dengan
                                        Benar</p>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Simpan
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" data-bs-backdrop="static"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('uploadForm').submit()">Yakin</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTAINER END -->
    </div>
</div>
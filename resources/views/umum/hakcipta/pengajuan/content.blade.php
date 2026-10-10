<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Pengajuan Hak Cipta</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/umum/hak-cipta">Hak Cipta</a></li>
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
                            <h3 class="card-title"><i class="fa fa-wpforms me-2"></i>Formulir Pengajuan Hak Cipta</h3>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <span class="d-flex justify-content-end">
                                <a href="https://drive.google.com/drive/folders/1-7Cop9aiCcB8FOl93FAluVu4FpSXONNl?usp=drive_link"
                                    target="_blank" class="link-dark link-underline link-underline-opacity-0"><b><i
                                            class="bi bi-download"></i></b>
                                    <img src={{ asset('assets/downloadicon.png') }} alt="">Berkas Yang Di
                                    Perlukan
                                </a>
                            </span>
                            <form method="post" enctype="multipart/form-data" action="/umum/pengajuan/hak-cipta/simpan" id="uploadForm">
                                @csrf
                                <p class="fs-4 fw-normal font-family-Kokoro">I. IDENTITAS</p>
                                <div class="container">
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control "
                                            id="nama_lengkap" placeholder="Masukkan Nama"name="nama_lengkap" value="{{ auth()->user()->nama_lengkap}}">
                                        {{-- @error('nama_lengkap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control "
                                            id="alamat" placeholder="Masukkan Alamat" name="alamat" value="{{ auth()->user()->alamat }}">
                                        {{-- @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_telepon" class="form-label">No telepon</label>
                                        <input type="number"
                                            class="form-control"
                                            id="no_telepon" placeholder="Masukkan No telepon" name="no_telepon" value="{{ auth()->user()->no_telepon }}">
                                        {{-- @error('no_telepon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                            class="form-control " value="{{ old('tanggal_lahir') }}">
                                        {{-- @error('tanggal_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="ktp" class="form-label">KTP Inventor</label>
                                        <input type="file"
                                            class="form-control "
                                            id="ktp" name="ktp_inventor">
                                            <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih dari 10mb</span>
                                        {{-- @error('ktp_inventor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control "
                                            id="email" placeholder="Masukkan Email" name="email" value="{{ auth()->user()->email }}">
                                        {{-- @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="warga" class="form-label">Kewarganegaraan</label>
                                        <input type="text"
                                            class="form-control "
                                            id="warga" placeholder="Masukkan Kewarganegaraan"
                                            name="kewarganegaraan" value="{{ old('kewarganegaraan') }}">
                                        {{-- @error('kewarganegaraan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="pos" class="form-label">Kode Pos</label>
                                        <input type="number"
                                            class="form-control " id="pos"
                                            placeholder="Masukkan Kode Pos" name="kode_pos" value="{{ old('kode_pos') }}">
                                        {{-- @error('kode_pos')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <input type="text" class="form-control @error('institusi') is-invalid @enderror" id=""
                                            value="Umum" name="institusi" hidden>
                                </div>
                                <p class="fs-4 fw-normal font-family-Kokoro mt-5">II. FORMULIR HAK CIPTA</p>
                                <div class="container">
                                    <div class="mb-3">
                                        @include('umum.layout.jenis-ciptaan')
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
                                            placeholder="Masukkan Judul Ciptaan" name="judul_ciptaan" id="judul_ciptaan" value="{{ old('judul_ciptaan') }}">
                                        {{-- @error('judul_ciptaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="uraian" class="form-label">Uraian Singkat Ciptaan</label>
                                        <textarea class="form-control " placeholder="Masukkan Uraian Singkat"
                                            name="uraian_singkat" id="uraian" style="height: 150px">{{ old('uraian_singkat') }}</textarea>
                                        @error('uarian_singkat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="invensi" class="form-label">Dokumen Invensi (Manual
                                            Book/Buku/Dll)</label>
                                        <input type="file"
                                            class="form-control "
                                            placeholder="" name="dokumen_invensi" id="invensi">
                                            <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih dari 10mb</span>
                                        {{-- @error('dokumen_invensi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
<div class="mb-3">
                                        <label for="gambar_ciptaan" class="form-label">Gambar Ciptaan (opsional, boleh lebih dari 1 file)</label>
                                        <input type="file"
                                            class="form-control "
                                            placeholder="" name="gambar_ciptaan[]" multiple accept=".pdf,.jpg,.jpeg,.png" id="gambar_ciptaan">
                                            <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>Boleh pilih lebih dari 1 file (PDF dan/atau gambar .jpg/.jpeg/.png), tiap file tidak lebih dari 2mb</span>
                                        {{-- @error('gambar_ciptaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label" for="surat_pengalihan">Surat Pengalihan Hak Cipta</label>
                                        <input type="file"
                                            class="form-control "
                                            placeholder="" name="surat_pengalihan" id="surat_pengalihan">
                                            <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih dari 10mb</span>
                                        {{-- @error('surat_pengalihan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="pernyataan" class="form-label">Surat Pernyataan</label>
                                        <input type="file" id="pernyataan"
                                            class="form-control "
                                            placeholder="" name="surat_pernyataan">
                                            <span class="text-danger"><i class="fa fa-warning me-2"
                                                data-bs-toggle="tooltip"></i>File harus bertipe .pdf dan tidak lebih dari 10mb</span>
                                        {{-- @error('surat_pernyataan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggalpengajuan" class="form-label" >Tanggal Pengajuan</label>
                                        <input type="date" name="tanggal_permohonan" id="tanggalpengajuan"
                                            class="form-control" value="{{ old('tanggal_permohonan') }}">
                                        {{-- @error('tanggal_permohonan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror --}}
                                    </div>
                                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Harap Isi semua Form Dengan
                                        Benar</p>
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
            </div>
            <!-- ROW-4 END -->
        </div>
        <!-- CONTAINER END -->
    </div>
</div>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Hak Cipta</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dosen/hak-cipta">Hak Cipta</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <!-- ROW-2 -->
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-table me-1" data-bs-toggle="tooltip"></i>Data Hak
                                Cipta
                                {{ $hc->nama_lengkap }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action={{ Route('dsn.update.hc', $hc->id) }} enctype="multipart/form-data"
                                method="post" id="uploadForm">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-borderless p-1">
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <td><input type="text" class="form-control" id="nama_lengkap"
                                                    name="nama_lengkap" value="{{ $hc->nama_lengkap }}">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>
                                                <input type="text" id="alamat" class="form-control "
                                                    name="alamat" value="{{ $hc->alamat }}">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>No Telepon</th>
                                            <td>
                                                <input type="number" id="no_telepon" class="form-control "
                                                    name="no_telepon" value="{{ $hc->no_telepon }}">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal lahir</th>
                                            <td>
                                                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                    class="form-control " value="{{ $hc->tanggal_lahir }}">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>KTP</th>
                                            <td>
                                                @if (!empty($hc->ktp_inventor))
                                                    File : {{ basename($hc->ktp_inventor) }}
                                                @else
                                                    File : Tidak ada
                                                @endif
                                                <input type="file" class="form-control " id="ktp"
                                                    name="ktp_inventor">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>masukan file jika ada
                                                    perubahan</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>
                                                <input type="email" id="email" class="form-control" name="email"
                                                    value="{{ $hc->email }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Kewarganegaraan</th>
                                            <td>
                                                <input type="text" id="warga" class="form-control"
                                                    value="{{ $hc->kewarganegaraan }}" name="kewarganegaraan">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Kode Pos</th>
                                            <td><input type="number" id="pos" class="form-control "
                                                    name="kode_pos" value="{{ $hc->kode_pos }}">

                                                <input type="text" class="form-control "
                                                    value="{{ $hc->institusi }}" name="institusi" hidden>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Data Mahasiswa / Dosen <span class="text-danger"><br>
                                                    (masukan file jika ada perubahan)</span>
                                            </th>
                                            <td>
                                                @if (!empty($hc->data_pengaju2))
                                                    File : {{ basename($hc->data_pengaju2) }}
                                                @else
                                                    File : Tidak ada
                                                @endif
                                                <input type="file" class="form-control " name="data_pengaju2"
                                                    id="data_pengaju2">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>File harus bertipe .xlsx</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>jurusan</th>
                                            <td>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="jurusan" id="jurusan">
                <option value="">Pilih Jurusan</option>
                @foreach($jurusanOptions as $j)
                    <option value="{{ $j->nama_jurusan }}" {{ old('jurusan', $hc->jurusan) == $j->nama_jurusan ? 'selected' : '' }}>{{ $j->nama_jurusan }}</option>
                @endforeach
            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>prodi</th>
                                            <td>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="prodi" id="prodi">
                <option value="">Pilih Prodi</option>
                @foreach($prodiOptions as $pr)
                    <option value="{{ $pr->nama_prodi }}" {{ old('prodi', $hc->prodi) == $pr->nama_prodi ? 'selected' : '' }}>{{ $pr->nama_prodi }}</option>
                @endforeach
            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Ciptaan</th>
                                            <td>
                                                <label for="jenis_ciptaan" class="form-label"></label>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="jenis_ciptaan" id="jenis_ciptaan">
                                                    <option value="">Pilih Jenis Hak Cipta</option>
                                                    <option value="Karya Tulis"
                                                        {{ old('jenis_ciptaan', $hc->jenis_ciptaan) == 'Karya Tulis' ? 'selected' : '' }}>
                                                        Karya Tulis</option>
                                                    <option value="Program Komputer"
                                                        {{ old('jenis_ciptaan', $hc->jenis_ciptaan) == 'Program Komputer' ? 'selected' : '' }}>
                                                        Program Komputer</option>
                                                    <option value="Karya Lainnya"
                                                        {{ old('jenis_ciptaan', $hc->jenis_ciptaan) == 'Karya Lainnya' ? 'selected' : '' }}>
                                                        Karya Lainnya</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Judul Ciptaan</th>
                                            <td>
                                                <input type="text" class="form-control " id="judul_ciptaan"
                                                    placeholder="Masukkan Judul Ciptaan" name="judul_ciptaan"
                                                    value="{{ $hc->judul_ciptaan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Uraian Singkat Ciptaan</th>
                                            <td>
                                                <textarea class="form-control " placeholder="Masukkan Uraian Siangkat" id="uraian" name="uraian_singkat"
                                                    id="floatingTextarea2" style="height: 150px">{{ $hc->uraian_singkat }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen Invensi (Manual Book/Buku/Dll)</th>
                                            <td>
                                                @if (!empty($hc->dokumen_invensi))
                                                    File : {{ basename($hc->dokumen_invensi) }}
                                                @else
                                                    File : Tidak ada
                                                @endif
                                                <input type="file" class="form-control " placeholder=""
                                                    name="dokumen_invensi" id="invensi">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>masukan file jika ada
                                                    perubahan</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Surat Pengalihan Hak Cipta</th>
                                            <td>
                                                @if (!empty($hc->surat_pengalihan))
                                                    File : {{ basename($hc->surat_pengalihan) }}
                                                @else
                                                    File : Tidak ada
                                                @endif
                                                <input type="file" class="form-control " placeholder=""
                                                    name="surat_pengalihan" id="surat_pengalihan">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>masukan file jika ada
                                                    perubahan</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Surat Pernyataan</th>
                                            <td>
                                                @if (!empty($hc->surat_pernyataan))
                                                    File : {{ basename($hc->surat_pernyataan) }}
                                                @else
                                                    File : Tidak ada
                                                @endif
                                                <input type="file" class="form-control " id="pernyataan"
                                                    placeholder="" name="surat_pernyataan">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>masukan file jika ada
                                                    perubahan</span>
                                            </td>
                                        </tr>
                                        <th>Tanggal pengajuan</th>
                                        <td>
                                            <input type="date" name="tanggal_permohonan" id="tanggalpengajuan"
                                                class="form-control " id="tanggalpengajuan"
                                                value="{{ $hc->tanggal_permohonan }}">
                                        </td>
                                        </tr>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
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
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>

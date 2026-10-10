<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Paten</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/umum/paten">Paten</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lihat</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-2 -->
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-table me-1" data-bs-toggle="tooltip"></i>Data Paten
                                {{ $p->nama_lengkap }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ Route('umum.paten.update', $p->id) }}" enctype="multipart/form-data"
                                method="POST">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-borderless p-1">
                                        <tr>
                                            <th>nama lengkap</th>
                                            <td>
                                                <input type="text" id="nama_lengkap" class="form-control"
                                                    placeholder="Masukkan Nama"name="nama_lengkap"
                                                    value="{{ $p->nama_lengkap }}">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>alamat</th>
                                            <td>
                                                <input type="text" class="form-control" id="alamat"
                                                    placeholder="Masukkan Alamat" name="alamat"
                                                    value="{{ $p->alamat }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>no telepon</th>
                                            <td>
                                                <input type="text" class="form-control" id="no_telepon"
                                                    placeholder="Masukkan No telepon" name="no_telepon"
                                                    value={{ $p->no_telepon }}>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>tanggal lahir</th>
                                            <td>
                                                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                    class="form-control" value={{ $p->tanggal_lahir }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>ktp inventor</th>
                                            <td>
                                                <input type="file" class="form-control" name="ktp_inventor"
                                                    id="ktp">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>Harus memasukkan kembali file yang
                                                    sama atau yang sudah di perbarui</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>email</th>
                                            <td>
                                                <input type="email" id="email" class="form-control"
                                                    placeholder="Masukkan Email" name="email"
                                                    value={{ $p->email }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>kewarganegaraan</th>
                                            <td>
                                                <input type="text" class="form-control"
                                                    placeholder="Masukkan Kewarganegaraan" id="warga"
                                                    name="kewarganegaraan" value={{ $p->kewarganegaraan }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>kode pos</th>
                                            <td>
                                                <input type="number" class="form-control" id="pos"
                                                    placeholder="Masukkan Kode Pos" name="kode_pos"
                                                    value={{ $p->kode_pos }}>
                                                    <input type="text" class="form-control" value="{{ $p->institusi }}"
                                                    name="institusi" id="institusi" hidden>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Paten</th>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_paten"
                                                        value="Paten" id="paten"
                                                        {{ old('jenis_paten', $p->jenis_paten) == 'Paten' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="paten">Paten</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_paten"
                                                        value="Paten Sederhana" id="paten_s"
                                                        {{ old('jenis_paten', $p->jenis_paten) == 'Paten Sederhana' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="paten_s">Paten
                                                        Sederhana</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>judul paten</th>
                                            <td>
                                                <input type="text" class="form-control" id="judul_paten"
                                                    placeholder="Masukkan Judul Paten" name="judul_paten"
                                                    value="{{ $p->judul_paten }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>abstrak paten</th>
                                            <td>
                                                <input type="file" class="form-control" id="abstrak"
                                                    placeholder="" name="abstrak_paten">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>Harus memasukkan kembali file yang
                                                    sama atau yang sudah di perbarui</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>deskripsi paten</th>
                                            <td>
                                                <input type="file" class="form-control" id="deskripsi"
                                                    placeholder="" name="deskripsi_paten">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>Harus memasukkan kembali file yang
                                                    sama atau yang sudah di perbarui</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pengalihan Hak
                                                Invensi</th>
                                            <td>
                                                <input type="file" class="form-control" id="pengalihan_hak"
                                                    placeholder="" name="pengalihan_hak">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>Harus memasukkan kembali file yang
                                                    sama atau yang sudah di perbarui</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>klaim</th>
                                            <td>
                                                <input type="file" class="form-control" id="klaim"
                                                    placeholder="" name="klaim">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>Harus memasukkan kembali file yang
                                                    sama atau yang sudah di perbarui</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pernyataan kepemikikan
                                                Inventor</th>
                                            <td>
                                                <input type="file" class="form-control" id="kepemilikan"
                                                    placeholder="" name="pernyataan_kepemilikan">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>Harus memasukkan kembali file yang
                                                    sama atau yang sudah di perbarui</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>surat kuasa</th>
                                            <td>
                                                <input type="file" class="form-control" id="kuasa"
                                                    placeholder="" name="surat_kuasa">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>Harus memasukkan kembali file yang
                                                    sama atau yang sudah di perbarui</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>gambar paten</th>
                                            <td>
                                                <input type="file" class="form-control" id="g_paten"
                                                    placeholder="" name="gambar_paten" accept=".pdf">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>Harus memasukkan kembali file yang
                                                    sama atau yang sudah di perbarui</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>gambar tampilan</th>
                                            <td>
                                                <input type="file" class="form-control" id="g_tampilan"
                                                    placeholder="" name="gambar_tampilan[]" multiple accept=".pdf,.jpg,.jpeg,.png">
                                                <span class="text-danger"><i class="fa fa-warning me-2"
                                                        data-bs-toggle="tooltip"></i>Harus memasukkan kembali file yang
                                                    sama atau yang sudah di perbarui</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>tanggal pengajuan</th>
                                            <td>
                                                <input type="date" name="tanggal_permohonan" id="tanggalpengajuan"
                                                    class="form-control" id="tanggalpengajuan"
                                                    value={{ $p->tanggal_permohonan }}>
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
    </div>
</div>

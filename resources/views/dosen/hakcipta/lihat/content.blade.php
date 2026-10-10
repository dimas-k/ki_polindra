<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Hak Cipta</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dosen/hak-cipta">hak Cipta</a></li>
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
                            <h3 class="card-title"><i class="fa fa-table me-1" data-bs-toggle="tooltip"></i>Data Hak
                                Cipta
                                {{ $hc->nama_lengkap }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless p-1">
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>: {{ $hc->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>: {{ $hc->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon</th>
                                        <td>: {{ $hc->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal lahir</th>
                                        <td>: {{ \Carbon\Carbon::parse($hc->tanggal_lahir)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>KTP</th>
                                        <td>:
                                            @if (!empty($hc->ktp_inventor))
                                                <a href="{{ route('private_hc_dosen', ['filename' => basename($hc->ktp_inventor)]) }}"
                                                    target="_blank">
                                                    Lihat KTP
                                                </a>
                                            @else
                                                KTP tidak tersedia.
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Anggota Inventor</th>
                                        <td>:
                                            @if ($hc->data_pengaju2)
                                                <a href="{{ route('private_hc_dosen', ['filename' => basename($hc->data_pengaju2)]) }}"
                                                    target="_blank">Download xlsx Anggota Inventor</a>
                                            @else
                                                Tidak ada data untuk diunduh.
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>: {{ $hc->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kewarganegaraan</th>
                                        <td>: {{ $hc->kewarganegaraan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pos</th>
                                        <td>: {{ $hc->kode_pos }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jurusan</th>
                                        <td>: {{ $hc->jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Prodi</th>
                                        <td>: {{ $hc->prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Ciptaan</th>
                                        <td>: {{ $hc->jenis_ciptaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Judul Ciptaan</th>
                                        <td>: {{ $hc->judul_ciptaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Uraian Singkat Ciptaan</th>
                                        <td>: {{ $hc->uraian_singkat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dokumen Invensi</th>
                                        <td>:
                                            <a href="{{ route('public_hc_dosen', ['filename' => basename($hc->dokumen_invensi)]) }}"
                                                target="_blank">Lihat Dokumen Invensi
                                            </a>
                                    </tr>
@if (!empty($hc->gambar_ciptaan))
<tr>
                                        <th>Gambar Ciptaan</th>
                                        <td>:
                                            @foreach (\App\Support\MultiFileStorage::decode($hc->gambar_ciptaan) as $__f)
<a href="{{ route('public_hc_dosen', ['filename' => basename($__f)]) }}"
                                                target="_blank">Lihat Gambar Ciptaan
                                            </a>
@endforeach
                                    </tr>
@endif
                                    <tr>
                                        <th>Surat Pengalihan Hak Cipta</th>
                                        <td>: 
                                            <a href="{{ route('private_hc_dosen', ['filename' => basename($hc->surat_pengalihan)]) }}"
                                                    target="_blank">Lihat Surat Pengalihan Hak Cipta
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Surat Pernyataan</th>
                                        <td>: <a href="{{ route('private_hc_dosen', ['filename' => basename($hc->surat_pernyataan)]) }}"
                                                target="_blank">Lihat Surat Pernyataan</a></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pengajuan</th>
                                        <td>: {{ \Carbon\Carbon::parse($hc->tanggal_permohonan)->format('d-m-Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>: {{ $hc->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Data Hak Cipta</th>
                                        <td>:
                                            @if ($hc->cekhc?->keterangan == null)
                                                Data Hak Cipta Belum Diverifikasi
                                            @else
                                                {{ $hc->cekhc?->keterangan }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikat Hak Cipta</th>
                                        <td>:
                                            @if ($hc->sertifikat_hakcipta != '')
                                                <a href="{{ route('public_hc_dosen', ['filename' => basename($hc->sertifikat_hakcipta)]) }}"
                                                    target="_blank">Lihat Sertifikat</a>
                                            @else
                                                Hak Cipta Anda Belum Mendapatkan Sertifikat
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <!-- COL END -->
            </div>
        </div>
        <!-- CONTAINER END -->
    </div>
</div>

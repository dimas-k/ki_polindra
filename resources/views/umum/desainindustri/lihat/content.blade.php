<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Desain industri</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/umum/desain-industri">Desain industri</a></li>
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
                            <h3 class="card-title"><i class="fa fa-table me-1" data-bs-toggle="tooltip"></i>Data Desain Industri
                                {{ $di->nama_lengkap }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless p-1">

                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>: {{ $di->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>: {{ $di->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon</th>
                                        <td>: {{ $di->no_telepon }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal lahir</th>
                                        <td>: {{ \Carbon\Carbon::parse($di->tanggal_lahir)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>KTP</th>
                                        <td>: <a href="{{ route('private_di_umum', ['file' => basename($di->ktp_inventor)]) }}"
                                                target="_blank">Lihat KTP</a></td>
                                    </tr>
                                    <tr>
                                        <th>Anggota Inventor</th>
                                        <td>:        
                                        @if($di->data_pengaju2)
                                            <a href="{{ route('private_di_umum', ['file' => basename($di->data_pengaju2)]) }}" target="_blank">Download xlsx Anggota Inventor</a>
                                        @else
                                            Tidak ada data untuk diunduh.
                                        @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>: {{ $di->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kewarganegaraan</th>
                                        <td>: {{ $di->kewarganegaraan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pos</th>
                                        <td>: {{ $di->kode_pos }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Disain Industri</th>
                                        <td>: {{ $di->jenis_di }}</td>
                                    </tr>
                                    <tr>
                                        <th>Judul Desain Industri</th>
                                        <td>: {{ $di->judul_di }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gambar desain Industri</th>
                                        <td >: @foreach (\App\Support\MultiFileStorage::decode($di->gambar_di) as $__f)
<a href="{{ route('private_di_umum', ['file' => basename($__f)]) }} "
                                            target="_blank">Lihat Gambar Desain Industri</a>@if (!$loop->last)<br>@endif
@endforeach</td>
                                    </tr>
                                    <tr>
                                        <th>Uraian Desain Industri</th>
                                        <td>: <a href="{{ route('private_di_umum', ['file' => basename($di->uraian_di)]) }}"
                                                target="_blank">Lihat Uraian Desain Industri</a></td>
                                    </tr>
                                    <tr>
                                        <th>Surat Kepemilikan</th>
                                        <td>: <a href="{{ route('private_di_umum', ['file' => basename($di->surat_kepemilikan)]) }}"
                                                target="_blank">Lihat Surat Kepemilikan</a></td>
                                    </tr>
                                    <tr>
                                        <th>Surat Pengalihan hak</th>
                                        <td>: <a href="{{ route('private_di_umum', ['file' => basename($di->surat_pengalihan)]) }}"
                                                target="_blank">Lihat Surat Pengalihan Hak</a></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal pengajuan</th>
                                        <td>: {{ \Carbon\Carbon::parse($di->tanggal_permohonan)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>: {{ $di->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>status data desain industri</th>
                                        <td>: @if ($di->cekDi?->keterangan == null)
                                            Data Desain Industri Belum Diverifikasi
                                        @else
                                            {{ $di->cekDi?->keterangan }}
                                        @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikat Desain Industri</th>
                                        <td>: @if ($di->sertifikat_desain != "")
                                                <a href="{{ route('private_di_umum', ['file' => basename($di->sertifikat_desain)]) }}""
                                                    class="" target="_blank">Lihat sertifikat</a>
                                            @else 
                                            Desain Industri Anda Belum Mendapatkan Sertifikat    
                                            @endif
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
            <!-- ROW-4 END -->
        </div>
        <!-- CONTAINER END -->
    </div>
</div>

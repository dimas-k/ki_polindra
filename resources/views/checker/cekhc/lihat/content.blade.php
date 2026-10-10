<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Hak Cipta</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dosen/paten">Paten</a></li>
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
                            @if (session()->has('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
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
                                                <a href="{{ route('private_hc_verifikator', ['file' => basename($hc->ktp_inventor)]) }}"
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
                                                <a href="{{ route('private_hc_verifikator', ['file' => basename($hc->data_pengaju2)]) }}"
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
                                        <td>: @if ($hc->jurusan == null)
                                                Bukan Dosen
                                            @else
                                                {{ $hc->jurusan }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Prodi</th>
                                        <td>: @if ($hc->prodi == null)
                                                Bukan Dosen
                                            @else
                                                {{ $hc->prodi }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Ciptaann</th>
                                        <td>: {{ $hc->jenis_ciptaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Judul Ciptaan</th>
                                        <td>: {{ $hc->judul_ciptaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Abstrak Ciptaan</th>
                                        <td>: {{ $hc->uraian_singkat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dokumen Invensi</th>
                                        <td>:
                                            <a href="{{ route('public_hc_verifikator', ['file' => basename($hc->dokumen_invensi)]) }}"
                                                target="_blank">Lihat Dokumen Invensi
                                            </a>
                                    </tr>
@if (!empty($hc->gambar_ciptaan))
<tr>
                                        <th>Gambar Ciptaan</th>
                                        <td>:
                                            @foreach (\App\Support\MultiFileStorage::decode($hc->gambar_ciptaan) as $__f)
<a href="{{ route('public_hc_verifikator', ['file' => basename($__f)]) }}"
                                                target="_blank">Lihat Gambar Ciptaan
                                            </a>
@endforeach
                                    </tr>
@endif
                                    <tr>
                                        <th>Surat Pengalihan Hak Cipta</th>
                                        <td>: 
                                            <a href="{{ route('private_hc_verifikator', ['file' => basename($hc->surat_pengalihan)]) }}"
                                                    target="_blank">Lihat Surat Pengalihan Hak Cipta
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Surat Pernyataan</th>
                                        <td>: <a href="{{ route('private_hc_verifikator', ['file' => basename($hc->surat_pernyataan)]) }}"
                                                target="_blank">Lihat Surat Pernyataan</a></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal pengajuan</th>
                                        <td>: {{ \Carbon\Carbon::parse($hc->tanggal_permohonan)->format('d-m-Y ') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>: {{ $hc->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikat Hak Cipta</th>
                                        <td>: @if ($hc->sertifikat_hakcipta != '')
                                                {{-- <a href={{ asset('storage/' . $hc->sertifikat_hakcipta) }}
                                                    class="" target="_blank">Lihat sertifikat</a> --}}
                                                    <a href="{{ route('public_hc_verifikator', parameters: ['file' => basename($hc->sertifikat_hakcipta)]) }}"
                                                        target="_blank">Lihat sertifikat
                                                    </a>
                                            @else
                                                Hak Cipta Ini Belum Mendapatkan Sertifikat
                                            @endif
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan status data hak cipta</th>
                                        <td>
                                            : @if ($hc->cekHc?->keterangan == '')
                                                Data Hak Cipta Belum Dicek
                                            @else
                                                {{ $hc->cekHc?->keterangan }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                {{-- <a class="btn btn-primary me-3" href="/verifikator/cek/hak-cipta/nilai/{{ request()->segment(5) }}">Nilai Data Hak Cipta</a>
                                <a href="/verifikator/cek/hak-cipta/nilai/update/{{ request()->segment(5) }}" class="btn btn-outline-secondary">Update nilai Data hak Cipta</a> --}}
                                <div class="mb-3">
                                    @if ($check)
                                        <!-- Data paten sudah dinilai -->
                                        <!-- Tombol "Nilai Data paten" dinonaktifkan -->
                                        <a class="btn btn-primary me-3 disabled" aria-disabled="true" title="Data paten sudah dinilai. Gunakan Update">
                                            Nilai Data Hak Cipta
                                        </a>
                                        <!-- Tombol "Update nilai Data paten" aktif -->
                                        <a href="/verifikator/cek/hak-cipta/nilai/update/{{ $hc->id }}" class="btn btn-outline-secondary">
                                            Update nilai Data Hak Cipta
                                        </a>
                                    @else
                                        <!-- Data hc belum dinilai -->
                                        <!-- Tombol "Nilai Data hc" aktif -->
                                        <a href="/verifikator/cek/hak-cipta/nilai/{{ $hc->id }}" class="btn btn-primary me-3">
                                            Nilai Data Hak Cipta
                                        </a>
                                        <!-- Tombol "Update nilai Data Hak Cipta" dinonaktifkan -->
                                        <a class="btn btn-outline-secondary disabled" aria-disabled="true" title="Data Hak Cipta belum dinilai. Silahkan nilai terlebih dahulu">
                                            Update nilai Data Hak Cipta
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
            </div>
        </div>
        <!-- CONTAINER END -->
    </div>
</div>

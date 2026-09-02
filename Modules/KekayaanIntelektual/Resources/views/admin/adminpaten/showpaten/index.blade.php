<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Paten | Lihat</title>
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
                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-person me-3"></i>Data Paten
                        {{ $p->nama_lengkap }}
                    </h3>
                    <div class="table-responsive p-3">
                        <table class="table table-borderless rounded">

                            <tr>
                                <th>Nama Lengkap</th>
                                <td>: {{ $p->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>: {{ $p->alamat }}</td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td>: {{ $p->no_telepon }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal lahir</th>
                                <td>: {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>KTP</th>
                                <td>: 
                                    <a href="{{ route('private_paten_admin', ['file' => basename($p->ktp_inventor)]) }}"
                                        target="_blank">Lihat KTP</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Anggota Inventor</th>
                                <td>:        
                                @if($p->data_pengaju2)
                                    <a href="{{ route('private_paten_admin', ['file' => basename($p->data_pengaju2)]) }}" target="_blank">Download xlsx Anggota Inventor</a>
                                @else
                                    Tidak ada data untuk diunduh.
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: {{ $p->email }}</td>
                            </tr>
                            <tr>
                                <th>Kewarganegaraan</th>
                                <td>: {{ $p->kewarganegaraan }}</td>
                            </tr>
                            <tr>
                                <th>Kode Pos</th>
                                <td>: {{ $p->kode_pos }}</td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>: @if ($p->jurusan == null)
                                        Bukan Dosen
                                    @else
                                        {{ $p->jurusan }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>prodi</th>
                                <td>: @if ($p->prodi == null)
                                        Bukan Dosen
                                    @else
                                        {{ $p->prodi }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Jenis Paten</th>
                                <td>: {{ $p->jenis_paten }}</td>
                            </tr>
                            <tr>
                                <th>Judul Paten</th>
                                <td>: {{ $p->judul_paten }}</td>
                            </tr>
                            <tr>
                                <th>Abstrak Paten</th>
                                <td>: <a href={{ route('public_paten_admin', ['file' => basename($p->abstrak_paten)]) }} class=""
                                        target="_blank">Lihat Abstrak Paten</a></td>
                            </tr>
                            <tr>
                                <th>Deskripsi Paten</th>
                                <td>: <a href={{ route('public_paten_admin', ['file' => basename($p->deskripsi_paten)]) }} class=""
                                        target="_blank">Lihat Deskripsi Paten</a></td>
                            </tr>
                            <tr>
                                <th>Pengalihan hak invensi</th>
                                <td>: <a href={{ route('private_paten_admin', ['file' => basename($p->pengalihan_hak)]) }} class=""
                                        target="_blank">Lihat Pengalihan Hak Invensi</a></td>
                            </tr>
                            <tr>
                                <th>Klaim</th>
                                <td>: <a href={{ route('private_paten_admin', ['file' => basename($p->klaim)]) }} class="" target="_blank">Lihat
                                        Klaim</a></td>
                            </tr>
                            <tr>
                                <th>Pernyataan Kepemilikan</th>
                                <td>: <a href={{ route('private_paten_admin', ['file' => basename($p->pernyataan_kepemilikan)]) }} class=""
                                        target="_blank">Lihat Pernyataan Kepemilikan</a></td>
                            </tr>
                            <tr>
                                <th>Surat Kuasa</th>
                                <td>: <a href={{ route('private_paten_admin', ['file' => basename($p->surat_kuasa)]) }} class=""
                                        target="_blank">Lihat Surat Kuasa</a></td>
                            </tr>
                            <tr>
                                <th>Gambar Paten</th>
                                <td>: <a href={{ route('public_paten_admin', ['file' => basename($p->gambar_paten)]) }} class=""
                                        target="_blank">Lihat Gambar paten</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Gambar Tampilan</th>
                                <td>: <a href={{ route('public_paten_admin', ['file' => basename($p->gambar_tampilan)]) }} class=""
                                    target="_blank">Lihat Gambar tampilan</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal pengajuan</th>
                                <td>: {{ \Carbon\Carbon::parse($p->tanggal_permohonan)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Sertifikat Paten</th>
                                <td>: @if ($p->sertifikat_paten != '')
                                        <a href={{ route('public_paten_admin', ['file' => basename($p->sertifikat_paten)]) }} class=""
                                            target="_blank">Lihat sertifikat</a>
                                    @else
                                        Paten Ini Belum Mendapatkan Sertifikat
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status Paten</th>
                                <td>: {{ $p->status }}</td>
                            </tr>
                            <tr>
                                <th>
                                    Keterangan Status Cek Paten
                                </th>
                                <td>:
                                    @if ($p->cek?->keterangan == '')
                                        Data Paten Belum Dicek
                                    @else
                                        {{ $p->cek?->keterangan }}
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <div class="mt-3">
                            @if ($p->dikirim_ke)
                                <span class="badge bg-success">
                                    Sudah dikirim ke {{ ucfirst($p->dikirim_ke) }}
                                </span>
                            @else
                                <a href="{{ route('admin_paten.form_kirim', $p->id) }}" class="btn btn-primary btn-sm">
                                    Kirim ke Dashboard (Produk Inovasi / Penelitian)
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                @include('admin.layout.tagihan-card', [
                    'pembayaran' => $p->payment,
                    'jenisSlug' => 'paten',
                    'pengajuanId' => $p->id,
                    'namaPengaju' => $p->nama_lengkap,
                ])
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
</body>

</html>

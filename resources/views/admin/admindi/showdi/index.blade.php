<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Desain Industri | Lihat</title>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>
    {{-- Top nav bar --}}
    <div class="container-fluid border">
        <nav class="navbar navbar-expand bg-body-tertiary">
            <div class="container-fluid">
                <img class="navbar-brand" src={{ asset('assets/polindra2.jpg') }}>
                <a class="navbar-brand fs-6 fw-normal font-family-Kokoro" href="#">Sistem Informasi Kekayaan
                    Intelektual<br>Politeknik Negeri Indramayu</a>
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
            <div class="col-lg-10 mt-2">
                <div class="container bg-light rounded border pt-3">
                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-person me-3"></i>Data Paten
                        {{ $di->nama_lengkap }}
                    </h3>
                    <div class="table-responsive p-3 ">
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
                                <td>: {{ $di->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th>KTP</th>
                                <td>: <a href={{ route('private_di', ['file' => basename($di->ktp_inventor)]) }} class=""
                                        target="_blank">Lihat KTP</a></td>
                            </tr>
                            <tr>
                                <th>Anggota Inventor</th>
                                <td>:        
                                @if($di->data_pengaju2)
                                    <a href="{{ route('private_di', ['file' => basename($di->data_pengaju2)]) }}" target="_blank">Download xlsx Anggota Inventor</a>
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
                                <th>Jurusan</th>
                                <td>: @if ($di->jurusan == null)
                                        Bukan Dosen
                                    @else
                                        {{ $di->jurusan }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Prodi</th>
                                <td>: @if ($di->prodi == null)
                                        Bukan Dosen
                                    @else
                                        {{ $di->prodi }}
                                    @endif
                                </td>
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
                                <td>: <a href={{ route('public_di', ['file' => basename($di->gambar_di)]) }} class=""
                                        target="_blank">Lihat Gambar Desain Industri</a></td>
                            </tr>
                            <tr>
                                <th>Uraian Desain Industri</th>
                                <td>: <a href={{ route('public_di', ['file' => basename($di->uraian_di)]) }} class=""
                                        target="_blank">Lihat Uraian Desain Industri</a></td>
                            </tr>
                            <tr>
                                <th>surat Kepemilikan</th>
                                <td>: <a href={{ route('private_di', ['file' => basename($di->surat_kepemilikan)]) }} class=""
                                        target="_blank">Lihat Surat Kepemilikan</a></td>
                            </tr>
                            <tr>
                                <th>Surat Pengalihan Hak</th>
                                <td>: <a href={{ route('private_di', ['file' => basename($di->surat_pengalihan)]) }} class=""
                                        target="_blank">Lihat Surat Pengalihan Hak</a></td>
                            </tr>
                            <tr>
                                <th>Tanggal pengajuan</th>
                                <td>: {{ $di->tanggal_permohonan }}</td>
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
                                <td>: @if ($di->sertifikat_desain != '')
                                        <a href={{ asset('storage/' . $di->sertifikat_desain) }} class=""
                                            target="_blank">Lihat sertifikat</a>
                                    @else
                                        Desain Industri Ini Belum Mendapatkan Sertifikat
                                    @endif
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @include('admin.layout.tagihan-card', [
                    'pembayaran' => $di->payment,
                    'jenisSlug' => 'desain-industri',
                    'pengajuanId' => $di->id,
                    'namaPengaju' => $di->nama_lengkap,
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

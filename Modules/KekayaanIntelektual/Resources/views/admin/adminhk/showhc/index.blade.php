<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Hak Cipta | Lihat</title>
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
                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-person me-3"></i>Data hak cipta
                        {{ $hc->nama_lengkap }}
                    </h3>
                    <div class="table-responsive p-3">
                        <table class="table table-borderless rounded">

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
                                    <a href={{ route('private_hc', ['file' => basename($hc->ktp_inventor)]) }}
                                        class="" target="_blank">Lihat KTP
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Anggota Inventor</th>
                                <td>:
                                    @if ($hc->data_pengaju2)
                                        <a href="{{ route('private_hc', ['file' => basename($hc->data_pengaju2)]) }} "
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
                                <th>prodi</th>
                                <td>: @if ($hc->prodi == null)
                                        Bukan Dosen
                                    @else
                                        {{ $hc->prodi }}
                                    @endif
                                </td>
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
                                <th>Uraian singkat ciptaan</th>
                                <td>: {{ $hc->uraian_singkat }}</td>
                            </tr>
                            <tr>
                                <th>Dokumen invensi</th>
                                <td>: <a href={{ route('public_hc', ['file' => basename($hc->dokumen_invensi)]) }}
                                        class="" target="_blank">Lihat Dokumen Invensi</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Surat Pengalihan Hak Cipta</th>
                                <td>: <a href={{ route('private_hc', ['file' => basename($hc->surat_pengalihan)]) }}
                                        class="" target="_blank">Surat Pengalihan Hak Cipta</a></td>
                            </tr>
                            <tr>
                                <th>surat pernyataan</th>
                                <td>: <a href={{ route('private_hc', ['file' => basename($hc->surat_pernyataan)]) }}
                                        class="" target="_blank">Lihat Surat Pernyataan</a></td>
                            </tr>
                            <tr>
                                <th>Tanggal pengajuan</th>
                                <td>: {{ \Carbon\Carbon::parse($hc->tanggal_permohonan)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>: {{ $hc->status }}</td>
                            </tr>
                            <tr>
                                <th>Status Data Hak Cipta</th>
                                <td>: @if ($hc->cekhc?->keterangan == null)
                                        Data Hak Cipta Belum Diverifikasi
                                    @else
                                        {{ $hc->cekhc?->keterangan }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Sertifikat Hak Cipta</th>
                                <td>: @if ($hc->sertifikat_hakcipta != '')
                                        <a href={{ route('public_hc', ['file' => basename($hc->sertifikat_hakcipta)]) }}
                                            class="" target="_blank">Lihat sertifikat</a>
                                    @else
                                        Hak Cipta Ini Belum Mendapatkan Sertifikat
                                    @endif
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>

                @include('admin.layout.tagihan-card', [
                    'pembayaran' => $hc->payment,
                    'jenisSlug' => 'hak-cipta',
                    'pengajuanId' => $hc->id,
                    'namaPengaju' => $hc->nama_lengkap,
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

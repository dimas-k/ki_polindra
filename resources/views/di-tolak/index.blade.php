<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="shortcut icon" href={{ asset('assets/logo-polindra.png') }}>
    <title>SIKI POLINDRA | desain-industri</title>
</head>

<body>
    @include('layout.nav')
    <br><br><br>
    <div class="container p-4">
        <a href="/desain-industri" class="link-dark link-underline link-underline-opacity-0 mb-3 "><i
                class="bi bi-arrow-left-circle mb-3" style="font-size: 35px;"></i></a>
        <h3 class="fw-normal font-family-Kokoro mb-3 mt-2"><i class="bi bi-table me-2"></i>Daftar Desain Industri</h3>
        <div class="table-responsive">
            <table id="tabel-di-tolak" class="table table-hover font-family-Kokoro w-100">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No. Pendaftaran</th>
                        <th scope="col">Nama lengkap</th>
                        <th scope="col">Jenis Desain</th>
                        <th scope="col">Judul Desain</th>
                        <th scope="col">Tanggal pengajuan</th>
                        <th scope="col">Status Desain Industri</th>
                        {{-- <th scope="col">Detail Pengajuan</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cek as $i => $d)
                        <tr>
                            <th scope="row">{{ $i + 1 }}</th>
                            <td>{{ $d->no_pendaftaran ?? '-' }}</td>
                            <td>{{ $d->nama_lengkap }}</td>
                            <td>{{ $d->jenis_di }}</td>
                            <td>{{ $d->judul_di }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->tanggal_permohonan)->format('d-m-Y') }}</td>
                            <td>{{ $d->status }}</td>
                            {{-- <td><a class="btn btn-primary"
                                    href={{ Route('desain-industri.show', $d->id) }}>Selengkapnya</a></td> --}}
                        </tr>
                    @empty
                        <td colspan="10" class="text-center">
                            <img src="{{ asset('assets/no-data.png') }}" style="width:30%; height:auto">
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('layout.footer')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('#tabel-di-tolak').DataTable({
                order: [[0, 'asc']],
                dom: 'lrtip',
                language: {
                    search: 'Cari:',
                    lengthMenu: '_MENU_ entri per halaman',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(disaring dari _MAX_ total data)',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: '<img src="{{ asset('assets/no-data.png') }}" style="width:30%; height:auto">',
                    paginate: {
                        first: 'Awal',
                        last: 'Akhir',
                        next: 'Berikutnya',
                        previous: 'Sebelumnya',
                    },
                },
            });
        });
    </script>

</body>

</html>

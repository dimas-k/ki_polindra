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
    <title>SIKI POLINDRA | Paten</title>
</head>

<body>
    {{-- nav --}}
    @include('layout.nav')
    {{-- end of nav --}}
    <br>
    <br>
    <br>
    <div class="container p-4">
        <a href="/paten" class="link-dark link-underline link-underline-opacity-0 mb-3 "><i
                class="bi bi-arrow-left-circle mb-3" style="font-size: 35px;"></i></a>
        <h3 class="fw-normal font-family-Kokoro mb-3 mt-3"><i class="bi bi-table me-2"></i>Daftar Paten</h3>
        <div class="table-responsive">
            <table id="tabel-paten-mp" class="table table-hover font-family-Kokoro w-100">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No. Pendaftaran</th>
                        <th scope="col">Nama lengkap</th>
                        <th scope="col">Jenis Paten</th>
                        <th scope="col">Judul paten</th>
                        <th scope="col">Tanggal pengajuan</th>
                        <th scope="col">Status paten</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cek as $i => $p)
                        <tr>
                            <th scope="row">{{ $i + 1 }}</th>
                            <td>{{ $p->no_pendaftaran ?? '-' }}</td>
                            <td>{{ $p->nama_lengkap }}</td>
                            <td>{{ $p->jenis_paten }}</td>
                            <td>{{ $p->judul_paten }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_permohonan)->format('d-m-Y') }}</td>
                            <td>{{ $p->status }}</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- footer --}}
    @include('layout.footer')
    {{-- end of footer --}}

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
            $('#tabel-paten-mp').DataTable({
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

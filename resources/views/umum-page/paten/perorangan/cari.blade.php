<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="shortcut icon" href={{ asset('assets/logo-polindra.png') }}>
    <title>SIKI POLINDRA || Paten Pegawai</title>
</head>

<body>
    <style>
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
                /* Elemen menjadi vertikal */
                align-items: stretch;
                /* Elemen memenuhi lebar kontainer */
            }

            .select2-container {
                width: 100% !important;
                /* Pastikan Select2 penuh lebar */
            }

            .select2-dropdown {
                width: auto !important;
                /* Pastikan dropdown menyesuaikan dengan kontainer */
                max-width: 100% !important;

            }

            .search-form>button {
                width: 80%;
                margin-left: 0;
                margin-top: 20px;
            }
        }
    </style>
    @include('layout.nav')
    <br>
    <br>
    <br>
    <br>
    <div class="container search-container">
        <a href="/paten" class="link-dark link-underline link-underline-opacity-0 mb-3">
            <i class="bi bi-arrow-left-circle" style="font-size: 2rem;"></i>
        </a>
        <div class="rounded border shadow-sm p-3 mb-4 mt-3">
            <form action="/paten/list/perorangan/cari" method="POST" class="search-form d-flex align-items-center">
                @csrf
                <label for="" class="form-label me-3">Nama</label>
                <select id="nama" class="form-select form-select-sm select2 flex-grow-1" name="nama"
                    style="width: 100%;" title="Pilih Nama">
                    <option></option>
                    @foreach ($nama->unique('nama_lengkap') as $o => $or)
                        <option value="{{ $or->nama_lengkap }}">{{ $or->nama_lengkap }}</option>
                    @endforeach
                </select>
                <span class="ms-3"></span>
                <button type="submit" class="btn btn-sm btn-primary">Cari</button>
            </form>
        </div>
        <div class="rounded border shadow-sm p-3 mb-5">
            <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-table me-2"></i>Daftar Paten <b>
                    @foreach ($orang as $p)
                        {{ $p->nama_lengkap }}
                    @break
                @endforeach
            </b>
        </h3>
        <div class="table-responsive">
            <table id="tabel-paten-perorangan" class="table table-hover font-family-Kokoro w-100">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No. Pendaftaran</th>
                        <th scope="col">Nama lengkap</th>
                        <th scope="col">Jenis Paten</th>
                        <th scope="col">Judul paten</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Prodi</th>
                        <th scope="col">Tanggal pengajuan</th>
                        <th scope="col">Status paten</th>
                        {{-- <th scope="col">Detail Pengajuan</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orang as $i => $or)
                        <tr>
                            <th scope="row">
                                {{ $loop->iteration }}</th>
                            <td>{{ $or->no_pendaftaran ?? '-' }}</td>
                            <td>{{ $or->nama_lengkap }}</td>
                            <td>{{ $or->jenis_paten }}</td>
                            <td>{{ $or->judul_paten }}</td>
                            <td>{{ $or->jurusan }}</td>
                            <td>{{ $or->prodi }}</td>
                            <td>{{ \Carbon\Carbon::parse($or->tanggal_permohonan)->format('d-m-Y') }}</td>
                            <td>{{ $or->status }}</td>
                            {{-- <td><a class="btn btn-primary" href={{ Route('paten.show', $p->id) }}>Selengkapnya</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Footer -->
@include('layout.footer')
<!-- Footer -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('#nama').select2({
            placeholder: "Pilih Nama",
            allowClear: true
        });
    });
</script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('#tabel-paten-perorangan').DataTable({
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

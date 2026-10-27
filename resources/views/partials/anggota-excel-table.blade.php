{{--
    Partial: tabel data anggota/pengaju lainnya (dibaca dari file Excel
    'data_pengaju2'). Variabel yang dibutuhkan:
    - $anggotaExcel : array|null hasil dari App\Support\AnggotaExcelReader::read()
                      (['headers' => [...], 'rows' => [[...], ...]])

    Dipakai di halaman show/lihat milik Admin, Verifikator, dan Dosen saja
    (tidak dipasang di halaman guest/umum).
--}}
@if (!empty($anggotaExcel))
    <div class="mt-4">
        <h6 class="fw-bold mb-2"><i class="bi bi-people"></i> Data Anggota / Pengaju Lainnya</h6>
        <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle">
                <thead class="table-light">
                    <tr>
                        @foreach ($anggotaExcel['headers'] as $h)
                            <th>{{ $h }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggotaExcel['rows'] as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td>{{ $cell !== '' ? $cell : '-' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

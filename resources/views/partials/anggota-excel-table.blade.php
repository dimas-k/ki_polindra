{{--
    Partial: tabel data anggota/pengaju lainnya (dibaca dari file Excel
    'data_pengaju2'). Variabel yang dibutuhkan:
    - $anggotaExcel : array|null hasil dari App\Support\AnggotaExcelReader::read()
                      (['headers' => [...], 'rows' => [[...], ...]])
    - $anggotaExcelPath (opsional) : path mentah 'data_pengaju2' yang dipakai
                      untuk pesan diagnosis kalau $anggotaExcel null padahal
                      field ini terisi (file ada tapi gagal dibaca / tidak
                      ditemukan di disk).

    Dipakai di halaman show/lihat milik Admin, Verifikator, dan Dosen saja
    (tidak dipasang di halaman guest/umum).
--}}
@if (empty($anggotaExcel) && !empty($anggotaExcelPath ?? null))
    <div class="mt-2 small text-danger">
        <i class="bi bi-exclamation-triangle"></i>
        Data tidak bisa ditampilkan sebagai teks (file Excel tidak ditemukan di server atau gagal dibaca).
    </div>
@endif
@if (!empty($anggotaExcel))
    @php
        // Cari kolom "Nama" (case-insensitive); kalau tidak ketemu, pakai kolom pertama.
        $namaColIndex = 0;
        foreach ($anggotaExcel['headers'] as $idx => $h) {
            if (strcasecmp(trim($h), 'Nama') === 0) {
                $namaColIndex = $idx;
                break;
            }
        }
    @endphp
    <div class="mt-2">
        <ul class="mb-0 ps-3">
            @foreach ($anggotaExcel['rows'] as $row)
                @php $nama = trim($row[$namaColIndex] ?? ''); @endphp
                @if ($nama !== '')
                    <li>{{ $nama }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif

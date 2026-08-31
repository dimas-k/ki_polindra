<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-2">
        <h5 class="card-header border-3 w-100 mb-2"><i class='bx bx-table me-2'></i>Data {{ $penelitian->judul }}</h5>
        <img class="mx-auto d-block mb-5 mt-4" src="{{ asset( 'storage/' . $penelitian->gambar) }}" alt="" style="max-width: 50%; height: auto">
        <div class="table-responsive text-nowrap mt-4">
            <table class="table table-borderless">

                <tr>
                    <th>Judul Penelitian</th>
                    <td>: {{ $penelitian->judul }}</td>
                </tr>
                <tr>
                    <th>Nama Penulis</th>
                    <td>: {{ $penelitian->penulis ?: $penelitian->penulis_lainnya }}</td>
                </tr>
                <tr>
                    <th>email penulis</th>
                    <td>: {{ $penelitian->email_penulis }}</td>
                </tr>
                <tr>
                    <th>Penulis Korespondensi</th>
                    <td>: {{ $penelitian->penulis_korespondensi }}
                    </td>
                </tr>
                <tr>
                    <th>Anggota Penulis (Dosen/Tendik POLINDRA)</th>
                    <td>
                        @foreach ($penelitian->anggotaPenelitian as $anggota)
                            <li>
                                @if ($anggota->anggota)
                                    @if ($anggota->anggota_type === 'users')
                                        {{ $anggota->anggota->nama_lengkap }} -
                                        {{ $anggota->anggota->jabatan ?? 'Tidak ada jabatan' }}
                                    @elseif ($anggota->anggota_type === 'anggota_kelompok_keahlians')
                                        {{ $anggota->anggota->nama_lengkap }} -
                                        {{ $anggota->anggota->jabatan ?? 'Tidak ada jabatan' }}
                                    @endif
                                @else
                                    Data anggota tidak ditemukan.
                                @endif
                            </li>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Anggota Penulis lainnya</th>
                    <td>
                        @if (!empty($penelitian->anggota_penulis_lainnya))
                            @foreach (array_filter(explode(',', $penelitian->anggota_penulis_lainnya)) as $anggota_lain)
                                <li>{{ $anggota_lain }}</li>
                            @endforeach
                        @else
                            <li>Tidak ada anggota lainnya.</li>
                        @endif
                    </td>
                </tr> 
                <tr>
                    <th>status produk</th>
                    <td>: {{ $penelitian->status }}</td>
                </tr>
                <tr>
                    <th>Abstrak</th>
                    <td style="white-space: normal; word-wrap: break-word;">{{ $penelitian->abstrak }}</td>
                </tr>
                <tr>
                    <th>Lampiran</th>
                    <td>: <a href={{ asset('storage/' . $penelitian->lampiran) }} class="" target="_blank">Lihat
                            Lampiran</a></td>
                </tr>
                {{-- <tr>
                    <th>Gambar</th>
                    <td>: <img src="{{ asset('storage/' . $penelitian->gambar) }}" alt="" style="max-width: 70%; height: auto"></td>
                </tr> --}}
                <tr>
                    <th>Tahun Publikasi</th>
                    <td>: {{ \Carbon\Carbon::parse($penelitian->tanggal_publikasi)->format('d-m-Y') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

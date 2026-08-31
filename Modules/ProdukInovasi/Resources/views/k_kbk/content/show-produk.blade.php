<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-2">
        <h5 class="card-header border-3 w-100 mb-2"><i class='bx bx-table me-2'></i>Data {{ $produk->nama_produk }}</h5>
        <img class="mx-auto d-block mb-5 mt-4" src="{{ asset('storage/' . $produk->gambar) }}" alt=""
            style="max-width: 50%; height: auto">
        <div class="table-responsive text-nowrap mt-4">
            <table class="table table-borderless">
                <tr>
                    <th>Nama Produk</th>
                    <td>: {{ $produk->nama_produk }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>: {{ $produk->deskripsi }}</td>
                </tr>
                <tr>
                    <th>Nama Inventor</th>
                    <td>: {{ $produk->inventor ?: $produk->inventor_lainnya }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: {{ $produk->email_inventor }}</td>
                </tr>
                <tr>
                    <th>Anggota Inventor</th>
                    <td>
                        @foreach ($produk->anggota as $anggota)
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
                    <th>Anggota Lainnya (Mahasiswa)</th>
                    <td>
                        @if (!empty($produk->anggota_inventor_lainnya))
                            @foreach (array_filter(explode(',', $produk->anggota_inventor_lainnya)) as $anggota_lain)
                                <li>{{ $anggota_lain }}</li>
                            @endforeach
                        @else
                            <li>Tidak ada anggota lainnya.</li>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Kelompok Keahlian</th>
                    <td>: {{ $produk->kelompokKeahlian ? $produk->kelompokKeahlian->nama_kbk : 'Tidak ada' }}</td>
                </tr>

                <tr>
                    <th>Lampiran</th>
                    <td>:
                        @if ($produk->lampiran)
                            <a href="{{ asset('storage/' . $produk->lampiran) }}" target="_blank">Lihat Lampiran</a>
                        @else
                            Tidak ada lampiran
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>: {{ $produk->status }}</td>
                </tr>
                <tr>
                    <th>Tanggal Submit</th>
                    <td>: {{ \Carbon\Carbon::parse($produk->tanggal_submit)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Granted</th>
                    <td>: {{ \Carbon\Carbon::parse($produk->tanggal_granted)->format('d-m-Y') }}</td>
                </tr>
            </table>


        </div>
    </div>
</div>

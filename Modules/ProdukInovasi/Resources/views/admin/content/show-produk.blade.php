<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-2">
        <h5 class="card-header border-3 w-100 mb-2"><i class='bx bx-table me-2'></i>Data {{ $produk->nama_produk }}</h5>
        <img class="mx-auto d-block mb-5 mt-4" src="{{ asset( 'storage/' . $produk->gambar) }}" alt="" style="max-width: 50%; height: auto">
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
                    <th>Inventor</th>
                    <td>: {{ $produk->inventor ?: $produk->inventor_lainnya}}</td>
                </tr>
                <tr>
                    <th>anggota inventor</th>
                    <td>@foreach ($produk->anggota as $anggota )
                        <li>{{ $anggota->detail->nama_lengkap }} - {{ $anggota->detail->jabatan }}</li>
                    @endforeach</td>
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
                    <th>status produk</th>
                    <td>: {{ $produk->status }}</td>
                </tr>
                <tr>
                    <th>Lampiran</th>
                    <td>: <a href={{ asset('storage/' . $produk->lampiran) }} class="" target="_blank">Lihat
                            Lampiran</a></td>
                </tr>
                {{-- <tr>
                    <th>Gambar</th>
                    <td>: <img src="{{ asset('storage/' . $produk->gambar) }}" alt="" style="max-width: 70%; height: auto"></td>
                </tr> --}}
                <tr>
                    <th>Tanggal Submit</th>
                    <td>:
                        {{ \Carbon\Carbon::parse($produk->tanggal_submit)->format('d-m-Y') }}
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Granted</th>
                    <td>:
                        {{ \Carbon\Carbon::parse($produk->tanggal_granted)->format('d-m-Y') }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

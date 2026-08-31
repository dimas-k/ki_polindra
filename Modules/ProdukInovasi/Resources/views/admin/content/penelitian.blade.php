<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-2">
        <h5 class="card-header"><i class='bx bx-table me-2'></i>Tabel Penelitian KBK {{ $kbk_navigasi1->nama_kbk }}</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Nama Penulis</th>
                        <th>Email Penulis</th>
                        <td>Tanggal Publikasi</td>
                        <th>STATUS</th>
                        <th>Aksi</th>
                        <th>Validasi</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                        $nomor = ($data_penelitian->currentPage() - 1) * $data_penelitian->perPage() + 1; // Menghitung nomor awal berdasarkan halaman
                    @endphp

                    @forelse ($data_penelitian as $p)
                        <tr>
                            <th scope="row">{{ $nomor++ }}</th>
                            <td>{{ $p->judul }}</td>
                            <td>{{ $p->kelompokKeahlian->nama_kbk }}</td>
                            <!-- Menampilkan nama kelompok keahlian dari relasi -->
                            <td>{{ $p->email_penulis }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_publikasi)->format('d-m-Y') }}</td>
                            <td>
                                @if ($p->status === 'Tervalidasi')
                                    <span class="badge bg-label-success me-1">{{ $p->status }}</span>
                                @else
                                    <span class="badge bg-label-warning me-1">{{ $p->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.show.penelitian', $p->id) }}" class="btn btn-sm btn-success">
                                    <i class='bx bxs-show'></i>
                                </a>
                            </td>
                            <td>
                                <form id="form-validasi-{{ $p->id }}"
                                    action="{{ route('validasi.penelitian', $p->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="checkbox" id="status_validasi-{{ $p->id }}" name="status"
                                        value="Tervalidasi" class="btn-checkbox bx bx-check"
                                        {{ $p->status == 'Tervalidasi' ? 'checked' : '' }}>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <img src="{{ asset('img/no-data.jpg') }}" style="width:15%; height:auto">
                                <p>Opss.. <br> <span class="fw-bold">Tidak ada data yang tersedia.</span></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-2">
                {{ $data_penelitian->links() }}
            </div>
        </div>
    </div>
</div>

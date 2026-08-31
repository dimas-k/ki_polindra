<div class="container-fluid flex-grow-1 container-p-y">
    <div class="card p-3 mt-4 mb-5">

        <div class="container">
            <h2>Laporan Produk dan Penelitian</h2>

            <!-- Form Filter -->
            <form method="GET" action="{{ route('report.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <label for="tahun_awal">Tahun Awal</label>
                        <input type="number" name="tahun_awal" id="tahun_awal" class="form-control"
                            placeholder="Contoh: 2020" value="{{ request('tahun_awal') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="tahun_akhir">Tahun Akhir</label>
                        <input type="number" name="tahun_akhir" id="tahun_akhir" class="form-control"
                            placeholder="Contoh: 2023" value="{{ request('tahun_akhir') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status_validasi">Status Validasi</label>
                        <select name="status_validasi" id="status_validasi" class="form-control">
                            <option value="">Semua</option>
                            <option value="Tervalidasi"
                                {{ request('status_validasi') == 'Tervalidasi' ? 'selected' : '' }}>Tervalidasi</option>
                            <option value="Belum Divalidasi"
                                {{ request('status_validasi') == 'Belum Divalidasi' ? 'selected' : '' }}>Belum
                                Divalidasi</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-3">Filter</button>
                        <a href="{{ route('report.index', array_merge(request()->all(), ['download' => 'Excel'])) }}"
                            class="btn btn-success ml-2">Unduh Excel</a>
                    </div>
                </div>
            </form>


            <!-- Tabel Data Produk -->
            <h3>Data Produk</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama KBK</th>
                            <th>Nama Produk</th>
                            <th>Inventor</th>
                            <th>Tanggal Submit</th>
                            <th>Tanggal Granted</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk_paginate as $p => $item)
                            <tr>
                                <td>{{ ($produk_paginate->currentPage() - 1) * $produk_paginate->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $item->kelompokKeahlian->nama_kbk ?? '-' }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->inventor ?: $item->inventor_lainnya }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_submit)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_granted)->format('d-m-Y') }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $produk_paginate->links() }} --}}
            </div>

            <!-- Tabel Data Penelitian -->
            <h3>Data Penelitian</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama KBK</th>
                            <th>Judul Penelitian</th>
                            <th>Penulis</th>
                            <th>Penulis Korespondensi</th>
                            <th>Tanggal Publikasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penelitian_paginate as $q => $item)
                            <tr>
                                <td>{{ ($penelitian_paginate->currentPage() - 1) * $penelitian_paginate->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $item->kelompokKeahlian->nama_kbk ?? '-' }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->penulis ?: $item->penulis_lainnya }}</td>
                                <td>{{ $item->penulis_korespondensi ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_publikasi)->format('d-m-Y') }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-4">
                    {{ $penelitian_paginate->links() }}
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="card p-3">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h4>Status Validasi Produk</h4>
                    <div id="produk-status-chart"></div>
                </div>
                <div class="col-md-6">
                    <h4>Status Validasi Penelitian</h4>
                    <div id="penelitian-status-chart"></div>
                </div>
            </div>

            <div class="row mt-4">
                <div id="gabungan-tahun-chart"></div>
                {{-- <div class="col-md-6">
                    <h4>Produk per Tahun</h4>
                    <div id="produk-tahun-chart"></div>
                </div>
                <div class="col-md-6">
                    <h4>Penelitian per Tahun</h4>
                    <div id="penelitian-tahun-chart"></div>
                </div> --}}
            </div>
        </div>

        <?php
        // Menggabungkan tahun dari produk dan penelitian menjadi satu array unik
        $tahun_kategori = array_unique(array_merge(array_keys($prdk_tahun->toArray()), array_keys($plt_tahun->toArray())));
        sort($tahun_kategori); // Urutkan tahun agar tampil berurutan
        ?>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Data untuk chart status produk
                var produkStatusOptions = {
                    chart: {
                        type: 'pie'
                    },
                    series: [{{ $prdk_valid }}, {{ $prdk_nonvalid }}],
                    labels: ['Tervalidasi', 'Belum Divalidasi'],
                    title: {
                        text: 'Status Validasi Produk'
                    }
                };
                var produkStatusChart = new ApexCharts(document.querySelector("#produk-status-chart"),
                    produkStatusOptions);
                produkStatusChart.render();

                // Data untuk chart status penelitian
                var penelitianStatusOptions = {
                    chart: {
                        type: 'pie'
                    },
                    series: [{{ $pnltan_valid }}, {{ $pnltan_nonvalid }}],
                    labels: ['Tervalidasi', 'Belum Divalidasi'],
                    title: {
                        text: 'Status Validasi Penelitian'
                    }
                };
                var penelitianStatusChart = new ApexCharts(document.querySelector("#penelitian-status-chart"),
                    penelitianStatusOptions);
                penelitianStatusChart.render();

                // Data untuk chart gabungan produk dan penelitian per tahun dengan area stacked
                var gabunganTahunOptions = {
                    chart: {
                        type: 'area',
                        height: 380,
                        // stacked: true
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    fill: {
                        opacity: 0.4
                    },
                    series: [{
                            name: 'Jumlah Produk',
                            data: {!! json_encode(array_values(array_replace(array_fill_keys($tahun_kategori, 0), $prdk_tahun->toArray()))) !!}
                        },
                        {
                            name: 'Jumlah Penelitian',
                            data: {!! json_encode(array_values(array_replace(array_fill_keys($tahun_kategori, 0), $plt_tahun->toArray()))) !!}
                        }
                    ],
                    xaxis: {
                        categories: {!! json_encode($tahun_kategori) !!}
                    },
                    yaxis: {
                        tickAmount: 4,
                        decimalsInFloat: 1
                    },
                    colors: ['#1E90FF', '#32CD32'],
                    title: {
                        text: 'Produk dan Penelitian per Tahun Berdasarkan Status Tervalidasi'
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left'
                    }
                };

                var gabunganTahunChart = new ApexCharts(document.querySelector("#gabungan-tahun-chart"),
                    gabunganTahunOptions);
                gabunganTahunChart.render();
            });
        </script>


    </div>

</div>

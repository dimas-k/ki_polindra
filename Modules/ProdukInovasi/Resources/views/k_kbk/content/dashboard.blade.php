<div class="container-fluid flex-grow-1 container-p-y">
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

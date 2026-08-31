<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.001s">
    <div class="container text-center py-5">
        <h1 class="display-4 text-white animated slideInDown mb-3">Katalog Produk Inovasi</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Katalog Produk Inovasi
                </li>
            </ol>
        </nav>
    </div>
</div>

<section class="site-section" id="section-resume">
    <div class="container">
        <div class="row">
            <!-- Bagian Produk -->
            <div class="container-fluid">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: auto;">
                    <h6 class="section-title bg-white text-center text-primary px-3">Katalog Produk</h6>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.1s">
                <div class="d-flex justify-content-end mb-5">
                    <form action="/dashboard/katalog/produk-inovasi/cari" method="post" class="row row-cols-lg-auto g-2 align-items-center">
                        @csrf
                        <div class="col-auto">
                            <label for="inputCariPaten" class="col-form-label">Cari Produk</label>
                        </div>
                        <div class="col">
                            <input type="search" id="inputCariPaten" class="form-control" name="cari_produk" placeholder="" style="min-width: 260px;">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">Cari</button>
                        </div>
                    </form>
                </div>
                
                <br><br>
                @foreach ($produk as $p)
                    <div class="col-12 d-flex flex-wrap align-items-start mb-4">
                        <div class="col-md-4 col-sm-12 mb-4">
                            <a href="{{ route('detail.produk', $p->nama_produk) }}"
                                class="link-underline link-underline-opacity-0">
                                <img src="{{ asset('storage/' . $p->gambar) }}"
                                    alt="gambar produk {{ $p->nama_produk }}" style="width:100%; height:auto;">
                            </a>
                        </div>
                        <div class="col-md-6 col-sm-12 ps-md-4">
                            <div>
                                <h3><a
                                        href="{{ route('detail.produk', ['nama_produk' => $p->nama_produk]) }}">{{ $p->nama_produk }}</a>
                                </h3>
                                <p class="text-panjang">{{ $p->deskripsi }}
                                    @if (strlen($p->deskripsi) > 200)
                                        <a href="{{ route('detail.produk', ['nama_produk' => $p->nama_produk]) }}"
                                            class="link-offset-3-hover link-underline-opacity-75-hover">...Selengkapnya</a>
                                    @endif
                                </p>
                                <p><strong>Tahun Granted:</strong>
                                    {{ \Carbon\Carbon::parse($p->tanggal_granted)->format('Y') }}</p>
                                <div class="article-meta-sm mt-2">
                                    <a class="link-secondary"
                                        href="{{ route('produk.dosen', ['dosen' => $p->inventor ?: $p->inventor_lainnya]) }}">
                                        {{ $p->inventor ?: $p->inventor_lainnya }}
                                    </a>
                                    <a class="link-secondary"
                                        href="{{ route('dashboard.penelitian', ['nama_kbk' => $p->kelompokKeahlian->nama_kbk]) }}">
                                        {{ $p->kelompokKeahlian->nama_kbk }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-end mt-3">
                    {{ $produk->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

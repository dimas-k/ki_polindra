<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.001s">
    <div class="container text-center py-5">
        <h1 class="display-4 text-white animated slideInDown mb-3">
            Produk & Penelitian
            @if ($anggota_kbk ?? $anggota_user)
                {{ $anggota_kbk->nama_lengkap ?? $anggota_user->nama_lengkap }}
            @elseif ($p_dosen && $p_dosen->isNotEmpty())
                {{ $dosen }}
            @elseif ($plt_dosen && $plt_dosen->isNotEmpty())
                {{ $dosen }}
            @else
                {{ $dosen }}
            @endif
        </h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">
                    Produk dan Penelitian
                    @if ($anggota_kbk ?? $anggota_user)
                        {{ $anggota_kbk ?? $anggota_user->nama_lengkap }}
                    @elseif ($p_dosen && $p_dosen->isNotEmpty())
                        {{ $dosen }}
                    @elseif ($plt_dosen && $plt_dosen->isNotEmpty())
                        {{ $dosen }}
                    @else
                        {{ $dosen }}
                    @endif
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
                    <h6 class="section-title bg-white text-center text-primary px-3">Produk</h6>
                </div>
            </div>

            <div class="wow fadeInUp" data-wow-delay="0.1s">
                @if ($p_dosen && $p_dosen->isNotEmpty())
                    @foreach ($p_dosen as $g_produk)
                        <div class="col-12 d-flex flex-wrap align-items-start mb-4">
                            <div class="col-md-4 col-sm-12 mb-4">
                                <a href="{{ route('detail.produk', $g_produk->nama_produk) }}"
                                    class="link-underline link-underline-opacity-0">
                                    <img src="{{ asset('storage/' . $g_produk->gambar) }}"
                                        alt="gambar produk {{ $g_produk->nama_produk }}"
                                        style="width:100%; height:auto;">
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12 ps-md-4">
                                <div>
                                    <h3>
                                        <a
                                            href="{{ route('detail.produk', ['nama_produk' => $g_produk->nama_produk]) }}">
                                            {{ $g_produk->nama_produk }}
                                        </a>
                                    </h3>
                                    <p class="text-panjang">{{ $g_produk->deskripsi }}
                                        @if (strlen($g_produk->deskripsi) > 200)
                                            <a href="{{ route('detail.produk', ['nama_produk' => $g_produk->nama_produk]) }}"
                                                class="link-offset-3-hover link-underline-opacity-75-hover">...Selengkapnya</a>
                                        @endif
                                    </p>
                                    <p><strong>Tahun Granted:</strong>
                                        {{ \Carbon\Carbon::parse($g_produk->tanggal_granted)->format('Y') }}</p>
                                    <div class="article-meta-sm mt-2">
                                        <a class="link-secondary"
                                            href="{{ route('dashboard.penelitian', ['nama_kbk' => $g_produk->kelompokKeahlian->nama_kbk]) }}">
                                            {{ $g_produk->kelompokKeahlian->nama_kbk }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- {{ $p_dosen->appends(request()->except('page'))->links() }} --}}
                @else
                    <p class="text-center mb-5">Tidak Ada Produk</p>
                @endif

            </div>
        </div>
    </div>
</section>
<br><br>
<section class="site-section" id="section-resume">
    <div class="container">
        <div class="row">
            <!-- Bagian Penelitian -->
            <div class="container-fluid">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: auto;">
                    <h6 class="section-title bg-white text-center text-primary px-3">Penelitian</h6>
                </div>
            </div>

            <div class="wow fadeInUp" data-wow-delay="0.1s">
                @if ($plt_dosen && $plt_dosen->isNotEmpty())
                    @foreach ($plt_dosen as $g_penelitian)
                        <div class="col-12 d-flex flex-wrap align-items-start mb-4">
                            <div class="col-md-4 col-sm-12 mb-4">
                                <a href="{{ route('detail.penelitian', $g_penelitian->judul) }}"
                                    class="link-underline link-underline-opacity-0">
                                    <img src="{{ asset('storage/' . $g_penelitian->gambar) }}"
                                        alt="gambar penelitian {{ $g_penelitian->judul }}"
                                        style="width:100%; height:auto;">
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12 ps-md-4">
                                <div>
                                    <h3><a
                                            href="{{ route('detail.penelitian', ['judul' => $g_penelitian->judul]) }}">{{ $g_penelitian->judul }}</a>
                                    </h3>
                                    <p class="text-panjang">{{ $g_penelitian->abstrak }}
                                        @if (strlen($g_penelitian->abstrak) > 200)
                                            <a href="{{ route('detail.produk', ['nama_produk' => $g_penelitian->judul]) }}"
                                                class="link-offset-3-hover link-underline-opacity-75-hover">...Selengkapnya</a>
                                        @endif
                                    </p>
                                    <p><strong>Tahun Publikasi:</strong>
                                        {{ \Carbon\Carbon::parse($g_penelitian->tanggal_publikasi)->format('Y') }}</p>
                                    <div class="article-meta-sm mt-2">
                                        <a class="link-secondary"
                                            href="{{ route('dashboard.penelitian', ['nama_kbk' => $g_penelitian->kelompokKeahlian->nama_kbk]) }}">
                                            {{ $g_penelitian->kelompokKeahlian->nama_kbk }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center mb-5">Tidak Ada Penelitian</p>
                @endif
                <div class="d-flex justify-content-end mt-2">
                    {{ $plt_dosen->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

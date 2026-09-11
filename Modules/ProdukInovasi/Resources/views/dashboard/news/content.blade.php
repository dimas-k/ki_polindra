<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.001s">
    <div class="container text-center py-5">
        <h1 class="display-4 text-white animated slideInDown mb-3">Berita &amp; Artikel</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="/dproin-polindra">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Berita</li>
            </ol>
        </nav>
    </div>
</div>

<section class="site-section" id="section-resume">
    <div class="container">
        <div class="container-fluid">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: auto;">
                <h6 class="section-title bg-white text-center text-primary px-3">Berita &amp; Artikel</h6>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-8 mb-2">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('news.index') }}"
                        class="btn btn-sm {{ empty($kategori) ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
                    @foreach ($kategoriList as $k)
                        <a href="{{ route('news.index', ['kategori' => $k]) }}"
                            class="btn btn-sm {{ $kategori == $k ? 'btn-primary' : 'btn-outline-primary' }}">{{ $k }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <form action="{{ route('news.index') }}" method="GET" class="d-flex">
                    @if ($kategori)
                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                    @endif
                    <input type="search" name="cari" class="form-control me-2" placeholder="Cari berita..."
                        value="{{ $cari }}">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="row">
            @forelse ($news as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <a href="{{ route('news.show', $item->slug) }}">
                            <img src="{{ $item->gambar_sampul ? asset('storage/' . $item->gambar_sampul) : asset('assets/gedung.jpg') }}"
                                class="card-img-top hover-animate" alt="{{ $item->judul }}"
                                style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary mb-2 align-self-start">{{ $item->kategori }}</span>
                            <h5 class="card-title">
                                <a href="{{ route('news.show', $item->slug) }}"
                                    class="text-dark text-decoration-none">{{ $item->judul }}</a>
                            </h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ \Illuminate\Support\Str::limit($item->ringkasan ?: strip_tags($item->konten), 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                                <a href="{{ route('news.show', $item->slug) }}"
                                    class="btn btn-sm btn-outline-primary">Baca</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted py-5">Belum ada berita untuk saat ini.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $news->links() }}
        </div>
    </div>
</section>

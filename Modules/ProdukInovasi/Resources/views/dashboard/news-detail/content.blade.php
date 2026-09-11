<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.001s">
    <div class="container text-center py-5">
        <h1 class="display-5 text-white animated slideInDown mb-3">{{ $berita->judul }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="/dproin-polindra">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('news.index') }}">Berita</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">{{ $berita->judul }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="site-section" id="section-resume">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <span class="badge bg-primary mb-3">{{ $berita->kategori }}</span>
                <p class="text-muted mb-4">
                    <i class="bi bi-calendar3 me-1"></i>{{ $berita->created_at->translatedFormat('d F Y') }}
                    @if ($berita->author)
                        &nbsp;|&nbsp;<i class="bi bi-person me-1"></i>{{ $berita->author->nama_lengkap }}
                    @endif
                </p>

                @if ($berita->gambar_sampul)
                    <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="{{ $berita->judul }}"
                        class="img-fluid rounded mb-4" style="width: 100%; max-height: 420px; object-fit: cover;">
                @endif

                <div class="news-content" style="line-height: 1.8; font-size: 1.05rem;">
                    {!! nl2br(e($berita->konten)) !!}
                </div>

                <a href="{{ route('news.index') }}" class="btn btn-outline-primary mt-4">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Berita
                </a>
            </div>

            <div class="col-lg-4">
                <h6 class="section-title text-primary mb-4">Berita Terkait</h6>
                @forelse ($terkait as $t)
                    <div class="d-flex mb-3">
                        <a href="{{ route('news.show', $t->slug) }}" class="me-3 flex-shrink-0">
                            <img src="{{ $t->gambar_sampul ? asset('storage/' . $t->gambar_sampul) : asset('assets/gedung.jpg') }}"
                                alt="{{ $t->judul }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px;">
                        </a>
                        <div>
                            <a href="{{ route('news.show', $t->slug) }}"
                                class="text-dark text-decoration-none fw-semibold small">{{ $t->judul }}</a>
                            <p class="text-muted mb-0" style="font-size: 0.8rem;">
                                {{ $t->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted small">Belum ada berita terkait lainnya.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

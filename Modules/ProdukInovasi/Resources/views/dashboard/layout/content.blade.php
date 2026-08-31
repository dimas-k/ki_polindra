<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1">
                <img class="img-fluid" src="{{ asset('assets/gedung.jpg') }}" alt="Image">
            </button>
            @foreach ($produk->take(3)->merge($pusat_penelitian->take(3)) as $index => $item)
                <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="{{ $index + 1 }}"
                    aria-label="Slide {{ $index + 2 }}">
                    <img class="img-fluid" src="{{ asset('storage/' . $item->gambar) }}" alt="Image">
                </button>
            @endforeach
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('assets/gedung.jpg') }}" alt="Image">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-4 animated zoomIn">Dashboard Produk Inovasi dan
                            Penelitian</h4>
                        <h1 class="display-1 text-white mb-0 animated zoomIn">POLITEKNIK NEGERI INDRAMAYU
                        </h1>
                    </div>
                </div>
            </div>
            @foreach ($produk->take(3)->merge($pusat_penelitian->take(3)) as $index => $item)
                <div class="carousel-item {{ $index + 1 }}">
                    <img class="w-100" src="{{ asset('storage/' . $item->gambar) }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-4 animated zoomIn">Dashboard Produk Inovasi dan
                                Penelitian</h4>
                            <h1 class="display-1 text-white mb-0 animated zoomIn">POLITEKNIK NEGERI INDRAMAYU</h1>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

<!-- Facts Start -->
<div class="container-xxl py-5 ">
    <div class="container">
        <div class="row g-4 d-flex justify-content-center align-items-center">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="fact-item bg-light rounded text-center h-100 p-5">
                    <i class="fa fa-search fa-4x text-primary mb-4"></i>
                    <h5 class="mb-3">Kelompok Bidang Keahlian</h5>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">
                        {{ $jumlah_kbk }}
                    </h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="fact-item bg-light rounded text-center h-100 p-5">
                    <i class="fa fa-archive fa-4x text-primary mb-4"></i>
                    <h5 class="mb-3">Produk Inovasi</h5>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">
                        {{ $jumlah_produk }}
                    </h1>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="fact-item bg-light rounded text-center h-100 p-5">
                    <i class="fa fa-cogs fa-4x text-primary mb-4"></i>
                    <h5 class="mb-3">Penelitian</h5>
                    <h1 class="display-5 mb-0" data-toggle="counter-up">
                        {{ $jumlah_pusat_penelitian }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->

<!-- Project Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Produk Inovasi</h6>
            <h1 class="display-6 mb-4">Produk Unggulan</h1>
        </div>
        <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach ($produk_terbaru as $p)
                <a href="{{ route('detail.produk', $p->nama_produk) }}">
                    <div class="project-item-new border rounded h-100 p-4" data-dot="{{ $loop->iteration }}">
                        <div class="position-relative mb-4">
                            <img class="img-fluid rounded" src="{{ asset('storage/' . $p->gambar) }}"
                                alt="Gambar Produk {{ $p->id }}">
                        </div>
                        <h6>{{ $p->nama_produk }}</h6>

                    </div>
                </a>
            @endforeach

        </div>
    </div>
</div>
<!-- Project End -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Penelitian</h6>
            <h1 class="display-6 mb-4">Penelitian Terbaru</h1>
        </div>
        <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach ($penelitian_terbaru as $p)
                <a href="{{ route('detail.penelitian', $p->judul) }}">
                    <div class="project-item-new border rounded h-100 p-4" data-dot="{{ $loop->iteration }}">
                        <div class="position-relative mb-4">
                            <img class="img-fluid rounded" src="{{ asset('storage/' . $p->gambar) }}"
                                alt="Gambar Produk {{ $p->id }}">
                        </div>
                        <h6>{{ $p->judul }}</h6>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</div>


<!-- Testimonial Start -->
{{-- <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
            <h1 class="display-6 mb-4">Pusat Penelitian</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item bg-light rounded p-4">
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1" src="img/testimonial-1.jpg" alt="">
                    <div class="ms-4">
                        <h5 class="mb-1">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                    eos. Clita erat ipsum et lorem et sit.</p>
            </div>
            <div class="testimonial-item bg-light rounded p-4">
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1" src="img/testimonial-2.jpg" alt="">
                    <div class="ms-4">
                        <h5 class="mb-1">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                    eos. Clita erat ipsum et lorem et sit.</p>
            </div>
            <div class="testimonial-item bg-light rounded p-4">
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1" src="img/testimonial-3.jpg" alt="">
                    <div class="ms-4">
                        <h5 class="mb-1">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                    eos. Clita erat ipsum et lorem et sit.</p>
            </div>
            <div class="testimonial-item bg-light rounded p-4">
                <div class="d-flex align-items-center mb-4">
                    <img class="flex-shrink-0 rounded-circle border p-1" src="img/testimonial-4.jpg" alt="">
                    <div class="ms-4">
                        <h5 class="mb-1">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et
                    eos. Clita erat ipsum et lorem et sit.</p>
            </div>
        </div>
    </div>
</div> --}}
<!-- Testimonial End -->

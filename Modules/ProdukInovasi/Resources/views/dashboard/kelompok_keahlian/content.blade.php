<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.01s">
    <div class="container text-center py-5">
        <h1 class="display-4 text-white animated slideInDown mb-3">Kelompok Bidang Keahlian</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">{{ $kkbk->nama_kbk }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<section class="site-section " id="section-resume">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h6 class="section-title bg-white text-center text-primary px-3">Kelompok Bidang Keahlian</h6>
                    <h1 class="display-6 mb-4">
                        {{ $kkbk->nama_kbk ?? '' }}
                    </h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="resume-item mb-4 shadow">
                    <strong>Deskripsi {{ $kkbk->nama_kbk }}</strong><br>
                    <p>{!! $kkbk->deskripsi ?? '' !!}</p>
                    <br>
                    <strong>Anggota {{ $kkbk->nama_kbk }}</strong><br>
                    @foreach ($anggota_kbk as $anggota)
                        <ul style="margin: 0; padding-left: 30px;">
                            <li style="margin-bottom: 5px;">
                                <a href="{{ route('produk.dosen', ['dosen' => $anggota->nama_lengkap]) }}">
                                    {{ $anggota->nama_lengkap }}
                                </a>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>

            <div class="col-md-6">

                <div class="mb-8">
                    {{-- <span class="date"><span class="icon-calendar"></span> March 2013 - Present</span> --}}
                    {{-- <h3>Lead Product Designer</h3> --}}
                    <div class="row g-4 ">
                        <div class="col-lg-5 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item text-center rounded overflow-hidden shadow">

                                <div class="m-4">
                                    <img class="img-fluid" src={{ $kkbk->pas_foto && file_exists(public_path('storage/' . $kkbk->pas_foto)) ? asset('storage/' . $kkbk->pas_foto) : asset('assets/foto_user_default.png') }} alt="">
                                </div>
                                <h5 class="mb-0">
                                    <a href="{{ route('produk.dosen', ['dosen' => $kkbk->nama_lengkap]) }}">
                                        {{ $kkbk->nama_lengkap ?? '' }}
                                    </a>
                                </h5>

                                <small>Ketua {{ $kkbk->nama_kbk }}</small>
                                <div class="d-flex justify-content-center mt-3">
                                    <a class="btn btn-square btn-primary mx-1" href="mailto:{{ $kkbk->email }}"><i
                                            class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- .section -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Produk Keahlian</h6>
            {{-- <h1 class="display-6 mb-4">Penelitian Terbaru</h1> --}}
        </div>
        <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
            @php
                $uniqueProducts = $data_produk->unique('id_produks');
            @endphp
            @foreach ($uniqueProducts as $p)
                <a href="{{ route('detail.produk', $p->nama_produks) }}">
                    <div class="project-item-new border rounded h-100 p-4" data-dot="{{ $loop->iteration }}">
                        <div class="position-relative mb-4">
                            <img class="img-fluid rounded" src="{{ asset('storage/' . $p->gambar) }}"
                                alt="Gambar Produk">

                        </div>
                        <h6>{{ $p->nama_produks }}</h6>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Penelitian</h6>
            {{-- <h1 class="display-6 mb-4">Penelitian Terbaru</h1> --}}
        </div>
        <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach ($data_penelitian as $plt)
                <a href="{{ route('detail.penelitian', $plt->judul) }}">
                    <div class="project-item-new border rounded h-100 p-4" data-dot="{{ $loop->iteration }}">
                        <div class="position-relative mb-4">
                            <img class="img-fluid rounded" src="{{ asset('storage/' . $plt->gambar) }}"
                                alt="Gambar Produk">
                        </div>
                        <h6>{{ $plt->judul }}</h6>

                    </div>
                </a>
            @endforeach

        </div>
    </div>
</div>
<!-- .section -->

<!-- Project Start -->
{{-- <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Our Projects</h6>
            <h1 class="display-6 mb-4">Learn More About Our Complete Projects</h1>
        </div>
        <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="project-item border rounded h-100 p-4" data-dot="01">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-1.jpg') }} alt="">
                    <a href="img/project-1.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
            <div class="project-item border rounded h-100 p-4" data-dot="02">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-2.jpg') }} alt="">
                    <a href="img/project-2.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
            <div class="project-item border rounded h-100 p-4" data-dot="03">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-3.jpg') }} alt="">
                    <a href="img/project-2.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
            <div class="project-item border rounded h-100 p-4" data-dot="04">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-4.jpg') }} alt="">
                    <a href="img/project-4.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
            <div class="project-item border rounded h-100 p-4" data-dot="05">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-5.jpg') }} alt="">
                    <a href="img/project-5.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
            <div class="project-item border rounded h-100 p-4" data-dot="06">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-6.jpg') }} alt="">
                    <a href="img/project-6.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
            <div class="project-item border rounded h-100 p-4" data-dot="07">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-7.jpg') }} alt="">
                    <a href="img/project-7.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
            <div class="project-item border rounded h-100 p-4" data-dot="08">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-8.jpg') }} alt="">
                    <a href="img/project-8.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
            <div class="project-item border rounded h-100 p-4" data-dot="09">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-9.jpg') }} alt="">
                    <a href="img/project-9.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
            <div class="project-item border rounded h-100 p-4" data-dot="10">
                <div class="position-relative mb-4">
                    <img class="img-fluid rounded" src={{ URL('img/roject-10.jpg') }} alt="">
                    <a href="img/project-10.jpg" data-lightbox="project"><i class="fa fa-eye fa-2x"></i></a>
                </div>
                <h6>UI / UX Design</h6>
                <span>Digital agency website design and development</span>
            </div>
        </div>
    </div>
</div> --}}
<!-- Project End -->

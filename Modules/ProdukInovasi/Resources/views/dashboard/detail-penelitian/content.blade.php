<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.001s">
    <div class="container text-center py-5">
        <h1 class="display-4 text-white animated slideInDown mb-3">Penelitian</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white"
                        href="{{ route('dashboard.penelitian', ['nama_kbk' => $penelitian->KelompokKeahlian->nama_kbk]) }}">{{ $penelitian->KelompokKeahlian->nama_kbk }}</a>
                </li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Produk {{ $penelitian->judul }}
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<section class="site-section " id="section-resume">
    <div class="container">
        <div class="row">
            <div class="container-fluid">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: auto;">
                    <h6 class="section-title bg-white text-center text-primary px-3">Penelitian Kelompok Bidang Keahlian
                    </h6>
                    <h1 class="display-6 mb-5">{{ $penelitian->judul }}</h1>
                    <img src="{{ asset('storage/' . $penelitian->gambar) }}" class=" img-fluid mt-5 mb-3" alt="gambar"
                        style="width: 50%; height:auto">
                </div>
            </div>
            <!-- Kolom Kiri -->
            <div class="col-12 col-md-6">
                <div class="resume-item mb-2">
                    <h2 class="resume mb-5">{{ $penelitian->judul }}</h2>
                    <strong class="">Abstrak Penelitian</strong> <br>
                    <p class="mt-1">{{ $penelitian->abstrak }}</p>
                    <strong>Tahun publikasi</strong> <br>
                    <p class="mt-1">Tahun {{ \Carbon\Carbon::parse($penelitian->tanggal_publikasi)->format('Y') }}</p>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="resume-item mb-2">
                    <strong>Tim Inventor</strong> <br><br><br>
                    <p class="mb-1"><strong>Penulis : </strong><a
                            href="{{ route('produk.dosen', ['dosen' => $penelitian->penulis ?: $penelitian->penulis_lainnya]) }}">
                            {{ $penelitian->penulis ?: $penelitian->penulis_lainnya }}</a></p>
                    <p class="mb-1"><strong>Penulis Korespondensi : </strong><a
                            href="{{ route('produk.dosen', ['dosen' => $penelitian->penulis_korespondensi ]) }}">
                            {{ $penelitian->penulis_korespondensi }}</a></p>
                    <br>
                    <p class="mb-1"><strong>Anggota : </strong></p>

                    @foreach ($penelitian->anggotaPenelitian as $anggota)
                            @if ($anggota->anggota)
                                <li><a
                                        href="{{ route('produk.dosen', ['dosen' => $anggota->anggota->nama_lengkap]) }}">
                                        {{ $anggota->anggota->nama_lengkap }} - {{ $anggota->anggota->jabatan }}</a>
                                </li>
                            @else
                                <li>Anggota tidak ditemukan</li>
                            @endif
                        @endforeach
                    </ul>
                    <br>
                    @if (!empty($penelitian->anggota_penulis_lainnya))
                        <p class="mb-1"><strong>Mahasiswa Atau Pihak Lain Yang Terlibat:</strong></p>
                        <ul>
                            @foreach ($penelitian->anggota_penulis_lainnya_array as $anggota_lain)
                                <li>
                                    <a
                                        href="{{ route('produk.dosen', ['dosen' => trim($anggota_lain)]) }}">{{ $anggota_lain }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <a class="btn btn-success p-3 mt-4" href="mailto:{{ $penelitian->email_penulis }}">
                        <i class="bi bi-envelope me-2"></i>Hubungi penulis
                    </a>
                </div>
            </div>


        </div>

    </div>
</section> <!-- .section -->

<div class="article-meta">
    <div><a href="{{ route('produk.dosen', $penelitian->penulis ?: $penelitian->penulis_lainnya) }}"
            class="link-secondary link-underline link-underline-opacity-0">By {{ $penelitian->penulis ?: $penelitian->penulis_lainnya }}</a></div>
    <div>{{ $penelitian->kelompokKeahlian->nama_kbk }}</div>
</div>

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

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.001s">
    <div class="container text-center py-5">
        <h1 class="display-4 text-white animated slideInDown mb-3">Karya Kekayaan Intelektual</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Karya Kekayaan Intelektual
                </li>
            </ol>
        </nav>
    </div>
</div>

<section class="site-section" id="section-resume">
    <div class="container">

        <p class="text-muted mb-5 text-center">
            Menampilkan karya Paten, Hak Cipta, dan Desain Industri yang sudah berstatus final
            (Diberi / Tercatat).
        </p>

        {{-- ===== PATEN ===== --}}
        <div class="mb-5">
            <div class="text-center mx-auto mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Paten</h6>
            </div>

            @if ($paten->isEmpty())
                <p class="text-center text-muted">Belum ada data paten yang tersedia.</p>
            @else
                <div class="row g-4">
                    @foreach ($paten as $p)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('assets/gedung.jpg') }}" class="card-img-top"
                                    alt="{{ $p->judul_paten }}" style="height: 180px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <span class="badge bg-primary mb-2 align-self-start">{{ $p->jenis_paten }}</span>
                                    <h5 class="card-title text-panjang">{{ $p->judul_paten }}</h5>
                                    <p class="card-text text-muted mb-1"><small>{{ $p->nama_lengkap }}</small></p>
                                    <p class="card-text text-muted mb-3">
                                        <small>{{ $p->prodi->nama_prodi ?? '-' }} &middot; {{ $p->prodi->jurusan->nama_jurusan ?? '-' }}</small>
                                    </p>
                                    <div class="mt-auto d-flex flex-wrap gap-2">
                                        @if ($p->abstrak_paten)
                                            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($p->abstrak_paten) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Abstrak</a>
                                        @endif
                                        @if ($p->gambar_paten)
                                            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($p->gambar_paten) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat Dokumen</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ===== HAK CIPTA ===== --}}
        <div class="mb-5">
            <div class="text-center mx-auto mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Hak Cipta</h6>
            </div>

            @if ($hakCipta->isEmpty())
                <p class="text-center text-muted">Belum ada data hak cipta yang tersedia.</p>
            @else
                <div class="row g-4">
                    @foreach ($hakCipta as $hc)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('assets/gedung.jpg') }}" class="card-img-top"
                                    alt="{{ $hc->judul_ciptaan }}" style="height: 180px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <span class="badge bg-primary mb-2 align-self-start">{{ $hc->jenis_ciptaan }}</span>
                                    <h5 class="card-title text-panjang">{{ $hc->judul_ciptaan }}</h5>
                                    <p class="card-text text-panjang">
                                        {{ \Illuminate\Support\Str::limit($hc->uraian_singkat, 120) }}
                                    </p>
                                    <p class="card-text text-muted mb-1"><small>{{ $hc->nama_lengkap }}</small></p>
                                    <p class="card-text text-muted mb-3">
                                        <small>{{ $hc->prodi->nama_prodi ?? '-' }} &middot; {{ $hc->prodi->jurusan->nama_jurusan ?? '-' }}</small>
                                    </p>
                                    <div class="mt-auto">
                                        @if ($hc->dokumen_invensi)
                                            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($hc->dokumen_invensi) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat Dokumen</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ===== DESAIN INDUSTRI ===== --}}
        <div class="mb-5">
            <div class="text-center mx-auto mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Desain Industri</h6>
            </div>

            @if ($desainIndustri->isEmpty())
                <p class="text-center text-muted">Belum ada data desain industri yang tersedia.</p>
            @else
                <div class="row g-4">
                    @foreach ($desainIndustri as $di)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('assets/gedung.jpg') }}" class="card-img-top"
                                    alt="{{ $di->judul_di }}" style="height: 180px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <span class="badge bg-primary mb-2 align-self-start">Desain Industri</span>
                                    <h5 class="card-title text-panjang">{{ $di->judul_di }}</h5>
                                    <p class="card-text text-muted mb-1"><small>{{ $di->nama_lengkap }}</small></p>
                                    <p class="card-text text-muted mb-3">
                                        <small>{{ $di->prodi->nama_prodi ?? '-' }} &middot; {{ $di->prodi->jurusan->nama_jurusan ?? '-' }}</small>
                                    </p>
                                    <div class="mt-auto d-flex flex-wrap gap-2">
                                        @if ($di->gambar_di)
                                            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($di->gambar_di) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Gambar Desain</a>
                                        @endif
                                        @if ($di->uraian_di)
                                            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($di->uraian_di) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat Uraian</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</section>

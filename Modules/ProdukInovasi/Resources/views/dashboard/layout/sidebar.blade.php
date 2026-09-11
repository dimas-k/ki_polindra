<nav class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="#" class="navbar-brand ms-3 d-lg-none">MENU</a>
    <button type="button" class="navbar-toggler me-3" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav d-flex w-100 p-3 p-lg-0">
            <a href="{{ url('/dproin-polindra') }}"
                class="nav-item nav-link {{ Request::is('dproin-polindra') ? 'active' : '' }}">Home</a>
            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ Request::is('dproin-polindra/kelompok-bidang-keahlian/*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown">Kelompok Bidang Keahlian</a>
                <div class="dropdown-menu border-0 rounded-0 rounded-bottom m-0">
                    @foreach ($kbk as $i)
                        <a href="{{ route('dashboard.penelitian', $i->nama_kbk) }}"
                            class="dropdown-item {{ Request::is('dproin-polindra/kelompok-bidang-keahlian/' . $i->nama_kbk) ? 'active' : '' }}">
                            {{ $i->nama_kbk }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ Request::is('dproin-polindra/katalog/*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown">Katalog Produk & Penelitian</a>
                <div class="dropdown-menu border-0 rounded-0 rounded-bottom m-0">
                    <a href="/dproin-polindra/katalog/produk-inovasi"
                        class="dropdown-item {{ Request::is('dproin-polindra/katalog/produk-inovasi') ? 'active' : '' }}">
                        Produk Inovasi
                    </a>
                    <a href="/dproin-polindra/katalog/penelitian"
                        class="dropdown-item {{ Request::is('dproin-polindra/katalog/penelitian') ? 'active' : '' }}">
                        Penelitian
                    </a>
                </div>
            </div>
            {{-- <a href="{{ route('karya-intelektual.index') }}" class="nav-item nav-link {{ Request::is('dproin-polindra/karya-intelektual') ? 'active' : '' }}">Karya Kekayaan Intelektual</a> --}}
            <a href="{{ route('news.index') }}"
                class="nav-item nav-link {{ Request::is('dproin-polindra/berita*') ? 'active' : '' }}">Berita</a>
            <a href="/dproin-polindra/kontak"
                class="nav-item nav-link {{ Request::is('dproin-polindra/kontak') ? 'active' : '' }}">Kontak Kami</a>
            <a href="/login" class="nav-item nav-link {{ Request::is('login') ? 'active' : '' }}"
                target="_blank">Login</a>
        </div>
    </div>
</nav>

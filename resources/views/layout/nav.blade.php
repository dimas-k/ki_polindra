<style>
    :root {
        --polindra-navy: #002a57;
        --polindra-blue: #003d7a;
        --polindra-line: rgba(255, 255, 255, 0.14);
    }

    .siki-navbar {
        background-color: var(--polindra-navy);
        border-bottom: 1px solid var(--polindra-line);
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .siki-navbar .container {
        display: flex;
        justify-content: flex-start !important;
        align-items: center;
    }

    .siki-brand {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .siki-brand img {
        height: 44px;
        width: 44px;
        object-fit: contain;
        flex-shrink: 0;
        margin-right: 10px;
    }

    .siki-brand-text {
        color: #fff;
        line-height: 1.3;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .siki-brand-text .siki-brand-title {
        display: block;
        font-size: 0.92rem;
        font-weight: 600;
    }

    .siki-brand-text .siki-brand-sub {
        display: block;
        font-size: 0.74rem;
        color: #b9c9dd;
        font-weight: 400;
    }

    .siki-navbar .navbar-toggler {
        flex-shrink: 0;
        margin-left: auto !important;
        border-color: var(--polindra-line);
    }

    .siki-navbar .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.85)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .siki-navbar .navbar-collapse {
        flex-basis: 100%;
        flex-grow: 1;
    }

    .siki-nav-link {
        color: #d7e2f0 !important;
        font-size: 0.88rem;
        font-weight: 500;
        padding: 8px 14px !important;
        margin: 0 2px;
        border-radius: 6px;
        border-bottom: 2px solid transparent;
    }

    .siki-nav-link:hover,
    .siki-nav-link:focus {
        color: #fff !important;
        background-color: rgba(255, 255, 255, 0.08);
    }

    .siki-nav-link.active {
        color: #fff !important;
        border-bottom: 2px solid #fff;
    }

    .siki-navbar .dropdown-menu {
        border: 1px solid #e3ebf3;
        border-radius: 8px;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
        padding: 6px;
        margin-top: 8px;
    }

    .siki-navbar .dropdown-item {
        font-size: 0.86rem;
        color: #33465c;
        border-radius: 6px;
        padding: 8px 12px;
    }

    .siki-navbar .dropdown-item:hover,
    .siki-navbar .dropdown-item:focus {
        background-color: #eef4fb;
        color: var(--polindra-blue);
    }

    .siki-login-btn {
        color: var(--polindra-navy) !important;
        background-color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        border-radius: 6px;
        padding: 7px 18px !important;
        margin-left: 6px;
    }

    .siki-login-btn:hover {
        background-color: #d7e2f0;
        color: var(--polindra-navy) !important;
    }

    /* Penyesuaian untuk tampilan kecil */
    @media (max-width: 991px) {
        .siki-navbar .navbar-collapse {
            margin-top: 12px;
            border-top: 1px solid var(--polindra-line);
            padding-top: 10px;
        }

        .siki-nav-link {
            margin: 2px 0;
        }

        .siki-nav-link.active {
            border-bottom: none;
            background-color: rgba(255, 255, 255, 0.08);
        }

        .siki-login-btn {
            display: inline-block;
            margin-top: 6px;
        }
    }

    @media (max-width: 480px) {
        .siki-brand-text .siki-brand-title {
            font-size: 0.8rem;
        }

        .siki-brand-text .siki-brand-sub {
            font-size: 0.68rem;
        }

        .siki-brand img {
            height: 38px;
            width: 38px;
        }
    }
</style>

<nav class="navbar navbar-expand-lg siki-navbar fixed-top">
    <div class="container">
        <a class="siki-brand" href="/">
            <img src="{{ asset('assets/logo-polindra.png') }}" alt="Logo Politeknik Negeri Indramayu">
            <span class="siki-brand-text">
                <span class="siki-brand-title">Sistem Informasi Kekayaan Intelektual</span>
                <span class="siki-brand-sub">Politeknik Negeri Indramayu</span>
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link siki-nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link siki-nav-link {{ request()->is('paten*') ? 'active' : '' }}"
                        href="/paten">Paten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link siki-nav-link {{ request()->is('hak-cipta*') ? 'active' : '' }}"
                        href="/hak-cipta">Hak Cipta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link siki-nav-link {{ request()->is('desain-industri*') ? 'active' : '' }}"
                        href="/desain-industri">Desain Industri</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link siki-nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Tentang SIKI
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="/visi-misi">Visi dan Misi P3M</a></li>
                        <li><a class="dropdown-item" href="/struktur-organisasi">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="/panduan">Panduan</a></li>
                        <li><a class="dropdown-item" href="/disclaimer">Disclaimer</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="siki-login-btn" href="/login" target="_blank">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
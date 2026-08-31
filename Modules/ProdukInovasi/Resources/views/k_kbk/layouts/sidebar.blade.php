<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets-admin/img/logo-item-bg.png') }}" alt=""
                    style="width: 110px; heigh: 50px">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->

        <li class="menu-item">
            <a href="/k-kbk/dashboard" class="menu-link {{ Request::is('k-kbk/dashboard') ? 'active bg-light' : '' }}">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/k-kbk/anggota-kbk" class="menu-link {{ Request::is('k-kbk/anggota-kbk') ? 'active bg-light' : '' }}">
                <i class="menu-icon tf-icons bx bxs-user"></i>
                <div class="text-truncate" data-i18n="Dashboard">Anggota KBK</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/k-kbk/produk" class="menu-link {{ Request::is('k-kbk/produk') ? 'active bg-light' : '' }}">
                <i class='menu-icon tf-icons bx bxs-cog'></i>
                <div class="text-truncate" data-i18n="Produk Inovasi">Produk Inovasi</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="/k-kbk/penelitian" class="menu-link {{ Request::is('k-kbk/penelitian') ? 'active bg-light' : '' }}">
                <i class='menu-icon tf-icons bx bxs-cog'></i>
                <div class="text-truncate" data-i18n="Penelitian">Penelitian</div>
            </a>
        </li>
      
    </ul>
</aside>

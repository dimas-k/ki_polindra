<div class="col-lg-2 bg-light border mt-2 rounded">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel" style="width: 245px">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav flex-column justify-content-end flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/admin/dashboard"><i
                                    class="bi bi-house me-4"></i>Dasboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/listadmin"><i class="bi bi-person me-4"></i>Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/verif"><i class="bi bi-person me-4"></i>Verifikator</a>
                        </li>
                        <li class="nav-item list-unstyled">
                            <a class="nav-link btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" href="#"
                                data-bs-toggle="collapse" data-bs-target="#masterdata-collapse" aria-expanded="false"><i class="bi bi-building me-4"></i>
                                Data Jurusan/Prodi
                            </a>
                            <div class="collapse" id="masterdata-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="/admin/jurusan"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-5 mb-2">Jurusan</a>
                                    </li>
                                    <li><a href="/admin/prodi"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-5">Prodi</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item list-unstyled">
                            <a class="nav-link btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" href="#"
                                data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false"><i class="bi bi-person me-4"></i>
                                Pengguna
                            </a>
                            <div class="collapse" id="home-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="/admin/pengguna/dosen"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-5 mb-2">Dosen</a>
                                    </li>
                                    <li><a href="/admin/pengguna/umum"
                                            class="link-body-emphasis d-inline-flex text-decoration-none rounded ms-5">Umum / Non POLINDRA</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/paten"><i class="bi bi-table me-4"></i></i>Paten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/desain-industri"><i class="bi bi-table me-4"></i>Desain
                                Industri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/hak-cipta"><i class="bi bi-table me-4"></i></i>Hak
                                Cipta</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

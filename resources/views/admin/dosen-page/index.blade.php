<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href={{ asset('assets/polindra21.png') }}>
    <title>SIKI POLINDRA-Admin | Dosen</title>
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
</head>

<body>
    {{-- Top nav bar --}}
    <div class="responsif">
        <div class="container-fluid border">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img class="navbar-brand" src={{ asset('assets/polindra2.jpg') }}>
                <a class="navbar-brand fs-6 fw-normal font-family-Kokoro brand-text-responsive" href="#">
                    <span class="d-inline d-md-none">SIKI POLINDRA</span>
                    <span class="d-none d-md-inline">Sistem Informasi Kekayaan
                        Intelektual<br>Politeknik Negeri Indramayu</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Selamat datang, {{ auth()->user()->nama_lengkap }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/logout"><i
                                                class="bi bi-arrow-bar-left me-2"></i>Log
                                            Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    {{-- end of top naavbar --}}
    <div class="container-fluid">
        <div class="row">
            {{-- Side bar --}}
            @include('admin.layout.sidenav')
            {{-- end of sidebar --}}
            <div class="col-12 col-lg-10 mt-2">
                <div class="container bg-light rounded border pt-3">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="d-flex justify-content-end">
                        {{-- <a href={{ Route('admin.tambah') }}
                        class="btn btn-success mb-2"><i class="bi bi-plus-circle me-1"></i>Tambah Dosen</a> --}}
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="bi bi-plus-circle me-1"></i>Tambah Dosen</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content p-4">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah akun dosen</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/admin/pengguna/dosen/tambah" enctype="multipart/form-data"
                                            method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="" class="col-form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id=""
                                                    name="nama_lengkap" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="col-form-label">No Telepon</label>
                                                <input type="number" class="form-control" id=""
                                                    name="no_telepon" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="">Email</label>
                                                <input type="text" id="" name="email"
                                                    class="form-control form-control @error('email') is-invalid @enderror"
                                                    required>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="">Alamat</label>
                                                <input type="text" id="" name="alamat"
                                                    class="form-control form-control @error('alamat') is-invalid @enderror"
                                                    required>
                                                @error('alamat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="pass">Jabatan</label>
                                                <input type="text" id="" name="jabatan"
                                                    class="form-control form-control @error('jabatan') is-invalid @enderror"
                                                    required>
                                                @error('jabatan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="">NIP</label>
                                                <input type="number" id="" name="nip"
                                                    class="form-control form-control @error('nip') is-invalid @enderror"
                                                    required>
                                                @error('nip')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="">Username</label>
                                                <input type="text" id="" name="username"
                                                    class="form-control form-control @error('username') is-invalid @enderror"
                                                    required>
                                                @error('username')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="col-form-label" for="pass">password</label>
                                                <input type="password" id="pass" name="password"
                                                    class="form-control form-control @error('password') is-invalid @enderror"
                                                    required>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <input type="text" value="Dosen" name="role" class="form-control"
                                                hidden>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Buat</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="fw-normal font-family-Kokoro mb-3"><i class="bi bi-table me-3"></i>Daftar Akun Dosen
                    </h3>
                    <form method="GET" action="{{ url()->current() }}" class="mb-3" id="dosenSearchForm">
                        <div class="input-group" style="max-width: 400px;">
                            <input type="text" name="search" id="dosenSearchInput" class="form-control"
                                placeholder="Cari nama, email, NIP, jabatan..." value="{{ $search ?? '' }}"
                                autocomplete="off">
                            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                            <a href="{{ url()->current() }}" id="dosenSearchClear"
                                class="btn btn-outline-danger {{ empty($search) ? 'd-none' : '' }}">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        </div>
                    </form>
                    <div id="dosenTableWrapper">
                        @include('admin.dosen-page.table', ['dosen' => $dosen])
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"
            integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous">
        </script>
        <script>
            (function () {
                const input = document.getElementById('dosenSearchInput');
                const wrapper = document.getElementById('dosenTableWrapper');
                const clearBtn = document.getElementById('dosenSearchClear');
                const form = document.getElementById('dosenSearchForm');
                const baseUrl = form.getAttribute('action');
                let debounceTimer = null;

                function fetchResults(search, pushUrl = true) {
                    const url = new URL(baseUrl, window.location.origin);
                    if (search) url.searchParams.set('search', search);

                    fetch(url.toString(), {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                        .then(res => res.text())
                        .then(html => {
                            wrapper.innerHTML = html;
                            clearBtn.classList.toggle('d-none', !search);
                            if (pushUrl) {
                                window.history.replaceState({}, '', url.toString());
                            }
                        })
                        .catch(() => {
                            // Kalau AJAX gagal (mis. network error), fallback ke submit form biasa
                            form.submit();
                        });
                }

                input.addEventListener('input', function () {
                    clearTimeout(debounceTimer);
                    const value = input.value.trim();
                    debounceTimer = setTimeout(() => fetchResults(value), 100);
                });

                // Klik tombol X: kosongkan input & tampilkan semua data, tanpa reload
                clearBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    input.value = '';
                    fetchResults('');
                });

                // Delegasi klik untuk link pagination di dalam wrapper (hasil AJAX), supaya tetap tanpa reload
                wrapper.addEventListener('click', function (e) {
                    const link = e.target.closest('a[href]');
                    if (!link) return;
                    const href = link.getAttribute('href');
                    if (!href || href.startsWith('#')) return;
                    // Hanya tangani link pagination (mengandung "page=")
                    if (href.includes('page=')) {
                        e.preventDefault();
                        const url = new URL(href, window.location.origin);
                        fetch(url.toString(), {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        })
                            .then(res => res.text())
                            .then(html => {
                                wrapper.innerHTML = html;
                                window.history.replaceState({}, '', url.toString());
                                window.scrollTo({ top: wrapper.offsetTop - 20, behavior: 'smooth' });
                            });
                    }
                });

                // Cegah submit form biasa (Enter key) ikut reload halaman, arahkan ke fetch juga
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    fetchResults(input.value.trim());
                });
            })();
        </script>
</body>

</html>
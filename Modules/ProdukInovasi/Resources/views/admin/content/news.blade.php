<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0"><i class="bx bx-news me-1"></i>Kelola Berita</h4>
        <a href="{{ route('admin.news.create') }}" class="btn btn-success">
            <i class="bx bx-plus me-1"></i>Tambah Berita
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.news.index') }}" class="mb-3" id="newsSearchForm">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="search" id="newsSearchInput" class="form-control"
                        placeholder="Cari judul atau kategori..." value="{{ $search ?? '' }}" autocomplete="off">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bx bx-search"></i></button>
                    <a href="{{ route('admin.news.index') }}" id="newsSearchClear"
                        class="btn btn-outline-danger {{ empty($search) ? 'd-none' : '' }}">
                        <i class="bx bx-x"></i>
                    </a>
                </div>
            </form>

            <div id="newsTableWrapper">
                @include('produkinovasi::admin.news.table', ['news' => $news])
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const input = document.getElementById('newsSearchInput');
        const wrapper = document.getElementById('newsTableWrapper');
        const clearBtn = document.getElementById('newsSearchClear');
        const form = document.getElementById('newsSearchForm');
        const baseUrl = form.getAttribute('action');
        let debounceTimer = null;

        function fetchResults(search) {
            const url = new URL(baseUrl, window.location.origin);
            if (search) url.searchParams.set('search', search);

            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(res => res.text())
                .then(html => {
                    wrapper.innerHTML = html;
                    clearBtn.classList.toggle('d-none', !search);
                    window.history.replaceState({}, '', url.toString());
                })
                .catch(() => form.submit());
        }

        input.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const value = input.value.trim();
            debounceTimer = setTimeout(() => fetchResults(value), 100);
        });

        clearBtn.addEventListener('click', function (e) {
            e.preventDefault();
            input.value = '';
            fetchResults('');
        });

        wrapper.addEventListener('click', function (e) {
            const link = e.target.closest('a[href]');
            if (!link) return;
            const href = link.getAttribute('href');
            if (!href || !href.includes('page=')) return;
            e.preventDefault();
            const url = new URL(href, window.location.origin);
            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(res => res.text())
                .then(html => {
                    wrapper.innerHTML = html;
                    window.history.replaceState({}, '', url.toString());
                    window.scrollTo({ top: wrapper.offsetTop - 20, behavior: 'smooth' });
                });
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            fetchResults(input.value.trim());
        });
    })();
</script>

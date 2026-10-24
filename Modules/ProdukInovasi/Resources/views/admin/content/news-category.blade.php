<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0"><i class="bx bx-category me-1"></i>Kategori Berita</h4>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#categoryModal"
            onclick="openCreateModal()">
            <i class="bx bx-plus me-1"></i>Tambah Kategori
        </button>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.news-category.index') }}" class="mb-3">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="search" class="form-control" placeholder="Cari kategori..."
                        value="{{ $search ?? '' }}">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bx bx-search"></i></button>
                </div>
            </form>

            @include('produkinovasi::admin.news-category.table', ['categories' => $categories])
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Kategori -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="categoryForm" method="POST">
            @csrf
            <div id="categoryMethodField"></div>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalTitle">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama" id="categoryNamaInput" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('categoryModalTitle').innerText = 'Tambah Kategori';
        document.getElementById('categoryForm').action = "{{ route('admin.news-category.store') }}";
        document.getElementById('categoryMethodField').innerHTML = '';
        document.getElementById('categoryNamaInput').value = '';
    }

    function openEditModal(id, nama) {
        document.getElementById('categoryModalTitle').innerText = 'Edit Kategori';
        document.getElementById('categoryForm').action = '/admin/news-category/update/' + id;
        document.getElementById('categoryMethodField').innerHTML = '@method('PUT')';
        document.getElementById('categoryNamaInput').value = nama;
        new bootstrap.Modal(document.getElementById('categoryModal')).show();
    }
</script>

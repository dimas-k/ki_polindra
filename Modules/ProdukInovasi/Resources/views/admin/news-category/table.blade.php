<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jumlah Berita</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $i => $category)
                <tr>
                    <td>{{ $categories->firstItem() + $i }}</td>
                    <td>{{ $category->nama }}</td>
                    <td><span class="badge bg-label-info">{{ $category->news_count }}</span></td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm"
                            onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->nama) }}')">
                            <i class="bx bx-pencil"></i>
                        </button>
                        <form action="{{ route('admin.news-category.destroy', $category->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($categories->isEmpty())
        <p class="text-center text-muted py-3">Belum ada kategori.</p>
    @endif
    <div class="d-flex justify-content-end mt-3">{{ $categories->links() }}</div>
</div>

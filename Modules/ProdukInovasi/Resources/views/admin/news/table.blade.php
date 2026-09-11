<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Sampul</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $i => $item)
                <tr>
                    <td>{{ $news->firstItem() + $i }}</td>
                    <td>
                        <img src="{{ $item->gambar_sampul ? asset('storage/' . $item->gambar_sampul) : asset('assets/gedung.jpg') }}"
                            alt="{{ $item->judul }}" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px;">
                    </td>
                    <td>{{ $item->judul }}</td>
                    <td><span class="badge bg-label-info">{{ $item->kategori }}</span></td>
                    <td>
                        @if ($item->status === 'published')
                            <span class="badge bg-label-success">Published</span>
                        @else
                            <span class="badge bg-label-secondary">Draft</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            <i class="bx bx-pencil"></i>
                        </a>
                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($news->isEmpty())
        <p class="text-center text-muted py-3">Belum ada berita.</p>
    @endif
    <div class="d-flex justify-content-end mt-3">
        {{ $news->links() }}
    </div>
</div>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4"><i class="bx bx-news me-1"></i>Tambah Berita</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul') }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" list="kategoriList"
                            class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori') }}"
                            placeholder="mis. Berita Kampus, Artikel">
                        <datalist id="kategoriList">
                            <option value="Berita Kampus">
                            <option value="Artikel">
                            <option value="Pengumuman">
                            <option value="Prestasi">
                        </datalist>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                Published (langsung tayang)</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (belum
                                tayang)</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Sampul</label>
                    <input type="file" name="gambar_sampul" accept="image/*"
                        class="form-control @error('gambar_sampul') is-invalid @enderror">
                    <div class="form-text">Format JPG/PNG/WEBP, maksimal 2MB.</div>
                    @error('gambar_sampul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Ringkasan Singkat</label>
                    <textarea name="ringkasan" rows="2" class="form-control @error('ringkasan') is-invalid @enderror"
                        placeholder="Muncul di daftar berita, maksimal 500 karakter">{{ old('ringkasan') }}</textarea>
                    @error('ringkasan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten Berita</label>
                    <textarea name="konten" rows="10" class="form-control @error('konten') is-invalid @enderror">{{ old('konten') }}</textarea>
                    @error('konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>

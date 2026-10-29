<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-3">
        <h5 class="card-header border-3 w-100 mb-2 d-flex justify-content-between align-items-center">
            <span><i class='bx bx-edit me-2'></i>Edit Produk {{ $produk->nama_produk }}</span>
            <a href="{{ route('show.produk', $produk->id) }}" class="btn btn-sm btn-outline-secondary">
                <i class='bx bx-arrow-back me-1'></i>Kembali
            </a>
        </h5>

        <form action="{{ route('admin.update.produk', $produk->id) }}" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf

            <div class="row mb-3">
                <div class="col mb-6">
                    <label for="kelompokKeahlianName" class="form-label">KBK</label>
                    <input class="form-control" type="text" id="kelompokKeahlianName"
                        value="{{ $produk->kelompokKeahlian ? $produk->kelompokKeahlian->nama_kbk : 'Tidak ada' }}"
                        readonly />
                    <span class="text-muted"><small>KBK produk tidak bisa dipindah dari sini.</small></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col mb-6">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" id="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"
                        value="{{ old('nama_produk', $produk->nama_produk) }}" name="nama_produk" />
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col mb-6">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                        id="deskripsi" style="height: 100px">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col mb-6">
                    <label for="gambar" class="form-label">Gambar Produk</label>
                    @if ($produk->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar saat ini"
                                style="max-width: 200px; height: auto;">
                        </div>
                    @endif
                    <input type="file" id="gambar" class="form-control @error('gambar') is-invalid @enderror"
                        name="gambar" accept=".jpg,.jpeg,.png" />
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="text-danger"><small><i class='bx bxs-error me-1'></i>Kosongkan jika tidak ingin
                            mengganti gambar.</small></span>
                </div>
            </div>

            <hr class="border-2 w-100">

            @php
                // Tebak kondisi awal radio Dosen/Non-Dosen dari data yang sudah ada.
                $isInventorDosen = filled($produk->inventor);
            @endphp

            <div class="row mb-3">
                <label class="form-label">Inventor Utama</label>
                <div>
                    <input type="radio" id="inventorDosen" name="inventor_type" value="dosen"
                        onclick="toggleInventorInput()" {{ $isInventorDosen ? 'checked' : '' }}>
                    <label for="inventorDosen">Dosen</label>

                    <input type="radio" id="inventorNonDosen" name="inventor_type" value="non_dosen"
                        onclick="toggleInventorInput()" {{ !$isInventorDosen ? 'checked' : '' }}>
                    <label for="inventorNonDosen">Non-Dosen</label>
                </div>
            </div>

            <div class="row mb-3" id="dosenInput" style="{{ $isInventorDosen ? '' : 'display: none;' }}">
                <div class="col mb-6">
                    <label for="inventor" class="form-label">Nama Inventor</label>
                    <select class="selectpicker w-50" data-live-search="true" id="inventor" name="inventor"
                        title="Pilih Inventor..">
                        <option value="">-- Tidak ada --</option>
                        <optgroup label="Ketua KBK">
                            @foreach ($inventorK as $inventor)
                                <option value="{{ $inventor->nama_lengkap }}"
                                    @if ($inventor->nama_lengkap === $produk->inventor) selected @endif>
                                    {{ $inventor->nama_lengkap }} - {{ $inventor->nama_kbk }}
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Anggota KBK">
                            @foreach ($inventorA as $inventor)
                                <option value="{{ $inventor->nama_lengkap }}"
                                    @if ($inventor->nama_lengkap === $produk->inventor) selected @endif>
                                    {{ $inventor->nama_lengkap }} - {{ $inventor->jabatan ?? 'Tidak ada jabatan' }}
                                    - {{ $inventor->nama_kbk }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>

            <div class="row mb-3" id="nonDosenInput" style="{{ $isInventorDosen ? 'display: none;' : '' }}">
                <div class="col mb-6">
                    <label for="inventor_lainnya" class="form-label">Nama Inventor Lainnya</label>
                    <input type="text" id="inventor_lainnya" class="form-control"
                        placeholder="Masukkan nama inventor lainnya" name="inventor_lainnya"
                        value="{{ old('inventor_lainnya', $produk->inventor_lainnya) }}" />
                    @error('inventor_lainnya')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col mb-6">
                    <label for="email_inventor" class="form-label">Email Inventor</label>
                    <input type="email" id="email_inventor"
                        class="form-control @error('email_inventor') is-invalid @enderror"
                        value="{{ old('email_inventor', $produk->email_inventor) }}" name="email_inventor" />
                    @error('email_inventor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="border-2 w-100">

            <div class="row mb-3">
                <div class="col mb-6">
                    <label class="form-label">Anggota Inventor saat ini</label>
                    <div>
                        @forelse ($produk->anggota as $anggota)
                            <li>
                                @if ($anggota->anggota_type === 'users')
                                    {{ $anggota->detail->nama_lengkap ?? '-' }} -
                                    {{ $anggota->detail->jabatan ?? ($anggota->detail->role ?? 'Tidak ada jabatan') }}
                                    (Ketua KBK)
                                @elseif ($anggota->anggota_type === 'anggota_kelompok_keahlians')
                                    {{ $anggota->detail->nama_lengkap ?? '-' }} -
                                    {{ $anggota->detail->jabatan ?? 'Tidak ada jabatan' }} (Anggota KBK)
                                @endif
                            </li>
                        @empty
                            <li>Belum ada anggota inventor terstruktur.</li>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col mb-6">
                    <label for="anggota_inventor" class="form-label">Pilih Anggota Inventor (Ketua KBK / Anggota
                        KBK)</label><br>
                    <select class="selectpicker w-50" data-live-search="true" id="anggota_inventor"
                        name="anggota_inventor[]" multiple title="Pilih Anggota Inventor..">
                        <optgroup label="Ketua KBK">
                            @foreach ($inventorK as $inventor)
                                <option value="user_{{ $inventor->id }}">
                                    {{ $inventor->nama_lengkap }} - {{ $inventor->nama_kbk }}
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Anggota KBK">
                            @foreach ($inventorA as $inventor)
                                <option value="anggota_{{ $inventor->id }}">
                                    {{ $inventor->nama_lengkap }} - {{ $inventor->jabatan ?? 'Tidak ada jabatan' }}
                                    - {{ $inventor->nama_kbk }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    <span class="text-danger"><small><i class='bx bxs-error me-1'></i>Kosongkan jika tidak ingin
                            mengubah daftar anggota inventor. Kalau diisi, pilihan ini akan MENGGANTI seluruh
                            daftar anggota inventor yang lama.</small></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col mb-6">
                    <label class="form-label" for="anggota_inventor_lainnya">Anggota Lainnya
                        (Mahasiswa/Dosen/Tendik terkait, bukan anggota KBK)</label>
                    <textarea id="anggota_inventor_lainnya" name="anggota_inventor_lainnya" class="form-control"
                        placeholder="Nama dipisah koma, misal: Budi Santoso, Siti Aminah">{{ old('anggota_inventor_lainnya', $produk->anggota_inventor_lainnya) }}</textarea>
                    @error('anggota_inventor_lainnya')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="border-2 w-100">

            <div class="row mb-3">
                <div class="col mb-6">
                    <label for="lampiran" class="form-label">Lampiran</label>
                    @if ($produk->lampiran)
                        <div class="mb-2">
                            <a href="{{ asset('storage/' . $produk->lampiran) }}" target="_blank">Lihat lampiran
                                saat ini</a>
                        </div>
                    @endif
                    <input type="file" id="lampiran" class="form-control @error('lampiran') is-invalid @enderror"
                        name="lampiran" accept=".jpg,.jpeg,.png,.pdf,.docx" />
                    @error('lampiran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <span class="text-danger"><small><i class='bx bxs-error me-1'></i>Kosongkan jika tidak ingin
                            mengganti lampiran.</small></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col mb-6">
                    <label for="tanggal_submit" class="form-label">Tanggal Submit</label>
                    <input type="date" name="tanggal_submit" id="tanggal_submit"
                        value="{{ old('tanggal_submit', $produk->tanggal_submit ? \Carbon\Carbon::parse($produk->tanggal_submit)->format('Y-m-d') : '') }}"
                        class="form-control @error('tanggal_submit') is-invalid @enderror">
                    @error('tanggal_submit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col mb-6">
                    <label for="tanggal_granted" class="form-label">Tanggal Granted</label>
                    <input type="date" name="tanggal_granted" id="tanggal_granted"
                        value="{{ old('tanggal_granted', $produk->tanggal_granted ? \Carbon\Carbon::parse($produk->tanggal_granted)->format('Y-m-d') : '') }}"
                        class="form-control @error('tanggal_granted') is-invalid @enderror">
                    @error('tanggal_granted')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="border-3 w-100">

            <div class="d-flex justify-content-end">
                <a href="{{ route('show.produk', $produk->id) }}" class="btn btn-outline-secondary me-1">Batal</a>
                <button type="submit" class="btn btn-primary ms-1">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

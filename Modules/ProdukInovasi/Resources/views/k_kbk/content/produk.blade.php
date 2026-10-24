<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-end mb-4">
        <div class="card p-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal">
                <i class='bx bx-plus-circle me-2'></i>Tambah Produk Inovasi
            </button>
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Tambah Produk Inovasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/k-kbk/produk/store" enctype="multipart/form-data" method="post"
                                id="uploadForm">
                                @csrf
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="kbk_id" class="form-label">
                                            KBK</label>
                                        <input name="kbk_id" value="{{ $kkbk->id }}" hidden>
                                        <input class="form-control" type="text" id="nama_kbk"
                                            value="{{ $kkbk->nama_kbk }}" readonly />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Nama produk</label>
                                        <input type="text" id="nama_produk" class="form-control"
                                            placeholder="Masukkan nama produk" name="nama_produk" />
                                        @error('nama_produk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" placeholder="Masukkan deskripsi" id="floatingTextarea"
                                            style="height: 100px"></textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Gambar Produk</label>
                                        <input type="file" id="gambar" class="form-control" name="gambar" />
                                        @error('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="form-label">Inventor</label>
                                    <div>
                                        <input type="radio" id="inventorDosen" name="inventor_type" value="dosen"
                                            checked onclick="toggleInventorInput1()">
                                        <label for="inventorDosen">Dosen</label>
                                        <input type="radio" id="inventorNonDosen" name="inventor_type"
                                            value="non_dosen" onclick="toggleInventorInput1()">
                                        <label for="inventorNonDosen">Non-Dosen</label>
                                    </div>
                                </div>
                                <!-- Input untuk Dosen (SelectPicker) -->
                                <div class="row" id="dosenInput">
                                    <div class="col mb-6">
                                        <label for="inventor" class="form-label">Nama Inventor</label>
                                        <select class="selectpicker w-70" data-live-search="true" id="inventor"
                                            name="inventor" title="Pilih Inventor..">
                                            <option disabled selected>--Pilih--</option>
                                            <optgroup label="Ketua KBK">
                                                @foreach ($inventorK as $inventor)
                                                    <option value="{{ $inventor->nama_lengkap }}">
                                                        {{ $inventor->nama_lengkap }} -
                                                        {{ $inventor->jabatan ?? 'Tidak ada jabatan' }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Anggota KBK">
                                                @foreach ($inventorA as $inventor)
                                                    <option value="{{ $inventor->nama_lengkap }}">
                                                        {{ $inventor->nama_lengkap }} -
                                                        {{ $inventor->jabatan ?? 'Tidak ada jabatan' }} -
                                                        {{ $inventor->nama_kbk }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <!-- Input untuk Non-Dosen (Input Teks) -->
                                <div class="row" id="nonDosenInput" style="display: none;">
                                    <div class="col mb-6">
                                        <label for="inventor_lainnya" class="form-label">Nama Inventor Lainnya</label>
                                        <input type="text" id="inventor_lainnya" class="form-control"
                                            placeholder="Masukkan nama inventor lainnya" name="inventor_lainnya" />
                                        @error('inventor_lainnya')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Email Inventor</label>
                                        <input type="email" id="email" class="form-control"
                                            placeholder="Masukkan email inventor" name="email_inventor" />
                                        @error('email_inventor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="form-label">Apakah Bersama Mahasiswa?</label>
                                    <div>
                                        <!-- Radio Button untuk "Tidak" -->
                                        <input type="radio" id="inventorNo" name="tipe_inventor" value="Tidak"
                                            onclick="toggleAnggotaLainnya1()">
                                        <label for="inventorNo">Tidak</label>

                                        <!-- Radio Button untuk "Ya" -->
                                        <input type="radio" id="inventorYes" name="tipe_inventor" value="Ya"
                                            onclick="toggleAnggotaLainnya1()">
                                        <label for="inventorYes">Ya</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6" id="anggotaLainnyaContainer" style="display: none;">
                                        <label class="form-label" for="anggota_inventor_lainnya">Nama Anggota
                                            Lainnya</label>
                                        <textarea id="anggota_inventor_lainnya" name="anggota_inventor_lainnya" class="form-control"
                                            placeholder="Masukkan nama anggota lainnya"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="anggota_inventor">Pilih Anggota Inventor</label> <br>
                                        <select class="selectpicker w-50" data-live-search="true"
                                            id="anggota_inventor" name="anggota_inventor[]" multiple
                                            title="Pilih Anggota Inventor..">
                                            <option disabled selected>-- Pilih --</option>
                                            <option value=""> None </option>
                                            <optgroup label="Ketua KBK">
                                                @foreach ($inventorK as $inventor)
                                                    <option value="user_{{ $inventor->id }}">
                                                        {{ $inventor->nama_lengkap }} &nbsp; - &nbsp;
                                                        {{ $inventor->nama_kbk }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Anggota KBK">
                                                @foreach ($inventorA as $inventor)
                                                    <option value="anggota_{{ $inventor->id }}">
                                                        {{ $inventor->nama_lengkap }} &nbsp; - &nbsp; {{ $inventor->nama_kbk }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Lampiran</label>
                                        <input type="file" id="lampiran" class="form-control" name="lampiran" />
                                        @error('lampiran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="tanggal_submit" class="form-label">Tanggal Submit</label>
                                        <input type="date" name="tanggal_submit" id="tanggal_submit"
                                            class="form-control @error('tanggal_submit') is-invalid @enderror">
                                        @error('tanggal_submit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="tanggal_granted" class="form-label">Tanggal Granted</label>
                                        <input type="date" name="tanggal_granted" id="tanggal_granted"
                                            class="form-control @error('tanggal_granted') is-invalid @enderror">
                                        @error('tanggal_granted')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr class="border-3 w-100">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary me-1"
                                        data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary ms-1"
                                        id="btnSubmit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-2">
        <h5 class="card-header"><i class='bx bx-table me-2'></i>Tabel Produk Inovasi</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Nama Inventor</th>
                        <th>email inventor</th>
                        <th>Tanggal Granted</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($produks as $i => $p)
                        <tr>
                            <th scope="row">
                                {{ ($produks->currentPage() - 1) * $produks->perPage() + $loop->iteration }}
                            </th>
                            <td>{{ $p->nama_produk }}</td>
                            {{-- <td>{{ $p->inventor }}</td> --}}
                            <td> {{ $p->inventor ?: $p->inventor_lainnya }}</td>
                            <td>{{ $p->email_inventor }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_granted)->format('d-m-Y') }}</td>
                            <td>
                                @if ($p->status === 'Tervalidasi')
                                    <span class="badge bg-label-success me-1">{{ $p->status }}</span>
                                @else
                                    <span class="badge bg-label-warning me-1">{{ $p->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('lihat.produk', $p->id) }}" class="btn btn-sm btn-primary"><i
                                        class='bx bxs-show'></i></a>
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $p->id }}">
                                    <i class='bx bx-pencil'></i>
                                </button>
                                <div class="modal fade" id="basicModal{{ $p->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Update Produk
                                                    {{ $p->nama_produk }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('update.produk', $p->id) }}"
                                                    enctype="multipart/form-data" method="post"
                                                    id="editForm_{{ $p->id }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="kelompokKeahlianName" id="kbk"
                                                                class="form-label">KBK</label>
                                                            <input class="form-control" type="text"
                                                                id="kelompokKeahlianName"
                                                                value="{{ $p->kelompokKeahlian ? $p->kelompokKeahlian->nama_kbk : 'Tidak ada' }}"
                                                                readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic" class="form-label">Nama
                                                                produk</label>
                                                            <input type="text"
                                                                id="nama_produk_{{ $p->id }}"
                                                                class="form-control" value="{{ $p->nama_produk }}"
                                                                name="nama_produk" />
                                                            @error('nama_produk')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic"
                                                                class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="deskripsi" id="deskripsi_{{ $p->id }}" style="height: 100px">{{ $p->deskripsi }}</textarea>
                                                            @error('deskripsi')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic" class="form-label">Gambar
                                                                Produk</label>
                                                            <input type="file" id="gambar_{{ $p->id }}"
                                                                class="form-control" name="gambar" />
                                                            @error('gambar')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <span class="text-danger"><small><i
                                                                        class='bx bxs-error me-1'></i>Jika tidak ada
                                                                    perubahan file tidak usah dinputkan
                                                                    kembali</small></span>
                                                        </div>
                                                    </div>
                                                    <label for="nameBasic" class="form-label">Nama
                                                        Inventor saat ini</label>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <li>{{ $p->inventor ?: $p->inventor_lainnya }} </li>
                                                            <input type="hidden" name="inventor"
                                                                value="{{ $p->inventor }}">
                                                            <!-- Hidden input untuk inventor_lainnya -->
                                                            <input type="hidden" name="inventor_lainnya"
                                                                value="{{ $p->inventor_lainnya }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="form-label">Inventor</label>
                                                        <div>
                                                            <input type="radio"
                                                                id="inventorDosen_{{ $p->id }}"
                                                                name="inventor_type_{{ $p->id }}"
                                                                value="dosen" onclick="toggleInventorInput()">
                                                            <label
                                                                for="inventorDosen_{{ $p->id }}">Dosen</label>
                                                            <input type="radio"
                                                                id="inventorNonDosen_{{ $p->id }}"
                                                                name="inventor_type_{{ $p->id }}"
                                                                value="non_dosen" onclick="toggleInventorInput()">
                                                            <label
                                                                for="inventorNonDosen_{{ $p->id }}">Non-Dosen</label>
                                                        </div>
                                                    </div>

                                                    <!-- Input untuk Dosen -->
                                                    <div class="row" id="dosenInput_{{ $p->id }}"
                                                        style="display: none;">
                                                        <div class="col mb-6">
                                                            <label for="inventor_{{ $p->id }}"
                                                                class="form-label">Nama Inventor</label>
                                                            <select class="selectpicker w-70" data-live-search="true"
                                                                id="inventor_{{ $p->id }}"
                                                                {{-- name="inventor_{{ $p->id }}" --}} name="inventor"
                                                                title="Pilih Inventor..">
                                                                <option disabled selected>--Pilih--</option>
                                                                <option value=""> None </option>
                                                                <optgroup label="Ketua KBK">
                                                                    @foreach ($inventorK as $inventor)
                                                                        <option value="{{ $inventor->nama_lengkap }}"
                                                                            @if ($inventor->nama_lengkap === $p->inventor) selected @endif>
                                                                            {{ $inventor->nama_lengkap }} -
                                                                            {{ $inventor->jabatan ?? 'Tidak ada jabatan' }}
                                                                        </option>
                                                                    @endforeach
                                                                </optgroup>
                                                                <optgroup label="Anggota KBK">
                                                                    @foreach ($inventorA as $inventor)
                                                                        <option value="{{ $inventor->nama_lengkap }}"
                                                                            @if ($inventor->nama_lengkap === $p->inventor) selected @endif>
                                                                            {{ $inventor->nama_lengkap }} -
                                                                            {{ $inventor->jabatan ?? 'Tidak ada jabatan' }}
                                                                            - {{ $inventor->nama_kbk }}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- Input untuk Non-Dosen -->
                                                    <div class="row" id="nonDosenInput_{{ $p->id }}"
                                                        style="display: none;">
                                                        <div class="col mb-6">
                                                            <label for="inventor_lainnya_{{ $p->id }}"
                                                                class="form-label">Nama Inventor Lainnya</label>
                                                            <input type="text"
                                                                id="inventor_lainnya_{{ $p->id }}"
                                                                class="form-control"
                                                                placeholder="Masukkan nama inventor lainnya"
                                                                {{-- name="inventor_lainnya_{{ $p->id }}" --}}
                                                                name="inventor_lainnya"
                                                                value="{{ $p->inventor_lainnya ?? '' }}" />
                                                            @error('inventor_lainnya')
                                                                <div class="invalid-feedback">{{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <span class="text-danger"><small><i
                                                                class='bx bxs-error me-1'></i>Jika tidak ada
                                                            perubahan anggota inventor tidak usah dinputkan
                                                            kembali</small>
                                                    </span>
                                                    <br> <br>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic" class="form-label">Email
                                                                Inventor</label>
                                                            <input type="email" id="email_{{ $p->id }}"
                                                                class="form-control" value="{{ $p->email_inventor }}"
                                                                name="email_inventor" />
                                                            @error('email_inventor')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="anggota_inventor" class="form-label">Anggota
                                                                Inventor saat ini</label><br>
                                                            <div class="row">
                                                                <div class="col mb-6">
                                                                    @foreach ($p->anggota as $anggota)
                                                                        <li>
                                                                            @if ($anggota->anggota_type === 'users')
                                                                                {{ $anggota->anggota->nama_lengkap }} -
                                                                                {{ $anggota->anggota->role ?? 'Tidak ada jabatan' }}
                                                                            @elseif ($anggota->anggota_type === 'anggota_kelompok_keahlians')
                                                                                {{ $anggota->anggota->nama_lengkap }} -
                                                                                {{ $anggota->anggota->jabatan ?? 'Tidak ada jabatan' }}
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                    @if (!empty($p->anggota_inventor_lainnya))
                                                                        @foreach (array_filter(explode(',', $p->anggota_inventor_lainnya)) as $anggota_lain)
                                                                            <li>{{ $anggota_lain }}</li>
                                                                        @endforeach
                                                                    @else
                                                                        <br>
                                                                        <p>Tidak ada anggota_lainnya </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="form-label">Apakah Bersama
                                                                    Mahasiswa?</label>
                                                                <div>
                                                                    <!-- Radio Button untuk "Tidak" -->
                                                                    <input type="radio"
                                                                        id="inventorNo_{{ $p->id }}"
                                                                        name="tipe_inventor_{{ $p->id }}"
                                                                        value="Tidak"
                                                                        {{ $p->anggota_inventor_lainnya ? '' : 'checked' }}>
                                                                    <label
                                                                        for="inventorNo_{{ $p->id }}">Tidak</label>

                                                                    <!-- Radio Button untuk "Ya" -->
                                                                    <input type="radio"
                                                                        id="inventorYes_{{ $p->id }}"
                                                                        name="tipe_inventor_{{ $p->id }}"
                                                                        value="Ya"
                                                                        {{ $p->anggota_inventor_lainnya ? 'checked' : '' }}>
                                                                    <label
                                                                        for="inventorYes_{{ $p->id }}">Ya</label>
                                                                </div>
                                                            </div>

                                                            <!-- Input untuk Nama Anggota Lainnya -->
                                                            <div class="row">
                                                                <div class="col mb-6"
                                                                    id="anggotaLainnyaContainer_{{ $p->id }}"
                                                                    style="display: none;">
                                                                    <label class="form-label"
                                                                        for="anggota_inventor_lainnya_{{ $p->id }}">Nama
                                                                        Anggota Lainnya</label>
                                                                    <textarea id="anggota_inventor_lainnya_{{ $p->id }}" {{-- name="anggota_inventor_lainnya_{{ $p->id }}" --}} name="anggota_inventor_lainnya"
                                                                        class="form-control" placeholder="Masukkan nama anggota lainnya">{{ $p->anggota_inventor_lainnya ?? ""}}</textarea>
                                                                </div>
                                                            </div>

                                                            <!-- Pilihan Anggota Inventor -->
                                                            <div class="row">
                                                                <div class="col mb-6">
                                                                    <label
                                                                        for="anggota_inventor_{{ $p->id }}">Pilih
                                                                        Anggota Inventor</label> <br>
                                                                    <select class="selectpicker w-50"
                                                                        data-live-search="true"
                                                                        id="anggota_inventor_{{ $p->id }}"
                                                                        {{-- name="anggota_inventor_{{ $p->id }}[]" --}} name="anggota_inventor[]"
                                                                        multiple title="Pilih Anggota Inventor..">
                                                                        <option disabled selected>-- Pilih --
                                                                        </option>
                                                                        <optgroup label="Ketua KBK">
                                                                            @foreach ($inventorK as $inventor)
                                                                                <option
                                                                                    value="user_{{ $inventor->id }}">
                                                                                    {{ $inventor->nama_lengkap }} -
                                                                                    {{ $inventor->jabatan ?? 'Tidak ada jabatan' }}
                                                                                </option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                        <optgroup label="Anggota KBK">
                                                                            @foreach ($inventorA as $inventor)
                                                                                <option
                                                                                    value="anggota_{{ $inventor->id }}">
                                                                                    {{ $inventor->nama_lengkap }} -
                                                                                    {{ $inventor->jabatan ?? 'Tidak ada jabatan' }}
                                                                                    - {{ $inventor->nama_kbk }}
                                                                                </option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <span class="text-danger"><small><i
                                                                        class='bx bxs-error me-1'></i>Jika tidak ada
                                                                    perubahan anggota inventor tidak usah dinputkan
                                                                    kembali</small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic" class="form-label">Lampiran</label>
                                                            <input type="file" id="lampiran_{{ $p->id }}"
                                                                class="form-control" name="lampiran" />
                                                            @error('lampiran')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <span class="text-danger"><small><i
                                                                        class='bx bxs-error me-1'></i>Jika tidak ada
                                                                    perubahan file tidak usah dinputkan
                                                                    kembali</small></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="tanggal_submit" class="form-label">Tanggal
                                                                Submit</label>
                                                            <input type="date" name="tanggal_submit"
                                                                id="tanggal_submit_{{ $p->id }}"
                                                                value="{{ $p->tanggal_submit ? \Carbon\Carbon::parse($p->tanggal_submit)->format('Y-m-d') : '' }}"
                                                                class="form-control @error('tanggal_submit') is-invalid @enderror">
                                                            @error('tanggal_submit')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="tanggal_granted" class="form-label">Tanggal
                                                                Granted</label>
                                                            <input type="date" name="tanggal_granted"
                                                                id="tanggal_granted_{{ $p->id }}"
                                                                value="{{ $p->tanggal_granted ? \Carbon\Carbon::parse($p->tanggal_granted)->format('Y-m-d') : '' }}"
                                                                class="form-control @error('tanggal_granted') is-invalid @enderror">
                                                            @error('tanggal_granted')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <hr class="border-3 w-100">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary me-1"
                                                            data-bs-dismiss="modal">
                                                            Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ms-1"
                                                            id="btnSubmit">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <form style="margin-left: 15px" method="post"
                                    action="{{ route('hapus.produk', $p->id) }}" id="deleteForm">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" type="submit"
                                        onclick="deleteConfirm(event)"><i class='bx bx-trash'></i></button>
                                </form> --}}
                                <div class="btn btn-sm btn-danger">
                                    <form method="post" action="{{ route('hapus.produk', $p->id) }}"
                                        id="deleteForm">
                                        @method('DELETE')
                                        @csrf
                                        <a type="submit" onclick="deleteConfirm(event)"><i
                                                class='bx bx-trash'></i></a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <img src="{{ asset('img/no-data.jpg') }}" style="width:15%; height:auto">
                                <p>Opss.. <br> <span class="fw-bold">Tidak ada data yang tersedia.</span></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-2">
                {{ $produks->links() }}
            </div>
        </div>
    </div>
</div>

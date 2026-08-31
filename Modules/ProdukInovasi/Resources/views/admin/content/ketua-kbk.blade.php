<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-end mb-4">
        <div class="card p-2">
            {{-- <a href="" class="btn btn-success"><i class='bx bx-plus-circle me-2'></i>Tambah KBK</a> --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal">
                <i class='bx bx-plus-circle me-2'></i>Tambah Ketua KBK
            </button>

            <!-- Modal -->
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Tambah Ketua Kelompok Bidang Keahlian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/ketua-kbk/store" enctype="multipart/form-data" method="post"
                                id="uploadForm">
                                @csrf
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Nama Lengkap</label>
                                        <input type="text" id="nama_lengkap" class="form-control"
                                            placeholder="Masukkan nama" name="nama_lengkap" />
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Nip</label>
                                        <input type="number" id="nip" class="form-control"
                                            placeholder="Masukkan nip" name="nip" />
                                        @error('nip')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Jabatan</label>
                                        <input type="text" id="jabatan" class="form-control"
                                            placeholder="Masukkan jabatan" name="jabatan" />
                                        @error('jabatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Pas Foto</label>
                                        <input type="file" id="foto" class="form-control" name="pas_foto" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">No Handphone</label>
                                        <input type="number" id="no_hp" class="form-control"
                                            placeholder="Masukkan no hanphone" name="no_hp" />
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Email</label>
                                        <input type="email" id="email" class="form-control"
                                            placeholder="Masukkan email" name="email" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="exampleFormControlSelect1" id="kbk" class="form-label">Pilih
                                            KBK</label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="kbk_id"
                                            aria-label="Default select example">
                                            <option value="" selected>Pilih KBK</option>
                                            @foreach ($jenis_kbk as $j_kbk)
                                                <option value="{{ $j_kbk->id }}">{{ $j_kbk->nama_kbk }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Username</label>
                                        <input type="text" id="username" class="form-control"
                                            placeholder="Masukkan username" name="username" />
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6 form-password-toggle">
                                        <label for="nameBasic" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" class="form-control"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                name="password" aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6 form-password-toggle">
                                        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="confirm_password" class="form-control"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                name="confirm_password" aria-describedby="confirm_password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                            @error('confirm_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="text" value="ketua_kbk" name="role" hidden>
                                <br>
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
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h5 class="card-header"><i class='bx bx-table me-2'></i>Tabel Ketua Kelompok Bidang Keahlian</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NIP</th>
                        <th>KBK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($kbk as $i => $k)
                        <tr>
                            <th scope="row">{{ ($kbk->currentPage() - 1) * $kbk->perPage() + $loop->iteration }}
                            </th>
                            <td>{{ $k->nama_lengkap }}</td>
                            <td>{{ $k->nip }}</td>
                            <td>{{ $k->KelompokKeahlian ? $k->KelompokKeahlian->nama_kbk : 'Tidak ada' }}</td>
                            <td>
                                <a href="{{ route('show.k-kbk', $k->id) }}" class="btn btn-sm btn-success">
                                    <i class='bx bxs-show'></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $k->id }}">
                                    <i class='bx bx-pencil'></i>
                                </button>
                                <div class="btn btn-sm btn-danger">
                                    <form method="post" action="{{ route('hapus.k-kbk', $k->id) }}"
                                        id="deleteForm">
                                        @method('DELETE')
                                        @csrf
                                        <a type="submit" onclick="deleteConfirm(event)"><i
                                                class='bx bx-trash'></i></a>
                                    </form>
                                </div>
                                <a href="{{ route('reset.password', $k->id) }}"
                                    class="btn btn-danger resetPasswordBtn"
                                    data-url="{{ route('reset.password', $k->id) }}">Reset Password</a>
                            </td>
                        </tr>

                        <!-- Modal Update -->
                        <div class="modal fade" id="basicModal{{ $k->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Update Ketua KBK</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('update.k-kbk', $k->id) }}" enctype="multipart/form-data"
                                            method="post" id="editForm_{{ $k->id }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="nameBasic" class="form-label">Nama Lengkap</label>
                                                    <input type="text" id="nama_lengkap_{{ $k->id }}" class="form-control"
                                                        value="{{ $k->nama_lengkap }}" name="nama_lengkap" />
                                                    @error('nama_lengkap')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="nameBasic" class="form-label">Nip</label>
                                                    <input type="number" id="nip_{{ $k->id }}" class="form-control"
                                                        value="{{ $k->nip }}" name="nip" />
                                                    @error('nip')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="nameBasic" class="form-label">Jabatan</label>
                                                    <input type="text" id="jabatan_{{ $k->id }}" class="form-control"
                                                        value="{{ $k->jabatan }}" name="jabatan" />
                                                    @error('jabatan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="nameBasic" class="form-label">Pas Foto</label>
                                                    <input type="file" id="foto_{{ $k->id }}" class="form-control"
                                                        name="pas_foto" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="nameBasic" class="form-label">No Handphone</label>
                                                    <input type="number" id="no_hp_{{ $k->id }}" class="form-control"
                                                        value="{{ $k->no_hp }}" name="no_hp" />
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="nameBasic" class="form-label">Email</label>
                                                    <input type="email" id="email_{{ $k->id }}" class="form-control"
                                                        value="{{ $k->email }}" name="email" />
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="exampleFormControlSelect1" id="kbk"
                                                        class="form-label">Pilih
                                                        KBK</label>
                                                    <select class="form-select" id="exampleFormControlSelect1"
                                                        name="kbk_id" aria-label="Default select example">
                                                        <option value=""
                                                            {{ $k->kbk_id == null ? 'selected' : '' }}>Pilih KBK
                                                        </option>
                                                        @foreach ($jenis_kbk as $j_kbk)
                                                            <option value="{{ $j_kbk->id }}"
                                                                {{ $j_kbk->id == $k->kbk_id ? 'selected' : '' }}>
                                                                {{ $j_kbk->nama_kbk }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mb-6">
                                                    <label for="nameBasic" class="form-label">Username</label>
                                                    <input type="text" id="username_{{ $k->id }}" class="form-control"
                                                        value="{{ $k->username }}" name="username" />
                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="text" value="ketua_kbk" name="role" hidden>
                                            <br>
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
                {{ $kbk->links() }}
            </div>
        </div>
    </div>
</div>

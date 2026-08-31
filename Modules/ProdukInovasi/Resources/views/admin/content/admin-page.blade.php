<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-end mb-4">
        <div class="card p-2">
            {{-- <a href="" class="btn btn-success"><i class='bx bx-plus-circle me-2'></i>Tambah KBK</a> --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal">
                <i class='bx bx-plus-circle me-2'></i>Tambah Admin
            </button>

            <!-- Modal -->
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Tambah Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/admin-page/tambah" enctype="multipart/form-data" method="post"
                                id="uploadForm">
                                @csrf
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Nama Lengkap</label>
                                        <input type="text" id="nama_lengkap" class="form-control"
                                            placeholder="Masukkan nama" name="nama_lengkap" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Nip</label>
                                        <input type="number" id="nip" class="form-control"
                                            placeholder="Masukkan nip" name="nip" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Jabatan</label>
                                        <input type="text" id="jabatan" class="form-control"
                                            placeholder="Masukkan jabatan" name="jabatan" />
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Email</label>
                                        <input type="email" id="email" class="form-control"
                                            placeholder="Masukkan email" name="email" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Username</label>
                                        <input type="text" id="username" class="form-control"
                                            placeholder="Masukkan username" name="username" />
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
                                        </div>
                                    </div>
                                </div>


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
        <h5 class="card-header"><i class='bx bx-table me-2'></i>Tabel Admin</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($admin as $i => $adm)
                        <tr>
                            <th scope="row">{{ $i + 1 }}</th>
                            <td>{{ $adm->nama_lengkap }}</td>
                            <td>{{ $adm->nip }}</td>
                            <td>{{ $adm->jabatan }}</td>
                            <td>
                                <a href="{{ route('admin.show', $adm->id) }}" class="btn btn-sm btn-success"><i
                                        class='bx bxs-show'></i></a>
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $adm->id }}">
                                    <i class='bx bx-pencil'></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="basicModal{{ $adm->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">update Admin</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('upate.admin', $adm->id) }}"
                                                    enctype="multipart/form-data" method="post"
                                                    id="editForm_{{ $adm->id }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic" class="form-label">Nama
                                                                Lengkap</label>
                                                            <input type="text" id="nama_{{ $adm->id }}"
                                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                                value="{{ $adm->nama_lengkap }}"
                                                                name="nama_lengkap" />
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
                                                            <input type="number" id="nip_{{ $adm->id }}"
                                                                class="form-control @error('nip') is-invalid @enderror"
                                                                value="{{ $adm->nip }}" name="nip" />
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
                                                            <input type="text" id="jabatan_{{ $adm->id }}"
                                                                class="form-control @error('jabatan') is-invalid @enderror"
                                                                value="{{ $adm->jabatan }}" name="jabatan" />
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
                                                            <input type="file" id="foto_{{ $adm->id }}"
                                                                class="form-control" name="pas_foto" />
                                                            <span class="text-danger"><i
                                                                    class='bx bxs-error me-1'></i>Jika ingin diganti
                                                                silahkan isi, jika tidak biarkan</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic" class="form-label">No
                                                                Handphone</label>
                                                            <input type="number" id="no_hp_{{ $adm->id }}"
                                                                class="form-control @error('no_hp') is-invalid @enderror"
                                                                value="{{ $adm->no_hp }}" name="no_hp" />
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
                                                            <input type="email" id="email_{{ $adm->id }}"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                value="{{ $adm->email }}" name="email" />
                                                            @error('email')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic" class="form-label">Username</label>
                                                            <input type="text" id="username_{{ $adm->id }}"
                                                                class="form-control @error('username') is-invalid @enderror"
                                                                value="{{ $adm->username }}" name="username" />
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
                                                                <input type="password"
                                                                    id="password_{{ $adm->id }}"
                                                                    class="form-control @error('password') is-invalid @enderror"
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


                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary me-1"
                                                            data-bs-dismiss="modal">
                                                            Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ms-1"
                                                            id="btnSubmit">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <form style="margin-left: 15px" method="post"
                                    action="{{ route('hapus.admin', $adm->id) }}" id="deleteForm">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" type="submit"
                                        onclick="deleteConfirm(event)"><i class='bx bx-trash'></i></button>
                                </form> --}}
                                <div class="btn btn-sm btn-danger">
                                    <form method="post" action="{{ route('hapus.admin', $adm->id) }}"
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
            </div>
        </div>
    </div>

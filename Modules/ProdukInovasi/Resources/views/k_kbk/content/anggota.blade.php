<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-end mb-4">
        <div class="card p-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal">
                <i class='bx bx-plus-circle me-2'></i>Tambah Anggota
            </button>
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Tambah Anggota</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/k-kbk/anggota-kbk/store" enctype="multipart/form-data" method="post"
                                id="uploadForm">
                                @csrf
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="kbk_id" class="form-label">KBK</label>
                                        <input class="form-control" type="text"
                                        id="kbk_id" name="kbk_id" value="{{ $kkbk->id}}" hidden/> <br>
                                        {{ $kkbk->nama_kbk}}
                                        {{-- <select class="form-select" id="exampleFormControlSelect1" name="kbk_id"
                                            aria-label="Default select example">
                                            <option value="" selected>Pilih KBK</option>
                                            @foreach ($kkbk as $j_kbk)
                                                <option value="{{ $j_kbk->id }}">{{ $j_kbk->nama_kbk }}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Nama Lengkap</label>
                                        <input type="text" id="nama_lengkap" class="form-control"
                                            placeholder="Masukkan nama lengkap anggota" name="nama_lengkap" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Jabatan</label>
                                        <input type="text" id="jabatan" class="form-control"
                                            placeholder="Masukkan Jabatan" name="jabatan" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">email</label>
                                        <input type="email" id="email" class="form-control"
                                            placeholder="Masukkan email anggota" name="email" />
                                    </div>
                                </div>

                                <hr class="border-3 w-100">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary me-1"
                                        data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary ms-1" id="btnSubmit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-2">
        <h5 class="card-header"><i class='bx bx-table me-2'></i>Tabel Anggota</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($anggotas as $i => $p)
                        <tr>
                            <th scope="row">
                                {{ ($anggotas->currentPage() - 1) * $anggotas->perPage() + $loop->iteration }}
                            </th>
                            <td>{{ $p->nama_lengkap }}</td>
                            <td>{{ $p->jabatan }}</td>
                            <td>{{ $p->email }}</td>
                            <td>

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
                                                <form action="{{ route('edit.anggota', $p->id) }}"
                                                    enctype="multipart/form-data" method="post"
                                                    id="editForm_{{ $p->id }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="exampleFormControlSelect1" id="kbk"
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
                                                                Lengkap</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $p->nama_lengkap }}" name="nama_lengkap" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic" class="form-label">Jabatan</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $p->jabatan }}" name="jabatan" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-6">
                                                            <label for="nameBasic" class="form-label">Email</label>
                                                            <input type="email" class="form-control"
                                                                value="{{ $p->email }}" name="email" />
                                                        </div>
                                                    </div>
                                                    <hr class="border-3 w-100">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary me-1"
                                                            data-bs-dismiss="modal">
                                                            Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ms-1"
                                                            id="btnSubmit">Uptade</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn btn-sm btn-danger">
                                    <form method="post" action="{{ route('hapus.anggota', $p->id) }}"
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
                {{ $anggotas->links() }}
            </div>
        </div>
    </div>
</div>

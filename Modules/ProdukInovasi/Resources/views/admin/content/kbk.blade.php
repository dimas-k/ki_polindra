<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-end mb-4">
        <div class="card p-2">
            {{-- <a href="" class="btn btn-success"><i class='bx bx-plus-circle me-2'></i>Tambah KBK</a> --}}
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal">
                <i class='bx bx-plus-circle me-2'></i>Tambah KBK
            </button>

            <!-- Modal -->
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Tambah KBK</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/kelompok-bidang-keahlian/create" method="post" id="uploadForm">
                                @csrf
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Nama KBK</label>
                                        <input type="text" id="namaKbk" class="form-control"
                                            placeholder="Masukkan nama kbk" name="nama_kbk" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="nameBasic" class="form-label">Jurusan</label>
                                        <input type="text" id="jurusan" class="form-control"
                                            placeholder="Masukkan jurusan" name="jurusan" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-6">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" id="editor"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col mb-6">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" id="descriptions" cols="10" rows="10"></textarea>
                                    </div>
                                </div> --}}

                                <br>
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

        <h5 class="card-header"><i class='bx bx-table me-2'></i>Tabel Kelompok Bidang keahlian (KBK)</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Nama KBK</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($kbk as $i => $k)
                        <tr>
                            <th scope="row">{{ $i + 1 }}</th>
                            <td>{{ $k->nama_kbk }}</td>
                            <td>{{ $k->jurusan }}</td>
                            <td>
                                <div style="display: flex">
                                    {{-- <a href="" class="btn btn-sm btn-primary"><i class='bx bx-pencil'></i></a> --}}
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $k->id }}">
                                        <i class="bx bx-pencil"></i>
                                    </button>
                                    <div class="modal fade" id="exampleModal{{ $k->id }}" tabindex="-1"
                                        data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content p-2">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1">Update KBK</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post"
                                                        action="{{ Route('updateKelompokBidang', $k->id) }}"
                                                        id="editForm_{{ $k->id }}">
                                                        @csrf
                                                        <div class="form-outline form-white mb-3">
                                                            <label class="form-label" for="">Nama
                                                                KBK</label>
                                                            <input type="text" id="kbk_{{ $k->id }}"
                                                                class="form-control" name="nama_kbk"
                                                                value="{{ $k->nama_kbk }}">
                                                        </div>
                                                        <div class="form-outline form-white mb-3">
                                                            <label class="form-label" for="">Jurusan</label>
                                                            <input type="text" id="jurusan_{{ $k->id }}"
                                                                class="form-control" name="jurusan"
                                                                value="{{ $k->jurusan }}">
                                                        </div>
                                                        <div class="form-outline form-white mb-3">
                                                            <label for="deskripsi"
                                                                class="form-label">Deskripsi</label>
                                                            <textarea name="deskripsi" id="editor">{!! $k->deskripsi !!}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary me-1"
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
                                    <form style="margin-left: 15px" method="post"
                                        action="{{ route('hapusKbk', $k->id) }}" id="deleteForm">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" type="submit"
                                            onclick="deleteConfirm(event)"><i class='bx bx-trash'></i></button>
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

<table class="table table-hover font-family-Kokoro">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama lengkap</th>
            <th scope="col">Email</th>
            <th scope="col">Bekerja Sebagai</th>
            <th scope="col">Alamat</th>
            <th scope="col">No telepon</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($umum as $i => $a)
            <tr>
                <th scope="row">{{ $umum->firstItem() + $i }}</th>
                <td>{{ $a->nama_lengkap }}</td>
                <td>{{ $a->email }}</td>
                <td>{{ $a->kerjaan }}</td>
                <td>{{ $a->alamat }}</td>
                <td>{{ $a->no_telepon }}</td>
                <td><a href={{ Route('umum.detail', $a->id) }} class="btn btn-primary"><i class="bi bi-eye"></i></a>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#exampleModal{{ $a->id }}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <div class="modal fade" id="exampleModal{{ $a->id }}" tabindex="-1"
                        data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content p-4">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Akun Umum
                                        {{ $a->nama_lengkap }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('umum.akun.update', $a->id) }}"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="" class="col-form-label">Nama
                                                Lengkap</label>
                                            <input type="text" class="form-control" id=""
                                                name="nama_lengkap" value="{{ $a->nama_lengkap }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="" class="col-form-label">No
                                                Telepon</label>
                                            <input type="number" class="form-control" id="" name="no_telepon"
                                                value="{{ $a->no_telepon }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="col-form-label" for="">Email</label>
                                            <input type="text" id="" name="email"
                                                class="form-control form-control @error('email') is-invalid @enderror"
                                                value="{{ $a->email }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="col-form-label" for="">Alamat</label>
                                            <input type="text" id="" name="alamat"
                                                class="form-control form-control @error('alamat') is-invalid @enderror"
                                                value="{{ $a->alamat }}" required>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="col-form-label" for="pass">Bekerja
                                                Sebagai</label>
                                            <input type="text" id="" name="kerjaan"
                                                class="form-control form-control @error('kerjaan') is-invalid @enderror"
                                                value="{{ $a->kerjaan }}" required>
                                            @error('kerjaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="col-form-label" for="">Username</label>
                                            <input type="text" id="" name="username"
                                                class="form-control form-control @error('username') is-invalid @enderror"
                                                value="{{ $a->username }}" required>
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="col-form-label" for="pass">password</label>
                                            <input type="password" id="pass" name="password"
                                                class="form-control form-control @error('password') is-invalid @enderror"
                                                required>
                                            <p class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i>Harap
                                                isi password dengan benar dan atau masukkan password
                                                baru</p>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <input type="text" value="Umum" name="role" class="form-control"
                                            hidden>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop{{ $a->id }}">
                        <i class="bi bi-trash3"></i>
                    </button>
                    <div class="modal fade" id="staticBackdrop{{ $a->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                        Peringatan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Anda yakin akan menghapus akun {{ $a->nama_lengkap }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <a href={{ Route('umum.hapus', $a->id) }} class="btn btn-danger">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if ($umum->isEmpty())
    <p class="text-center text-muted py-3">Data akun umum tidak ditemukan.</p>
@endif
<div class="d-flex justify-content-end mt-3">
    {{ $umum->links() }}
</div>

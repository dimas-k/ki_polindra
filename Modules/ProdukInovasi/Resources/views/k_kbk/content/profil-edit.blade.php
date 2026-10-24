<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-3">
        <h5 class="card-header border-3 w-100 mb-2"><i class='bx bx-table me-2'></i>Data
            {{ auth()->user()->nama_lengkap }}</h5>

        <div class="table-responsive text-nowrap">
            <form action="{{ route('update.profil', auth()->user()->id) }}" method="post" id="updateForm" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <table class="table table-borderless">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>
                            <input type="text" class="form-control {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td>
                            <input type="text" class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" id="nip" name="nip" value="{{ old('nip', auth()->user()->nip) }}">
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>
                            <input type="text" class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }}" id="jabatan" name="jabatan" value="{{ old('jabatan', auth()->user()->jabatan) }}">
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>Pas Foto</th>
                        <td>
                            <input type="file" id="foto" class="form-control {{ $errors->has('pas_foto') ? 'is-invalid' : '' }}" name="pas_foto" />
                            @error('pas_foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-danger"><i class='bx bxs-error me-1'></i>Jika ingin diganti silahkan isi, jika tidak biarkan</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>
                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>No Handphone</th>
                        <td>
                            <input type="number" class="form-control {{ $errors->has('no_hp') ? 'is-invalid' : '' }}" id="no_hp" name="no_hp" value="{{ old('no_hp', auth()->user()->no_hp) }}">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>Kelompok Bidang Keahlian</th>
                        <td>
                            <input type="text" class="form-control" id="kbk" name="kbk" value="{{ auth()->user()->kelompokKeahlian ? auth()->user()->kelompokKeahlian->nama_kbk : 'Tidak ada' }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>
                            <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" name="username" value="{{ old('username', auth()->user()->username) }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>Password Terakhir anda</th>
                        <td>
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_last" class="form-control {{ $errors->has('password_last') ? 'is-invalid' : '' }}" name="password_last" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    @error('password_last')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary m-2">Update</button>
            </form>
            
        </div>
    </div>
</div>

{{-- <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-3">
        <h5 class="card-header border-3 w-100 mb-2"><i class='bx bx-table me-2'></i>Data
            {{ auth()->user()->nama_lengkap }}</h5>

        <div class="table-responsive text-nowrap">
            <form action="{{ route('update.profil', auth()->user()->id) }}" method="post" id="updateForm">
                @method('PUT')
                @csrf
                <table class="table table-borderless">
                    <th>Nama Lengkap</th>
                    <td><input type="text" class="form-control " id="nama_lengkap"name="nama_lengkap"
                            value="{{ auth()->user()->nama_lengkap }}">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </td>
                    <!-- Field lainnya -->
                    <tr>
                        <th>Password Terakhir</th>
                        <td>
                            <input type="password" class="form-control" id="password_last" name="password_last"
                                placeholder="Masukkan password terakhir Anda" required>
                            @error('password_last')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary m-2">Update</button>
            </form>
        </div>
    </div>
</div> --}}

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-3">
        <h5 class="card-header border-3 w-100 mb-2"><i class='bx bx-table me-2'></i>Ubah Password Akun<br>
            {{ auth()->user()->nama_lengkap }}</h5>
        <div class="table-responsive text-nowrap">
            <form action="{{ route('proses.ubah.password', auth()->user()->id) }}" method="post" id="changePassForm">
                @csrf
                <table class="table table-borderless">
                    <tr>
                        <th><label for="password_lama" class="form-label">Password Lama</label></th>
                        <td>
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_lama" class="form-control" name="password_lama"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    @error('password_lama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th><label for="password_baru" class="form-label">Password Baru</label></th>
                        <td>
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_baru" class="form-control" name="password_baru"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    @error('password_baru')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="password_baru_confirmation" class="form-label">Konfirmasi Password</label></th>
                        <td>
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_baru_confirmation" class="form-control" name="password_baru_confirmation"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    @error('password_baru_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>                        
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary m-2">Ubah Password</button>
            </form>
        </div>
    </div>
</div>


<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register -->
        <div class="card px-sm-6 px-0">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="/" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('assets-admin/img/logo-item-bg.png') }}" alt=""
                                style="width: 110px; heigh: 50px">
                        </span>
                    </a>
                </div>
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- /Logo -->
                <h4 class="mb-1">Selamat Datang Kembali</h4>
                {{-- <p class="mb-6">Please sign-in to your account and start the adventure</p> --}}

                <form id="formAuthentication" class="mb-6" action="/login-admin/autentikasi" method="post">
                    @csrf
                    <div class="mb-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="email" name="username"
                            placeholder="Masukkan username anda" value="{{ old('username') }}" autofocus />
                    </div>
                    <div class="mb-6 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <br>
                    <div class="mb-6">
                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

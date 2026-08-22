<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href={{ URL('storage/polindra21.png') }}>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
    <title>SIKI-Admin | Tambah Admin</title>
</head>
<body>
    <div class="container">
        <a href="/admin/listadmin" class="link-dark link-underline link-underline-opacity-0 mb-3 "><i class="bi bi-arrow-left-circle mb-3" style="font-size: 35px;"></i></a>
        <form method="post" action="/simpan" class="mt-3">
            @csrf
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="">Nama Lengkap</label>
                <input type="text" id="" class="form-control" name="nama_lengkap" />
            </div>
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="">Jabatan</label>
                <input type="text" id="" class="form-control" name="jabatan" />
            </div>
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="">Alamat</label>
                <input type="text" id="" class="form-control" name="alamat"/>
            </div>
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="">No Telepon</label>
                <input type="text" id="" class="form-control" name="no_telepon"/>
            </div>
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="">Username</label>
                <input type="text" id="" class="form-control @error('username') is-invalid @enderror" name="username"/>
                @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
            </div>
            <div class="form-outline form-white mb-4">
                <label class="form-label" for="typePasswordX">Password</label>
                <input type="Password" id="" class="form-control @error('password') is-invalid @enderror" name="password"/>
                @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
            </div>
            <button class="btn bg-black text-white" type="submit">Tambah</button>
        </form>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <link href={{ asset('assets/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href={{ asset('assets/css/admin-theme.css') }} rel="stylesheet">
    <title>SIKI POLINDRA-Admin | Edit Admin</title>
</head>

<body>
    <div class="container mt-4 p-5 border rounded bg-light">
        <form method="post" action={{ Route('admin.update', $user->id) }}>
            @csrf
            <div class="form-outline form-white mb-3">
                <label class="form-label" for="">Nama Lengkap</label>
                <input type="text" id="" class="form-control" name="nama_lengkap" value={{ $user->nama_lengkap }} required>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="">Jabatan</label>
                <input type="text" id="" class="form-control" name="jabatan" value={{ $user->jabatan }}>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="">Alamat</label>
                <input type="text" id="" class="form-control" name="alamat" value={{ $user->alamat }}>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="">No Telepon</label>
                <input type="text" id="" class="form-control" name="no_telepon" value={{ $user->no_telepon }}>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="">Username</label>
                <input type="text" id="" class="form-control" name="username" value={{ $user->username }} required>
              </div>
              <div class="form-outline form-white mb-3">
                <label class="form-label" for="typePasswordX">Password</label>
                <input type="Password" id="" class="form-control" name="password" required>
              </div>
              <div class=" mt-4">
                <button class="btn bg-black btn-lg px-4 text-white" type="submit">Update</button>
              </div>
        </form>
    </div>
    <script src={{ asset('assets/bootstrap/js/dist/dropdown.js.map') }}></script>
    <script src={{ asset('assets/bootstrap/js/dist/collapse.js.map') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>

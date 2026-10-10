<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="shortcut icon" href={{ URL('storage/polindra21.png') }}>
    <title>SIKI POLINDRA | Pengajuan Desain Industri</title>
</head>

<body>
    {{-- nav --}}
    @include('layout.nav')
    {{-- end nav --}}

    <div class="container">
        <p class="fs-3 fw-normal font-family-Kokoro text-center mb-5">Formulir Pengajuan Desain Industri</p>
        <br>
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <span class="d-flex justify-content-end">
            <a href="https://drive.google.com/drive/folders/1a2GZs88nskQWqIIsA8asnVOdjbzjeT1_?usp=drive_link" target="_blank" class="link-dark link-underline link-underline-opacity-0" >
                <img src={{ URL('storage/downloadicon.png') }} alt="">Berkas Yang Di Perlukan
            </a>
        </span>
        <div class="border border-4 border-dark rounded"></div>
            <br>
            <form enctype="multipart/form-data" method="post" action="/simpandi">
                @csrf
                <p class="fs-4 fw-normal font-family-Kokoro">I. IDENTITAS</p>
                <div class="container">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                            id="" placeholder="Masukkan Nama"name="nama_lengkap">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id=""
                            placeholder="Masukkan Alamat" name="alamat">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">No telepon</label>
                        <input type="number" class="form-control @error('no_telepon') is-invalid @enderror" id=""
                            placeholder="Masukkan No telepon" name="no_telepon">
                        @error('no_telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id=""
                            class="form-control @error('tanggal_lahir') is-invalid @enderror">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">KTP Inventor</label>
                        <input type="file" class="form-control @error('ktp_inventor') is-invalid @enderror"
                            id="" name="ktp_inventor">
                        @error('ktp_inventor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id=""
                            placeholder="Masukkan Email" name="email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kewarganegaraan</label>
                        <input type="text" class="form-control @error('kewarganegaraan') is-invalid @enderror"
                            id="" placeholder="Masukkan Kewarganegaraan" name="kewarganegaraan">
                        @error('kewarganegaraan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Kode Pos</label>
                        <input type="number" class="form-control @error('kode_pos') is-invalid @enderror" id=""
                            placeholder="Masukkan Kode Pos" name="kode_pos">
                        @error('kode_pos')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <p class="fs-4 fw-normal font-family-Kokoro mt-5">II. FORMULIR DESAIN INDUSTRI</p>
                <div class="container">
                    <label for="" class="form-label">Jenis Desain</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_di" id="" value="Satu desain">
                        <label class="form-check-label" for="Satu desain">
                          Satu Desain
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_di" id="" value="Pecahan satu desain">
                        <label class="form-check-label" for="Pecahan satu desain">
                          Pecahan Satu Desain
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_di" id="" value="Satu kesatuan desain">
                        <label class="form-check-label" for="Satu kesatuan desain">
                          Satu Kesatuan Desain
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_di" id="" value="Kesatuan pecahan satu desain">
                        <label class="form-check-label" for="Kesatuan pecahan satu desain">
                          Kesatuan Pecahan Satu Desain
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Judul Desain Industri</label>
                        <input type="text" class="form-control @error('judul_di') is-invalid @enderror" placeholder="Masukkan Judul Desain Industri" name="judul_di">
                        @error('judul_di')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Gambar Desain Industri</label>
                        <input type="file" class="form-control @error('gambar_di') is-invalid @enderror" placeholder="" name="gambar_di[]" multiple accept=".pdf,.jpg,.jpeg,.png">
                        @error('gambar_di')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Uraian Desain Industri</label>
                        <input type="file" class="form-control @error('uraian_di') is-invalid @enderror" placeholder="" name="uraian_di">
                        @error('uraian_di')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Surat Pernyataan Kepemilikan</label>
                        <input type="file" class="form-control @error('surat_kepemilikan') is-invalid @enderror"  placeholder="" name="surat_kepemilikan">
                        @error('surat_kepemilikan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Surat Pengalihan Hak</label>
                        <input type="file" class="form-control @error('surat_pengalihan') is-invalid @enderror"  placeholder="" name="surat_pengalihan">
                        @error('surat_pengalihan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Pengajuan</label>
                        <input type="date" name="tanggal_permohonan" id="tanggalpengajuan" class="form-control @error('tanggal_permohonan') is-invalid @enderror">
                        @error('tanggal_permohonan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Harap Isi semua Form Dengan Benar</p>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </div>
            </form>
    </div>
    <footer class="text-center text-lg-star bg-body-white shadow-lg mt-5">
        <!-- Copyright -->
        <div class="text-center p-3">
            © 2023 Copyright:
            <a class="text-body link-underline link-underline-opacity-0" href="https://polindra.ac.id/">Politeknik Negeri Indramayu</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
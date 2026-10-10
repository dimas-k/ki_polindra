<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="shortcut icon" href={{ URL('storage/polindra21.png') }}>
    <title>SIKI POLINDRA | Pengajuan Hak Cipta</title>
</head>

<body>
    {{-- nav --}}
    @include('layout.nav')
    {{-- end nav --}}

    <div class="container">
        <p class="fs-3 fw-normal font-family-Kokoro text-center mb-5">Formulir Pengajuan Hak Cipta</p>
        <br>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <span class="d-flex justify-content-end">
            <a href="https://drive.google.com/drive/folders/1-7Cop9aiCcB8FOl93FAluVu4FpSXONNl?usp=drive_link"
                target="_blank" class="link-dark link-underline link-underline-opacity-0">
                <img src={{ URL('storage/downloadicon.png') }} alt="">Berkas Yang Di Perlukan
            </a>
        </span>
        <div class="border border-4 border-dark rounded"></div>
        <br>
        <form method="post" enctype="multipart/form-data" action="/simpanhk">
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
                    <input type="number" class="form-control @error('no_telepon') is-invalid @enderror"
                        id="" placeholder="Masukkan No telepon" name="no_telepon">
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

            <p class="fs-4 fw-normal font-family-Kokoro mt-5">II. FORMULIR HAK CIPTA</p>
            <div class="container">
                <div class="mb-3">
                    <label for="" class="form-label">Jenis Ciptaan</label>
                    <input type="text" class="form-control @error('jenis_ciptaan') is-invalid @enderror"
                        placeholder="Masukkan Jenis Ciptaan" name="jenis_ciptaan">
                    @error('jenis_ciptaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Judul Ciptaan</label>
                    <input type="text" class="form-control @error('judul_ciptaan') is-invalid @enderror"
                        placeholder="Masukkan Judul Ciptaan" name="judul_ciptaan">
                    @error('judul_ciptaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Uraian Singkat Ciptaan</label>
                    <textarea class="form-control @error('uraian_singkat') is-invalid @enderror" placeholder="Masukkan Uraian Siangkat" name="uraian_singkat" id="floatingTextarea2"
                        style="height: 150px"></textarea>
                        @error('uarian_singkat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Dokumen Invensi (Manual Book/Buku/Dll)</label>
                    <input type="file" class="form-control @error('dokumen_invensi') is-invalid @enderror"
                        placeholder="" name="dokumen_invensi">
                    @error('dokumen_invensi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
<div class="mb-3">
                    <label for="" class="form-label">Gambar Ciptaan (opsional, boleh lebih dari 1 file)</label>
                    <input type="file" class="form-control @error('gambar_ciptaan') is-invalid @enderror"
                        placeholder="" name="gambar_ciptaan[]" multiple accept=".pdf,.jpg,.jpeg,.png">
                    @error('gambar_ciptaan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Surat Pengalihan Hak Cipta</label>
                    <input type="file" class="form-control @error('surat_pengalihan') is-invalid @enderror"
                        placeholder="" name="surat_pengalihan">
                    @error('surat_pengalihan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Surat Pernyataan</label>
                    <input type="file" class="form-control @error('surat_pernyataan') is-invalid @enderror"
                        placeholder="" name="surat_pernyataan">
                    @error('surat_pernyataan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Pengajuan</label>
                    <input type="date" name="tanggal_permohonan" id="tanggalpengajuan"
                        class="form-control @error('tanggal_permohonan') is-invalid @enderror">
                    @error('tanggal_permohonan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <p class="text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Harap Isi semua Form Dengan
                    Benar</p>
                <button type="submit" class="btn btn-primary mt-3 ">Submit</button>
            </div>
        </form>
    </div>
    <footer class="text-center text-lg-star bg-body-white shadow-lg mt-5">
        <!-- Copyright -->
        <div class="text-center p-3">
            © 2023 Copyright:
            <a class="text-body link-underline link-underline-opacity-0" href="https://polindra.ac.id/">Politeknik
                Negeri Indramayu</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js">
        var element = document.querySelector("trix-editor")
        element.editor // is a Trix.Editor instance

        var document = element.editor.getDocument()
        document.toString()  // is a JavaScript string

        element.editor.setSelectedRange()

        localStorage["editorState"] = JSON.stringify(element.editor)

        // Restore editor state from local storage
        element.editor.loadJSON(JSON.parse(localStorage["editorState"]))
        
        element.editor.activateAttribute("bold")

        element.editor.activateAttribute("italic")
    </script>
    <script>
        $(".tm").on("change", function() {
            this.setAttribute(
                "tanggal_lahir", "tanggal_permohonan",
                moment(this.value, "mm/dd/yy")
                .format(this.getAttribute("data-date-format"))
            )
        }).trigger("change")
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>

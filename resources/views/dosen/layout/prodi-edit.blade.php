
<select class="form-select" aria-label="Default select example" name="prodi"
    id="prodi">
                <option value="">Pilih Prodi</option>
                @foreach($prodiOptions as $pr)
                    <option value="{{ $pr->nama_prodi }}">{{ $pr->nama_prodi }}</option>
                @endforeach
            </select>
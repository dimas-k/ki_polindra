<label for="jurusan" class="form-label">Jurusan</label>
<select class="form-select " aria-label="Default select example" name="jurusan"
    id="jurusan">
                <option value="">Pilih Jurusan</option>
                @foreach($jurusanOptions as $j)
                    <option value="{{ $j->nama_jurusan }}">{{ $j->nama_jurusan }}</option>
                @endforeach
            </select>
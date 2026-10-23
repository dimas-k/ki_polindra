{{--
    Form tambah/edit kanal pembayaran (dipakai di modal tambah & edit).
    Variabel yang diharapkan:
    - $formId     : suffix unik untuk id elemen (mis. "tambah" atau id bank)
    - $action     : url tujuan submit
    - $method     : "POST" (tambah) atau "POST" + @method('PUT') untuk update via multipart
    - $b          : instance PaymentBankAccount saat edit, null saat tambah
    - $submitLabel: label tombol submit
--}}
<form method="post" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label" for="tipe_{{ $formId }}">Tipe Kanal</label>
        <select id="tipe_{{ $formId }}" name="tipe" class="form-select @error('tipe') is-invalid @enderror"
            data-tipe-select="{{ $formId }}" required>
            @foreach (\App\Models\PaymentBankAccount::tipeOptions() as $value => $label)
                <option value="{{ $value }}" @selected(old('tipe', $b->tipe ?? 'transfer_manual') === $value)>
                    {{ $label }}</option>
            @endforeach
        </select>
        @error('tipe')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="nama_bank_{{ $formId }}">Nama Bank / Kanal</label>
        <input type="text" id="nama_bank_{{ $formId }}"
            class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank"
            value="{{ old('nama_bank', $b->nama_bank ?? '') }}" placeholder="mis. Bank BRI, Bank Mandiri, QRIS"
            required>
        @error('nama_bank')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div data-rekening-wrap="{{ $formId }}">
        <div class="mb-3">
            <label class="form-label" for="nomor_rekening_{{ $formId }}">Nomor Rekening / Nomor VA</label>
            <input type="text" id="nomor_rekening_{{ $formId }}"
                class="form-control @error('nomor_rekening') is-invalid @enderror" name="nomor_rekening"
                value="{{ old('nomor_rekening', $b->nomor_rekening ?? '') }}">
            @error('nomor_rekening')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="atas_nama_{{ $formId }}">Atas Nama</label>
            <input type="text" id="atas_nama_{{ $formId }}" class="form-control" name="atas_nama"
                value="{{ old('atas_nama', $b->atas_nama ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label" for="kode_bank_{{ $formId }}">Kode Bank (khusus Virtual Account)</label>
            <input type="text" id="kode_bank_{{ $formId }}" class="form-control" name="kode_bank"
                value="{{ old('kode_bank', $b->kode_bank ?? '') }}" placeholder="mis. 002, 008, 014">
        </div>

        <div class="mb-3">
            <label class="form-label" for="logo_{{ $formId }}">Logo Bank (opsional)</label>
            <input type="file" id="logo_{{ $formId }}" class="form-control @error('logo') is-invalid @enderror"
                name="logo" accept="image/*">
            @error('logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if (!empty($b?->logo))
                <div class="form-text">Logo saat ini: {{ basename($b->logo) }}</div>
            @endif
        </div>
    </div>

    <div data-qris-wrap="{{ $formId }}" class="d-none">
        <div class="mb-3">
            <label class="form-label" for="qris_image_{{ $formId }}">Gambar QRIS</label>
            <input type="file" id="qris_image_{{ $formId }}"
                class="form-control @error('qris_image') is-invalid @enderror" name="qris_image" accept="image/*">
            @error('qris_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if (!empty($b?->qris_image))
                <div class="form-text">Gambar saat ini: {{ basename($b->qris_image) }}</div>
            @endif
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="catatan_{{ $formId }}">Catatan / Instruksi untuk Pengaju (opsional)</label>
        <textarea id="catatan_{{ $formId }}" class="form-control" name="catatan" rows="2">{{ old('catatan', $b->catatan ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label" for="urutan_{{ $formId }}">Urutan Tampil</label>
        <input type="number" id="urutan_{{ $formId }}" class="form-control" name="urutan" min="0"
            value="{{ old('urutan', $b->urutan ?? 0) }}">
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" class="form-check-input" id="is_active_{{ $formId }}" name="is_active"
            value="1" @checked(old('is_active', $b->is_active ?? true))>
        <label class="form-check-label" for="is_active_{{ $formId }}">Aktif (tampil sebagai pilihan saat admin
            membuat tagihan)</label>
    </div>

    <div class="form-check mb-4">
        <input type="checkbox" class="form-check-input" id="is_default_{{ $formId }}" name="is_default"
            value="1" @checked(old('is_default', $b->is_default ?? false))>
        <label class="form-check-label" for="is_default_{{ $formId }}">Jadikan kanal default</label>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    </div>
</form>

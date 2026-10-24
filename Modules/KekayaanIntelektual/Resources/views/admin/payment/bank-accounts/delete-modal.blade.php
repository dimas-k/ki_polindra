{{-- Modal Hapus Kanal Pembayaran. Variabel: $b (PaymentBankAccount) --}}
<div class="modal fade" id="hapusBankModal{{ $b->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="hapusBankModalLabel{{ $b->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapusBankModalLabel{{ $b->id }}">Peringatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda yakin akan menghapus kanal pembayaran {{ $b->nama_bank }}
                ({{ $b->nomor_rekening ?? 'QRIS' }}) ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="post" action="{{ url('/admin/payment/bank-accounts/' . $b->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

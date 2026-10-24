{{-- Modal Edit Kanal Pembayaran. Variabel: $b (PaymentBankAccount) --}}
<div class="modal fade" id="editBankModal{{ $b->id }}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="editBankModalLabel{{ $b->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editBankModalLabel{{ $b->id }}">Edit {{ $b->nama_bank }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('kekayaanintelektual::admin.payment.bank-accounts.form', [
                    'formId' => $b->id,
                    'action' => url('/admin/payment/bank-accounts/' . $b->id),
                    'method' => 'PUT',
                    'b' => $b,
                    'submitLabel' => 'Update',
                ])
            </div>
        </div>
    </div>
</div>

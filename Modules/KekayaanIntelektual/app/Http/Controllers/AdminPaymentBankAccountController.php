<?php

namespace Modules\KekayaanIntelektual\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentBankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPaymentBankAccountController extends Controller
{
    /**
     * Tampilkan daftar bank/kanal pembayaran yang dikelola admin.
     */
    public function index()
    {
        $bankAccounts = PaymentBankAccount::urut()->get();

        return view('kekayaanintelektual::admin.payment.bank-accounts.index', compact('bankAccounts'));
    }

    /**
     * Simpan kanal pembayaran baru (transfer manual / VA / QRIS).
     */
    public function store(Request $request)
    {
        $validated = $this->validatedData($request);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('payment-bank-accounts/logo', 'public');
        }

        if ($request->hasFile('qris_image')) {
            $validated['qris_image'] = $request->file('qris_image')->store('payment-bank-accounts/qris', 'public');
        }

        $bankAccount = new PaymentBankAccount($validated);
        $bankAccount->is_active = $request->boolean('is_active', true);
        $bankAccount->save();

        if ($request->boolean('is_default')) {
            $this->jadikanDefault($bankAccount);
        }

        return redirect('/admin/payment/bank-accounts')->with('success', 'Kanal pembayaran berhasil ditambahkan.');
    }

    /**
     * Perbarui kanal pembayaran.
     */
    public function update(Request $request, string $id)
    {
        $bankAccount = PaymentBankAccount::findOrFail($id);

        $validated = $this->validatedData($request);

        if ($request->hasFile('logo')) {
            if ($bankAccount->logo) {
                Storage::disk('public')->delete($bankAccount->logo);
            }
            $validated['logo'] = $request->file('logo')->store('payment-bank-accounts/logo', 'public');
        }

        if ($request->hasFile('qris_image')) {
            if ($bankAccount->qris_image) {
                Storage::disk('public')->delete($bankAccount->qris_image);
            }
            $validated['qris_image'] = $request->file('qris_image')->store('payment-bank-accounts/qris', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $bankAccount->update($validated);

        if ($request->boolean('is_default')) {
            $this->jadikanDefault($bankAccount);
        }

        return redirect('/admin/payment/bank-accounts')->with('success', 'Kanal pembayaran berhasil diperbarui.');
    }

    /**
     * Hapus kanal pembayaran.
     * Ditolak kalau kanal masih dipakai pada riwayat pembayaran,
     * supaya riwayat lama tetap bisa dirunut sumber rekeningnya.
     */
    public function destroy(string $id)
    {
        $bankAccount = PaymentBankAccount::findOrFail($id);

        if ($bankAccount->payments()->exists()) {
            return redirect('/admin/payment/bank-accounts')
                ->with('error', 'Kanal pembayaran tidak bisa dihapus karena sudah pernah dipakai pada transaksi. Nonaktifkan saja jika tidak dipakai lagi.');
        }

        if ($bankAccount->logo) {
            Storage::disk('public')->delete($bankAccount->logo);
        }
        if ($bankAccount->qris_image) {
            Storage::disk('public')->delete($bankAccount->qris_image);
        }

        $bankAccount->delete();

        return redirect('/admin/payment/bank-accounts')->with('success', 'Kanal pembayaran berhasil dihapus.');
    }

    /**
     * Aktif/nonaktifkan kanal pembayaran tanpa membuka form edit.
     */
    public function toggleAktif(string $id)
    {
        $bankAccount = PaymentBankAccount::findOrFail($id);
        $bankAccount->update(['is_active' => !$bankAccount->is_active]);

        return redirect('/admin/payment/bank-accounts')->with('success', 'Status kanal pembayaran berhasil diubah.');
    }

    /**
     * Jadikan sebagai kanal pembayaran default (tampil utama di halaman pembayaran pengaju).
     */
    protected function jadikanDefault(PaymentBankAccount $bankAccount): void
    {
        PaymentBankAccount::where('id', '!=', $bankAccount->id)->update(['is_default' => false]);
        $bankAccount->update(['is_default' => true]);
    }

    protected function validatedData(Request $request): array
    {
        return $request->validate([
            'tipe' => 'required|in:transfer_manual,virtual_account,qris',
            'nama_bank' => 'required|string|max:100',
            'nomor_rekening' => 'nullable|required_unless:tipe,qris|string|max:100',
            'atas_nama' => 'nullable|string|max:150',
            'kode_bank' => 'nullable|string|max:20',
            'catatan' => 'nullable|string|max:500',
            'urutan' => 'nullable|integer|min:0',
            'logo' => 'nullable|image|max:1024',
            'qris_image' => 'nullable|required_if:tipe,qris|image|max:2048',
        ]);
    }
}

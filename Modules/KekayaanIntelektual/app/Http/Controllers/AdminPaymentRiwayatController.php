<?php

namespace Modules\KekayaanIntelektual\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentRiwayatController extends Controller
{
    /**
     * Riwayat seluruh transaksi pembayaran (Midtrans & manual),
     * dengan filter status dan metode.
     */
    public function index(Request $request)
    {
        $query = Payment::with(['payable', 'bankAccount', 'user'])
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('tipe_pembayaran')) {
            $query->where('tipe_pembayaran', $request->input('tipe_pembayaran'));
        }

        $payments = $query->paginate(20)->withQueryString();

        return view('kekayaanintelektual::admin.payment.riwayat.index', compact('payments'));
    }
}

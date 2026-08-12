@component('emails.layout', ['headerColor' => '#f83600'])
<h2 style="margin:0 0 16px; font-size:19px; color:#1f2937;">
    {{ $isReminder ? 'Pengingat Tagihan Pembayaran' : 'Tagihan Pembayaran Baru' }}
</h2>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Halo <strong>{{ $namaPengaju }}</strong>,
</p>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    @if ($isReminder)
        Ini adalah pengingat bahwa tagihan pembayaran untuk pengajuan <strong>{{ $payment->jenis_pengajuan }}</strong>
        &mdash; <strong>"{{ $judul }}"</strong> &mdash; akan segera jatuh tempo dan belum kami terima pembayarannya.
    @else
        Pengajuan <strong>{{ $payment->jenis_pengajuan }}</strong> Anda &mdash; <strong>"{{ $judul }}"</strong> &mdash;
        memerlukan pembayaran agar dapat diproses lebih lanjut.
    @endif
</p>

<table role="presentation" style="width:100%; margin:20px 0; background:#f9fafb; border-radius:8px; padding:4px;">
    <tr>
        <td style="padding:16px;">
            <div style="font-size:12px; color:#9ca3af;">Jumlah Tagihan</div>
            <div style="font-size:22px; font-weight:700; color:#1f2937;">
                Rp{{ number_format($payment->nominal, 0, ',', '.') }}
            </div>
        </td>
    </tr>
    <tr>
        <td style="padding:0 16px 16px;">
            <div style="font-size:12px; color:#9ca3af;">Batas Waktu Pembayaran</div>
            <div style="font-size:15px; font-weight:600; color:#f83600;">
                {{ $payment->tenggat_pembayaran->translatedFormat('d F Y, H:i') }} WIB
            </div>
        </td>
    </tr>
</table>

<div style="text-align:center; margin:28px 0;">
    <a href="{{ $paymentUrl }}"
        style="display:inline-block; background:linear-gradient(135deg, rgb(255,99,132), #f83600); color:#fff; text-decoration:none; font-weight:600; font-size:14px; padding:14px 32px; border-radius:8px;">
        Bayar Sekarang
    </a>
</div>

<p style="font-size:13px; color:#9ca3af; line-height:1.6;">
    Jika tombol di atas tidak berfungsi, salin dan buka tautan berikut di browser Anda:<br>
    <a href="{{ $paymentUrl }}" style="color:#f83600; word-break:break-all;">{{ $paymentUrl }}</a>
</p>

<p style="font-size:14px; color:#374151; line-height:1.6; margin-top:24px;">
    Terima kasih,<br>
    <strong>Tim SIKI Polindra</strong>
</p>
@endcomponent

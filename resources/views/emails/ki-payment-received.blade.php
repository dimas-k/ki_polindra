@component('emails.layout', ['headerColor' => '#16a34a'])
<h2 style="margin:0 0 16px; font-size:19px; color:#1f2937;">Pembayaran Berhasil Diterima</h2>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Halo <strong>{{ $namaPengaju }}</strong>,
</p>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Terima kasih, pembayaran untuk pengajuan <strong>{{ $payment->jenis_pengajuan }}</strong> &mdash;
    <strong>"{{ $judul }}"</strong> &mdash; telah kami terima.
</p>

<table role="presentation" style="width:100%; margin:20px 0; background:#f0fdf4; border-radius:8px;">
    <tr>
        <td style="padding:16px;">
            <div style="font-size:12px; color:#16a34a;">Jumlah Dibayar</div>
            <div style="font-size:22px; font-weight:700; color:#15803d;">
                Rp{{ number_format($payment->nominal, 0, ',', '.') }}
            </div>
        </td>
    </tr>
    <tr>
        <td style="padding:0 16px 16px;">
            <div style="font-size:12px; color:#9ca3af;">Waktu Pembayaran</div>
            <div style="font-size:14px; font-weight:600; color:#1f2937;">
                {{ optional($payment->paid_at)->translatedFormat('d F Y, H:i') }} WIB
            </div>
        </td>
    </tr>
</table>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Pengajuan Anda akan terus kami proses. Kami akan mengabari Anda kembali lewat email setiap ada perubahan status.
</p>

<p style="font-size:14px; color:#374151; line-height:1.6; margin-top:24px;">
    Terima kasih,<br>
    <strong>Tim SIKI Polindra</strong>
</p>
@endcomponent

@component('emails.layout', ['headerColor' => '#f83600'])
<h2 style="margin:0 0 16px; font-size:19px; color:#1f2937;">Pengajuan Anda Telah Kami Terima</h2>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Halo <strong>{{ $namaPengaju }}</strong>,
</p>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Pengajuan <strong>{{ $jenisKi }}</strong> Anda dengan judul/nama <strong>"{{ $judul }}"</strong>
    telah berhasil kami terima dan akan segera diverifikasi oleh tim kami.
</p>

<table role="presentation" style="width:100%; margin:20px 0; background:#f9fafb; border-radius:8px; padding:16px;">
    <tr>
        <td style="padding:6px 0; font-size:13px; color:#9ca3af;">Status saat ini</td>
    </tr>
    <tr>
        <td style="padding:0; font-size:15px; font-weight:700; color:#f83600;">{{ $status }}</td>
    </tr>
</table>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Kami akan mengirimkan email setiap kali ada perubahan status pada pengajuan Anda, termasuk
    apabila ada tagihan pembayaran yang perlu diselesaikan.
</p>

<p style="font-size:14px; color:#374151; line-height:1.6; margin-top:24px;">
    Terima kasih,<br>
    <strong>Tim SIKI Polindra</strong>
</p>
@endcomponent

@component('emails.layout', ['headerColor' => '#16a34a'])
<h2 style="margin:0 0 16px; font-size:19px; color:#1f2937;">Akun Anda Telah Berhasil Diverifikasi</h2>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Halo <strong>{{ $namaLengkap }}</strong>,
</p>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Kabar baik! Akun Anda telah berhasil diverifikasi oleh admin SIKI Polindra. Anda sekarang sudah dapat
    masuk dan menggunakan seluruh layanan pada sistem.
</p>

<p style="text-align:center; margin:24px 0;">
    <a href="{{ $loginUrl }}" style="background:#16a34a; color:#fff; text-decoration:none; padding:12px 24px; border-radius:8px; font-size:14px; font-weight:600; display:inline-block;">
        Masuk ke SIKI Polindra
    </a>
</p>

<p style="font-size:14px; color:#374151; line-height:1.6; margin-top:24px;">
    Terima kasih,<br>
    <strong>Tim SIKI Polindra</strong>
</p>
@endcomponent

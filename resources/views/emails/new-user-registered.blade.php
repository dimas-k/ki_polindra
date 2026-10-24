@component('emails.layout', ['headerColor' => '#1f2937'])
<h2 style="margin:0 0 16px; font-size:19px; color:#1f2937;">Pendaftaran Akun Baru</h2>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Halo Admin,
</p>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Ada pendaftaran akun baru pada SIKI Polindra yang menunggu verifikasi Anda.
</p>

<table role="presentation" style="width:100%; margin:20px 0; background:#f9fafb; border-radius:8px; padding:16px;">
    <tr>
        <td style="padding:6px 0; font-size:13px; color:#9ca3af;">Nama Lengkap</td>
        <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;"><strong>{{ $namaLengkap }}</strong></td>
    </tr>
    @if ($role === 'Dosen')
        <tr>
            <td style="padding:6px 0; font-size:13px; color:#9ca3af;">NIP</td>
            <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;">{{ $nip ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; font-size:13px; color:#9ca3af;">Email</td>
            <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;">{{ $email }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; font-size:13px; color:#9ca3af;">No Telepon</td>
            <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;">{{ $noTelepon ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; font-size:13px; color:#9ca3af;">Username</td>
            <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;">{{ $username ?? '-' }}</td>
        </tr>
    @else
        <tr>
            <td style="padding:6px 0; font-size:13px; color:#9ca3af;">Email</td>
            <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;">{{ $email }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; font-size:13px; color:#9ca3af;">Alamat</td>
            <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;">{{ $alamat ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; font-size:13px; color:#9ca3af;">No Telepon</td>
            <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;">{{ $noTelepon ?? '-' }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; font-size:13px; color:#9ca3af;">Username</td>
            <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;">{{ $username ?? '-' }}</td>
        </tr>
    @endif
    <tr>
        <td style="padding:6px 0; font-size:13px; color:#9ca3af;">Peran</td>
        <td style="padding:6px 0; font-size:14px; color:#1f2937; text-align:right;">{{ $role }}</td>
    </tr>
</table>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Pengguna ini belum dapat masuk ke sistem sampai akunnya diverifikasi. Silakan tinjau dan verifikasi
    akun tersebut melalui tautan berikut:
</p>

<p style="text-align:center; margin:24px 0;">
    <a href="{{ $verifUrl }}" style="background:#1f2937; color:#fff; text-decoration:none; padding:12px 24px; border-radius:8px; font-size:14px; font-weight:600; display:inline-block;">
        Tinjau &amp; Verifikasi Akun
    </a>
</p>

<p style="font-size:14px; color:#374151; line-height:1.6; margin-top:24px;">
    Terima kasih,<br>
    <strong>Sistem SIKI Polindra</strong>
</p>
@endcomponent

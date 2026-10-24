@component('emails.layout', ['headerColor' => '#f83600'])
<h2 style="margin:0 0 16px; font-size:19px; color:#1f2937;">Status Pengajuan Anda Diperbarui</h2>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Halo <strong>{{ $namaPengaju }}</strong>,
</p>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Status pengajuan <strong>{{ $jenisKi }}</strong> Anda &mdash; <strong>"{{ $judul }}"</strong> &mdash; telah diperbarui.
</p>

<table role="presentation" style="width:100%; margin:20px 0;">
    <tr>
        <td style="padding:12px; background:#f9fafb; border-radius:8px 0 0 8px; width:50%;">
            <div style="font-size:12px; color:#9ca3af;">Status sebelumnya</div>
            <div style="font-size:14px; color:#6b7280; text-decoration:line-through;">{{ $statusLama }}</div>
        </td>
        <td style="padding:12px; background:#fff3ee; border-radius:0 8px 8px 0; width:50%;">
            <div style="font-size:12px; color:#f83600;">Status saat ini</div>
            <div style="font-size:15px; font-weight:700; color:#f83600;">{{ $statusBaru }}</div>
        </td>
    </tr>
</table>

<p style="font-size:14px; color:#374151; line-height:1.6;">
    Silakan masuk ke akun SIKI Polindra Anda untuk melihat detail lengkap pengajuan.
</p>

<p style="font-size:14px; color:#374151; line-height:1.6; margin-top:24px;">
    Terima kasih,<br>
    <strong>Tim SIKI Polindra</strong>
</p>
@endcomponent

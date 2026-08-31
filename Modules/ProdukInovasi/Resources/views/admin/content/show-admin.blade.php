<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-2">
        <h5 class="card-header border-3 w-100 mb-2"><i class='bx bx-table me-2'></i>Data {{ $admin->nama_lengkap }}</h5>
        <img src="{{ auth()->user()->pas_foto && file_exists(public_path('storage/' . auth()->user()->pas_foto)) ? asset('storage/' . auth()->user()->pas_foto) : asset('assets/foto_user_default.png') }}" class="rounded-circle mx-auto d-block mb-5 mt-2" alt="" style="width: 140px; height: 140px; border-radius: 70%; object-fit: cover;">
        <div class="table-responsive text-nowrap">
        <div class="table-responsive text-nowrap">
            <table class="table table-borderless">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>: {{ $admin->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>nip</th>
                    <td>: {{ $admin->nip }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>: {{ $admin->jabatan }}</td>
                </tr>
                <tr>
                    <th>email</th>
                    <td>: {{ $admin->email }}</td>
                </tr>
                <tr>
                    <th>no handphone</th>
                    <td>: {{ $admin->no_hp }}</td>
                </tr>
                <tr>
                    <th>username</th>
                    <td>: {{ $admin->username }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

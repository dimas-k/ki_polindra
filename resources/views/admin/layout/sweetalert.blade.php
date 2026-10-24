{{-- Shared SweetAlert2 setup for admin pages.
     Loads the library once and turns any Laravel session flash message
     (success / error / loginError) into a SweetAlert2 popup. --}}
@once
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endonce

@if (session()->has('success') || session()->has('error') || session()->has('loginError'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: @js(session()->has('success') ? 'success' : 'error'),
                title: @js(session()->has('success') ? 'Berhasil' : 'Gagal'),
                text: @js(session('success') ?? session('error') ?? session('loginError')),
                confirmButtonColor: '#003d7a',
            });
        });
    </script>
@endif

@once
    {{-- Generic confirmation dialog: add class "js-sweetalert-confirm" to any
         <a> or <button>, with data-message="..." (and optionally
         data-confirm-text="..." / data-title="...") instead of using the
         native onclick="return confirm(...)". Works for plain links
         (navigates to href) and for buttons inside a <form> (submits the form). --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.js-sweetalert-confirm').forEach(function (el) {
                el.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: el.dataset.title || 'Apakah Kamu Yakin?',
                        text: el.dataset.message || '',
                        icon: el.dataset.icon || 'question',
                        showCancelButton: true,
                        confirmButtonText: el.dataset.confirmText || 'Ya',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#003d7a',
                        cancelButtonColor: '#6c757d',
                    }).then(function (result) {
                        if (!result.isConfirmed) return;
                        var form = el.closest('form');
                        if (form) {
                            form.submit();
                        } else if (el.getAttribute('href')) {
                            window.location.href = el.getAttribute('href');
                        }
                    });
                });
            });
        });
    </script>
@endonce

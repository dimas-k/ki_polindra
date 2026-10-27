/**
 * FilePond Multi-Upload Helper untuk SIKI POLINDRA
 * Memudahkan pengguna mengunggah beberapa file (gambar/PDF) sekaligus
 * atau SATU PER SATU secara bertahap tanpa harus menahan tombol Ctrl/Shift.
 */
(function (window) {
    'use strict';

    if (typeof window.FilePond === 'undefined') {
        return;
    }

    // Daftarkan plugin-plugin FilePond jika tersedia
    const plugins = [];
    if (typeof window.FilePondPluginImagePreview !== 'undefined') {
        plugins.push(window.FilePondPluginImagePreview);
    }
    if (typeof window.FilePondPluginFileValidateType !== 'undefined') {
        plugins.push(window.FilePondPluginFileValidateType);
    }
    if (typeof window.FilePondPluginFileValidateSize !== 'undefined') {
        plugins.push(window.FilePondPluginFileValidateSize);
    }

    if (plugins.length > 0) {
        window.FilePond.registerPlugin(...plugins);
    }

    // Ekstensi yang diizinkan (harus sinkron dengan validasi backend:
    // mimes:pdf,jpg,jpeg,png di MultiFileStorage::RULE_EACH_FILE)
    const ALLOWED_EXT = ['pdf', 'jpg', 'jpeg', 'png'];

    function getExt(filename) {
        return (filename || '').split('.').pop().toLowerCase();
    }

    function showTypeError(filename) {
        const msg = 'File "' + filename + '" ditolak: hanya file PDF, JPG, JPEG, atau PNG yang diizinkan.';
        if (typeof Swal !== 'undefined') {
            Swal.fire({ icon: 'error', title: 'Format file tidak didukung', text: msg });
        } else {
            alert(msg);
        }
    }

    // Default label bahasa Indonesia & konfigurasi multi-upload
    const defaultOptions = {
        credits: false,
        allowMultiple: true,
        allowReorder: true,
        maxFileSize: '2MB', // selaras dengan validasi backend: max:2028 (KB) di MultiFileStorage::RULE_EACH_FILE

        // === PERBAIKAN UTAMA ===
        // Tanpa opsi `server`, FilePond secara default TIDAK mengikutsertakan
        // file yang dipilih ke dalam <form> biasa (plain multipart submit).
        // File hanya disimpan di state internal FilePond (virtual), sehingga
        // saat form di-submit, field seperti gambar_di[]/gambar_tampilan[]/
        // gambar_ciptaan[] dikirim KOSONG ke server -> validasi backend
        // (required|array|min:1) gagal -> data tidak bisa disimpan.
        // `storeAsFile: true` membuat FilePond menaruh file yang dipilih ke
        // dalam <input type="file"> tersembunyi dengan nama field yang sama,
        // sehingga ikut terkirim secara normal saat form displain submit.
        storeAsFile: true,

        // Validasi MIME type (acceptedFileTypes) SENGAJA tidak dipakai di sini.
        // Browser kerap melaporkan MIME type PDF/gambar secara tidak konsisten
        // (terutama file dari Windows/cloud drive), dan versi plugin
        // filepond-plugin-file-validate-type yang terpasang mungkin tidak
        // mendukung override deteksi tipe. Supaya tidak bergantung ke itu,
        // validasi format dilakukan manual lewat ekstensi nama file di hook
        // `beforeAddFile` di bawah.
        allowFileTypeValidation: false,
        beforeAddFile: function (item) {
            const file = item.file;
            const ext = getExt(file.name);
            if (ALLOWED_EXT.indexOf(ext) === -1) {
                showTypeError(file.name);
                return false;
            }
            return true;
        },
        labelIdle: '<i class="bi bi-cloud-arrow-up fs-2 d-block mb-1 text-primary"></i> Seret & lepas file di sini atau <span class="filepond--label-action text-primary fw-bold text-decoration-underline">Pilih File</span><br><small class="text-muted">Boleh pilih lebih dari 1 file (bisa klik berulang kali tanpa tombol Ctrl)</small>',
        labelInvalidField: 'Field berisi file tidak valid',
        labelFileWaitingForSize: 'Menghitung ukuran...',
        labelFileSizeNotAvailable: 'Ukuran tidak tersedia',
        labelFileLoading: 'Memuat...',
        labelFileLoadError: 'Gagal memuat file',
        labelFileProcessing: 'Memproses...',
        labelFileProcessingComplete: 'Selesai',
        labelFileProcessingAborted: 'Dibatalkan',
        labelFileProcessingError: 'Kesalahan memproses',
        labelButtonRemoveItem: 'Hapus',
        labelButtonAbortItemLoad: 'Batal',
        labelButtonRetryItemLoad: 'Ulangi',
        labelButtonAbortItemProcessing: 'Batal',
        labelButtonStopItemProcessing: 'Berhenti',
        labelButtonRetryItemProcessing: 'Ulangi',
        labelButtonProcessItem: 'Unggah',
        labelFileTypeNotAllowed: 'Tipe file tidak diizinkan (harus PDF, JPG, JPEG, atau PNG)',
        fileValidateTypeLabelExpectedTypes: 'Harus berupa file {allButLastType} atau {lastType}',
        labelMaxFileSizeExceeded: 'Ukuran file terlalu besar',
        labelMaxFileSize: 'Maksimal ukuran file adalah {filesize}',
    };

    /**
     * Inisialisasi FilePond pada elemen input file
     * @param {HTMLElement|string} target
     * @param {Object} customOptions
     * @returns {FilePond}
     */
    window.initMultiFilePond = function (target, customOptions) {
        const el = typeof target === 'string' ? document.querySelector(target) : target;
        if (!el) return null;

        // Jika input memiliki atribut 'required', kita hapus atribut native HTML-nya
        // untuk mencegah error browser "An invalid form control is not focusable"
        // saat form disubmit dalam keadaan kosong.
        const wasRequired = el.hasAttribute('required');
        if (wasRequired) {
            el.removeAttribute('required');
        }

        const mergedOptions = Object.assign({}, defaultOptions, customOptions || {});

        const pond = window.FilePond.create(el, mergedOptions);

        // Jika form parent disubmit, pastikan jika wajib diisi minimal ada 1 file
        if (wasRequired) {
            const form = pond.element.closest('form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    if (pond.getFiles().length === 0) {
                        e.preventDefault();
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Perhatian',
                                text: 'Harap masukkan minimal 1 file gambar/dokumen tampilan!',
                            });
                        } else {
                            alert('Harap masukkan minimal 1 file gambar/dokumen tampilan!');
                        }
                    }
                });
            }
        }

        return pond;
    };

    // Auto-init elemen dengan attribute [data-filepond-multi], class .filepond-multi,
    // atau field multi-upload Kekayaan Intelektual (gambar_tampilan, gambar_ciptaan, gambar_di)
    function autoInit() {
        const selector = [
            'input[type="file"][data-filepond-multi]',
            'input[type="file"].filepond-multi',
            'input[type="file"][name="gambar_tampilan[]"]',
            'input[type="file"][name="gambar_ciptaan[]"]',
            'input[type="file"][name="gambar_di[]"]',
            'input[type="file"]#g_tampilan',
            'input[type="file"]#gambar_desain',
            'input[type="file"]#gambar_ciptaan'
        ].join(', ');

        document.querySelectorAll(selector).forEach(function (input) {
            if (!input.dataset.filepondInitialized) {
                input.dataset.filepondInitialized = 'true';
                window.initMultiFilePond(input);
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', autoInit);
    } else {
        autoInit();
    }

})(window);
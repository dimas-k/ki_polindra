<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <img src="{{ asset('assets/logo-polindra.png') }}" alt="Logo Politeknik Negeri Indramayu"
        class="polindra-spinner-logo">
</div>
<!-- Spinner End -->

<style>
    #spinner {
        z-index: 99999;
    }

    .polindra-spinner-logo {
        width: 110px;
        height: 110px;
        object-fit: contain;
        animation: polindra-spin-pulse 1.2s ease-in-out infinite;
    }

    @keyframes polindra-spin-pulse {
        0%, 100% {
            transform: scale(0.85);
            opacity: 0.6;
        }

        50% {
            transform: scale(1.1);
            opacity: 1;
        }
    }
</style>

<!-- Brand & Contact Start -->
<div class="container-fluid py-4 px-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="row align-items-center top-bar">
        <div class="col-lg-4 col-md-12 text-center text-lg-start">
            <a href="/" class="navbar-brand m-0 p-0">
                <img src="{{ asset('assets/img/logo-biru-bg.png') }}" style="width: 160px; height:auto">
            </a>
        </div>
        <div class="col-lg-8 col-md-7 d-none d-lg-block">
            <div class="row">  
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="flex-shrink-0 btn-lg-square border rounded-circle">
                            <i class="far fa-envelope text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <p class="mb-2">Email Us</p>
                            <a href="mailto:sentra_ki@polindra.ac.id">sentra_ki@polindra.ac.id</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand & Contact End -->
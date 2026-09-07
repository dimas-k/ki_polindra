<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-4 text-white animated slideInDown mb-3">Kontak Kami</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="/dproin-polindra">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Kontak kami</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<style>
    .contact-info-card {
        background: #fff;
        border-radius: 14px;
        padding: 28px 24px;
        height: 100%;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .contact-info-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(82, 110, 234, 0.15);
    }

    .contact-info-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #5f79f0, #526eea);
        color: #fff;
        font-size: 1.4rem;
        margin-bottom: 18px;
    }

    .contact-info-card h5 {
        font-weight: 700;
        margin-bottom: 10px;
        color: #212529;
    }

    .contact-info-card p,
    .contact-info-card a {
        color: #6c757d;
        margin-bottom: 4px;
        text-decoration: none;
    }

    .contact-info-card a:hover {
        color: #526eea;
    }

    .contact-map-wrapper {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        height: 100%;
        min-height: 320px;
    }

    .contact-map-wrapper iframe {
        width: 100%;
        height: 100%;
        min-height: 320px;
        border: 0;
        display: block;
    }

    .contact-hours-badge {
        display: inline-block;
        background: rgba(82, 110, 234, 0.08);
        color: #526eea;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }
</style>

<!-- Contact Start -->
<div class="container-xxl py-2">
    <div class="container mb-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="section-title bg-white text-center text-primary px-3">Kontak Kami</h6>
            <p class="text-muted mt-3">
                Punya pertanyaan seputar produk inovasi, penelitian, atau kekayaan intelektual? Hubungi kami
                melalui informasi di bawah ini.
            </p>
        </div>

        <!-- Info Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                <div class="contact-info-card text-center text-md-start">
                    <div class="contact-info-icon mx-auto mx-md-0">
                        <i class="fa fa-map-marker-alt"></i>
                    </div>
                    <h5>Alamat</h5>
                    <p>Politeknik Negeri Indramayu</p>
                    <p class="mb-0">Jl. Lohbener Lama No.08, Legok,<br>Kec. Lohbener, Kabupaten Indramayu</p>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="contact-info-card text-center text-md-start">
                    <div class="contact-info-icon mx-auto mx-md-0">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h5>Layanan Kerjasama</h5>
                    <p class="mb-0">
                        <a href="mailto:sentra_ki@polindra.ac.id">sentra_ki@polindra.ac.id</a>
                    </p>
                    <p class="mt-2 mb-0">
                        <a href="https://p3m.polindra.ac.id/" target="_blank" rel="noopener">p3m.polindra.ac.id</a>
                    </p>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.4s">
                <div class="contact-info-card text-center text-md-start">
                    <div class="contact-info-icon mx-auto mx-md-0">
                        <i class="fa fa-clock"></i>
                    </div>
                    <h5>Jam Operasional</h5>
                    <p class="mb-1">Senin - Jumat</p>
                    <span class="contact-hours-badge">08:00 - 16:00 WIB</span>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="row wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-12">
                <div class="contact-map-wrapper">
                    <iframe
                        title="Lokasi Politeknik Negeri Indramayu"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6473.427671449338!2d108.27999187518209!3d-6.413333251058172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb87d1fcaf97d%3A0x4fc15b3c8407ada4!2sPoliteknik%20Negeri%20Indramayu!5e0!3m2!1sid!2sid!4v1727838103756!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy" aria-hidden="false" tabindex="0"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
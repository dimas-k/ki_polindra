<!-- Footer -->
<style>
    .footer-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .footer-content {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
    }

    .footer-link {
        transition: all 0.3s ease;
        display: inline-block;
        position: relative;
    }

    .footer-link:hover {
        color: #667eea !important;
        transform: translateX(5px);
    }

    .footer-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: #667eea;
        transition: width 0.3s ease;
    }

    .footer-link:hover::after {
        width: 100%;
    }

    .footer-icon-btn {
        width: 45px;
        height: 45px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: 2px solid #667eea;
        color: #667eea;
    }

    .footer-icon-btn:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .footer-map {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .footer-map:hover {
        transform: scale(1.02);
    }

    .footer-title {
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        width: 50px;
        height: 3px;
        bottom: 0;
        left: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }

    .footer-contact-item {
        transition: all 0.3s ease;
        padding: 8px 0;
    }

    .footer-contact-item:hover {
        transform: translateX(5px);
        color: #667eea;
    }

    .footer-copyright {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-top: 1px solid rgba(102, 126, 234, 0.2);
    }

    @media (max-width: 768px) {
        .footer-icon-btn {
            width: 40px;
            height: 40px;
        }
    }
</style>

<footer class="footer-gradient text-white mt-5">
    <section class="footer-content pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="footer-title text-uppercase fw-bold mb-4 text-dark">Politeknik Negeri Indramayu</h5>
                    <p class="text-muted mb-4 lh-lg">
                        Sentra KI Polindra berkomitmen mendukung inovasi, penelitian, dan pengelolaan kekayaan
                        intelektual di lingkungan kampus untuk kemajuan bangsa.
                    </p>
                    <div class="footer-map">
                        <iframe
                            title="Lokasi Politeknik Negeri Indramayu"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.8880908169504!2d108.27887677495575!3d-6.408414693582335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb87d1fcaf97d%3A0x4fc15b3c8407ada4!2sPoliteknik%20Negeri%20Indramayu!5e0!3m2!1sid!2sid!4v1728365465003!5m2!1sid!2sid"
                            width="100%" height="200" style="border:0;" allowfullscreen loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title text-uppercase fw-bold mb-4 text-dark">Link Terkait</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="https://p3m.polindra.ac.id/" class="footer-link text-muted text-decoration-none"
                                target="_blank" rel="noopener">
                                <i class="bi bi-arrow-right-short me-1"></i>P3M POLINDRA
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="https://www.dgip.go.id/" class="footer-link text-muted text-decoration-none"
                                target="_blank" rel="noopener">
                                <i class="bi bi-arrow-right-short me-1"></i>DJKI
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="https://worldwide.espacenet.com/" class="footer-link text-muted text-decoration-none"
                                target="_blank" rel="noopener">
                                <i class="bi bi-arrow-right-short me-1"></i>Espacenet
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="https://patents.google.com/" class="footer-link text-muted text-decoration-none"
                                target="_blank" rel="noopener">
                                <i class="bi bi-arrow-right-short me-1"></i>Google Patent
                            </a>
                        </li>
                        <li class="mb-3">
                            <a href="https://pdki-indonesia.dgip.go.id/" class="footer-link text-muted text-decoration-none"
                                target="_blank" rel="noopener">
                                <i class="bi bi-arrow-right-short me-1"></i>Penelusuran PDKI
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="footer-title text-uppercase fw-bold mb-4 text-dark">Kontak Kami</h6>
                    <ul class="list-unstyled mb-4">
                        <li class="footer-contact-item mb-3">
                            <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                            <span class="text-muted">Jl. Raya Lohbener Lama No. 08<br>
                                <span class="ms-4">Indramayu 45252</span></span>
                        </li>
                        <li class="footer-contact-item mb-3">
                            <i class="bi bi-telephone-fill me-2 text-primary"></i>
                            <a href="tel:+622345746464" class="text-muted text-decoration-none">(0234) 5746464</a>
                        </li>
                        <li class="footer-contact-item mb-3">
                            <i class="bi bi-envelope-fill me-2 text-primary"></i>
                            <a href="mailto:sentra_ki@polindra.ac.id"
                                class="text-muted text-decoration-none">sentra_ki@polindra.ac.id</a>
                        </li>
                    </ul>
                </div>

                <!-- Social Media & Quick Actions -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="footer-title text-uppercase fw-bold mb-4 text-dark">Ikuti Kami</h6>
                    <p class="text-muted mb-4">Tetap terhubung dengan kami melalui media sosial dan kanal komunikasi
                        lainnya.</p>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a class="footer-icon-btn rounded-circle text-decoration-none"
                            href="https://polindra.ac.id/" target="_blank" rel="noopener" aria-label="Website Polindra"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Website Resmi">
                            <i class="bi bi-globe"></i>
                        </a>
                        <a class="footer-icon-btn rounded-circle text-decoration-none"
                            href="mailto:sentra_ki@polindra.ac.id" aria-label="Email Sentra KI"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Email">
                            <i class="bi bi-envelope-fill"></i>
                        </a>
                        <a class="footer-icon-btn rounded-circle text-decoration-none" href="tel:+622345746464"
                            aria-label="Telepon Sentra KI" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Hubungi Kami">
                            <i class="bi bi-telephone-fill"></i>
                        </a>
                    </div>
                    <div class="mt-4">
                        <p class="text-muted small mb-2"><strong>Jam Operasional:</strong></p>
                        <p class="text-muted small mb-0">Senin - Jumat: 08:00 - 16:00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        <div class="container">
            <p class="mb-0 text-dark">
                © {{ date('Y') }} <strong>Hak Cipta Dilindungi</strong> |
                <a class="text-decoration-none fw-bold" href="https://polindra.ac.id/" target="_blank"
                    rel="noopener" style="color: #000105;">Politeknik Negeri Indramayu</a>
            </p>
            <p class="mb-0 mt-2 text-muted small">
                Sentra Kekayaan Intelektual - Mengembangkan Inovasi untuk Kemajuan Bangsa
            </p>
        </div>
    </div>
</footer>
<!-- Footer -->

<script>
    // Initialize Bootstrap tooltips
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
</script>

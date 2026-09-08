<!-- Footer -->
<style>
    :root {
        --polindra-navy: #002a57;
        --polindra-blue: #003d7a;
        --polindra-blue-light: #0066cc;
        --polindra-line: rgba(255, 255, 255, 0.14);
    }

    .site-footer {
        background-color: var(--polindra-navy);
    }

    .footer-title {
        color: #fff;
        font-size: 0.85rem;
        letter-spacing: 0.6px;
        border-bottom: 2px solid var(--polindra-blue-light);
        padding-bottom: 10px;
        display: inline-block;
    }

    .footer-text {
        color: #b9c9dd;
        font-size: 0.88rem;
        line-height: 1.75;
    }

    .footer-map {
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid var(--polindra-line);
    }

    .footer-link {
        color: #b9c9dd;
        text-decoration: none;
        font-size: 0.88rem;
    }

    .footer-link:hover {
        color: #fff;
    }

    .footer-contact-item {
        color: #b9c9dd;
        font-size: 0.88rem;
        padding: 6px 0;
    }

    .footer-contact-item i {
        color: var(--polindra-blue-light);
    }

    .footer-contact-item a {
        color: #b9c9dd;
        text-decoration: none;
    }

    .footer-contact-item a:hover {
        color: #fff;
    }

    .footer-icon-btn {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--polindra-line);
        border-radius: 8px;
        color: #d7e2f0;
        text-decoration: none;
    }

    .footer-icon-btn:hover {
        background-color: rgba(255, 255, 255, 0.08);
        color: #fff;
    }

    .footer-hours-label {
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .footer-hours-value {
        color: #b9c9dd;
        font-size: 0.85rem;
    }

    .footer-divider {
        border-top: 1px solid var(--polindra-line);
    }

    .footer-copyright {
        background-color: var(--polindra-blue);
        color: #d7e2f0;
        font-size: 0.85rem;
    }

    .footer-copyright a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .footer-copyright a:hover {
        text-decoration: underline;
    }
</style>

<footer class="site-footer mt-5">
    <section class="pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="footer-title text-uppercase fw-bold mb-3">Politeknik Negeri Indramayu</h5>
                    <p class="footer-text mb-4">
                        Sentra KI Polindra berkomitmen mendukung inovasi, penelitian, dan pengelolaan kekayaan
                        intelektual di lingkungan kampus untuk kemajuan bangsa.
                    </p>
                    <div class="footer-map">
                        <iframe title="Lokasi Politeknik Negeri Indramayu"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.8880908169504!2d108.27887677495575!3d-6.408414693582335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb87d1fcaf97d%3A0x4fc15b3c8407ada4!2sPoliteknik%20Negeri%20Indramayu!5e0!3m2!1sid!2sid!4v1728365465003!5m2!1sid!2sid"
                            width="100%" height="200" style="border:0;" allowfullscreen loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-title text-uppercase fw-bold mb-3">Link Terkait</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/dproin-polindra" class="footer-link">
                                <i class="bi bi-chevron-right me-1"></i>Dashboard Produk Inovasi & Penelitian POLINDRA
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://p3m.polindra.ac.id/" class="footer-link" target="_blank" rel="noopener">
                                <i class="bi bi-chevron-right me-1"></i>P3M POLINDRA
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://www.dgip.go.id/" class="footer-link" target="_blank" rel="noopener">
                                <i class="bi bi-chevron-right me-1"></i>DJKI
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://worldwide.espacenet.com/" class="footer-link" target="_blank"
                                rel="noopener">
                                <i class="bi bi-chevron-right me-1"></i>Espacenet
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://patents.google.com/" class="footer-link" target="_blank" rel="noopener">
                                <i class="bi bi-chevron-right me-1"></i>Google Patent
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://pdki-indonesia.dgip.go.id/" class="footer-link" target="_blank"
                                rel="noopener">
                                <i class="bi bi-chevron-right me-1"></i>Penelusuran PDKI
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="footer-title text-uppercase fw-bold mb-3">Kontak Kami</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="footer-contact-item">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            Jl. Raya Lohbener Lama No. 08<br>
                            <span class="ms-4">Indramayu 45252</span>
                        </li>
                        <li class="footer-contact-item">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <a href="mailto:sentra_ki@polindra.ac.id">sentra_ki@polindra.ac.id</a>
                        </li>
                    </ul>
                </div>

                <!-- Social Media & Quick Actions -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="footer-title text-uppercase fw-bold mb-3">Ikuti Kami</h6>
                    <p class="footer-text mb-3">Tetap terhubung dengan kami melalui media sosial dan kanal komunikasi
                        lainnya.</p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <a class="footer-icon-btn" href="https://polindra.ac.id/" target="_blank" rel="noopener"
                            aria-label="Website Polindra" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Website Resmi">
                            <i class="bi bi-globe"></i>
                        </a>
                        <a class="footer-icon-btn" href="mailto:sentra_ki@polindra.ac.id"
                            aria-label="Email Sentra KI" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Kirim Email">
                            <i class="bi bi-envelope-fill"></i>
                        </a>
                    </div>
                    <div>
                        <p class="footer-hours-label mb-1">Jam Operasional</p>
                        <p class="footer-hours-value mb-0">Senin - Jumat: 08.00 - 16.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} Hak Cipta Dilindungi &nbsp;|&nbsp;
                <a href="https://polindra.ac.id/" target="_blank" rel="noopener">Politeknik Negeri Indramayu</a>
            </p>
            <p class="mb-0 mt-1 small">
                Sentra Kekayaan Intelektual &mdash; Mengembangkan Inovasi untuk Kemajuan Bangsa
            </p>
        </div>
    </div>
</footer>
<!-- Footer -->

<script>
    // Initialize Bootstrap tooltips
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
</script>
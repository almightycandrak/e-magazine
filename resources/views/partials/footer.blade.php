<footer class="modern-footer">
    <div class="footer-waves">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
        </svg>
    </div>
    
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <!-- School Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-section">
                        <div class="footer-logo">
                            <img src="{{ asset('images/logo-sekolah.jpg') }}" alt="Logo Sekolah" class="footer-logo-img">
                            <div class="footer-brand">
                                <h3>E-Magazine</h3>
                                <p>Bakti Nusantara 666</p>
                            </div>
                        </div>
                        <p class="footer-desc">
                            Platform digital untuk berbagi informasi, artikel, dan prestasi sekolah. 
                            Menghubungkan seluruh komunitas sekolah dalam satu tempat.
                        </p>
                        <div class="footer-social">
                            <a href="#" class="social-link facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" class="social-link twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-section">
                        <h4 class="footer-title">Menu Utama</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a></li>
                            <li><a href="{{ route('search') }}"><i class="fas fa-search"></i> Pencarian</a></li>
                            @auth
                                <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                <li><a href="{{ route('artikel.index') }}"><i class="fas fa-newspaper"></i> Artikel</a></li>
                            @else
                                <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                                <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Daftar</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>

                <!-- Categories -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-section">
                        <h4 class="footer-title">Kategori</h4>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fas fa-graduation-cap"></i> Pendidikan</a></li>
                            <li><a href="#"><i class="fas fa-trophy"></i> Prestasi</a></li>
                            <li><a href="#"><i class="fas fa-calendar-alt"></i> Kegiatan</a></li>
                            <li><a href="#"><i class="fas fa-bullhorn"></i> Pengumuman</a></li>
                            <li><a href="#"><i class="fas fa-users"></i> Ekstrakurikuler</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-section">
                        <h4 class="footer-title">Kontak Sekolah</h4>
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-text">
                                    <p>Jl. Pendidikan No. 666<br>Kota Bandung, Jawa Barat 40123</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-text">
                                    <p>(022) 123-4567<br>0812-3456-7890</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-text">
                                    <p>info@baktinusantara666.sch.id<br>admin@emading-bn666.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        &copy; {{ date('Y') }} E-Magazine Bakti Nusantara 666. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.modern-footer {
    background: linear-gradient(135deg, #0D5C75 0%, #199FB1 100%);
    color: white;
    position: relative;
    margin-top: 4rem;
}

.footer-waves {
    position: absolute;
    top: -1px;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.footer-waves svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 60px;
}

.footer-waves .shape-fill {
    fill: #ffffff;
}

.footer-content {
    padding: 4rem 0 2rem;
    position: relative;
    z-index: 2;
}

.footer-section {
    height: 100%;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.footer-logo-img {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    object-fit: cover;
}

.footer-brand h3 {
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}

.footer-brand p {
    color: #ffffff;
    margin: 0;
    font-size: 0.9rem;
    font-weight: 500;
}

.footer-desc {
    color: #ffffff;
    line-height: 1.6;
    margin-bottom: 2rem;
    font-weight: 400;
}

.footer-social {
    display: flex;
    gap: 1rem;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.social-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.social-link:hover::before {
    left: 100%;
}

.social-link:hover {
    transform: translateY(-3px);
    color: white;
}

.facebook { background: linear-gradient(135deg, #4267B2, #365899); }
.instagram { background: linear-gradient(135deg, #E4405F, #C13584); }
.youtube { background: linear-gradient(135deg, #FF0000, #CC0000); }
.twitter { background: linear-gradient(135deg, #1DA1F2, #0d8bd9); }

.footer-title {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 30px;
    height: 2px;
    background: #A5D1E1;
    border-radius: 1px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: #ffffff;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    font-weight: 400;
}

.footer-links a:hover {
    color: #A5D1E1;
    transform: translateX(5px);
}

.footer-links i {
    width: 16px;
    font-size: 0.8rem;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.contact-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.contact-icon i {
    color: white;
    font-size: 1rem;
}

.contact-text p {
    color: #ffffff;
    margin: 0;
    line-height: 1.5;
    font-size: 0.9rem;
    font-weight: 400;
}

.footer-bottom {
    background: rgba(0, 0, 0, 0.2);
    padding: 1.5rem 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.copyright {
    color: #ffffff;
    margin: 0;
    font-size: 0.9rem;
    font-weight: 400;
}

.footer-bottom-links {
    display: flex;
    gap: 1.5rem;
    justify-content: flex-end;
}

.footer-bottom-links a {
    color: #ffffff;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
    font-weight: 400;
}

.footer-bottom-links a:hover {
    color: #A5D1E1;
}

@media (max-width: 768px) {
    .footer-content {
        padding: 3rem 0 1.5rem;
    }
    
    .footer-logo {
        justify-content: center;
        text-align: center;
    }
    
    .footer-social {
        justify-content: center;
    }
    
    .footer-bottom-links {
        justify-content: center;
        margin-top: 1rem;
    }
    
    .contact-item {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }
}
</style>
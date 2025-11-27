@extends('layouts.app')

@section('content')
<div class="hero-section mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title mb-3">E-Magazine</h1>
                    <h2 class="hero-subtitle mb-4">Bakti Nusantara 666</h2>
                    <p class="hero-description mb-4">Yayasan Pendidikan Dasar dan Menengah</p>
                    <p class="hero-text mb-4">Form digital magazine untuk berbagi informasi, artikel, pengumuman, dan prestasi sekolah secara real-time. Menghubungkan seluruh komunitas sekolah dalam satu tempat.Platform Digital Magazine yang menjadi pusat informasi sekolah secara real-time, mulai dari berita, artikel, pengumuman, hingga deretan prestasi terbaik. Dirancang untuk menghubungkan seluruh warga sekolah dalam satu ekosistem digital yang interaktif, dinamis, dan mudah diakses kapan saja.</p>
                    <div class="hero-features mb-4">
                        <div class="feature-item">
                            <i class="fas fa-newspaper text-ocean-medium"></i>
                            <span>Artikel & Berita Terkini</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-bullhorn text-ocean-dark"></i>
                            <span>Pengumuman Penting</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-trophy" style="color: #f59e0b;"></i>
                            <span>Prestasi Siswa</span>
                        </div>
                    </div>
                    @guest
                        <div class="hero-actions">
                            <a href="{{ route('register') }}" class="btn-hero-primary btn-elegant ripple-effect">
                                <i class="fas fa-user-plus academic-icon"></i>
                                <span>Bergabung Sekarang</span>
                            </a>
                            <a href="#about" class="btn-hero-secondary btn-elegant ripple-effect">
                                <i class="fas fa-info-circle academic-icon"></i>
                                <span>Pelajari Lebih Lanjut</span>
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-illustration">
                    <div class="school-logo-watermark"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hero Waves -->
<div class="hero-waves">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" class="shape-fill"></path>
    </svg>
</div>

<!-- About Section -->
<section id="about" class="about-section py-5 mb-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title gradient-text-ocean">Apa itu E-Magazine?</h2>
            <p class="section-subtitle" style="color: var(--ocean-primary);">Revolusi cara sekolah berbagi informasi</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="info-card elegant-card paper-texture ocean-depth">
                    <div class="info-icon school-spirit">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h4 class="gradient-text-ocean">Digital & Modern</h4>
                    <p>Menggantikan mading konvensional dengan platform digital yang mudah diakses kapan saja, di mana saja.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-card elegant-card paper-texture ocean-depth">
                    <div class="info-icon school-spirit">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="gradient-text-ocean">Kolaboratif</h4>
                    <p>Memungkinkan guru, siswa, dan staff untuk berkontribusi dalam berbagi informasi dan konten.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-card elegant-card paper-texture ocean-depth">
                    <div class="info-icon school-spirit">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="gradient-text-ocean">Real-time</h4>
                    <p>Informasi dan pengumuman dapat dipublikasikan secara langsung tanpa perlu menunggu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Articles Section -->
<section class="articles-section">
    <div class="articles-bg">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>
    <div class="container">
        <div class="section-header mb-4">
            <h2 class="section-title gradient-text-ocean">Artikel Terbaru</h2>
            <p class="section-subtitle" style="color: var(--ocean-primary);">Informasi dan berita terkini dari komunitas sekolah</p>
        </div>
        <div class="row">
            @forelse($artikels as $artikel)
        <div class="col-md-4 mb-4">
            <div class="card modern-card elegant-card paper-texture">

                @if($artikel->foto)
                    <div class="card-img-wrapper">
                        <img src="{{ asset('storage/' . $artikel->foto) }}" class="card-img-top" alt="Foto">
                        <div class="card-overlay">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                @endif
                <div class="card-body">
                    <div class="card-meta mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-gradient">{{ $artikel->kategori->nama ?? 'Umum' }}</span>

                        </div>
                        <div class="article-stats-detailed">
                            <span class="stat-item">
                                <i class="fas fa-eye"></i> {{ $artikel->id * 23 + 47 }} views
                            </span>
                            <span class="stat-item">
                                <i class="fas fa-heart"></i> {{ $artikel->likes->count() }} likes
                            </span>
                            <span class="stat-item">
                                <i class="fas fa-comments"></i> {{ $artikel->komentars->count() }} comments
                            </span>
                        </div>
                        <div class="article-meta-info">
                            <span class="meta-item">
                                <i class="fas fa-calendar-alt"></i> {{ $artikel->created_at->format('d M Y') }}
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-clock"></i> {{ ($artikel->id % 8) + 3 }} min read
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-tag"></i> {{ $artikel->kategori->nama ?? 'Umum' }}
                            </span>
                        </div>
                    </div>
                    
                    <h5 class="card-title">{{ $artikel->judul }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($artikel->isi, 120) }}</p>
                    

                    <div class="card-footer-custom">
                        <div class="author-info-detailed">
                            <div class="author-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="author-details">
                                <span class="author-name">{{ $artikel->user->name ?? 'Admin' }}</span>
                                <span class="author-role">{{ ucfirst($artikel->user->role ?? 'admin') }}</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-gradient btn-sm">
                                <i class="fas fa-book-open"></i> Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">Belum Ada Artikel</h3>
                <p class="text-muted">Artikel akan muncul di sini setelah dipublikasikan</p>
            </div>
        </div>
            @endforelse
        </div>
    </div>
</section>

<style>


.hero-section {
    padding: 4rem 0 2rem 0;
    background: white;
    position: relative;
    color: #1e293b;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-family: 'Poppins', sans-serif;
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #0D5C75 0%, #199FB1 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.3;
    margin-bottom: 0.5rem;
    letter-spacing: -0.02em;
    padding-bottom: 0.3rem;
}

.hero-subtitle {
    font-family: 'Poppins', sans-serif;
    font-size: 1.8rem;
    font-weight: 600;
    color: #199FB1;
    margin-bottom: 1.5rem;
    letter-spacing: -0.01em;
}

.hero-description {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    font-weight: 500;
    color: #64748b;
    margin-bottom: 1.5rem;
}

.hero-text {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    font-weight: 400;
    color: #475569;
    line-height: 1.7;
    margin-bottom: 2rem;
}

.hero-illustration {
    position: relative;
    height: 400px;
}

.school-logo-watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 350px;
    height: 350px;
    background: url('{{ asset('images/logo-sekolah.jpg') }}') no-repeat center;
    background-size: contain;
    opacity: 0.1;
    border-radius: 50%;
}

@keyframes slowRotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.hero-features {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 10px 0;
    animation: fadeInUp 0.6s ease;
}

.feature-item i {
    font-size: 1.25rem;
    width: 32px;
}

.hero-actions {
    animation: fadeInUp 0.8s ease;
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-hero-primary {
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    color: white !important;
    padding: 1rem 2rem;
    border-radius: 15px;
    text-decoration: none !important;
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(25, 159, 177, 0.3);
    border: none;
    position: relative;
    overflow: hidden;
}

.btn-hero-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-hero-primary:hover::before {
    left: 100%;
}

.btn-hero-primary span, .btn-hero-primary i {
    color: white !important;
    opacity: 1 !important;
    z-index: 11;
    position: relative;
}

.btn-hero-primary:hover {
    color: white !important;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(25, 159, 177, 0.4);
    background: linear-gradient(135deg, #0D5C75 0%, #199FB1 100%);
    text-decoration: none !important;
}

.btn-hero-secondary {
    background: transparent;
    color: #199FB1 !important;
    padding: 1rem 2rem;
    border: 2px solid #199FB1;
    border-radius: 15px;
    text-decoration: none !important;
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    margin-left: 1rem;
}

.btn-hero-secondary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(25, 159, 177, 0.1), transparent);
    transition: left 0.5s;
}

.btn-hero-secondary:hover::before {
    left: 100%;
}

.btn-hero-secondary span, .btn-hero-secondary i {
    color: #199FB1 !important;
    opacity: 1 !important;
    z-index: 11;
    position: relative;
}

.btn-hero-secondary:hover {
    background: #199FB1;
    color: white !important;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(25, 159, 177, 0.3);
    text-decoration: none !important;
}

.btn-hero-secondary:hover span, .btn-hero-secondary:hover i {
    color: white !important;
    opacity: 1 !important;
}

.hero-illustration {
    position: relative;
    height: 400px;
    animation: slideInRight 0.8s ease;
}



.school-logo-watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    height: 400px;
    background: url('{{ asset('images/logo-sekolah.jpg') }}') no-repeat center;
    background-size: contain;
    opacity: 0.12;
    z-index: 1;
    animation: pulse 4s ease-in-out infinite;
    border-radius: 50%;
}

@keyframes pulse {
    0%, 100% { 
        opacity: 0.1;
        transform: translate(-50%, -50%) scale(1);
    }
    50% { 
        opacity: 0.2;
        transform: translate(-50%, -50%) scale(1.03);
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Hero Waves */
.hero-waves {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.hero-waves svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 60px;
}

.hero-waves .shape-fill {
    fill: #f8fafc;
}

/* About Section Waves */
.about-waves-top {
    position: absolute;
    top: -1px;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.about-waves-top svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 40px;
}

.about-waves-bottom {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.about-waves-bottom svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 40px;
}

.shape-fill-light {
    fill: #ffffff;
    opacity: 1;
}

/* Articles Section Background */
.articles-section {
    position: relative;
    background: white;
}

.articles-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
}

.floating-shapes {
    position: relative;
    width: 100%;
    height: 100%;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(25, 159, 177, 0.1), rgba(165, 209, 225, 0.2));
    animation: floatShape 6s ease-in-out infinite;
}

.shape-1 {
    width: 200px;
    height: 200px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.shape-3 {
    width: 100px;
    height: 100px;
    bottom: 20%;
    left: 60%;
    animation-delay: 4s;
}

@keyframes floatShape {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(180deg); }
}

/* Glass Morphism Effects */
.info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(25, 159, 177, 0.05));
    border-radius: 25px;
    z-index: -1;
}

.modern-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(25, 159, 177, 0.03));
    border-radius: 20px;
    z-index: -1;
}

/* Hero Content Styling */
.hero-content {
    position: relative;
    z-index: 2;
    animation: slideInLeft 0.8s ease;
    overflow: visible;
    padding: 1rem 0;
}

.hero-description {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.1rem;
    font-weight: 500;
    color: #64748b;
    animation: fadeInUp 0.8s ease 0.8s both;
    letter-spacing: 0.5px;
}

.hero-text {
    font-family: 'Inter', sans-serif;
    font-size: 1.2rem;
    font-weight: 400;
    color: #475569;
    line-height: 1.8;
    animation: fadeInUp 0.8s ease 1s both;
    max-width: 90%;
}

.feature-item span {
    color: #1e293b !important;
    font-weight: 600 !important;
    font-size: 1rem !important;
}

/* Container positioning */
.container {
    position: relative;
    z-index: 2;
}

/* Custom text selection */
::selection {
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    color: white;
    text-shadow: none;
}

::-moz-selection {
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    color: white;
    text-shadow: none;
}

/* Hero Accent */
.hero-accent {
    position: absolute;
    top: -50px;
    right: -50px;
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, #199FB1, #A5D1E1);
    border-radius: 50%;
    opacity: 0.1;
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.about-section {
    background: #ffffff;
    border-radius: 0;
    position: relative;
    overflow: hidden;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.2rem;
    color: #64748b;
    margin-bottom: 2rem;
}

.info-card {
    text-align: center;
    padding: 2rem;
    background: white !important;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(13, 92, 117, 0.1);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(25, 159, 177, 0.1);
}

.info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(25, 159, 177, 0.05));
    border-radius: 25px;
    z-index: -1;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(25, 159, 177, 0.2);
}

.info-card h4 {
    color: #0D5C75 !important;
    font-weight: 600 !important;
    font-size: 1.3rem !important;
    margin-bottom: 1rem !important;
}

.info-card p {
    color: #64748b !important;
    line-height: 1.6 !important;
    font-size: 0.95rem !important;
    margin: 0 !important;
}



.info-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 1rem;
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    position: relative;
    overflow: hidden;
}

.info-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.info-card:hover .info-icon::before {
    left: 100%;
}

.modern-card {
    border: none;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(13, 92, 117, 0.15);
    transition: all 0.4s ease;
    background: white !important;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.modern-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(25, 159, 177, 0.03));
    border-radius: 25px;
    z-index: -1;
}

.modern-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(25, 159, 177, 0.25);
}

.modern-card .card-body {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}





.card-img-wrapper {
    position: relative;
    overflow: hidden;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.modern-card:hover .card-img-top {
    transform: scale(1.1);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(25, 159, 177, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.card-overlay i {
    color: white;
    font-size: 1.75rem;
}

.modern-card:hover .card-overlay {
    opacity: 1;
}

.badge-gradient {
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    color: white;
    border-radius: 20px;
    font-size: 0.75rem;
    padding: 6px 12px;
    font-weight: 600;
}

.article-stats {
    display: flex;
    gap: 15px;
}

.stat-item {
    color: #64748b;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.3s ease;
}

.stat-item:hover {
    color: #199FB1;
}

.stat-item i {
    font-size: 0.75rem;
    width: 12px;
    text-align: center;
}

.empty-state {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 20px;
    margin: 2rem 0;
}

.section-header {
    text-align: center;
}

.btn-gradient {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border: none;
    color: white;
    font-weight: 600;
    border-radius: 15px;
    padding: 10px 18px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-gradient:hover::before {
    left: 100%;
}

.btn-gradient:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(25, 159, 177, 0.4);
    color: white;
}

.author-info {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    background: rgba(25, 159, 177, 0.1);
    border-radius: 15px;
    font-size: 0.8rem;
}

.author-info i {
    color: #199FB1;
    font-size: 0.875rem;
}



.article-stats-detailed {
    display: flex;
    gap: 1rem;
    margin: 0.8rem 0;
    flex-wrap: wrap;
}

.article-stats-detailed .stat-item {
    color: #64748b;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
    font-weight: 500;
}

.article-meta-info {
    display: flex;
    gap: 1rem;
    margin-top: 0.5rem;
    flex-wrap: wrap;
}

.meta-item {
    color: #94a3b8;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.article-tags {
    display: flex;
    gap: 0.5rem;
    margin: 1rem 0;
    flex-wrap: wrap;
}

.tag {
    background: rgba(25, 159, 177, 0.1);
    color: #199FB1;
    padding: 0.3rem 0.6rem;
    border-radius: 10px;
    font-size: 0.7rem;
    font-weight: 500;
}

.card-footer-custom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
    margin-top: auto;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.author-info-detailed {
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.author-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.author-details {
    display: flex;
    flex-direction: column;
}

.author-name {
    font-weight: 600;
    font-size: 0.85rem;
    color: #1e293b;
}

.author-role {
    font-size: 0.75rem;
    color: #64748b;
    text-transform: capitalize;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 0;
        text-align: center;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.4rem;
    }
    
    .hero-actions {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-hero-secondary {
        margin-left: 0;
    }
    
    .hero-illustration {
        height: 250px;
        margin-top: 2rem;
    }
    
    .school-logo-watermark {
        width: 250px;
        height: 250px;
    }
}
    
    .article-stats {
        flex-direction: column;
        gap: 5px;
    }
    
    .card-footer-custom {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .card-actions .btn {
        width: 100%;
        justify-content: center;
    }
    
    .article-stats-detailed {
        gap: 0.5rem;
    }
    
    .article-meta-info {
        gap: 0.5rem;
    }
}

@media (max-width: 576px) {
    .modern-card .card-body {
        padding: 1rem;
    }
    
    .card-footer-custom {
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        text-align: center;
    }
    
    .author-info-detailed {
        justify-content: center;
    }
}rd-footer-custom {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .card-actions {
        width: 100%;
    }
    
    .card-actions .btn {
        width: auto;
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
        white-space: nowrap;
    }
    
    .article-stats-detailed {
        gap: 0.5rem;
    }
    
    .article-meta-info {
        gap: 0.5rem;
    }
}

@media (max-width: 576px) {
    .card-body {
        padding: 1rem;
    }
    
    .card-footer-custom {
        flex-direction: row;
        gap: 0.5rem;
        align-items: center;
        justify-content: space-between;
    }
    
    .author-info-detailed {
        justify-content: center;
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection
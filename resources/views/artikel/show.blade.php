@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login-popup.css') }}" rel="stylesheet">
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <article class="article-modern">
                <!-- Article Header -->
                <div class="article-header-modern">
                    <div class="article-meta-modern">
                        <span class="category-modern">{{ $artikel->kategori->nama }}</span>
                        <span class="date-modern">{{ $artikel->created_at->format('d F Y') }}</span>
                    </div>
                    <h1 class="title-modern">{{ $artikel->judul }}</h1>
                    <div class="author-modern">
                        <div class="author-avatar-modern">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info-modern">
                            <span class="author-name-modern">{{ $artikel->user->name }}</span>
                            <span class="author-role-modern">{{ ucfirst($artikel->user->role) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Article Image -->
                @if($artikel->foto)
                <div class="article-image">
                    <img src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}" class="img-fluid">
                </div>
                @endif

                <!-- Article Content -->
                <div class="article-content-modern">
                    <div class="content-text-modern">
                        @if($isAuthenticated)
                            {!! nl2br(e($artikel->isi)) !!}
                        @else
                            {!! nl2br(e($artikel->isi_preview)) !!}
                            <div class="content-blur-overlay">
                                <div class="login-prompt">
                                    <i class="fas fa-lock"></i>
                                    <h4>Konten Terbatas</h4>
                                    <p>Silakan login untuk membaca artikel lengkap</p>
                                    <div class="login-buttons">
                                        <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                                        <a href="{{ route('register') }}" class="btn btn-register">Daftar</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Article Stats -->
                <div class="article-stats-section">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <i class="fas fa-eye"></i>
                            <div class="stat-content">
                                <span class="stat-number">{{ $artikel->id * 23 + 47 }}</span>
                                <span class="stat-label">Dibaca</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-clock"></i>
                            <div class="stat-content">
                                <span class="stat-number">{{ rand(3, 15) }}</span>
                                <span class="stat-label">Menit</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-calendar"></i>
                            <div class="stat-content">
                                <span class="stat-number">{{ $artikel->created_at->diffForHumans() }}</span>
                                <span class="stat-label">Dipublikasi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Actions -->
                @if($isAuthenticated)
                <div class="article-actions">
                    <div class="like-container">
                        <button class="btn-like" onclick="toggleLike({{ $artikel->id }})">
                            <i class="fas fa-heart" id="heart-icon"></i>
                            <span id="like-count">{{ $artikel->likes ? $artikel->likes->count() : 0 }}</span>
                        </button>
                    </div>
                    <div class="comment-info">
                        <i class="fas fa-comment"></i>
                        <span>{{ $artikel->komentars ? $artikel->komentars->count() : 0 }} Komentar</span>
                    </div>
                    <div class="share-buttons">
                        <button class="btn-share" onclick="shareArticle()">
                            <i class="fas fa-share-alt"></i>
                            Bagikan
                        </button>
                    </div>
                </div>
                @else
                <div class="article-actions-limited">
                    <div class="stats-only">
                        <div class="stat-item">
                            <i class="fas fa-heart"></i>
                            <span>{{ $artikel->likes ? $artikel->likes->count() : 0 }} Suka</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-comment"></i>
                            <span>{{ $artikel->komentars ? $artikel->komentars->count() : 0 }} Komentar</span>
                        </div>
                    </div>
                    <div class="login-to-interact">
                        <a href="{{ route('login') }}" class="btn-login-small">Login untuk berinteraksi</a>
                    </div>
                </div>
                @endif

                <!-- Reading Progress -->
                <div class="reading-progress-container">
                    <div class="reading-progress-bar" id="reading-progress"></div>
                </div>

                <!-- Comments Section -->
                @if($isAuthenticated)
                <div class="comments-section">
                    <h4 class="comments-title">
                        <i class="fas fa-comments"></i>
                        Komentar ({{ $artikel->komentars ? $artikel->komentars->count() : 0 }})
                    </h4>
                    
                    <!-- Comment Form -->
                    <div class="comment-form">
                        <div class="comment-input-wrapper">
                            <div class="user-avatar-small">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <textarea id="comment-input" placeholder="Tulis komentar..." maxlength="500"></textarea>
                            <button onclick="submitComment({{ $artikel->id }})" class="btn-comment">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Comments List -->
                    <div class="comments-list" id="comments-list">
                        @forelse($artikel->komentars as $komentar)
                        <div class="comment-item">
                            <div class="comment-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="comment-content">
                                <div class="comment-header">
                                    <span class="comment-author">{{ $komentar->user->name }}</span>
                                    <span class="comment-role">{{ ucfirst($komentar->user->role) }}</span>
                                    <span class="comment-time">{{ $komentar->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="comment-text">{{ $komentar->isi }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="no-comments">
                            <i class="fas fa-comment-slash"></i>
                            <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                @else
                <div class="comments-section-limited">
                    <h4 class="comments-title">
                        <i class="fas fa-comments"></i>
                        Komentar ({{ $artikel->komentars ? $artikel->komentars->count() : 0 }})
                    </h4>
                    <div class="login-to-comment">
                        <div class="comment-login-prompt">
                            <i class="fas fa-lock"></i>
                            <h5>Login untuk melihat dan menulis komentar</h5>
                            <p>Bergabunglah dengan diskusi dengan login terlebih dahulu</p>
                            <div class="comment-login-buttons">
                                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-register">Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Back Button -->
                <div class="article-navigation">
                    <button onclick="history.back()" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Artikel
                    </button>
                </div>
            </article>
        </div>
    </div>
    
    <!-- Recommended Articles -->
    <div class="recommended-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="recommended-title">
                        <i class="fas fa-thumbs-up"></i>
                        Artikel Rekomendasi
                    </h3>
                    <p class="recommended-subtitle">Artikel lain yang mungkin Anda sukai</p>
                </div>
            </div>
            <div class="row g-4">
                @php
                    $recommendedArticles = \App\Models\Artikel::where('status', 'publish')
                        ->where('id', '!=', $artikel->id)
                        ->inRandomOrder()
                        ->limit(3)
                        ->get();
                @endphp
                
                @forelse($recommendedArticles as $recommended)
                <div class="col-md-4">
                    <div class="recommended-card">
                        @if($recommended->foto)
                            <div class="recommended-image">
                                <img src="{{ asset('storage/' . $recommended->foto) }}" alt="{{ $recommended->judul }}">
                                <div class="recommended-overlay">
                                    <a href="{{ route('artikel.show', $recommended->id) }}" class="read-btn">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="recommended-placeholder">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        @endif
                        
                        <div class="recommended-content">
                            <div class="recommended-meta">
                                <span class="recommended-category">{{ $recommended->kategori->nama ?? 'Umum' }}</span>
                                <span class="recommended-date">{{ $recommended->created_at->format('d M Y') }}</span>
                            </div>
                            <h4 class="recommended-title-text">
                                <a href="{{ route('artikel.show', $recommended->id) }}">{{ $recommended->judul }}</a>
                            </h4>
                            <p class="recommended-excerpt">{{ Str::limit($recommended->isi, 80) }}</p>
                            <div class="recommended-author">
                                <i class="fas fa-user-circle"></i>
                                <span>{{ $recommended->user->name ?? 'Admin' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="no-recommendations">
                        <i class="fas fa-newspaper"></i>
                        <p>Belum ada artikel lain untuk direkomendasikan</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Login Popup -->
@if(!$isAuthenticated)
<div class="login-popup-overlay" id="loginPopup">
    <div class="login-popup">
        <div class="popup-header">
            <button class="popup-close" onclick="closeLoginPopup()">
                <i class="fas fa-times"></i>
            </button>
            <div class="popup-icon">
                <i class="fas fa-lock"></i>
            </div>
            <h3 class="popup-title">Akses Terbatas</h3>
            <p class="popup-subtitle">Login untuk pengalaman lengkap</p>
            <div class="floating-hearts">
                <i class="fas fa-heart floating-heart" style="left: 10%; animation-delay: 0s;"></i>
                <i class="fas fa-star floating-heart" style="left: 20%; animation-delay: 1s;"></i>
                <i class="fas fa-heart floating-heart" style="left: 80%; animation-delay: 2s;"></i>
                <i class="fas fa-bookmark floating-heart" style="left: 90%; animation-delay: 3s;"></i>
            </div>
        </div>
        <div class="popup-body">
            <p class="popup-message">
                Untuk membaca artikel lengkap dan mengakses semua fitur, silakan login atau daftar akun baru.
            </p>
            <div class="popup-benefits">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="benefit-text">Baca artikel lengkap tanpa batas</div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="benefit-text">Like dan komentar artikel</div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="benefit-text">Bergabung dengan komunitas</div>
                </div>
            </div>
            <div class="popup-actions">
                <a href="{{ route('login') }}" class="popup-btn popup-btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Login Sekarang
                </a>
                <a href="{{ route('register') }}" class="popup-btn popup-btn-secondary">
                    <i class="fas fa-user-plus"></i>
                    Daftar Gratis
                </a>
            </div>
        </div>
        <div class="popup-footer">
            <p class="popup-footer-text">Gratis dan mudah, hanya butuh 1 menit!</p>
            <a href="#" class="popup-skip" onclick="closeLoginPopup()">Lewati untuk sekarang</a>
        </div>
    </div>
</div>
@endif

<style>
.article-container {
    padding: 2rem 0;
    background: #ffffff;
    min-height: 100vh;
}

.article-detail {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: fadeInUp 0.6s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.article-header {
    padding: 2.5rem 2.5rem 1.5rem;
    background: #ffffff;
}

.article-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.category-badge {
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.article-date {
    color: #64748b;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.article-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1e293b;
    line-height: 1.2;
    margin-bottom: 1.5rem;
}

.author-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.author-details {
    display: flex;
    flex-direction: column;
}

.author-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 1.1rem;
}

.author-role {
    color: #199FB1;
    font-size: 0.875rem;
}

.article-image {
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    margin: 2rem 0;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    background: #f8fafc;
}

.article-image img {
    width: 100%;
    height: auto;
    max-height: 700px;
    object-fit: cover;
    transition: transform 0.3s ease;
    display: block;
    border-radius: 15px;
}

.article-image:hover img {
    transform: scale(1.02);
}

/* Responsive image handling */
@media (max-width: 768px) {
    .article-image img {
        max-height: 300px;
    }
}

.article-content {
    padding: 2.5rem;
}

.content-text {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #374151;
    text-align: justify;
}

.content-blur-overlay {
    position: relative;
    margin-top: 2rem;
    background: linear-gradient(to bottom, transparent 0%, rgba(255,255,255,0.9) 50%, rgba(255,255,255,1) 100%);
    padding: 3rem 0;
    text-align: center;
}

.login-prompt {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: 0 auto;
    border: 2px solid #199FB1;
}

.login-prompt i {
    font-size: 3rem;
    color: #199FB1;
    margin-bottom: 1rem;
}

.login-prompt h4 {
    color: #1e293b;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.login-prompt p {
    color: #64748b;
    margin-bottom: 1.5rem;
}

.login-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-login {
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-login:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(25, 159, 177, 0.3);
}

.btn-register {
    background: white;
    color: #199FB1;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    border: 2px solid #199FB1;
    transition: all 0.3s ease;
}

.btn-register:hover {
    background: #199FB1;
    color: white;
    transform: translateY(-2px);
}

.article-actions-limited {
    padding: 1.5rem 2.5rem;
    border-top: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f8fafc;
}

.stats-only {
    display: flex;
    gap: 2rem;
}

.stats-only .stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    font-size: 0.875rem;
}

.stats-only .stat-item i {
    color: #199FB1;
}

.btn-login-small {
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-login-small:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(25, 159, 177, 0.3);
}

.comments-section-limited {
    padding: 2rem 2.5rem;
    border-top: 1px solid #e2e8f0;
    background: #f8fafc;
}

.comment-login-prompt {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.comment-login-prompt i {
    font-size: 2rem;
    color: #199FB1;
    margin-bottom: 1rem;
}

.comment-login-prompt h5 {
    color: #1e293b;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.comment-login-prompt p {
    color: #64748b;
    margin-bottom: 1.5rem;
}

.comment-login-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}



.article-actions {
    padding: 1.5rem 2.5rem;
    border-top: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #ffffff;
}

.btn-like {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-like:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
}

.like-container {
    position: relative;
    overflow: visible;
}

.flying-heart {
    position: absolute;
    color: #ef4444;
    font-size: 1.5rem;
    pointer-events: none;
    animation: flyUp 2s ease-out forwards;
    z-index: 1000;
}

@keyframes flyUp {
    0% {
        opacity: 1;
        transform: translateY(0) scale(1) rotate(0deg);
    }
    25% {
        opacity: 1;
        transform: translateY(-20px) scale(1.2) rotate(10deg);
    }
    50% {
        opacity: 0.8;
        transform: translateY(-40px) scale(1.1) rotate(-5deg);
    }
    75% {
        opacity: 0.4;
        transform: translateY(-60px) scale(0.9) rotate(15deg);
    }
    100% {
        opacity: 0;
        transform: translateY(-80px) scale(0.5) rotate(-10deg);
    }
}

.btn-like.liked {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    animation: heartBeat 0.6s ease;
}

@keyframes heartBeat {
    0% { transform: scale(1); }
    25% { transform: scale(1.2); }
    50% { transform: scale(1.1); }
    75% { transform: scale(1.15); }
    100% { transform: scale(1); }
}

.btn-share {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-share:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
}

.article-navigation {
    padding: 1.5rem 2.5rem;
    text-align: center;
}

.btn-back {
    background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
    color: white;
    text-decoration: none;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-back:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(107, 114, 128, 0.3);
}

.comment-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #199FB1;
    font-size: 0.875rem;
}

.comments-section {
    padding: 2rem 2.5rem;
    border-top: 1px solid #e2e8f0;
    background: #ffffff;
}

.comments-title {
    color: #1e293b;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.comment-form {
    margin-bottom: 2rem;
}

.comment-input-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: white;
    padding: 1rem;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.user-avatar-small {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

#comment-input {
    flex: 1;
    border: none;
    outline: none;
    resize: none;
    font-size: 0.875rem;
    line-height: 1.5;
    min-height: 40px;
    max-height: 120px;
    padding: 8px 0;
    background: transparent;
}

.btn-comment {
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.btn-comment:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(25, 159, 177, 0.3);
}

.comments-list {
    max-height: 400px;
    overflow-y: auto;
}

.comment-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    animation: slideInUp 0.3s ease;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.comment-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    flex-shrink: 0;
}

.comment-content {
    flex: 1;
    background: white;
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.comment-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}

.comment-author {
    font-weight: 600;
    color: #1e293b;
    font-size: 0.875rem;
}

.comment-role {
    background: #e2e8f0;
    color: #64748b;
    padding: 0.125rem 0.5rem;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 500;
}

.comment-time {
    color: #9ca3af;
    font-size: 0.75rem;
    margin-left: auto;
}

.comment-text {
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.5;
}

.no-comments {
    text-align: center;
    padding: 2rem;
    color: #9ca3af;
}

.no-comments i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    display: block;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .article-header {
        padding: 1.5rem;
    }
    
    .article-title {
        font-size: 1.875rem;
    }
    
    .article-content {
        padding: 1.5rem;
    }
    
    .article-actions {
        padding: 1rem 1.5rem;
        flex-direction: column;
        gap: 1rem;
    }
    
    .article-navigation {
        padding: 1rem 1.5rem;
    }
}
.article-stats-section {
    padding: 2rem;
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1.5rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
}

.stat-item i {
    font-size: 1.5rem;
    color: #199FB1;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(25, 159, 177, 0.1);
    border-radius: 50%;
}

.stat-content {
    display: flex;
    flex-direction: column;
}

.stat-number {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1a202c;
}

.stat-label {
    font-size: 0.85rem;
    color: #64748b;
}

.reading-progress-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.reading-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #199FB1 0%, #0D5C75 100%);
    width: 0%;
    transition: width 0.3s ease;
}

.recommended-section {
    background: #ffffff;
    padding: 3rem 0;
    margin-top: 2rem;
}

.recommended-title {
    font-size: 2rem;
    font-weight: 800;
    color: #1a202c;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.recommended-title i {
    color: #199FB1;
}

.recommended-subtitle {
    color: #64748b;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

.recommended-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.recommended-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.recommended-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.recommended-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.recommended-card:hover .recommended-image img {
    transform: scale(1.1);
}

.recommended-overlay {
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

.recommended-card:hover .recommended-overlay {
    opacity: 1;
}

.read-btn {
    width: 50px;
    height: 50px;
    background: white;
    color: #199FB1;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.read-btn:hover {
    transform: scale(1.1);
    color: #199FB1;
}

.recommended-placeholder {
    height: 200px;
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: #94a3b8;
}

.recommended-content {
    padding: 1.5rem;
}

.recommended-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.recommended-category {
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.recommended-date {
    color: #64748b;
    font-size: 0.85rem;
}

.recommended-title-text {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 0.8rem;
    line-height: 1.4;
}

.recommended-title-text a {
    color: #1a202c;
    text-decoration: none;
    transition: color 0.3s ease;
}

.recommended-title-text a:hover {
    color: #199FB1;
}

.recommended-excerpt {
    color: #64748b;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 1rem;
}

.recommended-author {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    font-size: 0.85rem;
}

.recommended-author i {
    color: #199FB1;
    font-size: 1rem;
}

.no-recommendations {
    text-align: center;
    padding: 3rem;
    color: #94a3b8;
}

.no-recommendations i {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
}

@media (max-width: 768px) {
    .recommended-section {
        padding: 2rem 0;
    }
    
    .recommended-title {
        font-size: 1.5rem;
    }
}
</style>

<script>
function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $artikel->judul }}',
            text: '{{ Str::limit($artikel->isi, 100) }}',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link artikel berhasil disalin!');
        });
    }
}

function toggleLike(articleId) {
    const likeBtn = document.querySelector('.btn-like');
    const heartIcon = document.getElementById('heart-icon');
    const likeCount = document.getElementById('like-count');
    const likeContainer = document.querySelector('.like-container');
    
    // Create flying hearts animation
    createFlyingHearts(likeContainer);
    
    // Add heartbeat animation
    likeBtn.classList.add('liked');
    setTimeout(() => likeBtn.classList.remove('liked'), 600);
    
    fetch(`/like/${articleId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        likeCount.textContent = data.total;
        
        if (data.liked) {
            heartIcon.style.color = '#ef4444';
        } else {
            heartIcon.style.color = '#ffffff';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function createFlyingHearts(container) {
    const heartsCount = Math.floor(Math.random() * 5) + 3; // 3-7 hearts
    
    for (let i = 0; i < heartsCount; i++) {
        setTimeout(() => {
            const heart = document.createElement('i');
            heart.className = 'fas fa-heart flying-heart';
            
            // Random position around the button
            const randomX = (Math.random() - 0.5) * 100;
            const randomY = (Math.random() - 0.5) * 20;
            
            heart.style.left = `${50 + randomX}px`;
            heart.style.top = `${10 + randomY}px`;
            
            container.appendChild(heart);
            
            // Remove heart after animation
            setTimeout(() => {
                if (heart.parentNode) {
                    heart.parentNode.removeChild(heart);
                }
            }, 2000);
        }, i * 100); // Stagger the hearts
    }
}

function submitComment(articleId) {
    const commentInput = document.getElementById('comment-input');
    const commentText = commentInput.value.trim();
    
    if (!commentText) {
        alert('Silakan tulis komentar terlebih dahulu!');
        return;
    }
    
    fetch('/komentar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            isi: commentText,
            id_artikel: articleId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            addCommentToList(data.komentar);
            commentInput.value = '';
            updateCommentCount();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal mengirim komentar. Silakan coba lagi.');
    });
}

function addCommentToList(komentar) {
    const commentsList = document.getElementById('comments-list');
    const noComments = commentsList.querySelector('.no-comments');
    
    if (noComments) {
        noComments.remove();
    }
    
    const commentHTML = `
        <div class="comment-item">
            <div class="comment-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="comment-content">
                <div class="comment-header">
                    <span class="comment-author">${komentar.user_name}</span>
                    <span class="comment-role">${komentar.user_role}</span>
                    <span class="comment-time">${komentar.created_at}</span>
                </div>
                <div class="comment-text">${komentar.isi}</div>
            </div>
        </div>
    `;
    
    commentsList.insertAdjacentHTML('afterbegin', commentHTML);
}

function updateCommentCount() {
    const commentInfo = document.querySelector('.comment-info span');
    const commentsTitle = document.querySelector('.comments-title');
    const currentCount = parseInt(commentInfo.textContent.match(/\d+/)[0]) + 1;
    
    commentInfo.textContent = `${currentCount} Komentar`;
    commentsTitle.innerHTML = `<i class="fas fa-comments"></i> Komentar (${currentCount})`;
}

// Auto-resize textarea
document.getElementById('comment-input').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
});

// Submit comment on Enter (Shift+Enter for new line)
document.getElementById('comment-input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        submitComment({{ $artikel->id }});
    }
});

// Reading Progress Bar
window.addEventListener('scroll', function() {
    const article = document.querySelector('.article-content');
    const progressBar = document.getElementById('reading-progress');
    
    if (article && progressBar) {
        const articleTop = article.offsetTop;
        const articleHeight = article.offsetHeight;
        const windowHeight = window.innerHeight;
        const scrollTop = window.pageYOffset;
        
        const articleBottom = articleTop + articleHeight - windowHeight;
        const progress = Math.min(Math.max((scrollTop - articleTop) / (articleBottom - articleTop), 0), 1);
        
        progressBar.style.width = (progress * 100) + '%';
    }
});

// Bookmark functionality
function toggleBookmark(articleId) {
    const bookmarkBtn = document.querySelector('.btn-bookmark');
    const bookmarkIcon = document.getElementById('bookmark-icon');
    
    bookmarkBtn.style.transform = 'scale(0.95)';
    setTimeout(() => {
        bookmarkBtn.style.transform = 'scale(1)';
    }, 150);
    
    if (bookmarkIcon.classList.contains('fas')) {
        bookmarkIcon.classList.remove('fas');
        bookmarkIcon.classList.add('far');
        showNotification('Artikel dihapus dari bookmark');
    } else {
        bookmarkIcon.classList.remove('far');
        bookmarkIcon.classList.add('fas');
        showNotification('Artikel disimpan ke bookmark');
    }
}

// Show notification
function showNotification(message) {
    const notification = document.createElement('div');
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #199FB1;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        z-index: 10000;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

// Show login popup for unauthenticated users
@if(!$isAuthenticated)
let popupShown = false;

// Show popup after 8 seconds
setTimeout(function() {
    if (!popupShown) {
        showLoginPopup();
    }
}, 8000);

// Show popup when user tries to scroll past preview
window.addEventListener('scroll', function() {
    if (!popupShown) {
        const contentBlur = document.querySelector('.content-blur-overlay');
        if (contentBlur) {
            const rect = contentBlur.getBoundingClientRect();
            if (rect.top <= window.innerHeight / 2) {
                showLoginPopup();
            }
        }
    }
});

// Show popup when user tries to interact with restricted content
document.addEventListener('click', function(e) {
    if (!popupShown) {
        const restrictedElements = ['.btn-login-small', '.login-prompt a'];
        if (restrictedElements.some(selector => e.target.closest(selector))) {
            e.preventDefault();
            showLoginPopup();
        }
    }
});

function showLoginPopup() {
    const popup = document.getElementById('loginPopup');
    if (popup && !popupShown) {
        popup.classList.add('show');
        popupShown = true;
        document.body.style.overflow = 'hidden';
    }
}

function closeLoginPopup() {
    const popup = document.getElementById('loginPopup');
    if (popup) {
        popup.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
}

// Close popup when clicking outside
document.getElementById('loginPopup')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeLoginPopup();
    }
});

// Close popup with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLoginPopup();
    }
});
@endif
</script>
@endsection
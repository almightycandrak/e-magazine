@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <div class="container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="welcome-text">
                <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
                <span class="role-badge role-{{ Auth::user()->role }}">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-section">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $totalArtikels }}</h3>
                            <p>Total Artikel</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $publishedArtikels }}</h3>
                            <p>Dipublikasikan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $draftArtikels }}</h3>
                            <p>Draft</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-info">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $totalKomentars }}</h3>
                            <p>Komentar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="actions-section">
            <h2>Aksi Cepat</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h3>{{ Auth::user()->role === 'siswa' ? 'Artikel Saya' : 'Kelola Artikel' }}</h3>
                        <p>{{ Auth::user()->role === 'siswa' ? 'Buat dan kelola artikel Anda' : 'Kelola semua artikel' }}</p>
                        <a href="{{ route('artikel.index') }}" class="btn btn-primary">
                            {{ Auth::user()->role === 'siswa' ? 'Buat Artikel' : 'Kelola Artikel' }}
                        </a>
                    </div>
                </div>
                
                @if(in_array(Auth::user()->role, ['guru', 'admin']))
                <div class="col-md-6">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h3>Kelola Kategori</h3>
                        <p>Atur kategori artikel</p>
                        <a href="{{ route('kategori.index') }}" class="btn btn-success">
                            Kelola Kategori
                        </a>
                    </div>
                </div>
                @endif
                
                @if(Auth::user()->role === 'admin')
                <div class="col-md-6">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Kelola User</h3>
                        <p>Manajemen pengguna</p>
                        <a href="{{ route('user.index') }}" class="btn btn-info">
                            Kelola User
                        </a>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3>Laporan</h3>
                        <p>Statistik dan analisis</p>
                        <a href="{{ route('laporan.index') }}" class="btn btn-warning">
                            Lihat Laporan
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    padding: 6rem 0 2rem 0;
}

.welcome-section {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.user-avatar {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
}

.welcome-text h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
}

.role-badge {
    padding: 0.5rem 1rem;
    border-radius: 15px;
    font-weight: 600;
    font-size: 0.9rem;
}

.role-admin {
    background: #ef4444;
    color: white;
}

.role-guru {
    background: #199FB1;
    color: white;
}

.role-siswa {
    background: #8b5cf6;
    color: white;
}

.stats-section {
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.stat-info h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.stat-info p {
    color: #64748b;
    margin: 0;
    font-size: 0.9rem;
}

.actions-section h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1.5rem;
}

.action-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    text-align: center;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.action-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    margin: 0 auto 0.75rem;
}

.action-card h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.4rem;
}

.action-card p {
    color: #64748b;
    margin-bottom: 1rem;
    font-size: 0.85rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

/* Fix navbar profile icon */
.navbar .user-avatar {
    width: 40px !important;
    height: 40px !important;
    font-size: 1rem !important;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 3rem 0 2rem 0;
    }
    
    .welcome-section {
        flex-direction: column;
        text-align: center;
    }
    
    .welcome-text h1 {
        font-size: 1.5rem;
    }
}
.dashboard-universe {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
    min-height: 100vh;
    padding: 4rem 0 2rem 0;
    position: relative;
    overflow: hidden;
}

.welcome-hero {
    margin-bottom: 2rem;
}

/* Floating Particles Animation */
.floating-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
    opacity: 0.6;
}

.particle:nth-child(1) {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.particle:nth-child(2) {
    top: 60%;
    left: 80%;
    animation-delay: 2s;
}

.particle:nth-child(3) {
    top: 80%;
    left: 20%;
    animation-delay: 4s;
}

.particle:nth-child(4) {
    top: 30%;
    left: 70%;
    animation-delay: 1s;
}

.particle:nth-child(5) {
    top: 70%;
    left: 50%;
    animation-delay: 3s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.6;
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
        opacity: 1;
    }
}

/* Hero Section */
.hero-section {
    margin-bottom: 3rem;
    position: relative;
    z-index: 2;
}

.welcome-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 30px;
    padding: 3rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    position: relative;
    overflow: hidden;
}

.welcome-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(25, 159, 177, 0.05), rgba(13, 92, 117, 0.02));
    border-radius: 30px;
    z-index: -1;
}

.user-profile-section {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.avatar-container {
    position: relative;
}

.user-avatar-large {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border-radius: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    font-weight: 700;
    box-shadow: 0 15px 35px rgba(25, 159, 177, 0.3);
    position: relative;
    overflow: hidden;
}

.user-avatar-large::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0% {
        transform: translateX(-100%) translateY(-100%) rotate(45deg);
    }
    50% {
        transform: translateX(100%) translateY(100%) rotate(45deg);
    }
    100% {
        transform: translateX(-100%) translateY(-100%) rotate(45deg);
    }
}

.status-indicator {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 20px;
    height: 20px;
    background: #10b981;
    border-radius: 50%;
    border: 3px solid white;
    animation: pulse 2s infinite;
}

.welcome-title {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0 0 1rem 0;
    line-height: 1.2;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.role-admin {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.role-guru {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    color: white;
}

.role-siswa {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: white;
}

.welcome-subtitle {
    color: #64748b;
    font-size: 1.1rem;
    margin: 0;
    line-height: 1.5;
}

/* Statistics Section */
.stats-section {
    margin-bottom: 3rem;
    position: relative;
    z-index: 2;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    transition: all 0.3s ease;
}

.artikel-card::before {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.published-card::before {
    background: linear-gradient(135deg, #10b981, #059669);
}

.draft-card::before {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.comment-card::before {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.stat-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.stat-card:hover::before {
    width: 100%;
    opacity: 0.05;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.artikel-card .stat-icon {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.published-card .stat-icon {
    background: linear-gradient(135deg, #10b981, #059669);
}

.draft-card .stat-icon {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.comment-card .stat-icon {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1e293b;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-trend {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.stat-trend.up {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.stat-trend.neutral {
    background: rgba(156, 163, 175, 0.1);
    color: #9ca3af;
}

/* Actions Section */
.actions-section {
    position: relative;
    z-index: 2;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2rem;
}

.section-title i {
    color: #199FB1;
    font-size: 1.5rem;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
}

.action-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 2.5rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
}

.action-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0;
    transition: all 0.3s ease;
    border-radius: 25px;
    z-index: -1;
}

.primary-action::before {
    background: linear-gradient(135deg, rgba(25, 159, 177, 0.05), rgba(13, 92, 117, 0.02));
}

.secondary-action::before {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(29, 78, 216, 0.02));
}

.tertiary-action::before {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(124, 58, 237, 0.02));
}

.quaternary-action::before {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.05), rgba(217, 119, 6, 0.02));
}

.action-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
}

.action-card:hover::before {
    opacity: 1;
}

.action-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.action-icon {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.primary-action .action-icon {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
}

.secondary-action .action-icon {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.tertiary-action .action-icon {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.quaternary-action .action-icon {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.action-badge {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.action-content h3 {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.75rem;
}

.action-content p {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.action-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 1rem 1.5rem;
    border-radius: 15px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.primary-btn {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    color: white;
}

.secondary-btn {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
}

.tertiary-btn {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: white;
}

.quaternary-btn {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    color: white;
}

.action-btn i {
    transition: transform 0.3s ease;
}

.action-btn:hover i {
    transform: translateX(5px);
}

@media (max-width: 768px) {
    .dashboard-universe {
        padding: 3rem 0 2rem 0;
    }
    
    .user-profile-section {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
    
    .welcome-title {
        font-size: 2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .action-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .section-title {
        font-size: 1.5rem;
    }
}
</style>
@endsection
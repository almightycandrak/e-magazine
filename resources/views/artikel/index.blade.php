@extends('layouts.app')

@section('content')
<div class="artikel-container">
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    <div class="container">
        <!-- Modern Header -->
        <div class="modern-header">
            <div class="header-grid">
                <div class="header-nav">
                    <a href="{{ route('dashboard') }}" class="nav-back">
                        <div class="nav-icon">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <span>Dashboard</span>
                    </a>
                </div>
                
                <div class="header-main">
                    <div class="title-section">
                        <div class="title-decoration">
                            <div class="deco-line"></div>
                            <div class="deco-dot"></div>
                        </div>
                        <h1 class="main-title">{{ Auth::user()->role === 'siswa' ? 'My Articles' : 'Article Management' }}</h1>
                        <p class="main-subtitle">{{ Auth::user()->role === 'siswa' ? 'Create and manage your personal articles' : 'Manage all articles from writers' }}</p>
                    </div>
                </div>
                
                <div class="header-action">
                    <a href="{{ route('artikel.create') }}" class="create-article-btn">
                        <div class="btn-bg"></div>
                        <div class="btn-content">
                            <div class="btn-icon-wrapper">
                                <i class="fas fa-pen-fancy"></i>
                            </div>
                            <span class="btn-text">New Article</span>
                        </div>
                        <div class="btn-glow"></div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-section">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $artikels->count() }}</h3>
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
                            <h3>{{ $artikels->where('status', 'publish')->count() }}</h3>
                            <p>Dipublikasi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $artikels->where('status', 'draft')->count() }}</h3>
                            <p>Draft</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-info">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $artikels->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                            <p>Bulan Ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="search-section">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchArticle" class="form-control" placeholder="Cari artikel...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="filterStatus">
                        <option value="">Semua Status</option>
                        <option value="publish">Dipublikasi</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="filterCategory">
                        <option value="">Semua Kategori</option>
                        @foreach($artikels->pluck('kategori.nama')->unique()->filter() as $kategori)
                            <option value="{{ $kategori }}">{{ $kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Articles Grid -->
        <div class="articles-grid" id="articlesContainer">
            @forelse($artikels as $artikel)
                <div class="article-item" 
                     data-status="{{ $artikel->status }}" 
                     data-category="{{ $artikel->kategori->nama ?? 'Umum' }}" 
                     data-title="{{ strtolower($artikel->judul) }}">
                    <div class="article-card">
                        @if($artikel->foto)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}">
                                <div class="status-badge status-{{ $artikel->status }}">
                                    @if($artikel->status === 'publish')
                                        <i class="fas fa-check-circle"></i> Dipublikasi
                                    @elseif($artikel->status === 'rejected')
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    @else
                                        <i class="fas fa-clock"></i> Draft
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="card-placeholder">
                                <i class="fas fa-newspaper"></i>
                                <div class="status-badge status-{{ $artikel->status }}">
                                    @if($artikel->status === 'publish')
                                        <i class="fas fa-check-circle"></i> Dipublikasi
                                    @elseif($artikel->status === 'rejected')
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    @else
                                        <i class="fas fa-clock"></i> Draft
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="category">{{ $artikel->kategori->nama ?? 'Umum' }}</span>
                                <span class="date">{{ $artikel->created_at->format('d M Y') }}</span>
                            </div>
                            
                            <h3 class="card-title">{{ $artikel->judul }}</h3>
                            <p class="card-excerpt">{{ Str::limit($artikel->isi, 100) }}</p>
                            
                            <div class="card-footer">
                                <div class="author">
                                    <i class="fas fa-user"></i>
                                    {{ $artikel->user->name ?? 'Admin' }}
                                </div>
                                <div class="actions">
                                    <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(in_array(Auth::user()->role, ['guru', 'admin']) && $artikel->status === 'draft')
                                        <a href="{{ route('artikel.review', $artikel->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('artikel.edit', $artikel->id) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus artikel ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3>Belum Ada Artikel</h3>
                    <p>Mulai berbagi cerita dengan membuat artikel pertama</p>
                    <a href="{{ route('artikel.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Buat Artikel Pertama
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
.artikel-container {
    min-height: 100vh;
    padding: 5rem 0 2rem 0;
    position: relative;
    overflow: hidden;
}

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
    width: 6px;
    height: 6px;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite;
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
        transform: translateY(-30px) rotate(180deg);
        opacity: 1;
    }
}

/* Modern Header */
.modern-header {
    background: linear-gradient(135deg, #0D5C75 0%, #199FB1 50%, #A5D1E1 100%);
    border-radius: 30px;
    padding: 2rem;
    margin: 2rem;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
    z-index: 2;
    box-shadow: 0 10px 30px rgba(13, 92, 117, 0.2);
}

.header-grid {
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 3;
}

.nav-back {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    font-weight: 600;
    padding: 1rem 1.5rem;
    background: rgba(255,255,255,0.1);
    border-radius: 20px;
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.4s ease;
}

.nav-back:hover {
    color: white;
    background: rgba(255,255,255,0.2);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.nav-icon {
    width: 35px;
    height: 35px;
    background: rgba(255,255,255,0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.title-section {
    text-align: center;
    position: relative;
}

.title-decoration {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.deco-line {
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
}

.deco-dot {
    width: 8px;
    height: 8px;
    background: rgba(255,255,255,0.8);
    border-radius: 50%;
    animation: pulse 2s infinite;
}

.main-title {
    font-size: 3rem;
    font-weight: 900;
    color: white;
    margin: 0 0 0.5rem 0;
    text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    letter-spacing: -1px;
}

.main-subtitle {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.8);
    margin: 0;
    font-weight: 400;
}

.create-article-btn {
    position: relative;
    display: flex;
    align-items: center;
    text-decoration: none;
    padding: 1.2rem 2rem;
    border-radius: 25px;
    overflow: hidden;
    transition: all 0.4s ease;
}

.btn-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border-radius: 25px;
    transition: all 0.4s ease;
}

.btn-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    position: relative;
    z-index: 2;
}

.btn-icon-wrapper {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
}

.btn-text {
    color: white;
    font-weight: 700;
    font-size: 1rem;
}

.btn-glow {
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border-radius: 27px;
    opacity: 0;
    filter: blur(8px);
    transition: opacity 0.4s ease;
    z-index: -1;
}

.create-article-btn:hover .btn-glow {
    opacity: 0.6;
}

.create-article-btn:hover {
    transform: translateY(-5px);
}

.create-article-btn:hover .btn-bg {
    background: linear-gradient(135deg, #0D5C75, #199FB1);
}

@keyframes pulse {
    0%, 100% {
        opacity: 0.8;
        transform: scale(1);
    }
    50% {
        opacity: 1;
        transform: scale(1.2);
    }
}

.stats-section {
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
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

.stat-icon.bg-primary {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
}

.stat-icon.bg-success {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
}

.stat-icon.bg-warning {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
}

.stat-icon.bg-info {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
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

.search-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.search-input-wrapper {
    position: relative;
}

.search-input-wrapper i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #199FB1;
    z-index: 2;
}

.search-input-wrapper input {
    padding-left: 45px !important;
}

.articles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    position: relative;
    z-index: 2;
}

.article-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.article-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.card-image {
    height: 180px;
    position: relative;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-placeholder {
    height: 180px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #94a3b8;
    position: relative;
}

.status-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    animation: statusPulse 2s infinite;
}

.status-publish {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
}

.status-draft {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    box-shadow: 0 4px 20px rgba(245, 158, 11, 0.4);
}

.status-rejected {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
}

@keyframes statusPulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.9;
    }
}

.card-content {
    padding: 1.5rem;
}

.card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.category {
    background: #199FB1;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 600;
}

.date {
    color: #64748b;
    font-size: 0.85rem;
}

.card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.card-excerpt {
    color: #64748b;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 1rem;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
}

.author {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    font-size: 0.85rem;
}

.actions {
    display: flex;
    gap: 0.5rem;
}

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 3rem 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.empty-icon {
    font-size: 3rem;
    color: #199FB1;
    margin-bottom: 1rem;
    opacity: 0.7;
}

.empty-state h3 {
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #64748b;
    margin-bottom: 1.5rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    color: white;
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-primary:hover::before {
    left: 100%;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0D5C75, #199FB1);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(25, 159, 177, 0.3);
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.btn-warning {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    color: white;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #0D5C75, #199FB1);
    color: white;
    transform: translateY(-2px);
}

.btn-outline-secondary {
    background: white;
    border: 2px solid #e2e8f0;
    color: #64748b;
}

.alert {
    padding: 1.25rem 1.5rem;
    border-radius: 15px;
    margin-bottom: 1.5rem;
    border: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.alert-success {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #065f46;
}

.form-control, .form-select {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #199FB1;
    box-shadow: 0 0 0 3px rgba(25, 159, 177, 0.1);
}

.dropdown-menu {
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    padding: 0.5rem 0;
    z-index: 1000 !important;
    position: absolute !important;
    background: white !important;
    min-width: 150px !important;
}

.dropdown-item {
    padding: 0.75rem 1.25rem;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background: #f8fafc;
    color: #199FB1;
}

@media (max-width: 768px) {
    .artikel-container {
        padding: 4rem 0 2rem 0;
    }
    
    .header-content {
        flex-direction: column;
        align-items: stretch;
    }
    
    .header-text h1 {
        font-size: 1.5rem;
    }
    
    .articles-grid {
        grid-template-columns: 1fr;
    }
    
    .card-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .card-footer {
        flex-direction: column;
        gap: 0.75rem;
        align-items: flex-start;
    }
}


</style>

<script>
// Search and Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchArticle');
    const statusFilter = document.getElementById('filterStatus');
    const categoryFilter = document.getElementById('filterCategory');
    const articleItems = document.querySelectorAll('.article-item');
    
    function filterArticles() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const categoryValue = categoryFilter.value;
        
        articleItems.forEach(item => {
            const title = item.dataset.title;
            const status = item.dataset.status;
            const category = item.dataset.category;
            
            const matchesSearch = title.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;
            const matchesCategory = !categoryValue || category === categoryValue;
            
            if (matchesSearch && matchesStatus && matchesCategory) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', filterArticles);
    statusFilter.addEventListener('change', filterArticles);
    categoryFilter.addEventListener('change', filterArticles);
});
</script>

@endsection
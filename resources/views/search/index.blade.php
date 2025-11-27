@extends('layouts.app')

@section('content')
<div class="search-container">
    <div class="container">
        <!-- Header -->
        <div class="search-header">
            <div class="header-icon">
                <i class="fas fa-search"></i>
            </div>
            <div class="header-text">
                <h1>Pencarian Artikel</h1>
                <p>Temukan artikel berdasarkan judul, kategori, atau tanggal</p>
            </div>
        </div>

        <!-- Search Form -->
        <div class="search-form-card">
            <form method="GET" action="{{ route('search') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="search-input-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" name="q" class="form-control search-input" placeholder="Cari artikel..." value="{{ $query }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ $kategori == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-search w-100">
                            <i class="fas fa-search"></i>
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results Info -->
        @if($query || $kategori || $tanggal)
            <div class="results-info">
                <p>Menampilkan {{ $artikels->total() }} hasil @if($query) untuk "<strong>{{ $query }}</strong>" @endif</p>
            </div>
        @endif

        <!-- Results Grid -->
        <div class="results-grid">
            @forelse($artikels as $artikel)
                <div class="article-card">
                    @if($artikel->foto)
                        <div class="card-image">
                            <img src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}">
                        </div>
                    @else
                        <div class="card-placeholder">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    @endif
                    
                    <div class="card-content">
                        <div class="card-meta">
                            <span class="category">{{ $artikel->kategori->nama ?? 'Umum' }}</span>
                            <span class="date">{{ $artikel->created_at->format('d M Y') }}</span>
                        </div>
                        
                        <h3 class="card-title">
                            <a href="{{ route('artikel.show', $artikel->id) }}">{{ $artikel->judul }}</a>
                        </h3>
                        
                        <p class="card-excerpt">{{ Str::limit($artikel->isi, 100) }}</p>
                        
                        <div class="card-footer">
                            <div class="author">
                                <i class="fas fa-user"></i>
                                {{ $artikel->user->name ?? 'Admin' }}
                            </div>
                            <div class="stats">
                                <span><i class="fas fa-heart"></i> {{ $artikel->likes->count() }}</span>
                                <span><i class="fas fa-comments"></i> {{ $artikel->komentars->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Tidak Ada Hasil</h3>
                    <p>Coba ubah kata kunci atau filter pencarian</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($artikels->hasPages())
            <div class="pagination-wrapper">
                {{ $artikels->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<style>
.search-container {
    padding: 5rem 0 2rem 0;
}

.search-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.header-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.header-text h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
}

.header-text p {
    color: #64748b;
    margin: 0;
}

.search-form-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
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

.search-input {
    padding-left: 45px !important;
}

.btn-search {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border: none;
    color: white;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    justify-content: center;
}

.btn-search:hover {
    background: linear-gradient(135deg, #0D5C75, #199FB1);
    color: white;
    transform: translateY(-2px);
}

.results-info {
    margin-bottom: 1.5rem;
}

.results-info p {
    color: #64748b;
    margin: 0;
}

.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.article-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-image {
    height: 180px;
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
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.card-title a {
    color: #1e293b;
    text-decoration: none;
}

.card-title a:hover {
    color: #199FB1;
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

.stats {
    display: flex;
    gap: 1rem;
}

.stats span {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    color: #64748b;
    font-size: 0.8rem;
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
    margin: 0;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

@media (max-width: 768px) {
    .search-container {
        padding: 4rem 0 2rem 0;
    }
    
    .search-header {
        flex-direction: column;
        text-align: center;
    }
    
    .header-text h1 {
        font-size: 1.5rem;
    }
    
    .results-grid {
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
@endsection
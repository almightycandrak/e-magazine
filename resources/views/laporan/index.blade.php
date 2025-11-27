@extends('layouts.app')

@section('content')
<div class="laporan-header mb-5">
    <!-- Floating Particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    
    <!-- Geometric Pattern -->
    <div class="geometric-pattern"></div>
    
    <!-- Gradient Overlay -->
    <div class="gradient-overlay"></div>
    
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12">
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3 shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <div class="header-content text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="header-icon me-3">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div>
                            <h1 class="display-6 fw-bold text-white mb-0">Laporan Artikel</h1>
                            <p class="text-white-50 mb-0">Analisis dan statistik artikel</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Border Effect -->
    <div class="bottom-border"></div>
</div>

<!-- Filter Form -->
<div class="container-fluid">
    <div class="filter-card mb-5">
        <div class="filter-header mb-4">
            <h3 class="filter-title">Filter Laporan</h3>
            <p class="filter-subtitle">Pilih periode dan kategori untuk analisis</p>
        </div>
        <form method="GET" action="{{ route('laporan.index') }}" class="filter-form">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="form-group-modern">
                        <label class="form-label-modern">Periode Bulan</label>
                        <div class="input-wrapper">
                            <i class="fas fa-calendar input-icon"></i>
                            <input type="month" name="bulan" class="form-control-modern" value="{{ $bulan }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-modern">
                        <label class="form-label-modern">Kategori</label>
                        <div class="input-wrapper">
                            <i class="fas fa-tags input-icon"></i>
                            <select name="kategori" class="form-control-modern">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat->id }}" {{ $kategori == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-modern">
                        <label class="form-label-modern">Aksi</label>
                        <div class="filter-actions">
                            <button type="submit" class="btn-filter btn-primary">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                            <a href="{{ route('laporan.export.pdf', request()->query()) }}" class="btn-filter btn-pdf">
                                <i class="fas fa-file-pdf me-2"></i>PDF
                            </a>
                            {{-- <a href="{{ route('laporan.export.excel', request()->query()) }}" class="btn-filter btn-excel">
                                <i class="fas fa-file-excel me-2"></i>Excel
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-section mb-5">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-primary">
                    <div class="stat-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $stats['total_artikel'] }}</h3>
                        <p class="stat-label">Total Artikel</p>
                    </div>
                    <div class="stat-decoration"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-danger">
                    <div class="stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $stats['total_likes'] }}</h3>
                        <p class="stat-label">Total Like</p>
                    </div>
                    <div class="stat-decoration"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-info">
                    <div class="stat-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $stats['total_komentar'] }}</h3>
                        <p class="stat-label">Total Komentar</p>
                    </div>
                    <div class="stat-decoration"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card stat-warning">
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">{{ $stats['artikel_terpopuler'] ? $stats['artikel_terpopuler']->likes->count() : 0 }}</h3>
                        <p class="stat-label">Like Terbanyak</p>
                    </div>
                    <div class="stat-decoration"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="table-card">
        <div class="table-header">
            <h3 class="table-title">Daftar Artikel</h3>
            <p class="table-subtitle">Data artikel berdasarkan filter yang dipilih</p>
        </div>
        <div class="table-container">
            @forelse($artikels as $artikel)
                <div class="article-row">
                    <div class="article-main">
                        <div class="article-header">
                            <div class="article-title">{{ $artikel->judul }}</div>
                            <div class="article-status">
                                <span class="status-badge status-approved">Published</span>
                            </div>
                        </div>
                        <div class="article-excerpt">{{ Str::limit(strip_tags($artikel->konten), 120) }}</div>
                        <div class="article-meta">
                            <span class="author"><i class="fas fa-user me-1"></i>{{ $artikel->user->name }} ({{ ucfirst($artikel->user->role) }})</span>
                            <span class="category"><i class="fas fa-tag me-1"></i>{{ $artikel->kategori->nama ?? 'Umum' }}</span>
                            <span class="date"><i class="fas fa-calendar me-1"></i>{{ $artikel->created_at->format('d M Y, H:i') }}</span>
                            <span class="word-count"><i class="fas fa-file-alt me-1"></i>{{ str_word_count(strip_tags($artikel->konten)) }} kata</span>
                            @if($artikel->updated_at != $artikel->created_at)
                                <span class="updated"><i class="fas fa-edit me-1"></i>Diupdate {{ $artikel->updated_at->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="article-sidebar">
                        <div class="article-stats">
                            <div class="stat-item stat-likes">
                                <i class="fas fa-heart"></i>
                                <span>{{ $artikel->likes->count() }}</span>
                                <small>Likes</small>
                            </div>
                            <div class="stat-item stat-comments">
                                <i class="fas fa-comments"></i>
                                <span>{{ $artikel->komentars->count() }}</span>
                                <small>Komentar</small>
                            </div>
                            <div class="stat-item stat-engagement">
                                <i class="fas fa-chart-line"></i>
                                <span>{{ $artikel->likes->count() + $artikel->komentars->count() }}</span>
                                <small>Engagement</small>
                            </div>
                            <div class="stat-item stat-length">
                                <i class="fas fa-align-left"></i>
                                <span>{{ strlen(strip_tags($artikel->konten)) }}</span>
                                <small>Karakter</small>
                            </div>
                        </div>
                        <div class="article-actions">
                            <a href="{{ route('artikel.show', $artikel->id) }}" class="btn-view">
                                <i class="fas fa-eye"></i>
                                <span>Lihat Detail</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state-modern">
                    <div class="empty-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3 class="empty-title">Tidak Ada Data</h3>
                    <p class="empty-description">Tidak ada artikel untuk periode dan kategori yang dipilih</p>
                </div>
            @endforelse
        </div>
    </div>
</div>


@endsection
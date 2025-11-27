@extends('layouts.app')

@section('content')
<div class="kategori-header mb-5">
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
            <div class="col-md-8">
                <button onclick="history.back()" class="btn btn-light btn-sm mb-3 shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </button>
                <div class="header-content">
                    <div class="d-flex align-items-center mb-2">
                        <div class="header-icon me-3">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div>
                            <h1 class="display-6 fw-bold text-white mb-0">Kelola Kategori</h1>
                            <p class="text-white-50 mb-0">Organisasi dan kelola kategori artikel Anda</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('kategori.create') }}" class="btn btn-light btn-lg shadow-sm">
                    <i class="fas fa-plus me-2"></i>Tambah Kategori
                </a>
            </div>
        </div>
    </div>
    
    <!-- Bottom Border Effect -->
    <div class="bottom-border"></div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid">
    <div class="row g-4">
        @forelse($kategoris as $kategori)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="kategori-card-modern h-100">
                    <div class="card-body p-4">
                        <div class="kategori-icon-container mb-4">
                            <div class="kategori-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="kategori-badge">{{ $loop->iteration }}</div>
                        </div>
                        
                        <div class="kategori-content mb-4">
                            <h4 class="kategori-title mb-2">{{ $kategori->nama }}</h4>
                            <p class="kategori-description">{{ $kategori->deskripsi ?: 'Tidak ada deskripsi tersedia' }}</p>
                        </div>
                        
                        <div class="kategori-actions">
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin hapus kategori ini?')">
                                    <i class="fas fa-trash"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state-modern">
                    <div class="empty-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h3 class="empty-title">Belum Ada Kategori</h3>
                    <p class="empty-description">Mulai dengan membuat kategori pertama untuk mengorganisir artikel Anda</p>
                    <a href="{{ route('kategori.create') }}" class="btn btn-ocean btn-lg">
                        <i class="fas fa-plus me-2"></i>Buat Kategori Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to form submission
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span class="loading-spinner me-2"></span>Menyimpan...';
                submitBtn.disabled = true;
                
                // Re-enable after 3 seconds as fallback
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }
        });
    });
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });
});
</script>
@endsection
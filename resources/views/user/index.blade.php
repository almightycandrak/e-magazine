@extends('layouts.app')

@section('content')
<div class="user-header mb-5">
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
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h1 class="display-6 fw-bold text-white mb-0">Kelola User</h1>
                            <p class="text-white-50 mb-0">Manajemen user guru dan siswa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('user.create') }}" class="btn btn-light btn-lg shadow-sm">
                    <i class="fas fa-plus me-2"></i>Tambah User
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

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid">
    <div class="row g-4">
        @forelse($users as $user)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="user-card-modern h-100">
                    <div class="card-body p-4">
                        <div class="text-center mb-3 position-relative">
                            <div class="user-avatar mx-auto mb-3">
                                <i class="fas fa-user"></i>
                            </div>
                            @if($user->id === auth()->id())
                                <span class="status-badge-card">Anda</span>
                            @endif
                        </div>
                        
                        <div class="text-center mb-4">
                            <h4 class="user-name mb-2">{{ $user->name }}</h4>
                            <p class="user-email mb-3">{{ $user->email }}</p>
                            <div class="role-badge role-{{ $user->role }} mb-2">
                                @if($user->role === 'admin')
                                    <i class="fas fa-crown me-1"></i>
                                @elseif($user->role === 'guru')
                                    <i class="fas fa-chalkboard-teacher me-1"></i>
                                @else
                                    <i class="fas fa-graduation-cap me-1"></i>
                                @endif
                                {{ ucfirst($user->role) }}
                            </div>
                            <small class="text-muted">{{ $user->created_at->format('d M Y') }}</small>
                        </div>
                        
                        <div class="user-actions">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn-action btn-edit">
                                <i class="fas fa-edit"></i>
                                <span>Edit</span>
                            </a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin hapus user ini?')">
                                        <i class="fas fa-trash"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            @else
                                <div class="btn-action btn-disabled">
                                    <i class="fas fa-lock"></i>
                                    <span>Protected</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state-modern">
                    <div class="empty-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="empty-title">Belum Ada User</h3>
                    <p class="empty-description">Mulai dengan membuat user pertama untuk sistem</p>
                    <a href="{{ route('user.create') }}" class="btn btn-ocean btn-lg">
                        <i class="fas fa-plus me-2"></i>Buat User Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>


@endsection
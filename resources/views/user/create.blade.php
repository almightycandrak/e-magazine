@extends('layouts.app')

@section('content')
<div class="create-user-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="create-header mb-4">
                    <button onclick="history.back()" class="btn btn-light btn-sm mb-3 shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </button>
                    <div class="d-flex align-items-center mb-3">
                        <div class="create-icon me-3">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1">Tambah User Baru</h2>
                            <p class="text-muted mb-0">Buat akun user untuk sistem</p>
                        </div>
                    </div>
                </div>
                
                <div class="form-card">
                    <form action="{{ route('user.store') }}" method="POST" class="modern-form">
                        @csrf
                        
                        <div class="form-group-modern mb-4">
                            <label for="name" class="form-label-modern">Nama Lengkap</label>
                            <div class="input-wrapper">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" class="form-control-modern @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="Masukkan nama lengkap" required>
                            </div>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-modern mb-4">
                            <label for="email" class="form-label-modern">Email</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" class="form-control-modern @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Masukkan email" required>
                            </div>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-modern mb-4">
                            <label for="role" class="form-label-modern">Role</label>
                            <div class="input-wrapper">
                                <i class="fas fa-user-tag input-icon"></i>
                                <select class="form-control-modern @error('role') is-invalid @enderror" 
                                        id="role" name="role" required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                </select>
                            </div>
                            @error('role')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-modern mb-5">
                            <label for="password" class="form-label-modern">Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" class="form-control-modern @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Masukkan password" required>
                            </div>
                            <small class="text-muted">Minimal 8 karakter</small>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="button" onclick="history.back()" class="btn-modern btn-cancel">
                                <i class="fas fa-times me-2"></i>Batal
                            </button>
                            <button type="submit" class="btn-modern btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.modern-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('.btn-primary');
            if (submitBtn && !submitBtn.disabled) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<div class="spinner-border spinner-border-sm me-2"></div>Menyimpan...';
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
            }
        });
    }
    
    const firstInput = document.querySelector('input[name="name"]');
    if (firstInput) {
        setTimeout(() => {
            firstInput.focus();
        }, 300);
    }
    
    const inputs = document.querySelectorAll('.form-control-modern');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim()) {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
        
        if (input.value.trim()) {
            input.classList.add('has-value');
        }
    });
});
</script>
@endsection
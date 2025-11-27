@extends('layouts.app')

@section('content')
<div class="edit-kategori-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="edit-header mb-4">
                    <button onclick="history.back()" class="btn btn-light btn-sm mb-3 shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </button>
                    <div class="d-flex align-items-center mb-3">
                        <div class="edit-icon me-3">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1">Edit Kategori</h2>
                            <p class="text-muted mb-0">Perbarui informasi kategori "{{ $kategori->nama }}"</p>
                        </div>
                    </div>
                </div>
                
                <div class="form-card">
                    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="modern-form">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group-modern mb-4">
                            <label for="nama" class="form-label-modern">Nama Kategori</label>
                            <div class="input-wrapper">
                                <i class="fas fa-tag input-icon"></i>
                                <input type="text" class="form-control-modern @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" 
                                       placeholder="Masukkan nama kategori" required>
                            </div>
                            @error('nama')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-modern mb-5">
                            <label for="deskripsi" class="form-label-modern">Deskripsi</label>
                            <div class="textarea-wrapper">
                                <i class="fas fa-align-left textarea-icon"></i>
                                <textarea class="form-control-modern @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" rows="4" 
                                          placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                            </div>
                            @error('deskripsi')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="button" onclick="history.back()" class="btn-modern btn-cancel">
                                <i class="fas fa-times me-2"></i>Batal
                            </button>
                            <button type="submit" class="btn-modern btn-primary">
                                <i class="fas fa-save me-2"></i>Update Kategori
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
    // Enhanced form submission with loading state
    const form = document.querySelector('.modern-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('.btn-primary');
            if (submitBtn && !submitBtn.disabled) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<div class="spinner-border spinner-border-sm me-2"></div>Mengupdate...';
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
            }
        });
    }
    
    // Auto-focus and select text for editing
    const firstInput = document.querySelector('input[name="nama"]');
    if (firstInput) {
        setTimeout(() => {
            firstInput.focus();
            firstInput.select();
        }, 300);
    }
    
    // Form validation feedback
    const inputs = document.querySelectorAll('.form-control-modern');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim()) {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
        
        // Check initial values
        if (input.value.trim()) {
            input.classList.add('has-value');
        }
    });
});
</script>
@endsection
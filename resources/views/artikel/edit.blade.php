@extends('layouts.app')

@section('content')
<div class="edit-article-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="edit-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="header-text">
                            <h1>Edit Artikel</h1>
                            <p>Perbarui artikel Anda</p>
                        </div>
                    </div>
                    <button onclick="history.back()" class="btn-back-modern">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </button>
                </div>

                <div class="edit-form-wrapper">
                    <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data" class="modern-form">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group-modern">
                            <div class="input-wrapper">
                                <i class="fas fa-heading input-icon"></i>
                                <input type="text" class="form-input @error('judul') is-invalid @enderror" 
                                       id="judul" name="judul" value="{{ old('judul', $artikel->judul) }}" placeholder=" " required>
                                <label for="judul" class="floating-label">Judul Artikel</label>
                            </div>
                            @error('judul')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-modern">
                            <div class="input-wrapper">
                                <i class="fas fa-tags input-icon"></i>
                                <select class="form-select-modern @error('id_kategori') is-invalid @enderror" 
                                        id="id_kategori" name="id_kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('id_kategori', $artikel->id_kategori) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_kategori')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-modern">
                            <div class="textarea-wrapper">
                                <div class="textarea-header">
                                    <label for="isi" class="textarea-label">
                                        <i class="fas fa-edit"></i>
                                        Isi Artikel
                                    </label>
                                </div>
                                <textarea class="form-textarea @error('isi') is-invalid @enderror" 
                                          id="isi" name="isi" rows="8" required 
                                          placeholder="Tulis artikel Anda di sini...">{{ old('isi', $artikel->isi) }}</textarea>
                            </div>
                            @error('isi')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label">
                                <i class="fas fa-image"></i> Foto Artikel
                            </label>
                            @if($artikel->foto)
                                <div class="current-image mb-3">
                                    <img src="{{ asset('storage/' . $artikel->foto) }}" alt="Current photo" class="img-preview">
                                    <p class="text-muted small mt-2">Foto saat ini</p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                            @error('foto')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="button" onclick="history.back()" class="btn-cancel">
                                <i class="fas fa-times"></i>
                                <span>Batal</span>
                            </button>
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-save"></i>
                                <span>Update Artikel</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.edit-article-container {
    min-height: 100vh;
    background: #ffffff;
    padding: 2rem 0;
}

.edit-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.header-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header-icon i {
    font-size: 1.5rem;
    color: white;
}

.header-text h1 {
    color: #1e293b;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
}

.header-text p {
    color: #64748b;
    font-size: 1rem;
    margin: 0.5rem 0 0 0;
}

.btn-back-modern {
    background: #f1f5f9;
    color: #475569;
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    cursor: pointer;
    font-weight: 500;
}

.btn-back-modern:hover {
    background: #e2e8f0;
    color: #334155;
}

.edit-form-wrapper {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    border: 1px solid #f1f5f9;
}

.form-group-modern {
    margin-bottom: 1.5rem;
}

.input-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 1rem;
    z-index: 2;
}

.input-wrapper:focus-within .input-icon {
    color: #199FB1;
}

.floating-label {
    position: absolute;
    left: 3rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1rem;
    color: #94a3b8;
    background: white;
    padding: 0 0.5rem;
    transition: all 0.3s ease;
    pointer-events: none;
    z-index: 1;
}

.input-wrapper:focus-within .floating-label {
    color: #199FB1;
    transform: translateY(-2.5rem) scale(0.85);
}

.form-input, .form-select-modern {
    width: 100%;
    border: 2px solid #e2e8f0;
    background: white;
    font-size: 1rem;
    padding: 1rem 1rem 1rem 3rem;
    outline: none;
    color: #374151;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.form-input:focus, .form-select-modern:focus {
    border-color: #199FB1;
    box-shadow: 0 0 0 3px rgba(25, 159, 177, 0.1);
}

.form-input:not(:placeholder-shown) + .floating-label {
    transform: translateY(-2.5rem) scale(0.85);
    color: #199FB1;
}

.form-select-modern {
    appearance: none;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%2394a3b8" stroke-width="2"><polyline points="6,9 12,15 18,9"></polyline></svg>');
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1rem;
}

.textarea-wrapper {
    position: relative;
}

.textarea-header {
    margin-bottom: 0.75rem;
}

.textarea-label {
    font-weight: 600;
    color: #374151;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.textarea-label i {
    color: #199FB1;
}

.form-textarea {
    width: 100%;
    border: 2px solid #e2e8f0;
    background: white;
    font-size: 1rem;
    line-height: 1.6;
    resize: vertical;
    outline: none;
    color: #374151;
    padding: 1rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    min-height: 120px;
}

.form-textarea:focus {
    border-color: #199FB1;
    box-shadow: 0 0 0 3px rgba(25, 159, 177, 0.1);
}

.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-label i {
    color: #199FB1;
}

.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #199FB1;
    box-shadow: 0 0 0 3px rgba(25, 159, 177, 0.1);
}

.current-image {
    text-align: center;
}

.img-preview {
    max-height: 200px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
    gap: 1rem;
}

.btn-cancel {
    background: #f1f5f9;
    color: #64748b;
    padding: 0.875rem 1.75rem;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    cursor: pointer;
    font-weight: 500;
}

.btn-cancel:hover {
    background: #e2e8f0;
    color: #475569;
}

.btn-submit {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    color: white;
    padding: 0.875rem 1.75rem;
    border: none;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(25, 159, 177, 0.2);
}

.btn-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(25, 159, 177, 0.3);
}

.error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-weight: 500;
}

.error-message::before {
    content: '⚠';
    font-size: 1rem;
}

@media (max-width: 768px) {
    .edit-header {
        flex-direction: column;
        gap: 1rem;
        padding: 1.5rem;
    }
    
    .header-text h1 {
        font-size: 1.5rem;
    }
    
    .edit-form-wrapper {
        padding: 1.5rem;
        margin: 0 1rem;
    }
    
    .form-actions {
        flex-direction: column-reverse;
        gap: 1rem;
    }
    
    .btn-cancel, .btn-submit {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
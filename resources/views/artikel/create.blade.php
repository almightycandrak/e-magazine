@extends('layouts.app')

@section('content')
<div class="create-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="create-header">
                    <h1>Create New Article</h1>
                    <p>Share your thoughts with the world</p>
                    <a href="{{ route('artikel.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Articles
                    </a>
                </div>

                <div class="glass-form">
                    <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="judul">Article Title</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul') }}" 
                                   placeholder="Enter article title" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_kategori">Category</label>
                            <select class="form-control @error('id_kategori') is-invalid @enderror" 
                                    id="id_kategori" name="id_kategori" required>
                                <option value="">Choose Category</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('id_kategori') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="isi">Article Content</label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" 
                                      id="isi" name="isi" rows="8" required 
                                      placeholder="Write your article content here...">{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Upload Image (Optional)</label>
                            <div class="file-upload">
                                <input type="file" class="file-input @error('foto') is-invalid @enderror" 
                                       id="foto" name="foto" accept="image/*" onchange="previewImage(this)">
                                <label for="foto" class="file-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Click to upload image</span>
                                </label>
                                <div id="imagePreview" class="image-preview" style="display: none;">
                                    <img id="preview" src="" alt="Preview">
                                    <button type="button" onclick="removeImage()" class="remove-btn">×</button>
                                </div>
                            </div>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="button" onclick="history.back()" class="btn btn-cancel">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-publish">
                                <i class="fas fa-paper-plane"></i>
                                Publish Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.create-container {
    padding: 6rem 0 3rem 0;
    min-height: 100vh;
}

.create-header {
    text-align: center;
    margin-bottom: 3rem;
}

.create-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 0.5rem;
}

.create-header p {
    color: #64748b;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #199FB1;
    text-decoration: none;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 25px;
    border: 1px solid rgba(25, 159, 177, 0.2);
    transition: all 0.3s ease;
}

.back-btn:hover {
    color: white;
    background: #199FB1;
    transform: translateY(-2px);
}

.glass-form {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #1e293b;
    font-weight: 600;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    background: rgba(255, 255, 255, 0.8);
    border: 2px solid rgba(25, 159, 177, 0.1);
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #199FB1;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 0 0 3px rgba(25, 159, 177, 0.1);
}

.file-upload {
    position: relative;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.8);
    border: 2px dashed rgba(25, 159, 177, 0.3);
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.file-label:hover {
    border-color: #199FB1;
    background: rgba(255, 255, 255, 0.95);
}

.file-label i {
    font-size: 2rem;
    color: #199FB1;
}

.image-preview {
    margin-top: 1rem;
    position: relative;
    display: inline-block;
}

.image-preview img {
    max-width: 200px;
    max-height: 150px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.remove-btn {
    position: absolute;
    top: -8px;
    right: -8px;
    width: 24px;
    height: 24px;
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1rem;
    line-height: 1;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn {
    flex: 1;
    padding: 0.875rem 1.5rem;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-cancel {
    background: #f8fafc;
    color: #64748b;
    border: 2px solid #e2e8f0;
}

.btn-cancel:hover {
    background: #e2e8f0;
}

.btn-publish {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    color: white;
}

.btn-publish:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(25, 159, 177, 0.3);
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

@media (max-width: 768px) {
    .create-container {
        padding: 4rem 0 2rem 0;
    }
    
    .create-header h1 {
        font-size: 2rem;
    }
    
    .glass-form {
        padding: 1.5rem;
        margin: 0 1rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('foto').value = '';
    document.getElementById('imagePreview').style.display = 'none';
}
</script>

@endsection
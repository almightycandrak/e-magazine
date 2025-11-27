@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="page-header mb-4 p-4 bg-ocean-medium text-white" style="margin-top: 20px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('artikel.index') }}" class="btn btn-light btn-sm mb-2">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                        <h2 class="mb-1"><i class="fas fa-search me-2"></i>Review Artikel</h2>
                        <p class="mb-0 opacity-75">Periksa kelayakan artikel untuk publikasi</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">{{ $artikel->judul }}</h5>
                            <small class="text-muted">
                                Oleh: {{ $artikel->user->name }} | 
                                Kategori: {{ $artikel->kategori->nama }} | 
                                {{ $artikel->created_at->format('d M Y H:i') }}
                            </small>
                        </div>
                        <div class="card-body">
                            @if($artikel->foto)
                                <img src="{{ Storage::url($artikel->foto) }}" class="img-fluid mb-3 rounded">
                            @endif
                            <div class="artikel-content">
                                {!! nl2br(e($artikel->isi)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Review Artikel</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="badge bg-{{ $artikel->status == 'draft' ? 'warning' : ($artikel->status == 'publish' ? 'success' : 'danger') }}">
                                    {{ ucfirst($artikel->status) }}
                                </span>
                            </div>

                            <form action="{{ route('artikel.approve', $artikel) }}" method="POST" class="mb-2">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Catatan Review (Opsional)</label>
                                    <textarea name="review_notes" class="form-control" rows="3" placeholder="Tambahkan catatan untuk penulis..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check me-1"></i>Setujui & Publikasikan
                                </button>
                            </form>

                            <form action="{{ route('artikel.revise', $artikel) }}" method="POST" class="mb-2">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-warning">Catatan Revisi *</label>
                                    <textarea name="review_notes" class="form-control @error('review_notes') is-invalid @enderror" 
                                              rows="3" required placeholder="Jelaskan apa yang perlu diperbaiki..."></textarea>
                                    @error('review_notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="fas fa-edit me-1"></i>Minta Revisi
                                </button>
                            </form>

                            <form action="{{ route('artikel.reject', $artikel) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-danger">Alasan Penolakan *</label>
                                    <textarea name="review_notes" class="form-control @error('review_notes') is-invalid @enderror" 
                                              rows="4" required placeholder="Jelaskan alasan penolakan artikel ini..."></textarea>
                                    @error('review_notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-times me-1"></i>Tolak Artikel
                                </button>
                            </form>

                            @if($artikel->review_notes)
                                <div class="mt-3 p-3 bg-light rounded">
                                    <h6>Review Terakhir:</h6>
                                    <p class="mb-1">{{ $artikel->review_notes }}</p>
                                    <small class="text-muted">
                                        {{ $artikel->reviewed_at?->format('d M Y H:i') }}
                                    </small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, {{ Auth::user()->nama }}</p>

    <a href="{{ route('artikel.index') }}" class="btn btn-primary">Kelola Artikel</a>
    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kelola Kategori</a>
    <a href="{{ route('user.index') }}" class="btn btn-info">Kelola User</a>
    <a href="{{ route('laporan.index') }}" class="btn btn-warning">Laporan</a>
@endsection
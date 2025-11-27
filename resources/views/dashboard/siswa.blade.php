@extends('layouts.app')

@section('content')
    <h2>Dashboard Siswa</h2>
    <p>Selamat datang, {{ Auth::user()->nama }}</p>

    <a href="{{ route('artikel.create') }}" class="btn btn-success">Tulis Artikel</a>
    <a href="{{ route('artikel.index') }}" class="btn btn-primary">Lihat Artikel</a>
@endsection
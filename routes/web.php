<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    $artikels = \App\Models\Artikel::with('user', 'kategori', 'likes', 'komentars')->where('status', 'publish')->latest()->take(6)->get();
    $terpopuler = \App\Models\Artikel::with('user', 'kategori', 'likes')->where('status', 'publish')
        ->withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();
    $kategoris = \App\Models\Kategori::withCount('artikels')->get();
    return view('home', compact('artikels', 'terpopuler', 'kategoris'));
})->name('home');

// Public routes
Route::get('search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $totalArtikels = \App\Models\Artikel::count();
        $publishedArtikels = \App\Models\Artikel::where('status', 'publish')->count();
        $draftArtikels = \App\Models\Artikel::where('status', 'draft')->count();
        $totalKomentars = \App\Models\Komentar::count();
        
        return view('dashboard', compact('totalArtikels', 'publishedArtikels', 'draftArtikels', 'totalKomentars'));
    })->name('dashboard');
    
    // Routes for all authenticated users
    Route::get('artikel', [App\Http\Controllers\ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('artikel/create', [App\Http\Controllers\ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('artikel', [App\Http\Controllers\ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('artikel/{artikel}/edit', [App\Http\Controllers\ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('artikel/{artikel}', [App\Http\Controllers\ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('artikel/{artikel}', [App\Http\Controllers\ArtikelController::class, 'destroy'])->name('artikel.destroy');
    
    // Routes only for guru and admin
    Route::middleware(['role:guru,admin'])->group(function () {
        Route::get('artikel/{artikel}/review', [App\Http\Controllers\ArtikelController::class, 'review'])->name('artikel.review');
        Route::post('artikel/{artikel}/approve', [App\Http\Controllers\ArtikelController::class, 'approve'])->name('artikel.approve');
        Route::post('artikel/{artikel}/reject', [App\Http\Controllers\ArtikelController::class, 'reject'])->name('artikel.reject');
        Route::post('artikel/{artikel}/revise', [App\Http\Controllers\ArtikelController::class, 'revise'])->name('artikel.revise');
        Route::resource('kategori', App\Http\Controllers\KategoriController::class);
        Route::get('laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/export/pdf', [App\Http\Controllers\LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
        Route::get('laporan/export/excel', [App\Http\Controllers\LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    });
    
    // Notifications
    Route::get('notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{notification}/mark-read', [App\Http\Controllers\NotificationController::class, 'markRead'])->name('notifications.markRead');
    Route::post('notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::delete('notifications/{notification}', [App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.destroy');
    
    Route::post('like/{id}', [App\Http\Controllers\LikeController::class, 'toggle'])->name('like.toggle');
    Route::post('komentar', [App\Http\Controllers\KomentarController::class, 'store'])->name('komentar.store');
    
    // Routes only for admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('user', App\Http\Controllers\UserController::class);
    });
});

// Storage route for serving files
Route::get('storage/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);
    if (file_exists($file)) {
        return response()->file($file);
    }
    abort(404);
})->where('path', '.*');

// Artikel show route (must be last to avoid conflicts)
Route::get('artikel/{artikel}', [App\Http\Controllers\ArtikelController::class, 'show'])->name('artikel.show');
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\ArticleReview;
use App\Notifications\ArticleApproved;
use App\Notifications\ArticleRejected;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        if (in_array(auth()->user()->role, ['guru', 'admin'])) {
            $artikels = Artikel::with(['user', 'kategori'])->get();
        } else {
            $artikels = Artikel::with(['user', 'kategori'])->where('id_user', auth()->id())->get();
        }
        return view('artikel.index', compact('artikels'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('artikel.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'id_kategori' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('foto')?->store('foto_artikel', 'public');

        Artikel::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => now(),
            'id_user' => auth()->id(),
            'id_kategori' => $request->id_kategori,
            'foto' => $path,
            'status' => 'draft',
        ]);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dikirim, menunggu persetujuan.');
    }

    public function show(Artikel $artikel)
    {
        $artikel->load(['user', 'kategori', 'likes', 'komentars.user']);
        
        // Limit content for unauthenticated users
        $isAuthenticated = auth()->check();
        if (!$isAuthenticated) {
            // Show only first 200 characters for non-authenticated users
            $artikel->isi_preview = substr(strip_tags($artikel->isi), 0, 200) . '...';
        }
        
        return view('artikel.show', compact('artikel', 'isAuthenticated'));
    }

    public function edit(Artikel $artikel)
    {
        $kategoris = Kategori::all();
        return view('artikel.edit', compact('artikel', 'kategoris'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'id_kategori' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'id_kategori' => $request->id_kategori,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_artikel', 'public');
        }

        $artikel->update($data);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diupdate.');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function review(Artikel $artikel)
    {
        return view('artikel.review', compact('artikel'));
    }

    public function approve(Request $request, Artikel $artikel)
    {
        $artikel->load('user');
        
        // Simpan review ke tabel terpisah
        $review = ArticleReview::create([
            'artikel_id' => $artikel->id,
            'reviewer_id' => auth()->id(),
            'author_id' => $artikel->id_user,
            'artikel_title' => $artikel->judul,
            'action' => 'approved',
            'notes' => $request->review_notes
        ]);
        
        $artikel->update([
            'status' => 'publish',
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
            'review_notes' => $request->review_notes
        ]);
        
        $artikel->user->notify(new ArticleApproved($artikel));
        
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil disetujui.');
    }

    public function reject(Request $request, Artikel $artikel)
    {
        $request->validate([
            'review_notes' => 'required|string|min:10'
        ]);

        $artikel->load('user');
        
        // Simpan review ke tabel terpisah
        $review = ArticleReview::create([
            'artikel_id' => $artikel->id,
            'reviewer_id' => auth()->id(),
            'author_id' => $artikel->id_user,
            'artikel_title' => $artikel->judul,
            'action' => 'rejected',
            'notes' => $request->review_notes
        ]);
        
        $artikel->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
            'review_notes' => $request->review_notes
        ]);

        $artikel->user->notify(new ArticleRejected($review));

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditolak.');
    }

    public function revise(Request $request, Artikel $artikel)
    {
        $request->validate([
            'review_notes' => 'required|string|min:10'
        ]);

        $artikel->load('user');
        
        // Simpan review ke tabel terpisah
        $review = ArticleReview::create([
            'artikel_id' => $artikel->id,
            'reviewer_id' => auth()->id(),
            'author_id' => $artikel->id_user,
            'artikel_title' => $artikel->judul,
            'action' => 'revision',
            'notes' => $request->review_notes
        ]);
        
        $artikel->update([
            'status' => 'draft',
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
            'review_notes' => $request->review_notes
        ]);

        $artikel->user->notify(new \App\Notifications\ArticleRevision($review));

        return redirect()->route('artikel.index')->with('success', 'Artikel dikembalikan untuk revisi.');
    }
}

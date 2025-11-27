<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');
        $kategori = $request->get('kategori');
        $tanggal = $request->get('tanggal');
        
        $artikels = Artikel::with(['user', 'kategori', 'likes', 'komentars'])
            ->where('status', 'publish');
            
        if ($query) {
            $artikels->where('judul', 'like', '%' . $query . '%');
        }
        
        if ($kategori) {
            $artikels->where('id_kategori', $kategori);
        }
        
        if ($tanggal) {
            $artikels->whereDate('created_at', $tanggal);
        }
        
        $artikels = $artikels->latest()->paginate(9);
        $kategoris = \App\Models\Kategori::all();
        
        return view('search.index', compact('artikels', 'kategoris', 'query', 'kategori', 'tanggal'));
    }
}
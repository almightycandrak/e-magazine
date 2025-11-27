<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArtikelExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('Y-m'));
        $kategori = $request->get('kategori');
        
        $artikels = Artikel::with(['user', 'kategori', 'likes', 'komentars'])
            ->where('status', 'publish');
            
        if ($bulan) {
            $artikels->whereYear('created_at', substr($bulan, 0, 4))
                    ->whereMonth('created_at', substr($bulan, 5, 2));
        }
        
        if ($kategori) {
            $artikels->where('id_kategori', $kategori);
        }
        
        $artikels = $artikels->latest()->get();
        $kategoris = Kategori::all();
        
        $stats = [
            'total_artikel' => $artikels->count(),
            'total_likes' => $artikels->sum(function($artikel) { return $artikel->likes->count(); }),
            'total_komentar' => $artikels->sum(function($artikel) { return $artikel->komentars->count(); }),
            'artikel_terpopuler' => $artikels->sortByDesc(function($artikel) { return $artikel->likes->count(); })->first()
        ];
        
        return view('laporan.index', compact('artikels', 'kategoris', 'bulan', 'kategori', 'stats'));
    }
    
    public function exportPdf(Request $request)
    {
        $bulan = $request->get('bulan', date('Y-m'));
        $kategori = $request->get('kategori');
        
        $artikels = Artikel::with(['user', 'kategori', 'likes', 'komentars'])
            ->where('status', 'publish');
            
        if ($bulan) {
            $artikels->whereYear('created_at', substr($bulan, 0, 4))
                    ->whereMonth('created_at', substr($bulan, 5, 2));
        }
        
        if ($kategori) {
            $artikels->where('id_kategori', $kategori);
        }
        
        $artikels = $artikels->latest()->get();
        $kategoriName = $kategori ? Kategori::find($kategori)->nama : 'Semua Kategori';
        
        $pdf = Pdf::loadView('laporan.pdf', compact('artikels', 'bulan', 'kategoriName'));
        return $pdf->download('laporan-artikel-' . $bulan . '.pdf');
    }
    
    public function exportExcel(Request $request)
    {
        $bulan = $request->get('bulan', date('Y-m'));
        $kategori = $request->get('kategori');
        
        return Excel::download(new ArtikelExport($bulan, $kategori), 'laporan-artikel-' . $bulan . '.xlsx');
    }
}
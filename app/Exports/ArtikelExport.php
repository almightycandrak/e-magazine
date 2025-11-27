<?php

namespace App\Exports;

use App\Models\Artikel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ArtikelExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bulan;
    protected $kategori;

    public function __construct($bulan, $kategori = null)
    {
        $this->bulan = $bulan;
        $this->kategori = $kategori;
    }

    public function collection()
    {
        $artikels = Artikel::with(['user', 'kategori', 'likes', 'komentars'])
            ->where('status', 'publish');
            
        if ($this->bulan) {
            $artikels->whereYear('created_at', substr($this->bulan, 0, 4))
                    ->whereMonth('created_at', substr($this->bulan, 5, 2));
        }
        
        if ($this->kategori) {
            $artikels->where('id_kategori', $this->kategori);
        }
        
        return $artikels->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul',
            'Penulis',
            'Kategori',
            'Tanggal Publish',
            'Jumlah Like',
            'Jumlah Komentar',
            'Status'
        ];
    }

    public function map($artikel): array
    {
        static $no = 1;
        return [
            $no++,
            $artikel->judul,
            $artikel->user->name,
            $artikel->kategori->nama ?? 'Umum',
            $artikel->created_at->format('d/m/Y'),
            $artikel->likes->count(),
            $artikel->komentars->count(),
            ucfirst($artikel->status)
        ];
    }
}
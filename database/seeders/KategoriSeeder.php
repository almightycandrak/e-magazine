<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Pendidikan', 'deskripsi' => 'Artikel tentang kegiatan pembelajaran dan pendidikan'],
            ['nama' => 'Prestasi', 'deskripsi' => 'Prestasi siswa dan sekolah'],
            ['nama' => 'Kegiatan', 'deskripsi' => 'Kegiatan sekolah dan ekstrakurikuler'],
            ['nama' => 'Pengumuman', 'deskripsi' => 'Pengumuman penting sekolah'],
            ['nama' => 'Umum', 'deskripsi' => 'Artikel umum lainnya'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
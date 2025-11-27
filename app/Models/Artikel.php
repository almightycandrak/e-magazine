<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $fillable = [
        'judul', 'isi', 'tanggal', 'id_user', 'id_kategori', 'foto', 'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_artikel');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_artikel');
    }
}
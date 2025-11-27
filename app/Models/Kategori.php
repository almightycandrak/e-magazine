<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama', 'deskripsi'];

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'id_kategori');
    }
}
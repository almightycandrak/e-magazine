<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = ['isi', 'id_artikel', 'id_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'id_artikel');
    }
}

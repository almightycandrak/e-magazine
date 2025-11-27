<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['id_user', 'id_artikel'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'id_artikel');
    }
}

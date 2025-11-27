<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleReview extends Model
{
    protected $fillable = [
        'artikel_id',
        'reviewer_id', 
        'author_id',
        'artikel_title',
        'action',
        'notes'
    ];

    public function artikel(): BelongsTo
    {
        return $this->belongsTo(Artikel::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

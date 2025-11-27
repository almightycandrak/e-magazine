<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\ArticleReview;

class ArticleRevision extends Notification
{
    use Queueable;

    protected $review;

    public function __construct(ArticleReview $review)
    {
        $this->review = $review;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $catatan = $this->review->notes ?: 'Tidak ada catatan yang diberikan';
        
        return [
            'title' => '📝 Artikel Perlu Revisi',
            'message' => "Artikel '{$this->review->artikel_title}' memerlukan perbaikan.\n\n📋 Catatan Reviewer:\n{$catatan}\n\n💡 Silakan edit artikel Anda sesuai dengan catatan di atas.",
            'artikel_id' => $this->review->artikel_id,
            'type' => 'article_revision',
            'review_notes' => $catatan,
            'artikel_title' => $this->review->artikel_title,
            'reviewer_name' => $this->review->reviewer->name ?? 'Admin'
        ];
    }
}
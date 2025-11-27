<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\ArticleReview;

class ArticleRejected extends Notification
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
        $alasan = $this->review->notes ?: 'Tidak ada alasan yang diberikan';
        
        return [
            'title' => '❌ Artikel Ditolak',
            'message' => "Artikel '{$this->review->artikel_title}' telah ditolak.\n\n📝 Alasan Penolakan:\n{$alasan}\n\n💡 Anda dapat membuat artikel baru atau memperbaiki artikel ini.",
            'artikel_id' => $this->review->artikel_id,
            'type' => 'article_rejected',
            'review_notes' => $alasan,
            'artikel_title' => $this->review->artikel_title,
            'reviewer_name' => $this->review->reviewer->name ?? 'Admin'
        ];
    }
}
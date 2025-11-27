<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Artikel;

class ArticleApproved extends Notification
{
    use Queueable;

    public function __construct(public Artikel $artikel)
    {
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Artikel Disetujui',
            'message' => "Artikel '{$this->artikel->judul}' telah disetujui dan dipublikasikan.",
            'artikel_id' => $this->artikel->id,
        ];
    }
}
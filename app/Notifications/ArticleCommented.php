<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Artikel;
use App\Models\User;

class ArticleCommented extends Notification
{
    use Queueable;

    public function __construct(public Artikel $artikel, public User $commenter, public string $comment)
    {
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Komentar Baru',
            'message' => "{$this->commenter->name} berkomentar di artikel '{$this->artikel->judul}': {$this->comment}",
            'artikel_id' => $this->artikel->id,
            'commenter_id' => $this->commenter->id,
        ];
    }
}
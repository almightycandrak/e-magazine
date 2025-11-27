<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Artikel;
use App\Models\User;

class ArticleLiked extends Notification
{
    use Queueable;

    public function __construct(public Artikel $artikel, public User $liker)
    {
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Artikel Disukai',
            'message' => "{$this->liker->name} menyukai artikel '{$this->artikel->judul}'.",
            'artikel_id' => $this->artikel->id,
            'liker_id' => $this->liker->id,
        ];
    }
}
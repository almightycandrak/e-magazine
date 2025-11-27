<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Artikel;
use App\Notifications\ArticleLiked;

class LikeController extends Controller
{
    public function toggle(Request $request, $artikelId)
    {
        try {
            $artikel = Artikel::findOrFail($artikelId);
            $userId = auth()->id();
            
            $like = Like::where('id_artikel', $artikelId)
                       ->where('id_user', $userId)
                       ->first();
            
            if ($like) {
                $like->delete();
                $liked = false;
            } else {
                Like::create([
                    'id_artikel' => $artikelId,
                    'id_user' => $userId
                ]);
                $liked = true;
                
                // Send notification to article author (if not self-like)
                if ($artikel->id_user != $userId) {
                    $artikel->load('user');
                    $artikel->user->notify(new ArticleLiked($artikel, auth()->user()));
                }
            }
            
            $total = Like::where('id_artikel', $artikelId)->count();
            
            return response()->json([
                'liked' => $liked,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
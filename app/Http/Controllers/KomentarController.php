<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Artikel;
use App\Notifications\ArticleCommented;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'isi' => 'required|max:500',
                'id_artikel' => 'required|exists:artikels,id'
            ]);
            
            $artikel = Artikel::findOrFail($request->id_artikel);
            
            $komentar = Komentar::create([
                'isi' => $request->isi,
                'id_artikel' => $request->id_artikel,
                'id_user' => auth()->id()
            ]);
            
            // Send notification to article author (if not self-comment)
            if ($artikel->id_user != auth()->id()) {
                $artikel->load('user');
                $artikel->user->notify(new ArticleCommented($artikel, auth()->user(), $request->isi));
            }
            
            return response()->json([
                'success' => true,
                'komentar' => [
                    'user_name' => auth()->user()->name,
                    'user_role' => ucfirst(auth()->user()->role),
                    'isi' => $komentar->isi,
                    'created_at' => $komentar->created_at->diffForHumans()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
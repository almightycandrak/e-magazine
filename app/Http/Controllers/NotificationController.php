<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function markRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi ditandai sebagai dibaca.');
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();
        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}
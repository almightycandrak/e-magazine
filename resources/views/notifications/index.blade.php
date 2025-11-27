@extends('layouts.app')

@section('content')
<div class="notification-universe">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Floating Header -->
                <div class="floating-header">
                    <div class="header-content">
                        <div class="back-btn-container">
                            <a href="{{ route('dashboard') }}" class="glass-btn back-btn">
                                <i class="fas fa-arrow-left"></i>
                                <span>Kembali</span>
                            </a>
                        </div>
                        <div class="title-section">
                            <div class="notification-icon-large">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="title-text">
                                <h1 class="page-title">Notifikasi</h1>
                                <p class="page-subtitle">Kelola semua notifikasi Anda</p>
                            </div>
                        </div>
                        @if($notifications->count() > 0)
                            <div class="action-btn-container">
                                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="glass-btn mark-all-btn">
                                        <i class="fas fa-check-double"></i>
                                        <span>Tandai Semua Dibaca</span>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                @if(session('success'))
                    <div class="success-toast">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Notifications List -->
                <div class="notifications-container">
                    @forelse($notifications as $notification)
                        <div class="notification-card {{ $notification->read_at ? 'read' : 'unread' }}">
                            <div class="notification-indicator">
                                @if(!$notification->read_at)
                                    <div class="unread-dot"></div>
                                @else
                                    <div class="read-check">
                                        <i class="fas fa-check"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="notification-content">
                                <div class="notification-header">
                                    <h6 class="notification-title">
                                        {{ $notification->data['title'] ?? 'Notifikasi' }}
                                    </h6>
                                    <div class="notification-actions">
                                        @if(!$notification->read_at)
                                            <form action="{{ route('notifications.markRead', $notification->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="action-btn-simple read-btn" title="Tandai Dibaca">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn-simple delete-btn" onclick="return confirm('Hapus notifikasi ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="notification-message">
                                    @if(isset($notification->data['type']) && $notification->data['type'] === 'article_revision')
                                        <div class="revision-details">
                                            <p><strong>Artikel:</strong> {{ $notification->data['artikel_title'] ?? 'Tidak diketahui' }}</p>
                                            <p><strong>Reviewer:</strong> {{ $notification->data['reviewer_name'] ?? 'Admin' }}</p>
                                            <div class="review-notes">
                                                <strong>📋 Catatan Reviewer:</strong>
                                                <div class="notes-content">
                                                    {{ $notification->data['review_notes'] ?? 'Tidak ada catatan' }}
                                                </div>
                                            </div>
                                            <p class="revision-instruction">
                                                💡 <em>Silakan edit artikel Anda sesuai dengan catatan di atas.</em>
                                            </p>
                                        </div>
                                    @elseif(isset($notification->data['type']) && $notification->data['type'] === 'article_rejected')
                                        <div class="rejection-details">
                                            <p><strong>Artikel:</strong> {{ $notification->data['artikel_title'] ?? 'Tidak diketahui' }}</p>
                                            <p><strong>Reviewer:</strong> {{ $notification->data['reviewer_name'] ?? 'Admin' }}</p>
                                            <div class="review-notes">
                                                <strong>📝 Alasan Penolakan:</strong>
                                                <div class="notes-content rejection">
                                                    {{ $notification->data['review_notes'] ?? 'Tidak ada alasan' }}
                                                </div>
                                            </div>
                                            <p class="rejection-instruction">
                                                💡 <em>Anda dapat membuat artikel baru atau memperbaiki artikel ini.</em>
                                            </p>
                                        </div>
                                    @else
                                        <p>{{ $notification->data['message'] ?? 'Pesan notifikasi' }}</p>
                                    @endif
                                </div>
                                <div class="notification-time">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-bell-slash"></i>
                            </div>
                            <h5 class="empty-title">Tidak ada notifikasi</h5>
                            <p class="empty-subtitle">Notifikasi akan muncul di sini ketika ada aktivitas baru</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.notification-universe {
    padding: 4rem 0 2rem 0;
}

.floating-header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.title-section {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex: 1;
}

.notification-icon-large {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 8px 25px rgba(25, 159, 177, 0.3);
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-subtitle {
    color: #64748b;
    margin: 0;
    font-size: 1rem;
}

.glass-btn {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 15px;
    padding: 0.75rem 1.5rem;
    color: #0D5C75;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.glass-btn:hover {
    background: rgba(255, 255, 255, 1);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    color: #0D5C75;
}

.mark-all-btn {
    background: linear-gradient(135deg, #199FB1, #0D5C75);
    color: white;
    border: none;
}

.mark-all-btn:hover {
    background: linear-gradient(135deg, #0D5C75, #199FB1);
    color: white;
}

.success-toast {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 15px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    animation: slideInDown 0.5s ease;
}

.notifications-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.notification-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 1.5rem;
    display: flex;
    gap: 1rem;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.notification-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.notification-card.unread {
    border-left: 4px solid #199FB1;
    background: rgba(25, 159, 177, 0.05);
}

.notification-indicator {
    display: flex;
    align-items: flex-start;
    padding-top: 0.25rem;
}

.unread-dot {
    width: 12px;
    height: 12px;
    background: #199FB1;
    border-radius: 50%;
    animation: pulse 2s infinite;
    box-shadow: 0 0 10px rgba(25, 159, 177, 0.5);
}

.read-check {
    width: 12px;
    height: 12px;
    background: #10b981;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.6rem;
}

.notification-content {
    flex: 1;
}

.notification-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.5rem;
}

.notification-title {
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    font-size: 1.1rem;
}

.notification-message {
    color: #64748b;
    margin: 0.5rem 0;
    line-height: 1.5;
}

.revision-details {
    background: linear-gradient(135deg, rgba(255, 248, 220, 0.95), rgba(254, 243, 199, 0.9));
    border: 1px solid rgba(245, 158, 11, 0.2);
    border-left: 5px solid #f59e0b;
    padding: 1.5rem;
    border-radius: 15px;
    margin: 1rem 0;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.1);
    backdrop-filter: blur(10px);
}

.revision-details p {
    margin: 0.75rem 0;
    color: #92400e;
    font-weight: 500;
}

.revision-details p strong {
    color: #78350f;
    font-weight: 600;
}

.review-notes {
    margin: 1.25rem 0;
}

.review-notes strong {
    color: #78350f;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    font-size: 1rem;
    font-weight: 600;
}

.notes-content {
    background: rgba(255, 255, 255, 0.95);
    padding: 1rem;
    border-radius: 10px;
    border: 2px solid rgba(245, 158, 11, 0.2);
    font-style: normal;
    color: #451a03;
    white-space: pre-wrap;
    line-height: 1.6;
    font-weight: 500;
    box-shadow: inset 0 2px 8px rgba(245, 158, 11, 0.05);
}

.revision-instruction {
    color: #065f46;
    font-size: 0.95rem;
    margin-top: 1.25rem;
    padding: 0.75rem 1rem;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(5, 150, 105, 0.1));
    border-radius: 10px;
    border: 1px solid rgba(16, 185, 129, 0.2);
    font-weight: 500;
}

.rejection-details {
    background: linear-gradient(135deg, rgba(254, 242, 242, 0.95), rgba(252, 231, 243, 0.9));
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-left: 5px solid #ef4444;
    padding: 1.5rem;
    border-radius: 15px;
    margin: 1rem 0;
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.1);
    backdrop-filter: blur(10px);
}

.rejection-details p {
    margin: 0.75rem 0;
    color: #991b1b;
    font-weight: 500;
}

.rejection-details p strong {
    color: #7f1d1d;
    font-weight: 600;
}

.notes-content.rejection {
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid rgba(239, 68, 68, 0.2);
    color: #7f1d1d;
    box-shadow: inset 0 2px 8px rgba(239, 68, 68, 0.05);
}

.rejection-instruction {
    color: #7f1d1d;
    font-size: 0.95rem;
    margin-top: 1.25rem;
    padding: 0.75rem 1rem;
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.1));
    border-radius: 10px;
    border: 1px solid rgba(239, 68, 68, 0.2);
    font-weight: 500;
}

.notification-time {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #94a3b8;
    font-size: 0.9rem;
}

.notification-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.action-btn-simple {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(148, 163, 184, 0.3);
    color: #64748b;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.read-btn:hover {
    background: rgba(16, 185, 129, 0.1);
    border-color: #10b981;
    color: #10b981;
    transform: scale(1.05);
}

.delete-btn:hover {
    background: rgba(239, 68, 68, 0.1);
    border-color: #ef4444;
    color: #ef4444;
    transform: scale(1.05);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: #94a3b8;
    font-size: 2rem;
}

.empty-title {
    color: #1e293b;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.empty-subtitle {
    color: #64748b;
    margin: 0;
}

.pagination-container {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(25, 159, 177, 0.7);
    }
    70% {
        transform: scale(1.1);
        box-shadow: 0 0 0 10px rgba(25, 159, 177, 0);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(25, 159, 177, 0);
    }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
    }
    
    .title-section {
        justify-content: center;
    }
    
    .notification-card {
        padding: 1rem;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
}
</style>
@endsection
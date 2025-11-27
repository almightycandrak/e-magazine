<nav class="navbar navbar-expand-lg modern-navbar fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-sekolah.jpg') }}" alt="Logo" class="navbar-logo">
            <div class="brand-text">
                <span>E-Magazine</span>
                <small>Bakti Nusantara 666</small>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('search') }}">
                        <i class="fas fa-search"></i> Pencarian
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('artikel.index') }}">
                            <i class="fas fa-newspaper"></i> Artikel
                        </a>
                    </li>
                    @if(in_array(Auth::user()->role, ['guru', 'admin']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kategori.index') }}">
                                <i class="fas fa-tags"></i> Kategori
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="navbar-nav ms-auto">
                @auth
                    <div class="d-flex align-items-center gap-3">
                        <a class="notification-btn" href="{{ route('notifications.index') }}">
                            <div class="notification-icon">
                                <i class="fas fa-bell"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="notification-dot"></span>
                                @endif
                            </div>
                        </a>
                        <div class="user-profile">
                            <div class="profile-container">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <span class="user-name">{{ Auth::user()->name }}</span>
                                    <small class="user-role">{{ ucfirst(Auth::user()->role) }}</small>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="auth-buttons">
                        <a href="{{ route('login') }}" class="btn auth-btn login-btn">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Login</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn auth-btn register-btn">
                            <i class="fas fa-user-plus"></i>
                            <span>Daftar</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
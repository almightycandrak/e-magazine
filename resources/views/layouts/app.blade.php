<!DOCTYPE html>
<html lang="id" style="margin: 0; padding: 0;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Magazine</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ocean-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/typography.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contrast-fix.css') }}" rel="stylesheet">
    <link href="{{ asset('css/kategori-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/kategori-modern.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user-modern.css') }}" rel="stylesheet">
    <link href="{{ asset('css/laporan-modern.css') }}" rel="stylesheet">
    <link href="{{ asset('css/artikel-show-modern.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout-fix.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/school-theme-effects.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modern-navbar.css') }}" rel="stylesheet">
    <style>
        body {
            padding-top: 120px;
        }

        .fixed-top {
            position: fixed !important;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
        }



        .page-header {
            margin-top: 40px !important;
        }

        /* Navbar Waves */
        .navbar-waves {
            position: relative;
            top: -1px;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            z-index: 1;
        }

        .navbar-waves svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 40px;
        }

        .navbar-waves .shape-fill {
            fill: #f8fafc;
        }

        /* Card animations - Footer Style */
        .card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(13, 92, 117, 0.15);
            border-radius: 20px;
            overflow: hidden;
            background: white;
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(25, 159, 177, 0.03));
            border-radius: 20px;
            z-index: -1;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(25, 159, 177, 0.25);
        }
        
        .card-body {
            background: white;
        }
        
        .modern-card {
            background: white;
        }
        
        .info-card {
            background: white;
        }

        .card-img-top {
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        /* Button animations - Footer Style */
        .btn {
            transition: all 0.3s ease;
            border-radius: 15px;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }
        
        .btn:not(.btn-outline-secondary):not(.btn-outline-danger):not(.btn-light)::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn:not(.btn-outline-secondary):not(.btn-outline-danger):not(.btn-light):hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn:active {
            transform: translateY(-1px) scale(0.98);
        }

        /* Form animations - Footer Style */
        .form-control, .form-select {
            transition: all 0.3s ease;
            border-radius: 15px;
            border: 2px solid #e2e8f0;
            padding: 12px 16px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #199FB1;
            box-shadow: 0 0 0 3px rgba(25, 159, 177, 0.2);
            transform: translateY(-2px);
        }

        /* Alert animations - Footer Style */
        .alert {
            border-radius: 15px;
            border: none;
            animation: slideInDown 0.5s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .alert-info {
            background: linear-gradient(135deg, rgba(165, 209, 225, 0.2) 0%, rgba(25, 159, 177, 0.1) 100%);
            border: 1px solid #A5D1E1;
            color: #0D5C75;
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(22, 163, 74, 0.1) 100%);
            border: 1px solid #22c55e;
            color: #15803d;
        }
        
        .alert-warning {
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.2) 0%, rgba(245, 158, 11, 0.1) 100%);
            border: 1px solid #fbbf24;
            color: #d97706;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.1) 100%);
            border: 1px solid #ef4444;
            color: #dc2626;
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

        /* Page content animation */
        .container {
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation untuk cards */
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }

        /* Dropdown Styles - Footer Style */
        .modern-dropdown {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(13, 92, 117, 0.15);
            padding: 15px 0;
            margin-top: 10px;
            background: white;
        }

        .dropdown-item {
            padding: 12px 20px;
            border-radius: 15px;
            margin: 3px 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }
        
        .dropdown-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .dropdown-item:hover::before {
            left: 100%;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
            color: white;
            transform: translateX(8px);
        }

        .dropdown-item i {
            width: 14px;
            text-align: center;
            font-size: 13px;
        }

        /* User Dropdown */
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px;
            transition: all 0.3s ease;
        }

        .user-dropdown:hover {
            transform: translateY(-1px);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        .user-name {
            font-weight: 600;
            color: white;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white !important;
            text-decoration: none;
        }

        .user-dropdown:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white !important;
        }

        /* Navbar Animations */
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::before {
            width: 80%;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 20px;
                gap: 8px;
            }
            
            .navbar-logo {
                width: 36px;
                height: 36px;
            }
            
            .nav-link {
                padding: 8px 12px !important;
                font-size: 13px;
            }

            .user-dropdown {
                flex-direction: column;
                text-align: center;
            }

            .modern-dropdown {
                position: static;
                box-shadow: none;
                background: rgba(248, 250, 252, 0.95);
                margin: 10px;
                border-radius: 10px;
            }
        }
    </style>
</head>
<body>


    @include('partials.navbar')
    
    <!-- Navbar Waves -->
    <div class="navbar-waves">
        <svg viewBox="0 0 1200 80" preserveAspectRatio="none">
            <defs>
                <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:rgba(248,250,252,0.8);stop-opacity:1" />
                    <stop offset="50%" style="stop-color:rgba(248,250,252,1);stop-opacity:1" />
                    <stop offset="100%" style="stop-color:rgba(248,250,252,0.8);stop-opacity:1" />
                </linearGradient>
            </defs>
            <path d="M0,0V30C150,50 350,10 600,25C850,40 1050,15 1200,35V0Z" fill="url(#waveGradient)"></path>
            <path d="M0,0V20C200,35 400,5 600,20C800,35 1000,10 1200,25V0Z" fill="rgba(248,250,252,0.6)"></path>
        </svg>
    </div>
    
    <div class="container container-main">
        @yield('content')
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/icon-optimizer.js') }}"></script>
    <script>
        // Page transition animations
        document.addEventListener('DOMContentLoaded', function() {
            // Fade in animation untuk halaman
            document.body.style.opacity = '0';
            document.body.style.transform = 'translateY(20px)';
            document.body.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                document.body.style.opacity = '1';
                document.body.style.transform = 'translateY(0)';
            }, 100);

            // Animasi untuk cards
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 200 + (index * 100));
            });

            // Animasi untuk form elements
            const formElements = document.querySelectorAll('.form-control, .form-select, .btn');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateX(-20px)';
                element.style.transition = 'all 0.5s ease';
                
                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateX(0)';
                }, 300 + (index * 50));
            });
        });

        // Smooth page transitions saat navigasi (disabled untuk mencegah white screen)
        // document.addEventListener('click', function(e) {
        //     const link = e.target.closest('a');
        //     if (link && link.href && !link.href.includes('#') && !link.target && link.hostname === window.location.hostname) {
        //         e.preventDefault();
        //         
        //         // Fade out animation
        //         document.body.style.transition = 'all 0.3s ease';
        //         document.body.style.opacity = '0';
        //         document.body.style.transform = 'translateY(-20px)';
        //         
        //         setTimeout(() => {
        //             window.location.href = link.href;
        //         }, 300);
        //     }
        // });

        // Enhanced navbar scroll effects
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.modern-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Create floating particles
        function createParticles() {
            const navbar = document.querySelector('.modern-navbar');
            const particlesContainer = document.createElement('div');
            particlesContainer.className = 'navbar-particles';
            navbar.appendChild(particlesContainer);

            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Initialize particles
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            
            // Add active state to current page nav link
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
            
            // Smooth hover effects for nav items
            const navItems = document.querySelectorAll('.navbar-nav .nav-item');
            navItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Notification bell animation
            const notificationBtn = document.querySelector('.notification-btn');
            if (notificationBtn) {
                notificationBtn.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('i');
                    icon.style.animation = 'swing 0.6s ease-in-out';
                });
                
                notificationBtn.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('i');
                    icon.style.animation = '';
                });
            }
        });
        
        // Add swing animation for notification bell
        const swingStyle = document.createElement('style');
        swingStyle.textContent = `
            @keyframes swing {
                0%, 100% { transform: rotate(0deg); }
                25% { transform: rotate(15deg); }
                75% { transform: rotate(-15deg); }
            }
        `;
        document.head.appendChild(swingStyle);

        // Animasi hover untuk brand
        document.querySelector('.navbar-brand').addEventListener('mouseenter', function() {
            this.querySelector('i').style.transform = 'rotate(360deg)';
            this.querySelector('i').style.transition = 'transform 0.6s ease';
        });

        document.querySelector('.navbar-brand').addEventListener('mouseleave', function() {
            this.querySelector('i').style.transform = 'rotate(0deg)';
        });

        // Hover effects untuk cards
        document.addEventListener('mouseover', function(e) {
            if (e.target.closest('.card')) {
                const card = e.target.closest('.card');
                card.style.transform = 'translateY(-5px) scale(1.02)';
                card.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.15)';
                card.style.transition = 'all 0.3s ease';
            }
        });

        document.addEventListener('mouseout', function(e) {
            if (e.target.closest('.card')) {
                const card = e.target.closest('.card');
                card.style.transform = 'translateY(0) scale(1)';
                card.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            }
        });

        // Button click animations
        document.addEventListener('click', function(e) {
            if (e.target.matches('.btn')) {
                const btn = e.target;
                btn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    btn.style.transform = 'scale(1)';
                }, 150);
            }
        });
    </script>
</body>
</html>
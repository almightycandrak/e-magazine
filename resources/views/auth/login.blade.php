<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Magazine</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            display: flex;
            background: white;
            border-radius: 25px;
            box-shadow: 0 8px 25px rgba(13, 92, 117, 0.25);
            overflow: hidden;
            width: 900px;
            min-height: 600px;
            animation: slideIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(10px);
            position: relative;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(25, 159, 177, 0.03));
            border-radius: 25px;
            z-index: -1;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .left-section {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            animation: fadeInLeft 1s ease 0.3s both;
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .right-section {
            flex: 1;
            background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
            animation: fadeInRight 1s ease 0.5s both;
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .right-section::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .right-section::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -75px;
            left: -75px;
        }

        .form-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .form-header h2 {
            font-size: 32px;
            font-weight: 800;
            color: #1a202c;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-header p {
            color: #64748b;
            font-size: 16px;
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 18px 50px 18px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            font-size: 16px;
            background: #ffffff;
            color: #1a202c;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform: translateY(0);
            font-weight: 500;
        }

        .form-control:focus {
            outline: none;
            border-color: #199FB1;
            background: white;
            transform: translateY(-3px);
            box-shadow: 0 0 0 3px rgba(25, 159, 177, 0.2);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 16px;
        }

        .btn-login {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #199FB1 0%, #0D5C75 100%);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transform: translateY(0);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0D5C75 0%, #199FB1 100%);
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(25, 159, 177, 0.4);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
        }

        .forgot-password a {
            color: #0D5C75;
            text-decoration: none;
            font-size: 14px;
        }

        .welcome-section h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .welcome-section p {
            font-size: 16px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .signup-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 15px 35px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform: translateY(0);
            display: inline-block;
            position: relative;
            overflow: hidden;
        }
        
        .signup-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .signup-btn:hover::before {
            left: 100%;
        }

        .signup-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .remember-me input[type="checkbox"] {
            margin: 0;
            accent-color: #0D5C75;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="left-section">
            <div class="form-header">
                <h2>Selamat Datang</h2>
                <p>Masuk ke akun E-Magazine Anda</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#">Lupa Password?</a>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    MASUK
                </button>
            </form>
        </div>

        <div class="right-section">
            <div class="welcome-section">
                <h1>E-MAGAZINE</h1>
                <p>Platform digital untuk berbagi artikel dan informasi sekolah</p>
                <div style="margin-bottom: 20px;">
                    <i class="fas fa-newspaper" style="font-size: 48px; margin-bottom: 20px; opacity: 0.8;"></i>
                </div>
                <p style="font-size: 14px; margin-bottom: 30px;">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="signup-btn">DAFTAR SEKARANG</a>
            </div>
        </div>
    </div>
</body>
</html>
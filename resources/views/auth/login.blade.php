<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - {{ config('puskesmas.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #047857;
            --primary-dark: #065f46;
            --primary-darker: #022c22;
            --accent-color: #ffcc00;
            --teal: #0f766e;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
            --bg-light: #f8fafc;
            --mint: #ecfdf5;
            --danger: #dc2626;
            --radius: 20px;
            --radius-sm: 12px;
            --shadow-lg: 0 25px 50px rgba(4, 120, 87, 0.25);
            --ease: cubic-bezier(.22, 1, .36, 1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        body {
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #ecfdf5 0%, #f0f9ff 50%, #f8fafc 100%);
        }

        /* Left Panel - Branding */
        .branding-panel {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 50%, var(--primary-darker) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        .branding-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 60%);
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .branding-content {
            text-align: center;
            color: #fff;
            z-index: 1;
            max-width: 400px;
        }

        .brand-logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 24px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .brand-logo img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .brand-title {
            font-family: 'League Spartan', sans-serif;
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .brand-subtitle {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 32px;
        }

        .brand-features {
            list-style: none;
            text-align: left;
        }

        .brand-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand-features li:last-child {
            border-bottom: none;
        }

        .brand-features li i {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-color);
        }

        /* Decorative shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: var(--accent-color);
            top: -100px;
            right: -100px;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: #fff;
            bottom: -50px;
            left: -50px;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: var(--teal);
            bottom: 20%;
            right: -50px;
        }

        /* Right Panel - Login Form */
        .form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: var(--radius);
            padding: 40px;
            box-shadow: var(--shadow-lg);
            animation: slideUp 0.6s var(--ease);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header .icon {
            width: 64px;
            height: 64px;
            background: var(--mint);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: var(--primary-color);
            font-size: 28px;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 4px;
        }

        .login-header p {
            font-size: 14px;
            color: var(--muted);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 16px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid var(--line);
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-family: inherit;
            transition: all 0.25s var(--ease);
            background: #fff;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(4, 120, 87, 0.1);
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 13px;
            color: var(--muted);
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 13px;
            color: var(--primary-color);
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-color), var(--teal));
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s var(--ease);
            box-shadow: 0 4px 15px rgba(4, 120, 87, 0.35);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(4, 120, 87, 0.45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
            color: var(--muted);
            font-size: 12px;
        }

        .login-divider::before,
        .login-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .back-to-site {
            text-align: center;
            margin-top: 24px;
        }

        .back-to-site a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 13px;
            transition: color 0.2s;
        }

        .back-to-site a:hover {
            color: var(--primary-color);
        }

        /* Error Message */
        .error-message {
            background: rgba(220, 38, 38, 0.08);
            color: var(--danger);
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .error-message i {
            font-size: 16px;
        }

        /* Footer */
        .login-footer {
            margin-top: 32px;
            text-align: center;
            font-size: 12px;
            color: var(--muted);
        }

        .login-footer a {
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 992px) {
            body {
                flex-direction: column;
            }

            .branding-panel {
                padding: 32px;
                min-height: auto;
            }

            .brand-logo {
                width: 80px;
                height: 80px;
            }

            .brand-logo img {
                width: 55px;
                height: 55px;
            }

            .brand-title {
                font-size: 24px;
            }

            .brand-features {
                display: none;
            }

            .form-panel {
                padding: 32px 24px;
            }

            .login-card {
                padding: 32px 24px;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 24px 20px;
            }

            .login-header .icon {
                width: 56px;
                height: 56px;
                font-size: 24px;
            }

            .login-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Left Branding Panel -->
    <div class="branding-panel">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>

        <div class="branding-content">
            <div class="brand-logo">
                <img src="https://www.freepnglogos.com/uploads/logo-puskesmas-png/logo-puskesmas-lambang-baru-puskesmas-puskesmas-makale-3.png" alt="Logo Puskesmas">
            </div>
            <h2 class="brand-title">Puskesmas<br>Madukara 1</h2>
            <p class="brand-subtitle">Kabupaten Banjarnegara</p>

            <ul class="brand-features">
                <li>
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Panel keamanan terenkripsi untuk melindungi data</span>
                </li>
                <li>
                    <i class="fa-solid fa-pen-nib"></i>
                    <span>Kelola konten website dengan mudah</span>
                </li>
                <li>
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Pantau statistik dan kunjungan real-time</span>
                </li>
                <li>
                    <i class="fa-solid fa-image"></i>
                    <span>Upload gambar dan galeri dokumentasi</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Right Login Form Panel -->
    <div class="form-panel">
        <div class="login-card">
            <div class="login-header">
                <div class="icon">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <h1>Login Admin</h1>
                <p>Masuk ke panel pengelolaan {{ config('puskesmas.name') }}</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Email atau password yang Anda masukkan salah.</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-input"
                               placeholder="admin@puskesmas.go.id"
                               required
                               autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-key"></i>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-input"
                               placeholder="Masukkan password"
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fa-regular fa-eye" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="remember" value="1" id="remember">
                        <span>Ingat saya</span>
                    </label>
                    {{-- <a href="#" class="forgot-link">Lupa password?</a> --}}
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Masuk</span>
                </button>
            </form>

            <div class="back-to-site">
                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Website
                </a>
            </div>

            <div class="login-footer">
                &copy; {{ date('Y') }} {{ config('puskesmas.name') }}. All Rights Reserved.
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIGAP ALAM</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Premium CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/premium-style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #047857 0%, #059669 25%, #10b981 50%, #0284c7 75%, #0369a1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        body::before,
        body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            animation: float 20s ease-in-out infinite;
        }

        body::before {
            top: -10%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0) 70%);
        }

        body::after {
            bottom: -10%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.6) 0%, rgba(255, 255, 255, 0) 70%);
            animation-delay: -10s;
        }

        .login-container {
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 2;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 3rem 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-icon-large {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #059669 0%, #10b981 50%, #0284c7 100%);
            border-radius: 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 2rem;
            box-shadow: 0 10px 30px -5px rgba(5, 150, 105, 0.3);
            margin-bottom: 1rem;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: var(--gray-600);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
            font-size: 0.9375rem;
        }

        .input-group-custom {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            pointer-events: none;
            z-index: 5;
        }

        .form-control-custom {
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid var(--gray-200);
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control-custom:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
            outline: none;
        }

        .form-control-custom:focus+.input-icon {
            color: var(--primary-green);
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            padding: 0.25rem;
            z-index: 5;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--gray-600);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9375rem;
        }

        .form-check-custom {
            display: flex;
            align-items: center;
        }

        .form-check-custom input {
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
            cursor: pointer;
            accent-color: var(--primary-green);
        }

        .form-check-custom label {
            margin: 0;
            cursor: pointer;
            color: var(--gray-700);
            user-select: none;
        }

        .forgot-link {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--primary-green-dark);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #059669 0%, #10b981 50%, #0284c7 100%);
            border: none;
            border-radius: 0.75rem;
            color: white;
            font-weight: 700;
            font-size: 1.0625rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px -5px rgba(5, 150, 105, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(5, 150, 105, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--gray-500);
            margin: 1.5rem 0;
            font-size: 0.875rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--gray-200);
        }

        .divider span {
            padding: 0 1rem;
        }

        .register-link {
            text-align: center;
            color: var(--gray-600);
            font-size: 0.9375rem;
        }

        .register-link a {
            color: var(--primary-green);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: var(--primary-green-dark);
            text-decoration: underline;
        }

        .back-home {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-home a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .alert-custom {
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            display: none;
            animation: slideDown 0.3s ease;
        }

        .alert-error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .alert-success {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #065f46;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Logo & Header -->
            <div class="logo-section">
                <div class="logo-icon-large">SA</div>
                <h1 class="login-title">Masuk ke SIGAP ALAM</h1>
                <p class="login-subtitle">Platform Edukasi Lingkungan dan Kesadaran Bencana</p>
            </div>

            <!-- Alert -->
            <div id="alertBox" class="alert-custom"></div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="needs-validation">
                @csrf
                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Email atau Username</label>
                    <div class="input-group-custom">
                        <input type="email" id="email" name="email" class="form-control-custom"
                            placeholder="nama@example.com" required autocomplete="email">
                        <i class="bi bi-envelope input-icon"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>

                    <div class="input-group-custom">
                        <input type="password" id="password" name="password" class="form-control-custom"
                            placeholder="Masukkan password" required autocomplete="current-password">

                        <i class="bi bi-lock input-icon"></i>

                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="remember-forgot">
                    <div class="form-check-custom">
                        <input type="checkbox" id="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-login">
                    <span>Masuk</span>
                    <i class="bi bi-arrow-right"></i>
                </button>

                <!-- Divider -->
                <div class="divider">
                    <span>atau</span>
                </div>

                <!-- Register Link -->
                <div class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}"
                        onclick="showRegisterInfo(); return false;">Daftar sekarang</a>
                </div>
            </form>
        </div>

        <!-- Back to Home -->
        <div class="back-home">
            <a href="/">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    @include('alert')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Premium JS -->
    <script src="{{ asset('assets/js/premium-script.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye-slash';
            }
        }
    </script>

</body>

</html>

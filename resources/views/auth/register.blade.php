<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SIGAP ALAM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/premium-style.css">

    <style>
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* scroll normal */
            padding: 2rem 1rem;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background: linear-gradient(135deg,
                    #047857 0%,
                    #059669 25%,
                    #10b981 50%,
                    #0284c7 75%,
                    #0369a1 100%);
            margin: 0;
            padding: 0;
            position: relative;
            overflow-x: hidden;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* 🔑 penting */
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

        .register-container {
            width: 100%;
            max-width: 550px;
            position: relative;
            z-index: 2;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 2.5rem 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-icon-large {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #059669 0%, #10b981 50%, #0284c7 100%);
            border-radius: 1.25rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.75rem;
            box-shadow: 0 10px 30px -5px rgba(5, 150, 105, 0.3);
            margin-bottom: 1rem;
        }

        .register-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .register-subtitle {
            color: var(--gray-600);
            font-size: 0.9375rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
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
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 2px solid var(--gray-200);
            border-radius: 0.75rem;
            font-size: 0.9375rem;
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

        .btn-register {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #059669 0%, #10b981 50%, #0284c7 100%);
            border: none;
            border-radius: 0.75rem;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px -5px rgba(5, 150, 105, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(5, 150, 105, 0.4);
        }

        .btn-register:active {
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

        .login-link {
            text-align: center;
            color: var(--gray-600);
            font-size: 0.9375rem;
        }

        .login-link a {
            color: var(--primary-green);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
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
            font-size: 0.9375rem;
        }

        .back-home a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .form-check-custom {
            display: flex;
            align-items: start;
            margin-bottom: 1.25rem;
        }

        .form-check-custom input {
            width: 18px;
            height: 18px;
            margin-right: 0.625rem;
            margin-top: 0.125rem;
            cursor: pointer;
            accent-color: var(--primary-green);
            flex-shrink: 0;
        }

        .form-check-custom label {
            margin: 0;
            cursor: pointer;
            color: var(--gray-600);
            font-size: 0.875rem;
            user-select: none;
        }

        .form-check-custom label a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 500;
        }

        .form-check-custom label a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .register-card {
                padding: 2rem 1.5rem;
            }

            .register-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="register-container">
            <div class="register-card">
                <!-- Logo & Header -->
                <div class="logo-section">
                    <div class="logo-icon-large">SA</div>
                    <h1 class="register-title">Bergabung dengan SIGAP ALAM</h1>
                    <p class="register-subtitle">Buat akun dan mulai berbagi pengetahuan tentang mitigasi bencana</p>
                </div>

                <!-- Register Form -->
                <form id="registerForm" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <!-- Full Name -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="fullName" class="form-label">Nama Lengkap</label>
                                <div class="input-group-custom">
                                    <input type="text" id="fullName" name="name" class="form-control" style="padding-left: 45px" required>
                                    <i class="bi bi-person input-icon"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group-custom">
                                    <input type="email" id="email" name="email" class="form-control" style="padding-left: 45px" required>
                                    <i class="bi bi-envelope input-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row gx-4 gy-3" style="margin-top: -10px">
                            <!-- Password -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group-custom">
                                        <input type="password" id="password" name="password"
                                            class="form-control-custom w-100" required>
                                        <i class="bi bi-lock input-icon"></i>
                                        <button type="button" class="password-toggle"
                                            onclick="togglePassword('password', this)">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                    <div class="input-group-custom">
                                        <input type="password" id="confirmPassword" name="password_confirmation"
                                            class="form-control-custom w-100" required>
                                        <i class="bi bi-lock-fill input-icon"></i>
                                        <button type="button" class="password-toggle"
                                            onclick="togglePassword('confirmPassword', this)">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Daftar Sebagai</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check-custom flex-fill">
                                        <input type="radio" name="role" value="contributor" checked>
                                        <label for="roleContributor" class="flex-fill">
                                            <div class="p-3 border rounded-3 text-center" style="transition: all 0.3s;">
                                                <i class="bi bi-pencil-square d-block mb-2"
                                                    style="font-size: 1.5rem; color: #10b981;"></i>
                                                <strong class="d-block mb-1">Kontributor</strong>
                                                <small class="text-muted">Penulis artikel</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="form-check-custom">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">
                            Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan
                                Privasi</a> SIGAP ALAM
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="btn-register" id="registerBtn">
                        <span>Daftar Sekarang</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>

                    <!-- Divider -->
                    <div class="divider">
                        <span>atau</span>
                    </div>

                    <!-- Login Link -->
                    <div class="login-link">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/premium-script.js"></script>

    <script>
        // Toggle password visibility

        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye-slash';
            }
        }

        // Handle registration
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const registerBtn = document.getElementById('registerBtn');

            registerBtn.innerHTML = 'Mendaftar...';
            registerBtn.disabled = true;

            fetch("{{ route('register.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status) {
                        alert(data.message);
                        window.location.href = "/login";
                    }
                })
                .catch(err => {
                    alert('Registrasi gagal');
                    registerBtn.disabled = false;
                    registerBtn.innerHTML = 'Daftar Sekarang';
                });
        });

        // Radio button styling
        document.querySelectorAll('input[name="role"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('input[name="role"]').forEach(r => {
                    const label = r.nextElementSibling.querySelector('div');
                    if (r.checked) {
                        label.style.borderColor = '#059669';
                        label.style.background = 'rgba(5, 150, 105, 0.05)';
                    } else {
                        label.style.borderColor = '#e5e7eb';
                        label.style.background = 'white';
                    }
                });
            });
        });
    </script>
</body>

</html>

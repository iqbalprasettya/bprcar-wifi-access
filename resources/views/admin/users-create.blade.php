<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Admin BPR CAR</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .wave-header {
            position: relative;
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            height: 350px;
            overflow: hidden;
        }

        /* Floating particles/bubbles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: float-up 15s infinite ease-in;
        }

        .particle:nth-child(1) {
            width: 60px;
            height: 60px;
            left: 15%;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .particle:nth-child(2) {
            width: 40px;
            height: 40px;
            left: 40%;
            animation-delay: 3s;
            animation-duration: 15s;
        }

        .particle:nth-child(3) {
            width: 80px;
            height: 80px;
            left: 65%;
            animation-delay: 5s;
            animation-duration: 20s;
        }

        .particle:nth-child(4) {
            width: 50px;
            height: 50px;
            left: 85%;
            animation-delay: 2s;
            animation-duration: 16s;
        }

        @keyframes float-up {
            0% {
                bottom: -100px;
                opacity: 0;
                transform: translateY(0) rotate(0deg);
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                bottom: 110%;
                opacity: 0;
                transform: translateY(-100px) rotate(360deg);
            }
        }

        /* SVG Wave Animation */
        .waves {
            position: absolute;
            width: 100%;
            height: 12vh;
            bottom: 0;
            left: 0;
            min-height: 80px;
            max-height: 120px;
        }

        .parallax>use {
            animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
        }

        .parallax>use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
        }

        .parallax>use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
        }

        .parallax>use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
        }

        .parallax>use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
        }

        @keyframes move-forever {
            0% {
                transform: translate3d(-90px, 0, 0);
            }

            100% {
                transform: translate3d(85px, 0, 0);
            }
        }

        .header-content {
            position: relative;
            z-index: 10;
            padding: 50px 20px 20px;
            color: white;
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }

        .header-left {
            flex: 1;
            animation: fadeInLeft 0.8s ease-out;
        }

        .header-right {
            flex: 1;
            text-align: right;
            animation: fadeInRight 0.8s ease-out;
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

        .header-left h1 {
            font-size: 36px;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            margin: 0;
        }

        .header-left p {
            font-size: 15px;
            opacity: 0.9;
            margin-top: 8px;
        }

        .welcome-text {
            font-size: 15px;
            opacity: 0.9;
            margin-bottom: 8px;
        }

        .username-display {
            font-size: 28px;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            margin: 0;
        }

        .nav-btn,
        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .nav-btn:hover,
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .status-dot-header {
            width: 8px;
            height: 8px;
            background: #1cc88a;
            border-radius: 50%;
            animation: pulse-header 2s ease-in-out infinite;
        }

        @keyframes pulse-header {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(28, 200, 138, 0.7);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.1);
                box-shadow: 0 0 0 10px rgba(28, 200, 138, 0);
            }
        }

        .container {
            max-width: 500px;
            margin: -80px auto 50px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .form-container {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            animation: slideUp 0.6s ease-out both;
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

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h1 {
            color: #5a5c69;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #858796;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #5a5c69;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e3e6f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fc;
            color: #5a5c69;
            font-weight: 500;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4e73df;
            background: white;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
            transform: translateY(-1px);
        }

        .password-strength {
            margin-top: 5px;
            font-size: 12px;
            height: 4px;
            background: #f1f1f1;
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
        }

        .password-strength.weak .password-strength-bar {
            width: 33%;
            background: #ef4444;
        }

        .password-strength.medium .password-strength-bar {
            width: 66%;
            background: #f59e0b;
        }

        .password-strength.strong .password-strength-bar {
            width: 100%;
            background: #10b981;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
            color: white;
            border: none;
            flex: 1;
            box-shadow: 0 2px 10px rgba(28, 200, 138, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(28, 200, 138, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #858796;
            border: 2px solid #e3e6f0;
            flex: 0.5;
        }

        .btn-secondary:hover {
            border-color: #4e73df;
            color: #4e73df;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .alert-success {
            background: #d1fae5;
            border-left: 4px solid #10b981;
            color: #065f46;
        }

        .alert-error {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }

        .form-info {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #0369a1;
        }

        @media (max-width: 768px) {
            .wave-header {
                height: auto;
                min-height: 320px;
                padding-bottom: 40px;
            }

            .header-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 25px;
                padding: 35px 20px 20px;
                max-width: 100%;
            }

            .header-left {
                width: 100%;
            }

            .header-right {
                width: 100%;
                text-align: left;
                padding-top: 10px;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }

            .header-left h1 {
                font-size: 26px;
                line-height: 1.2;
            }

            .header-left p {
                font-size: 14px;
                margin-top: 6px;
            }

            .username-display {
                font-size: 24px;
                line-height: 1.2;
            }

            .welcome-text {
                font-size: 14px;
            }

            .container {
                margin-top: -50px;
                padding: 0 15px;
            }

            .form-container {
                padding: 30px 20px;
            }

            .form-header h1 {
                font-size: 20px;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="wave-header">
        <!-- Floating Particles -->
        <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <!-- Waves Container -->
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(245,245,245,0.7)" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(245,245,245,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(245,245,245,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="rgb(245,245,245)" />
            </g>
        </svg>

        <div class="header-content">
            <div class="header-left">
                <div class="status-badge">
                    <span class="status-dot-header"></span>
                    Create User
                </div>
                <h1>Tambah User Baru</h1>
                <p>Buat akun hotspot baru</p>
            </div>
            <div class="header-right">
                <p class="welcome-text">Selamat datang kembali,</p>
                <div class="username-display">{{ Auth::user()->name }}</div>
                <div style="gap: 10px; margin-top: 15px;">
                    <a href="{{ route('admin.users') }}" class="nav-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            style="width: 16px; height: 16px;">
                            <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        User List
                    </a>
                    <a href="{{ route('admin.active-users') }}" class="nav-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            style="width: 16px; height: 16px;">
                            <path
                                d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                        </svg>
                        Active Users
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 16px; height: 16px;">
                                <path fill-rule="evenodd"
                                    d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h1>Form Tambah User</h1>
                <p>Isi data untuk membuat akun hotspot baru</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="form-info">
                💡 <strong>Info:</strong> Pastikan username unik dan password minimal 4 karakter
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Username</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan username"
                        required
                        minlength="3"
                        maxlength="32"
                        pattern="[a-zA-Z0-9_-]+"
                        title="Username hanya boleh berisi huruf, angka, underscore, dan dash"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                        minlength="4"
                        maxlength="32"
                        onkeyup="checkPasswordStrength(this.value)"
                    >
                    <div class="password-strength" id="passwordStrength">
                        <div class="password-strength-bar"></div>
                    </div>
                    <small id="passwordText" style="color: #858796; margin-top: 5px; font-size: 12px;"></small>
                </div>

                <div class="form-group">
                    <label for="profile">Profile</label>
                    <select id="profile" name="profile" required>
                        @foreach ($profiles as $profile)
                            <option value="{{ $profile['name'] ?? 'default' }}"
                                {{ old('profile') == ($profile['name'] ?? 'default') ? 'selected' : '' }}>
                                {{ $profile['name'] ?? 'default' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                            <path fill-rule="evenodd" d="M10.22 12.72a.75.75 0 0 0 0 1.06l-1.06 1.06L6.25 11.31 3.28 8.44a.75.75 0 0 1-1.06 1.06L2.22 6.28a.75.75 0 0 1 1.06 0l3.78 3.78 1.06-1.06L4.44 8.94l1.06-1.06L7.5 9.69l3.78 3.78 1.06-1.06L9.72 9.69 7.5 11.5 1.06-1.06l3.78-3.78zM12.47 14.53a.75.75 0 0 1 0 1.06L17.69 9.47a.75.75 0 0 1 0-1.06l-1.06 1.06L13.44 10.5l1.06-1.06L12.38 8.44a.75.75 0 0 1 0-1.06l-1.06 1.06l3.78 3.78z" clip-rule="evenodd" />
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                            <path fill-rule="evenodd" d="M12 4.354a.75.75 0 01.75.75v7.5a.75.75 0 01-1.5 0v-7.5a.75.75 0 01.75-.75zM12.75 8.25a.75.75 0 00-.75.75v7.5h7.5a.75.75 0 000-1.5h-7.5z" clip-rule="evenodd" />
                        </svg>
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function checkPasswordStrength(password) {
            const strengthBar = document.querySelector('.password-strength-bar');
            const strengthText = document.getElementById('passwordText');
            const strengthContainer = document.getElementById('passwordStrength');

            let strength = 0;
            let strengthTextContent = '';

            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            if (strength < 3) {
                strengthContainer.className = 'password-strength weak';
                strengthTextContent = 'Password lemah (min: 8 karakter, campur: huruf, angka, simbol)';
            } else if (strength < 5) {
                strengthContainer.className = 'password-strength medium';
                strengthTextContent = 'Password sedang (tambahkan simbol untuk lebih kuat)';
            } else {
                strengthContainer.className = 'password-strength strong';
                strengthTextContent = 'Password kuat!';
            }

            strengthText.textContent = strengthTextContent;
        }

        // Auto-check password strength on input
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            if (passwordInput && passwordInput.value) {
                checkPasswordStrength(passwordInput.value);
            }
        });
    </script>
</body>

</html>
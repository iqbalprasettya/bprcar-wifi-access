<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - BPR CAR</title>
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
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .login-container {
            position: relative;
            z-index: 10;
            width: 90%;
            max-width: 420px;
        }

        .login-card {
            background: white;
            padding: 45px 40px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            animation: fadeInUp 0.6s ease-out;
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

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .admin-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .admin-icon svg {
            width: 35px;
            height: 35px;
            fill: white;
        }

        h2 {
            color: #4e73df;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #858796;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            color: #5a5c69;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e3e6f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s ease;
            background: #f8f9fc;
            color: #5a5c69;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4e73df;
            background: white;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        }

        button[type="submit"] {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.25);
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 115, 223, 0.35);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .error-message {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            animation: shake 0.5s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-10px);
            }

            75% {
                transform: translateX(10px);
            }
        }

        .success-message {
            background: #d1fae5;
            border-left: 4px solid #10b981;
            color: #065f46;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .footer-text {
            text-align: center;
            color: #858796;
            font-size: 13px;
            margin-top: 25px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 35px 30px;
            }

            h2 {
                font-size: 22px;
            }

            .admin-icon {
                width: 60px;
                height: 60px;
            }

            .admin-icon svg {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="wave-header">
        <!-- Waves Container -->
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
        </svg>

        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <div class="admin-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2>Admin Login</h2>
                    <p class="subtitle">BPR CAR - Hotspot Management</p>
                </div>

                @if (session('error'))
                    <div class="error-message">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="error-message">
                        {{ $errors->first('error') ?? 'Terjadi kesalahan' }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukkan email admin" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    </div>

                    <button type="submit">
                        Login
                    </button>
                </form>

                <div class="footer-text">
                    © {{ date('Y') }} BPR CAR. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>

</html>

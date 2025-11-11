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
            height: 380px;
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
            height: 15vh;
            bottom: 0;
            left: 0;
            min-height: 100px;
            max-height: 150px;
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
            text-align: center;
            padding-top: 80px;
            color: white;
        }

        .admin-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse-scale 2s ease-in-out infinite;
        }

        .admin-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        @keyframes pulse-scale {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
            }
        }

        .header-content h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 0.8s ease-out;
        }

        .header-content p {
            font-size: 18px;
            font-weight: 400;
            opacity: 0.95;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .container {
            max-width: 460px;
            margin: -100px auto 50px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
            animation: slideUp 0.6s ease-out 0.2s both;
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

        .login-card {
            background: white;
            padding: 50px 45px;
            border-radius: 16px;
            box-shadow: 0 20px 80px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #5a5c69;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e3e6f0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #f8f9fc;
            color: #5a5c69;
            font-weight: 500;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #4e73df;
            background: white;
            box-shadow: 0 0 0 4px rgba(78, 115, 223, 0.1);
            transform: translateY(-2px);
        }

        button[type="submit"] {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
            margin-top: 30px;
            position: relative;
            overflow: hidden;
        }

        button[type="submit"]::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        button[type="submit"]:hover::before {
            width: 300px;
            height: 300px;
        }

        button[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(78, 115, 223, 0.4);
        }

        .error-message {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
            padding: 16px 20px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 14px;
            font-weight: 600;
            animation: shake 0.6s ease-out;
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }

            10%, 30%, 50%, 70%, 90% {
                transform: translateX(-8px);
            }

            20%, 40%, 60%, 80% {
                transform: translateX(8px);
            }
        }

        .success-message {
            background: #d1fae5;
            border-left: 4px solid #10b981;
            color: #065f46;
            padding: 16px 20px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .footer-text {
            text-align: center;
            color: #858796;
            font-size: 12px;
            margin-top: 30px;
            opacity: 0.8;
        }

        .security-notice {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 25px;
            font-size: 12px;
            color: #0c4a6e;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .security-notice svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: #0284c7;
        }

        @media (max-width: 768px) {
            .wave-header {
                height: 320px;
            }

            .waves {
                height: 60px;
                min-height: 60px;
            }

            .header-content {
                padding-top: 60px;
            }

            .admin-icon {
                width: 60px;
                height: 60px;
                margin-bottom: 15px;
            }

            .admin-icon svg {
                width: 30px;
                height: 30px;
            }

            .header-content h1 {
                font-size: 36px;
            }

            .header-content p {
                font-size: 16px;
            }

            .container {
                margin-top: -80px;
            }

            .login-card {
                padding: 40px 35px;
            }
        }

        @media (max-width: 480px) {
            .wave-header {
                height: 280px;
            }

            .header-content {
                padding-top: 50px;
            }

            .header-content h1 {
                font-size: 32px;
            }

            .header-content p {
                font-size: 15px;
            }

            .container {
                margin-top: -70px;
                padding: 0 15px;
            }

            .login-card {
                padding: 35px 30px;
            }

            input[type="email"],
            input[type="password"] {
                padding: 14px 16px;
                font-size: 14px;
            }

            button[type="submit"] {
                padding: 16px;
                font-size: 15px;
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
                <path id="gentle-wave"
                    d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(245,245,245,0.7)" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(245,245,245,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(245,245,245,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="rgb(245,245,245)" />
            </g>
        </svg>

        <div class="header-content">
            <div class="admin-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.785 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                    <path d="M15.75 9a3 3 0 116 0 3 3 0 01-6 0z" />
                </svg>
            </div>
            <h1>Admin Portal</h1>
            <p>BPR CAR - Hotspot Management System</p>
        </div>
    </div>

    <div class="container">
        <div class="login-card">

            @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="error-message">
                {{ $errors->first('error') ?? 'Terjadi kesalahan' }}
            </div>
            @endif

            @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@bprcar.co.id"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <button type="submit">
                    Sign In to Admin Panel
                </button>
            </form>

            <div class="footer-text">
                © {{ date('Y') }} BPR CAR. Unauthorized access is prohibited.
            </div>
        </div>
    </div>
</body>

</html>

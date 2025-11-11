<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Login Internet BPR CAR</title>
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
            padding-top: 60px;
            color: white;
        }

        .header-content h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 0.8s ease-out;
        }

        .header-content p {
            font-size: 20px;
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
            max-width: 440px;
            margin: -80px auto 50px;
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
            padding: 45px 40px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #5a5c69;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #b7b9cc;
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
            margin-top: 25px;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 115, 223, 0.35);
        }

        button[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(78, 115, 223, 0.25);
        }

        .error-message {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 14px;
            animation: shake 0.5s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .error-message ul {
            list-style: none;
            margin: 0;
        }

        .error-message li {
            margin: 5px 0;
        }

        .footer-text {
            text-align: center;
            color: #858796;
            font-size: 12px;
            margin-top: 25px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .wave-header {
                height: 280px;
            }

            .waves {
                height: 40px;
                min-height: 40px;
            }

            .header-content {
                padding-top: 40px;
            }

            .header-content h1 {
                font-size: 32px;
            }

            .header-content p {
                font-size: 16px;
            }

            .container {
                margin-top: -70px;
            }

            .login-card {
                padding: 35px 30px;
            }
        }

        @media (max-width: 480px) {
            .wave-header {
                height: 250px;
            }

            .header-content h1 {
                font-size: 28px;
            }

            .header-content p {
                font-size: 15px;
            }

            .login-card {
                padding: 30px 25px;
            }

            .form-group label {
                font-size: 12px;
            }

            input[type="text"],
            input[type="password"] {
                padding: 12px 16px;
                font-size: 14px;
            }

            button[type="submit"] {
                padding: 14px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="wave-header">
        <!-- Header Content -->
        <div class="header-content">
            <h1>Internet Access</h1>
            <p>Welcome to the Internet Access System</p>
        </div>

        <!-- SVG Animated Waves -->
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
    </div>

    <div class="container">
        <div class="login-card">
            <form method="post" action="{{ route('portal.submit') }}">
                @csrf
                <input type="hidden" name="mac" value="{{ $mac ?? '' }}">
                <input type="hidden" name="ip" value="{{ $ip ?? '' }}">
                <input type="hidden" name="dst" value="{{ $dst ?? 'http://google.com' }}">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit">Sign In</button>
            </form>

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="footer-text">
                © {{ date('Y') }} BPR CAR. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Internet BPR CAR</title>
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
            height: 300px;
            overflow: hidden;
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

        .status-dot {
            width: 8px;
            height: 8px;
            background: #1cc88a;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
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

        .container {
            max-width: 900px;
            margin: -80px auto 50px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #4e73df;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: slideUp 0.6s ease-out both;
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.4s;
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

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-card.green {
            border-left-color: #1cc88a;
        }

        .stat-card.cyan {
            border-left-color: #36b9cc;
        }

        .stat-card.orange {
            border-left-color: #f6c23e;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #5a5c69;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dddfeb;
        }

        .stat-icon svg {
            width: 24px;
            height: 24px;
            fill: currentColor;
        }

        .stat-value {
            color: #5a5c69;
            font-size: 24px;
            font-weight: 700;
        }

        .info-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            animation: slideUp 0.6s ease-out 0.5s both;
        }

        .card-header {
            color: #4e73df;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e3e6f0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f8f9fc;
            transition: background 0.3s ease;
        }

        .info-row:hover {
            background: #f8f9fc;
            padding-left: 10px;
            padding-right: 10px;
            margin: 0 -10px;
            border-radius: 5px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #858796;
            font-size: 14px;
            font-weight: 500;
        }

        .info-value {
            color: #5a5c69;
            font-size: 14px;
            font-weight: 600;
            text-align: right;
        }

        .logout-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #e74a3b 0%, #e02424 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(231, 74, 59, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            animation: slideUp 0.6s ease-out 0.6s both;
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
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

        .logout-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(231, 74, 59, 0.4);
        }

        .logout-btn svg {
            width: 18px;
            height: 18px;
            fill: white;
            position: relative;
            z-index: 1;
        }

        .logout-btn span {
            position: relative;
            z-index: 1;
        }

        .footer-text {
            text-align: center;
            color: #858796;
            font-size: 13px;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .wave-header {
                height: auto;
                min-height: 320px;
                padding-bottom: 40px;
            }

            .waves {
                height: 60px;
                min-height: 60px;
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

            .status-badge {
                font-size: 12px;
                padding: 6px 16px;
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

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-value {
                font-size: 20px;
            }

            .stat-label {
                font-size: 10px;
            }

            .info-card {
                padding: 20px 15px;
            }

            .card-header {
                font-size: 15px;
            }

            .info-row {
                padding: 10px 0;
                font-size: 13px;
            }

            .info-label,
            .info-value {
                font-size: 13px;
            }

            .logout-btn {
                padding: 12px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .wave-header {
                min-height: 280px;
            }

            .header-content {
                padding: 30px 15px 20px;
                gap: 20px;
            }

            .header-left h1 {
                font-size: 22px;
            }

            .header-left p {
                font-size: 13px;
            }

            .username-display {
                font-size: 20px;
            }

            .welcome-text {
                font-size: 13px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-value {
                font-size: 22px;
            }

            .stat-header {
                margin-bottom: 8px;
            }

            .info-card {
                padding: 18px 12px;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
                padding: 12px 0;
            }

            .info-value {
                text-align: left;
                word-break: break-all;
            }
        }

        @media (max-width: 360px) {
            .header-left h1 {
                font-size: 20px;
            }

            .username-display {
                font-size: 18px;
            }

            .stat-card {
                padding: 14px;
            }

            .stat-value {
                font-size: 20px;
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

        <!-- Header Content -->
        <div class="header-content">
            <div class="header-left">
                <div class="status-badge">
                    <span class="status-dot"></span>
                    Connected
                </div>
                <h1>Dashboard Internet</h1>
                <p>Kelola koneksi dan data internet Anda</p>
            </div>
            <div class="header-right">
                <p class="welcome-text">Selamat datang kembali,</p>
                <div class="username-display">{{ $sessionData['username'] }}</div>
            </div>
        </div>

        <!-- SVG Animated Waves -->
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave-dash"
                    d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave-dash" x="48" y="0" fill="rgba(245,245,245,0.7)" />
                <use xlink:href="#gentle-wave-dash" x="48" y="3" fill="rgba(245,245,245,0.5)" />
                <use xlink:href="#gentle-wave-dash" x="48" y="5" fill="rgba(245,245,245,0.3)" />
                <use xlink:href="#gentle-wave-dash" x="48" y="7" fill="rgb(245,245,245)" />
            </g>
        </svg>
    </div>

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-label">Waktu Online</div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="stat-value">{{ $sessionData['uptime'] }}</div>
            </div>

            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-label">Data Download</div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="stat-value">{{ $sessionData['bytes_in'] }}</div>
            </div>

            <div class="stat-card cyan">
                <div class="stat-header">
                    <div class="stat-label">Data Upload</div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M11.47 2.47a.75.75 0 011.06 0l4.5 4.5a.75.75 0 01-1.06 1.06l-3.22-3.22V16.5a.75.75 0 01-1.5 0V4.81L8.03 8.03a.75.75 0 01-1.06-1.06l4.5-4.5zM3 15.75a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="stat-value">{{ $sessionData['bytes_out'] }}</div>
            </div>

            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-label">Server</div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 00-1.032-.211 50.89 50.89 0 00-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 002.433 3.984L7.28 21.53A.75.75 0 016 21v-4.03a48.527 48.527 0 01-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979z" />
                            <path
                                d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 001.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0015.75 7.5z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-value" style="font-size: 16px;">{{ $sessionData['server'] }}</div>
            </div>
        </div>

        <div class="info-card">
            <div class="card-header">Informasi Koneksi</div>

            <div class="info-row">
                <span class="info-label">Username</span>
                <span class="info-value">{{ $sessionData['username'] }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">IP Address</span>
                <span class="info-value">{{ $sessionData['ip'] }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">MAC Address</span>
                <span class="info-value">{{ $sessionData['mac'] }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Total Download</span>
                <span class="info-value">{{ $sessionData['bytes_in'] }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Total Upload</span>
                <span class="info-value">{{ $sessionData['bytes_out'] }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="hidden" name="ip" value="{{ $sessionData['ip'] }}">
            <button type="submit" class="logout-btn"
                onclick="return confirm('Apakah Anda yakin ingin logout dari internet?')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                        clip-rule="evenodd" />
                </svg>
                <span>Logout dari Internet</span>
            </button>
        </form>

        <p class="footer-text">
            © {{ date('Y') }} BPR CAR. Koneksi internet Anda aman dan terenkripsi.
        </p>
    </div>
</body>

</html>

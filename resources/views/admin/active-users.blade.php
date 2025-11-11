<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Users - Admin BPR CAR</title>
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

        .header-right {
            display: flex;
            gap: 15px;
            align-items: center;
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

        /* Users Grid */
        .users-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            padding: 25px;
            animation: slideUp 0.6s ease-out 0.5s both;
        }

        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .user-card {
            background: white;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .user-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .user-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e3e6f0;
        }

        .user-name {
            font-size: 18px;
            font-weight: 700;
            color: #5a5c69;
            margin-bottom: 5px;
        }

        .user-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            background: #d1fae5;
            color: #065f46;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .user-info {
            display: grid;
            gap: 0;
            margin-bottom: 15px;
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

        .user-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e3e6f0;
        }

        .btn-kick {
            flex: 1;
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
        }

        .btn-kick:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(231, 74, 59, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #858796;
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #5a5c69;
        }

        .empty-state p {
            font-size: 15px;
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

            .users-grid {
                grid-template-columns: 1fr;
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
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
        </svg>

        <div class="header-content">
            <div class="header-top">
                <div class="header-left">
                    <h1>Active Users Monitor</h1>
                    <p>Real-time monitoring user yang sedang terhubung</p>
                </div>
                <div class="header-right">
                    <div>
                        <div class="welcome-text">
                            👤 Admin
                        </div>
                        <div class="username-display">
                            {{ Auth::user()->name }}
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('admin.logs') }}" class="nav-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 16px; height: 16px;">
                                    <path
                                        d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" />
                                    <path
                                        d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z" />
                                    <path
                                        d="M10.933 19.231l-7.668-4.13-1.37.739a.75.75 0 000 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 000-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 01-2.134-.001z" />
                                </svg>
                                View Logs
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
        </div>
    </div>

    <div class="container">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-label">Total Active</div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-value">{{ count($activeUsers) }}</div>
            </div>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                ✗ {{ session('error') }}
            </div>
        @endif

        @if (isset($error))
            <div class="alert alert-error">
                ✗ {{ $error }}
            </div>
        @endif

        <!-- Users Grid -->
        <div class="users-container">
            @if (count($activeUsers) > 0)
                <div class="users-grid">
                    @foreach ($activeUsers as $user)
                        <div class="user-card">
                            <div class="user-header">
                                <div>
                                    <div class="user-name">{{ $user['user'] ?? 'Unknown' }}</div>
                                </div>
                                <div class="user-status">
                                    <span class="status-dot"></span>
                                    Online
                                </div>
                            </div>

                            <div class="user-info">
                                <div class="info-row">
                                    <span class="info-label">IP Address</span>
                                    <span class="info-value">{{ $user['address'] ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">MAC Address</span>
                                    <span class="info-value">{{ $user['mac-address'] ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Uptime</span>
                                    <span class="info-value">{{ $user['uptime'] ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Download</span>
                                    <span class="info-value">
                                        @php
                                            $bytesIn = $user['bytes-in'] ?? 0;
                                            $mb = $bytesIn / 1024 / 1024;
                                            echo number_format($mb, 2) . ' MB';
                                        @endphp
                                    </span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Upload</span>
                                    <span class="info-value">
                                        @php
                                            $bytesOut = $user['bytes-out'] ?? 0;
                                            $mb = $bytesOut / 1024 / 1024;
                                            echo number_format($mb, 2) . ' MB';
                                        @endphp
                                    </span>
                                </div>
                                @if (isset($userStats[$user['user']]))
                                    <div class="info-row">
                                        <span class="info-label">Total Login</span>
                                        <span
                                            class="info-value">{{ $userStats[$user['user']]['total_logins'] }}x</span>
                                    </div>
                                @endif
                            </div>

                            <div class="user-actions">
                                <form method="POST" action="{{ route('admin.kick-user', $user['address']) }}"
                                    style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn-kick"
                                        onclick="return confirm('Yakin ingin kick user {{ $user['user'] }}?')">
                                        Kick User
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <h3>Tidak Ada User Online</h3>
                    <p>Tidak ada user yang sedang terhubung saat ini</p>
                </div>
            @endif
        </div>
    </div>
</body>

</html>

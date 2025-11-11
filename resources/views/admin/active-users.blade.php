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
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            height: 260px;
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

        .header-content {
            position: relative;
            z-index: 10;
            padding: 35px 25px 25px;
            color: white;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header-left h1 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-left p {
            font-size: 15px;
            opacity: 0.95;
            font-weight: 500;
        }

        .header-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .admin-info {
            font-size: 15px;
            opacity: 0.95;
            font-weight: 600;
            text-align: right;
            margin-bottom: 12px;
        }

        .nav-btn,
        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            backdrop-filter: blur(10px);
        }

        .nav-btn:hover,
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Stats Cards */
        .stats-container {
            position: relative;
            z-index: 10;
            margin-top: -70px;
            padding: 0 25px 35px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-color: rgba(78, 115, 223, 0.2);
        }

        .stat-label {
            color: #6c757d;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Users Grid */
        .users-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 25px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .user-card {
            background: linear-gradient(135deg, #f8f9fc 0%, #e8eaf6 100%);
            border: 2px solid #e3e8ef;
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .user-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            border-color: #4e73df;
        }

        .user-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.1);
        }

        .user-name {
            font-size: 18px;
            font-weight: 800;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .user-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .user-info {
            display: grid;
            gap: 12px;
            margin-bottom: 15px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-label {
            color: #6c757d;
            font-size: 13px;
            font-weight: 600;
        }

        .info-value {
            color: #2d3748;
            font-size: 14px;
            font-weight: 700;
        }

        .user-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid rgba(0, 0, 0, 0.1);
        }

        .btn-kick {
            flex: 1;
            padding: 10px;
            background: linear-gradient(135deg, #e74a3b 0%, #c62828 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(231, 74, 59, 0.25);
        }

        .btn-kick:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 74, 59, 0.35);
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
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-left: 5px solid #10b981;
            color: #065f46;
        }

        .alert-error {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-left: 5px solid #ef4444;
            color: #991b1b;
        }

        @media (max-width: 768px) {
            .header-top {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-right {
                width: 100%;
                flex-direction: column;
                align-items: flex-start;
            }

            .admin-info {
                text-align: left;
            }

            .nav-btn, .logout-btn {
                width: 100%;
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            }

            .stat-value {
                font-size: 24px;
            }

            .users-grid {
                grid-template-columns: 1fr;
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

        <div class="header-content">
            <div class="header-top">
                <div class="header-left">
                    <h1>Active Users Monitor</h1>
                    <p>Real-time monitoring user yang sedang terhubung</p>
                </div>
                <div class="header-right">
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div class="admin-info">
                            👤 Admin: {{ Auth::user()->name }}
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('admin.logs') }}" class="nav-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                                    <path d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" />
                                    <path d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z" />
                                    <path d="M10.933 19.231l-7.668-4.13-1.37.739a.75.75 0 000 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 000-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 01-2.134-.001z" />
                                </svg>
                                View Logs
                            </a>
                            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                                        <path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z" clip-rule="evenodd" />
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

    <div class="stats-container">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Active</div>
                <div class="stat-value">{{ count($activeUsers) }}</div>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            ✗ {{ session('error') }}
        </div>
        @endif

        @if(isset($error))
        <div class="alert alert-error">
            ✗ {{ $error }}
        </div>
        @endif

        <!-- Users Grid -->
        <div class="users-container">
            @if(count($activeUsers) > 0)
            <div class="users-grid">
                @foreach($activeUsers as $user)
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
                        @if(isset($userStats[$user['user']]))
                        <div class="info-row">
                            <span class="info-label">Total Login</span>
                            <span class="info-value">{{ $userStats[$user['user']]['total_logins'] }}x</span>
                        </div>
                        @endif
                    </div>

                    <div class="user-actions">
                        <form method="POST" action="{{ route('admin.kick-user', $user['address']) }}" style="flex: 1;">
                            @csrf
                            <button type="submit" class="btn-kick" onclick="return confirm('Yakin ingin kick user {{ $user['user'] }}?')">
                                Kick User
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <h3>Tidak Ada User Online</h3>
                <p>Tidak ada user yang sedang terhubung saat ini</p>
            </div>
            @endif
        </div>
    </div>
</body>

</html>


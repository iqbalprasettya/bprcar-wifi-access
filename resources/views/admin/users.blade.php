<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin BPR CAR</title>
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
            max-width: 900px;
            margin: -80px auto 50px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .actions-bar {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            animation: slideUp 0.6s ease-out both;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .btn-create {
            padding: 10px 20px;
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(28, 200, 138, 0.4);
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 2px solid #e3e6f0;
            border-radius: 25px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8f9fc;
        }

        .search-box input:focus {
            outline: none;
            border-color: #4e73df;
            background: white;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        }

        .search-box svg {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #858796;
        }

        /* Users Table */
        .users-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            animation: slideUp 0.6s ease-out 0.5s both;
        }

        .users-table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fc;
        }

        th {
            padding: 15px 12px;
            text-align: left;
            color: #5a5c69;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e3e6f0;
        }

        tbody tr {
            border-bottom: 1px solid #e3e6f0;
            transition: background 0.3s ease;
        }

        tbody tr:hover {
            background: #f8f9fc;
        }

        td {
            padding: 14px 12px;
            color: #5a5c69;
            font-size: 14px;
        }

        .username-cell {
            font-weight: 700;
            color: #5a5c69;
        }

        .profile-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #e3f2fd;
            color: #1565c0;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .actions-cell {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-edit {
            background: #f6c23e;
            color: white;
        }

        .btn-edit:hover {
            background: #f0b90b;
        }

        .btn-delete {
            background: #e74a3b;
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
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

            .actions-bar {
                flex-direction: column;
                gap: 15px;
            }

            .search-box {
                max-width: 100%;
            }

            .users-table-wrapper {
                font-size: 13px;
            }

            th,
            td {
                padding: 10px 8px;
            }

            .btn-action {
                font-size: 11px;
                padding: 4px 8px;
            }

            .actions-cell {
                flex-direction: column;
                gap: 5px;
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
                    User Management
                </div>
                <h1>Kelola Akun Hotspot</h1>
                <p>Manajemen user dan profile hotspot</p>
            </div>
            <div class="header-right">
                <p class="welcome-text">Selamat datang kembali,</p>
                <div class="username-display">{{ Auth::user()->name }}</div>
                <div style="gap: 10px; margin-top: 15px;">
                    <a href="{{ route('admin.active-users') }}" class="nav-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            style="width: 16px; height: 16px;">
                            <path
                                d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                        </svg>
                        Active Users
                    </a>
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

    <div class="container">
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

        <!-- Actions Bar -->
        <div class="actions-bar">
            <a href="{{ route('admin.users.create') }}" class="btn-create">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v7.5a.75.75 0 01-1.5 0v-7.5a.75.75 0 01.75-.75zM12.75 8.25a.75.75 0 00-.75.75v7.5h7.5a.75.75 0 000-1.5h-7.5z" clip-rule="evenodd" />
                </svg>
                Tambah User Baru
            </a>

            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.16 5.614l5.378 5.377a1 1 0 001.415-1.414l-5.377-5.378a8.25 8.25 0 01-11.576 0z" clip-rule="evenodd" />
                </svg>
                <input type="text" placeholder="Cari user..." id="searchInput" onkeyup="searchUsers()">
            </div>
        </div>

        <!-- Users Table -->
        <div class="users-container">
            @if (count($users) > 0)
                <div class="users-table-wrapper">
                    <table id="usersTable">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Profile</th>
                                <th>Disabled</th>
                                <th>Uptime Limit</th>
                                <th>Bytes In</th>
                                <th>Bytes Out</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr data-user="{{ strtolower($user['name'] ?? '') }}">
                                    <td class="username-cell">{{ $user['name'] ?? '-' }}</td>
                                    <td>
                                        <span class="profile-badge">{{ $user['profile'] ?? 'default' }}</span>
                                    </td>
                                    <td>{{ $user['disabled'] ?? 'No' }}</td>
                                    <td>{{ $user['uptime-limit'] ?? 'unlimited' }}</td>
                                    <td>{{ $user['bytes-in'] ?? 0 }}</td>
                                    <td>{{ $user['bytes-out'] ?? 0 }}</td>
                                    <td class="actions-cell">
                                        <a href="{{ route('admin.users.edit', $user['name']) }}" class="btn-action btn-edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 14px; height: 14px;">
                                                <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652-2.652L10.582 9.07a1.875 1.875 0 01-2.652 0L3.51 13.225a1.875 1.875 0 012.652-2.652zm3.62 4.637a.75.75 0 001.06-1.061l-1.061-1.061a.75.75 0 00-1.061 1.06l1.06 1.061A.75.75 0 0018.824 19.875l1.06-1.06z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.users.delete', $user['name']) }}"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user['name }}?')"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 14px; height: 14px;">
                                                    <path fill-rule="evenodd" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652-2.652L10.582 9.07a1.875 1.875 0 01-2.652 0L3.51 13.225a1.875 1.875 0 012.652-2.652zm3.62 4.637a.75.75 0 001.06-1.061l-1.061-1.061a.75.75 0 00-1.061 1.06l1.06 1.061A.75.75 0 0018.824 19.875l1.06-1.06z" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <h3>Tidak Ada User</h3>
                    <p>Belum ada akun hotspot yang terdaftar</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function searchUsers() {
            const input = document.getElementById('searchInput');
            const table = document.getElementById('usersTable');
            const rows = table.getElementsByTagName('tr');
            const filter = input.value.toLowerCase();

            // Loop through all table rows, and hide those who don't match the search query
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const username = row.getAttribute('data-user');

                if (username) {
                    row.style.display = username.includes(filter) ? '' : 'none';
                }
            }
        }
    </script>
</body>

</html>
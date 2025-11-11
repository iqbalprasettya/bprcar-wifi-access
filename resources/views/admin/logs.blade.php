<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotspot Logs - Admin BPR CAR</title>
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

        .header-right {
            text-align: right;
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

        .stat-card:nth-child(5) {
            animation-delay: 0.5s;
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

        .stat-card.red {
            border-left-color: #e74a3b;
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

        /* Filters */
        .filters-container {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            animation: slideUp 0.6s ease-out 0.5s both;
        }

        .filters-row {
            display: flex;
            gap: 12px;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .filter-group {
            min-width: 140px;
            flex: 1;
        }

        .filter-group label {
            display: block;
            color: #5a5c69;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .filter-group select,
        .filter-group input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #e3e8ef;
            border-radius: 8px;
            font-size: 13px;
            transition: all 0.3s ease;
            background: #f8f9fc;
            font-weight: 500;
        }

        .filter-group select:focus,
        .filter-group input[type="text"]:focus {
            outline: none;
            border-color: #4e73df;
            background: white;
            box-shadow: 0 0 0 2px rgba(78, 115, 223, 0.1);
        }

        .btn {
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-block;
            white-space: nowrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            color: white;
            border: none;
            box-shadow: 0 2px 10px rgba(78, 115, 223, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #858796;
            border: 2px solid #e3e6f0;
        }

        .btn-secondary:hover {
            border-color: #4e73df;
            color: #4e73df;
        }

        /* Logs Table */
        .logs-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            animation: slideUp 0.6s ease-out 0.6s both;
        }

        .logs-table-wrapper {
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

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .text-muted {
            color: #858796;
            font-size: 13px;
        }

        .text-bold {
            font-weight: 600;
            color: #5a5c69;
        }

        /* Pagination */
        .pagination-container {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info {
            color: #858796;
            font-size: 14px;
        }

        .pagination-links {
            display: flex;
            gap: 8px;
        }

        .pagination-links a,
        .pagination-links span {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination-links a {
            background: white;
            color: #4e73df;
            border: 2px solid #e3e6f0;
        }

        .pagination-links a:hover {
            border-color: #4e73df;
            background: #f8f9fc;
        }

        .pagination-links .active {
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            color: white;
            border: none;
        }

        /* Responsive */
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

            .filters-row {
                flex-direction: column;
                gap: 10px;
            }

            .filter-group {
                min-width: auto;
                width: 100%;
            }

            .btn {
                width: 100%;
                margin-top: 5px;
            }

            table {
                font-size: 13px;
            }

            th,
            td {
                padding: 10px 8px;
            }

            .pagination-container {
                flex-direction: column;
                gap: 15px;
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
                    <span class="status-dot"></span>
                    Admin System
                </div>
                <h1>Hotspot Activity Logs</h1>
                <p>Monitor dan tracking aktivitas user hotspot</p>
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
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-label">Total Logs</div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M5.507 4.048A3 3 0 017.785 3h8.43a3 3 0 012.278 1.048l1.722 2.008A4.533 4.533 0 0119.5 6h-15c-.243 0-.482.02-.715.056l1.722-2.008z" />
                            <path fill-rule="evenodd"
                                d="M1.5 10.5a3 3 0 013-3h15a3 3 0 110 6h-15a3 3 0 01-3-3zM15.75 17.25v-4.5H18a2.25 2.25 0 002.25-2.25V9.75A2.25 2.25 0 0018 7.5h-2.25v4.5H12v-4.5H9.75v4.5H6v-4.5H3.75v4.5H1.5V21a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 21v-3.75h-6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_logs']) }}</div>
            </div>
            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-label">Login Success</div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_logins']) }}</div>
            </div>
            <div class="stat-card red">
                <div class="stat-header">
                    <div class="stat-label">Login Failed</div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['total_failed']) }}</div>
            </div>
            <div class="stat-card cyan">
                <div class="stat-header">
                    <div class="stat-label">Unique Users</div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                        </svg>
                    </div>
                </div>
                <div class="stat-value">{{ number_format($stats['unique_users']) }}</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters-container">
            <form method="GET" action="{{ route('admin.logs') }}">
                <div class="filters-row">
                    <div class="filter-group">
                        <label>Periode</label>
                        <select name="filter" onchange="this.form.submit()">
                            <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Semua</option>
                            <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Action</label>
                        <select name="action" onchange="this.form.submit()">
                            <option value="all" {{ $action == 'all' ? 'selected' : '' }}>Semua Action</option>
                            <option value="login_attempt" {{ $action == 'login_attempt' ? 'selected' : '' }}>Login Attempt</option>
                            <option value="login_success" {{ $action == 'login_success' ? 'selected' : '' }}>Login Success</option>
                            <option value="login_failed" {{ $action == 'login_failed' ? 'selected' : '' }}>Login Failed</option>
                            <option value="logout" {{ $action == 'logout' ? 'selected' : '' }}>Logout</option>
                            <option value="view_dashboard" {{ $action == 'view_dashboard' ? 'selected' : '' }}>View Dashboard</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Search</label>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Username/IP/MAC">
                    </div>

                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>

        <!-- Logs Table -->
        <div class="logs-container">
            <div class="logs-table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Username</th>
                            <th>Action</th>
                            <th>IP Address</th>
                            <th>Device</th>
                            <th>Status</th>
                            <th>Traffic</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>
                                    <div class="text-bold">{{ $log->created_at->format('d M Y') }}</div>
                                    <div class="text-muted">{{ $log->created_at->format('H:i:s') }}</div>
                                </td>
                                <td>
                                    <div class="text-bold">{{ $log->username }}</div>
                                    @if ($log->mac_address)
                                        <div class="text-muted">{{ $log->mac_address }}</div>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $badgeClass = 'badge-info';
                                        if ($log->action == 'login_success') {
                                            $badgeClass = 'badge-success';
                                        } elseif ($log->action == 'login_failed') {
                                            $badgeClass = 'badge-danger';
                                        } elseif ($log->action == 'logout') {
                                            $badgeClass = 'badge-warning';
                                        }
                                    @endphp
                                    <span
                                        class="badge {{ $badgeClass }}">{{ str_replace('_', ' ', $log->action) }}</span>
                                </td>
                                <td class="text-muted">{{ $log->ip_address }}</td>
                                <td>
                                    @if ($log->device_type)
                                        <div class="text-bold">{{ ucfirst($log->device_type) }}</div>
                                    @endif
                                    @if ($log->browser)
                                        <div class="text-muted" style="font-size: 12px;">{{ $log->browser }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($log->status == 'success')
                                        <span class="badge badge-success">{{ $log->status }}</span>
                                    @elseif($log->status == 'failed')
                                        <span class="badge badge-danger">{{ $log->status }}</span>
                                    @else
                                        <span class="badge badge-info">{{ $log->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($log->bytes_in > 0 || $log->bytes_out > 0)
                                        <div class="text-muted" style="font-size: 12px;">
                                            ↓ {{ $log->formatted_bytes_in }}<br>
                                            ↑ {{ $log->formatted_bytes_out }}
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($log->session_duration)
                                        <span class="text-muted">{{ $log->formatted_duration }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center; padding: 40px; color: #858796;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        style="width: 48px; height: 48px; margin: 0 auto 10px; opacity: 0.5;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                    </svg>
                                    <div style="font-size: 16px; font-weight: 600; margin-bottom: 5px;">Tidak ada
                                        data
                                        log</div>
                                    <div style="font-size: 14px;">Coba ubah filter atau search Anda</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($logs->hasPages())
                <div class="pagination-container">
                    <div class="pagination-info">
                        Menampilkan {{ $logs->firstItem() }} - {{ $logs->lastItem() }} dari {{ $logs->total() }}
                        data
                    </div>
                    <div class="pagination-links">
                        {{ $logs->links('pagination::simple-default') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>

</html>

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
            text-align: right;
        }

        .admin-info {
            font-size: 15px;
            opacity: 0.95;
            margin-bottom: 12px;
            font-weight: 600;
        }

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

        .nav-btn,
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .nav-btn {
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

        /* Filters */
        .filters-container {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .filters-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .filter-group label {
            display: block;
            color: #5a5c69;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .filter-group select,
        .filter-group input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e3e8ef;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8f9fc;
            font-weight: 500;
        }

        .filter-group select:focus,
        .filter-group input[type="text"]:focus {
            outline: none;
            border-color: #4e73df;
            background: white;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
            transform: translateY(-1px);
        }

        .filter-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 115, 223, 0.35);
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
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .logs-table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #f8f9fc 0%, #e8eaf6 100%);
        }

        th {
            padding: 18px 15px;
            text-align: left;
            color: #3a3d4a;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 3px solid #4e73df;
        }

        tbody tr {
            border-bottom: 1px solid #e8eaf6;
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background-color: #f8f9fc;
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        td {
            padding: 16px 15px;
            color: #2d3748;
            font-size: 14px;
            font-weight: 500;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
            letter-spacing: 0.3px;
        }

        .badge-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
        }

        .badge-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.2);
        }

        .badge-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
        }

        .badge-warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.2);
        }

        .text-muted {
            color: #858796;
            font-size: 13px;
        }

        .text-bold {
            font-weight: 700;
            color: #2d3748;
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
            .header-top {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-right {
                text-align: left;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            }

            .stat-value {
                font-size: 22px;
            }

            .filters-row {
                grid-template-columns: 1fr;
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
                    <h1>Hotspot Activity Logs</h1>
                    <p>Monitor dan tracking aktivitas user hotspot</p>
                </div>
                <div class="header-right">
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div class="admin-info">
                            👤 Admin: {{ Auth::user()->name }}
                        </div>
                        <div style="display: flex; gap: 10px;">
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
        </div>

        <div class="stats-container">
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Logs</div>
                    <div class="stat-value">{{ number_format($stats['total_logs']) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Login Success</div>
                    <div class="stat-value" style="color: #1cc88a;">{{ number_format($stats['total_logins']) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Login Failed</div>
                    <div class="stat-value" style="color: #e74a3b;">{{ number_format($stats['total_failed']) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Unique Users</div>
                    <div class="stat-value" style="color: #36b9cc;">{{ number_format($stats['unique_users']) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Traffic</div>
                    <div class="stat-value" style="color: #f6c23e; font-size: 20px;">
                        {{ number_format($stats['total_traffic'] / 1024 / 1024, 2) }} MB
                    </div>
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
                                <option value="login_attempt" {{ $action == 'login_attempt' ? 'selected' : '' }}>Login
                                    Attempt</option>
                                <option value="login_success" {{ $action == 'login_success' ? 'selected' : '' }}>Login
                                    Success</option>
                                <option value="login_failed" {{ $action == 'login_failed' ? 'selected' : '' }}>Login
                                    Failed
                                </option>
                                <option value="logout" {{ $action == 'logout' ? 'selected' : '' }}>Logout</option>
                                <option value="view_dashboard" {{ $action == 'view_dashboard' ? 'selected' : '' }}>View
                                    Dashboard</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Search (Username/IP/MAC)</label>
                            <input type="text" name="search" value="{{ $search }}" placeholder="Cari...">
                        </div>

                        <div class="filter-group" style="display: flex; align-items: flex-end;">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
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

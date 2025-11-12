@php
if (!function_exists('formatBytes')) {
    function formatBytes($size, $precision = 2) {
        $base = log($size, 1024);
        $suffixes = ['', 'KB', 'MB', 'GB', 'TB'];
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
}
@endphp

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Hotspot - Admin BPR CAR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .edit-form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
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
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            color: white;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            white-space: nowrap;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .form-body {
            padding: 30px;
        }

        /* User Info Preview */
        .user-info-preview {
            display: flex;
            align-items: center;
            padding: 25px;
            background: #f8f9fc;
            border-radius: 10px;
            margin-bottom: 25px;
            border: 2px solid #e3e6f0;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 25px;
            color: white;
            font-size: 2rem;
            box-shadow: 0 8px 16px rgba(78, 115, 223, 0.3);
        }

        .user-details h4 {
            margin: 0 0 10px 0;
            font-size: 1.5rem;
            color: #333;
            font-weight: 600;
        }

        .user-details p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .profile-badge {
            background: #4CAF50;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-active {
            background: #4CAF50;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-disabled {
            background: #f44336;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: #5a5c69;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e3e8ef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8f9fc;
            font-weight: 500;
        }

        .form-control:focus {
            outline: none;
            border-color: #4e73df;
            background: white;
            box-shadow: 0 0 0 2px rgba(78, 115, 223, 0.1);
        }

        .form-control.readonly-field {
            background: #e3e8ee;
            color: #666;
            cursor: not-allowed;
        }

        .password-input-group {
            position: relative;
        }

        .password-toggle-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            padding: 5px;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .password-toggle-btn:hover {
            color: #4e73df;
        }

        /* Password Strength */
        .password-strength-container {
            margin-top: 8px;
        }

        .password-strength-bar {
            height: 4px;
            background: #e3e8ee;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-text {
            font-size: 12px;
            color: #666;
        }

        .strength-weak { background: #f44336; width: 33%; }
        .strength-medium { background: #ff9800; width: 66%; }
        .strength-strong { background: #4CAF50; width: 100%; }

        /* Current Info Box */
        .current-info-box {
            background: #f8fafc;
            border: 2px solid #e3e8ee;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
        }

        .current-info-box h4 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .info-item label {
            font-weight: 500;
            color: #666;
            font-size: 13px;
        }

        .info-item span {
            color: #333;
            font-weight: 600;
            font-size: 13px;
        }

        /* Form Actions */
        .form-actions-group {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            padding-top: 20px;
            border-top: 1px solid rgba(0,0,0,0.1);
            margin-top: 30px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            color: white;
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

        /* Alert */
        .alert {
            margin: 20px 0;
            padding: 15px 20px;
            border-radius: 8px;
            display: flex;
            align-items: flex-start;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .alert i {
            margin-right: 10px;
            margin-top: 2px;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert li {
            margin-bottom: 5px;
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

            .form-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .user-info-preview {
                flex-direction: column;
                text-align: center;
            }

            .user-avatar {
                margin-right: 0;
                margin-bottom: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .form-actions-group {
                flex-direction: column;
            }

            .form-body {
                padding: 20px;
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
                <h1>Edit User Hotspot</h1>
                <p>Ubah pengaturan user {{ $user['name'] ?? 'Unknown' }}</p>
            </div>
            <div class="header-right">
                <p class="welcome-text">Selamat datang kembali,</p>
                <div class="username-display">{{ Auth::user()->name }}</div>
                <div style="gap: 10px; margin-top: 15px;">
                    <a href="{{ route('admin.users') }}" class="nav-btn">
                        <i class="fas fa-users"></i>
                        User Management
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Edit Form Container -->
        <div class="edit-form-container">
            <div class="form-header">
                <h3 class="form-title">
                    <i class="fas fa-user-edit"></i>
                    Edit User
                </h3>
                <div class="form-actions">
                    <a href="{{ route('admin.users') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="form-body">
                <!-- Current User Info -->
                <div class="user-info-preview">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <h4>{{ $user['name'] ?? 'Unknown' }}</h4>
                        <p>Profile: <span class="profile-badge">{{ $user['profile'] ?? 'N/A' }}</span></p>
                        <p>Status: <span class="status-badge {{ ($user['disabled'] ?? false) == 'true' ? 'status-disabled' : 'status-active' }}">
                            {{ ($user['disabled'] ?? false) == 'true' ? 'Disabled' : 'Active' }}
                        </span></p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user['name']) }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')

                    <!-- Username Field (Read-only) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i>
                            Username
                        </label>
                        <input type="text" value="{{ $user['name'] ?? '' }}" readonly
                               class="form-control readonly-field">
                        <small style="color: #666; font-size: 12px; margin-top: 5px; display: block;">Username tidak dapat diubah</small>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>
                            Password Baru
                        </label>
                        <div class="password-input-group">
                            <input type="password" id="password" name="password"
                                   placeholder="Kosongkan jika tidak ingin mengubah password"
                                   class="form-control" minlength="4" maxlength="32">
                            <button type="button" class="password-toggle-btn" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-toggle-icon"></i>
                            </button>
                        </div>
                        <div class="password-strength-container">
                            <div class="password-strength-bar">
                                <div id="password-strength" class="strength-fill"></div>
                            </div>
                            <span id="password-strength-text" class="strength-text">Kosongkan jika tidak ingin mengubah password</span>
                        </div>
                        <small style="color: #666; font-size: 12px; margin-top: 5px; display: block;">Minimal 4 karakter, maksimal 32 karakter</small>
                    </div>

                    <!-- Profile Selection -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user-tag"></i>
                            Profile
                        </label>
                        <select id="profile" name="profile" class="form-control" required>
                            <option value="">Pilih Profile</option>
                            @foreach ($profiles as $profile)
                                <option value="{{ $profile['name'] ?? $profile }}"
                                        {{ ($user['profile'] ?? '') == ($profile['name'] ?? $profile) ? 'selected' : '' }}>
                                    {{ $profile['name'] ?? $profile }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Current Info Summary -->
                    <div class="current-info-box">
                        <h4><i class="fas fa-info-circle"></i> Informasi Saat Ini</h4>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>User ID:</label>
                                <span>{{ $user['.id'] ?? 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <label>Uptime:</label>
                                <span>{{ $user['uptime'] ?? 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <label>Bytes In:</label>
                                <span>{{ formatBytes($user['bytes-in'] ?? 0) }}</span>
                            </div>
                            <div class="info-item">
                                <label>Bytes Out:</label>
                                <span>{{ formatBytes($user['bytes-out'] ?? 0) }}</span>
                            </div>
                            <div class="info-item">
                                <label>Login By:</label>
                                <span>{{ $user['login-by'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions-group">
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '-toggle-icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('password-strength');
            const strengthText = document.getElementById('password-strength-text');

            if (password.length === 0) {
                strengthBar.className = 'strength-fill';
                strengthText.textContent = 'Kosongkan jika tidak ingin mengubah password';
                return;
            }

            let strength = 0;

            // Length check
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;

            // Character variety
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;

            // Update strength indicator
            strengthBar.className = 'strength-fill';

            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Lemah';
            } else if (strength <= 4) {
                strengthBar.classList.add('strength-medium');
                strengthText.textContent = 'Sedang';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Kuat';
            }
        });

        // Form validation feedback
        const form = document.getElementById('editUserForm');
        form.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const profile = document.getElementById('profile').value;

            if (password && password.length < 4) {
                e.preventDefault();
                alert('Password minimal harus 4 karakter!');
                return false;
            }

            if (!profile) {
                e.preventDefault();
                alert('Silakan pilih profile!');
                return false;
            }
        });
    </script>
</body>

</html>
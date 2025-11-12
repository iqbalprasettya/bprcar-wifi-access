@extends('layouts.app')

@section('content')
<div class="portal-container">
    <!-- Animated Background -->
    <div class="bg-animated">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
            <div class="shape shape-6"></div>
        </div>
    </div>

    <!-- Wave Header -->
    <div class="wave-header">
        <div class="wave-content">
            <div class="header-content">
                <h1 class="header-title">
                    <i class="fas fa-user"></i>
                    Edit User Hotspot
                </h1>
                <p class="header-subtitle">Ubah pengaturan user {{ $user['name'] ?? 'Unknown' }}</p>
                <div class="header-stats">
                    <div class="stat-card">
                        <i class="fas fa-user-edit"></i>
                        <div class="stat-text">
                            <small>Mode Edit</small>
                                                            <strong>{{ $user['name'] ?? 'Unknown' }}</strong>
                                                    </div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-clock"></i>
                        <div class="stat-text">
                            <small>User ID</small>
                            <strong>{{ $user['.id'] ?? 'Unknown' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            <svg class="wave" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                <path fill="rgba(255,255,255,0.5)" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,218.7C672,235,768,245,864,234.7C960,224,1056,192,1152,181.3C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Breadcrumb Navigation -->
            <div class="breadcrumb-nav">
                <a href="{{ route('admin.active-users') }}" class="breadcrumb-item">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
                <span class="breadcrumb-separator">/</span>
                <a href="{{ route('admin.users') }}" class="breadcrumb-item">
                    <i class="fas fa-users"></i>
                    User Management
                </a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active">
                    <i class="fas fa-user-edit"></i>
                    Edit User
                </span>
            </div>

            <!-- Edit Form -->
            <div class="form-card edit-card">
                <div class="form-header">
                    <h3 class="form-title">
                        <i class="fas fa-user-edit"></i>
                        Edit User
                    </h3>
                    <div class="form-actions">
                        <a href="{{ route('admin.users') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>

                <!-- Current User Info -->
                <div class="user-info-preview">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <h4>{{ $user['name'] ?? 'Unknown' }}</h4>
                        <p>Profile: <span class="profile-badge">{{ $user['profile'] ?? 'N/A' }}</span></p>
                        <p>Status: <span class="status-badge {{ $user['disabled'] ?? false == 'true' ? 'status-disabled' : 'status-active' }}">
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

                <form action="{{ route('admin.users.update', $user['name']) }}" method="POST" class="modern-form" id="editUserForm">
                    @csrf
                    @method('PUT')

                    <!-- Username Field (Read-only) -->
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i class="fas fa-user"></i>
                            Username
                        </label>
                        <input type="text" id="username" value="{{ $user['name'] ?? '' }}" readonly
                               class="form-control readonly-field">
                        <small class="form-help">Username tidak dapat diubah</small>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">
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
                        <small class="form-help">Minimal 4 karakter, maksimal 32 karakter</small>
                    </div>

                    <!-- Profile Selection -->
                    <div class="form-group">
                        <label for="profile" class="form-label">
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
</div>

@if (!function_exists('formatBytes'))
    <?php
    function formatBytes($size, $precision = 2) {
        $base = log($size, 1024);
        $suffixes = ['', 'KB', 'MB', 'GB', 'TB'];
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
    ?>
@endif

<style>
/* Portal Container */
.portal-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow-x: hidden;
}

/* Animated Background */
.bg-animated {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    overflow: hidden;
}

.floating-shapes {
    position: absolute;
    width: 100%;
    height: 100%;
}

.shape {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border-radius: 50%;
    animation: float 20s infinite ease-in-out;
}

.shape-1 {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 10%;
    animation-delay: 2s;
}

.shape-3 {
    width: 100px;
    height: 100px;
    bottom: 20%;
    left: 30%;
    animation-delay: 4s;
}

.shape-4 {
    width: 60px;
    height: 60px;
    top: 40%;
    right: 30%;
    animation-delay: 6s;
}

.shape-5 {
    width: 90px;
    height: 90px;
    bottom: 30%;
    right: 20%;
    animation-delay: 8s;
}

.shape-6 {
    width: 110px;
    height: 110px;
    top: 10%;
    left: 50%;
    animation-delay: 10s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    25% { transform: translateY(-20px) rotate(90deg); }
    50% { transform: translateY(0px) rotate(180deg); }
    75% { transform: translateY(20px) rotate(270deg); }
}

/* Wave Header */
.wave-header {
    position: relative;
    padding: 60px 0 40px;
    background: linear-gradient(135deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.1) 100%);
}

.wave-content {
    position: relative;
    z-index: 2;
}

.header-content {
    text-align: center;
    color: white;
    animation: fadeInDown 0.8s ease;
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

.header-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.header-title i {
    margin-right: 15px;
}

.header-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 30px;
}

.header-stats {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.stat-card {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.15);
    padding: 15px 25px;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
}

.stat-card i {
    font-size: 1.5rem;
    margin-right: 15px;
    color: #ffd700;
}

.stat-text small {
    display: block;
    opacity: 0.8;
    font-size: 0.8rem;
}

.stat-text strong {
    font-size: 1rem;
}

.wave {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
}

/* Main Content */
.main-content {
    position: relative;
    z-index: 1;
    padding: 40px 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Breadcrumb Navigation */
.breadcrumb-nav {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    background: rgba(255,255,255,0.1);
    padding: 15px 20px;
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    animation: fadeIn 1s ease;
}

.breadcrumb-item {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: color 0.3s ease;
}

.breadcrumb-item:hover {
    color: white;
}

.breadcrumb-item.active {
    color: white;
    font-weight: 600;
}

.breadcrumb-separator {
    margin: 0 12px;
    color: rgba(255,255,255,0.6);
}

.breadcrumb-item i {
    margin-right: 8px;
}

/* Form Card */
.form-card {
    background: rgba(255,255,255,0.95);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    animation: slideUp 0.8s ease;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px 30px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.form-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.form-title i {
    margin-right: 10px;
}

.btn-back {
    background: rgba(255,255,255,0.2);
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    transform: translateX(-3px);
}

.btn-back i {
    margin-right: 8px;
}

/* User Info Preview */
.user-info-preview {
    display: flex;
    align-items: center;
    padding: 30px;
    background: rgba(0,0,0,0.05);
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.user-avatar {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 25px;
    color: white;
    font-size: 2rem;
    box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
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
}

.profile-badge {
    background: #4CAF50;
    color: white;
    padding: 3px 10px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-badge {
    padding: 3px 10px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-active {
    background: #4CAF50;
    color: white;
}

.status-disabled {
    background: #f44336;
    color: white;
}

/* Form Styles */
.modern-form {
    padding: 30px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: flex;
    align-items: center;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    font-size: 0.9rem;
}

.form-label i {
    margin-right: 8px;
    color: #667eea;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e3e8ee;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8fafc;
}

.form-control:focus {
    border-color: #667eea;
    outline: none;
    background: white;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
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
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.password-toggle-btn:hover {
    color: #667eea;
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
    font-size: 0.8rem;
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
}

.current-info-box h4 i {
    margin-right: 8px;
    color: #667eea;
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
}

.info-item span {
    color: #333;
    font-weight: 600;
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

.btn {
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    font-family: inherit;
}

.btn i {
    margin-right: 8px;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

.btn-secondary {
    background: #64748b;
    color: white;
}

.btn-secondary:hover {
    background: #475569;
    transform: translateY(-1px);
}

/* Alert */
.alert {
    margin: 20px 30px;
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
    .header-title {
        font-size: 2rem;
    }

    .header-stats {
        gap: 15px;
    }

    .stat-card {
        padding: 12px 20px;
        flex-direction: column;
        text-align: center;
    }

    .stat-card i {
        margin-right: 0;
        margin-bottom: 8px;
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

    .breadcrumb-nav {
        flex-wrap: wrap;
        gap: 5px;
    }

    .container {
        padding: 0 15px;
    }

    .modern-form {
        padding: 20px;
    }

    .user-info-preview {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .header-title {
        font-size: 1.8rem;
    }

    .form-card {
        border-radius: 15px;
    }

    .form-control {
        padding: 12px 15px;
    }

    .btn {
        padding: 10px 20px;
        font-size: 0.85rem;
    }
}
</style>

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

// Add ripple effect to buttons
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255,255,255,0.5);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;

        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    });
});

// Add ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
</style>
@endsection
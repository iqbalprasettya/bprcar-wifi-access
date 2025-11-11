<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Login Internet BPR</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
            padding: 40px 35px;
            animation: slideUp 0.5s ease-out;
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

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #06b6d4 100%);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .logo-circle svg {
            width: 45px;
            height: 45px;
            fill: white;
        }

        h2 {
            color: #1e3a8a;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        .input-icon svg {
            width: 20px;
            height: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        button[type="submit"] {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #06b6d4 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .error-message {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 14px;
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
            color: #94a3b8;
            font-size: 12px;
            margin-top: 25px;
        }

        @media (max-width: 480px) {
            .container {
                padding: 30px 25px;
            }

            h2 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo-section">
            <div class="logo-circle">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                    <path
                        d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                </svg>
            </div>
            <h2>Selamat Datang</h2>
            <p class="subtitle">Portal Internet BPR CAR</p>
        </div>

        <form method="post" action="{{ route('portal.submit') }}">
            @csrf
            <input type="hidden" name="mac" value="{{ $mac ?? '' }}">
            <input type="hidden" name="ip" value="{{ $ip ?? '' }}">
            <input type="hidden" name="dst" value="{{ $dst ?? 'http://google.com' }}">

            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required
                        autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit">
                Masuk ke Internet
            </button>
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

        <p class="footer-text">
            © {{ date('Y') }} BPR CAR. Gunakan kredensial yang valid.
        </p>
    </div>
</body>

</html>

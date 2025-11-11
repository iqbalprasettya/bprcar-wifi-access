<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mengaktifkan Internet…</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
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
            padding: 50px 35px;
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .loader-wrapper {
            margin-bottom: 30px;
        }

        .loader {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            position: relative;
        }

        .loader-circle {
            width: 100%;
            height: 100%;
            border: 4px solid #e2e8f0;
            border-top-color: #4e73df;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .wifi-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .wifi-icon svg {
            width: 35px;
            height: 35px;
            fill: #4e73df;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        h1 {
            color: #1e3a8a;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .message {
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .dots {
            display: inline-block;
            width: 20px;
        }

        .dots span {
            animation: blink 1.4s infinite;
            animation-fill-mode: both;
        }

        .dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes blink {
            0% {
                opacity: 0.2;
            }
            20% {
                opacity: 1;
            }
            100% {
                opacity: 0.2;
            }
        }

        .info-text {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 20px;
        }

        @media (max-width: 480px) {
            .container {
                padding: 40px 25px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="loader-wrapper">
            <div class="loader">
                <div class="loader-circle"></div>
                <div class="wifi-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M1.371 8.143c5.858-5.857 15.356-5.857 21.213 0a.75.75 0 010 1.061l-.53.53a.75.75 0 01-1.06 0c-4.98-4.979-13.053-4.979-18.032 0a.75.75 0 01-1.06 0l-.53-.53a.75.75 0 010-1.06zm3.182 3.182c4.1-4.1 10.749-4.1 14.85 0a.75.75 0 010 1.061l-.53.53a.75.75 0 01-1.062 0 8.25 8.25 0 00-11.667 0 .75.75 0 01-1.06 0l-.53-.53a.75.75 0 010-1.06zm3.204 3.182a6 6 0 018.486 0 .75.75 0 010 1.061l-.53.53a.75.75 0 01-1.061 0 3.75 3.75 0 00-5.304 0 .75.75 0 01-1.06 0l-.53-.53a.75.75 0 010-1.061zm3.182 3.182a1.5 1.5 0 012.122 0 .75.75 0 010 1.061l-.53.53a.75.75 0 01-1.061 0l-.53-.53a.75.75 0 010-1.061z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <h1>Mengaktifkan Koneksi</h1>
        <p class="message">
            Mohon tunggu, kami sedang menghubungkan Anda ke internet<span class="dots"><span>.</span><span>.</span><span>.</span></span>
        </p>

        <p class="info-text">Jangan tutup halaman ini...</p>
    </div>

    <!-- Form auto-submit ke MikroTik -->
    <form id="loginForm" method="post" action="http://login.bprcar.local/login" style="display:none;">
        <input type="hidden" name="username" value="{{ $username }}">
        <input type="hidden" name="password" value="{{ $password }}">
        <input type="hidden" name="dst" value="{{ $dst }}">
    </form>

    <script>
        // Auto submit form
        document.getElementById('loginForm').submit();
    </script>
</body>
</html>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Berhasil</title>
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
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 440px;
            padding: 50px 40px;
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1cc88a 0%, #10b981 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: checkmark 0.5s ease-out 0.3s both;
        }

        @keyframes checkmark {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-icon svg {
            width: 45px;
            height: 45px;
            fill: white;
        }

        h1 {
            color: #4e73df;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .message {
            color: #5a5c69;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 35px;
        }

        .login-btn {
            display: inline-block;
            padding: 16px 40px;
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.25);
            text-decoration: none;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 115, 223, 0.35);
        }

        .login-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(78, 115, 223, 0.25);
        }

        .info-text {
            color: #858796;
            font-size: 13px;
            margin-top: 30px;
        }

        @media (max-width: 480px) {
            .container {
                padding: 40px 30px;
            }

            h1 {
                font-size: 24px;
            }

            .message {
                font-size: 14px;
            }

            .login-btn {
                padding: 14px 32px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="success-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                    clip-rule="evenodd" />
            </svg>
        </div>

        <h1>Logout Berhasil!</h1>
        <p class="message">
            Anda telah berhasil keluar dari jaringan internet. Terima kasih telah menggunakan layanan kami.
        </p>

        <a href="http://login.bprcar.local/" class="login-btn">
            Login Kembali
        </a>

        <p class="info-text">
            © {{ date('Y') }} BPR CAR. Sampai jumpa kembali!
        </p>
    </div>
</body>

</html>

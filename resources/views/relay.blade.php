<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mengaktifkan Internet…</title>
</head>
<body>
    <p>Mengaktifkan koneksi internet Anda, mohon tunggu...</p>
    <form id="mk" method="post" action="http://login.bprcar.local/login">
        <input type="hidden" name="username" value="{{ $username }}">
        <input type="hidden" name="password" value="{{ $password }}">
        <input type="hidden" name="dst" value="{{ $dst ?? 'http://google.com' }}">
        <input type="hidden" name="popup" value="true">
    </form>
    <script>
        document.getElementById('mk').submit();
    </script>
    <noscript>
        <button onclick="document.getElementById('mk').submit()">Klik untuk lanjut</button>
    </noscript>
</body>
</html>

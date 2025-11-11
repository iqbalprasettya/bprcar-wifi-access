<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Login Internet BPR</title>
</head>

<body>
    <h2>Portal Login Internet BPR</h2>
    <form method="post" action="{{ route('portal.submit') }}">
        @csrf
        <input type="hidden" name="mac" value="{{ $mac ?? '' }}">
        <input type="hidden" name="ip" value="{{ $ip ?? '' }}">
        <input type="hidden" name="dst" value="{{ $dst ?? 'http://google.com' }}">
        <div><input name="username" placeholder="Username" required></div>
        <div><input type="password" name="password" placeholder="Password" required></div>
        <button type="submit">Login</button>
    </form>

    @if ($errors->any())
        <div style="color: red; margin-top: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>

</html>

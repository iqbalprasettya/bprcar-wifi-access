<form method="post" action="{{ route('portal.submit') }}">
    @csrf
    <input type="hidden" name="mac" value="{{ $mac }}">
    <input type="hidden" name="ip" value="{{ $ip }}">
    <input type="hidden" name="dst" value="{{ $dst }}">
    <input name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

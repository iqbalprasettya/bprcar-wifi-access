<form id="mk" method="post" action="http://login.bprcar.local/login">
    <input type="hidden" name="username" value="{{ $username }}">
    <input type="hidden" name="password" value="{{ $password }}">
    <input type="hidden" name="dst" value="{{ $dst }}">
    <input type="hidden" name="popup" value="true">
</form>
<script>
    document.getElementById('mk').submit();
</script>

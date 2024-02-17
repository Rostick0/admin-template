<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!-- <script src="https://yastatic.net/s3/passport-sdk/autofill/v1/sdk-suggest-token-with-polyfills-latest.js"></script> -->
    <title>My Admin</title>
</head>

<body>
    <noscript>
        <strong>We're sorry but doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <!-- @if (Session::has('token_auth'))
        <script>
            localStorage.setItem('access_token', {{ '`' . Session::get('token_auth') . '`' }});
        </script>
    @endif -->
    <div id="app"></div>
    @vite('resources/js/app.js')
</body>

</html>
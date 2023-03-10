<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>

    <meta name="description" content="{{ config('app.tagline') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">

    <meta name="theme-color" content="#282828">
    <meta name="msapplication-navbutton-color" content="#282828">

    <base href="{{ asset('') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}"/>
    <meta name="msapplication-config" content="{{ asset('browserconfig.xml') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('img/cmkbinza.png') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('img/cmkbinza.png') }}">
    <link rel="apple-touch-icon" type="image/png" href="{{ asset('img/cmkbinza.png') }}">

    <script>
        // Work around for "global is not defined" error with local-storage.js
        window.global = window
    </script>
</head>
<body>
<div id="app"></div>

<noscript>It may sound funny, but Koel requires JavaScript to sing. Please enable it.</noscript>

<script>
    window.BASE_URL = @json(asset(''));
    window.PUSHER_APP_KEY = @json(config('broadcasting.connections.pusher.key'));
    window.PUSHER_APP_CLUSTER = @json(config('broadcasting.connections.pusher.options.cluster'));
</script>

@stack('scripts')
</body>
</html>

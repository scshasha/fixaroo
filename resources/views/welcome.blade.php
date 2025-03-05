<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="/css/app.css" />
</head>
<body>
<div class="welcome flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="getting-started-links top-right">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ url('ticket/create') }}">Create a Ticket</a>
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif

    <div class="content text-center">
        <div class="hero-intro-text m-b-md">
            <i class="fa fa-ticket"></i><br />{{ env('APP_NAME', 'Laravel') }}<span class="dot-style"></span>
        </div>
        <div class="hero-tagline-text">
            <p>{{ env('APP_TAGLINE', 'Laravel') }}</p>
        </div>
        @auth
        @else
            <p class="muted">Hey there! Please <a href="{{ route('login') }}">log in</a> to get started.</p>
            <p class="muted">New around here? No worries! <a href="{{ route('register') }}">Sign up</a> in just a few clicks.</p>
        @endauth
    </div>
</div>
<script src="/js/app.js"></script>
</body>
</html>

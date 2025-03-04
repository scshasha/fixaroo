<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="{{ url('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff !important;
                color: #636b6f !important;
                font-family: 'Raleway', sans-serif !important;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh !important;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute !important;
                right: 10px !important;
                top: 18px !important;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px !important;
                letter-spacing: 5px !important;
            }

            .links >  a {
                color: #636b6f !important;
                padding: 0 25px !important;
                font-size: 12px !important;
                font-weight: 600 !important;
                letter-spacing: .1rem !important;
                text-decoration: none !important;
                text-transform: uppercase !important;
            }

            .m-b-md {
                margin-bottom: 30px !important;
            }
            .dot-style {
                color: #f90347 !important;
            }
            
            .muted {
                font-size: .737em !important;
            }

            .muted a, .btn-link {
                color: #636b6f !important;
            }

            .subtitle {
                margin-top: -1em !important;
                margin-bottom: 5em !important;
                letter-spacing: 2px !important;
            }
            
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('ticket/create') }}">Add Ticket</a>
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <i class="fa fa-ticket"></i><br />{{ env('APP_NAME', 'Laravel app') }}<span class="dot-style"></span>
                </div>
                <div class="subtitle">
                    <p>{{ env('APP_TAGLINE', 'Laravel app tagline) }}</p>
                </div>
                @auth
                @else
                    <p class="muted">Hey there! Please <a href="{{ route('login') }}">log in</a> to get started.</p>
                    <p class="muted">New around here? No worries! <a href="{{ route('register') }}">Sign up</a> in just a few clicks.</p>
                @endauth
            </div>
        </div>
    </body>
</html>

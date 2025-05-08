{{--<nav class="navbar full-width w-100">--}}
    @if(Route::has('login'))
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
{{--</nav>--}}

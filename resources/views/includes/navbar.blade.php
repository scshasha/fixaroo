<nav class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar bg-dark p-0">
    <a href="{{ url('/') }}" class="navbar-brand mr-4"><i class="fa fa-ticket mr-md-2"></i>fixaroo<span class="dot-style"></span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/home') }}">Home</a>
            </li>
        </ul>
        @auth
        <ul class="navbar-nav ml-md-auto mt-2 navbar-top-links pull-right">
            <li id="dropdown-user" class="dropdown nav-item">
                <a href="#" class="dropdown-toggle text-right nav-item mr-md-2 p-2" id="bd-profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="pull-right"> <img src="{{ url('img/user.png') }}" class="img-circle img-user media-object" alt="Profile Picture"> </span>
                    <div class="username hidden-xs">{{ ucfirst(Auth::user()->name) }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right with-arrow">
                    <!-- User dropdown menu -->
                    <ul class="head-list">
                        <li>
                            <a class="dropdown-item" href="{{ url('ticket/create') }}"> <i class="fa fa-plus fa-fw"></i> Create Ticket </a>
                        </li>
                        <li>
                            @if (Auth::user()->is_admin === 1)
                            <a class="dropdown-item" href="{{ url('admin/tickets') }}">  <i class="fa fa-ticket fa-fw"></i> All Tickets </a>
                            @else
                            <a class="dropdown-item" href="{{ url('/tickets') }}">  <i class="fa fa-ticket fa-fw"></i> All Tickets </a>
                            @endif
                        </li>
                        <!-- <li>
                            <a class="dropdown-item" href="#">  <i class="fa fa-gear fa-fw"></i> Settings </a>
                        </li> -->
                        <div class="divider"></div>
                        <li>
                            <form class="" method="POST" action="{{ route('logout') }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-link dropdown-item"> <i class="fa fa-sign-out fa-fw"></i> Logout </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        @else
            @if (Route::has('login'))
            <ul class="navbar-nav pull-right">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            </ul>
            @endif
        @endauth
        
    </div>
</nav>
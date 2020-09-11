<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ env('APP_NAME') }} &bull; @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-overrides.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- <script src="{{ asset('js/jquery-latest.min.js') }}"></script> -->
    <script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.js') }}"></script>
    <style>

        html,body {
            font-size: 85%;
        }
        
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .navbar.navbar-dark.shadow.sticky-top {
            padding: 0em 1em !important;
        }
        .img-user {
            border-radius: 50% !important;
        }
    </style>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

    @include('includes.navbar')
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin') }}">
                            <span data-feather="home"></span>
                            <i class="fa fa-dashboard"></i>
                            Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('categories') }}">
                            <span data-feather="file"></span>
                            <i class="fa fa-gear"></i>
                            Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/tickets') }}">
                            <span data-feather="file"></span>
                            <i class="fa fa-ticket"></i>
                            Tickets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <span data-feather="shopping-cart"></span>
                            <i class="fa fa-inbox"></i>
                            Comments
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Manage</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <div class="divider"></div>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="users"></span>
                                <i class="fa fa-users fa-per"></i>
                                Agents
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            @if (session('status'))
                @include('includes.alert.alert-success')
            @endif
            @yield('content')
            </main>
        </div>
    </div>


    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
 

     <!--jQuery [ REQUIRED ]-->
     <script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script>
        $('.navbar-dark').addClass('sticky-top shadow');

        $('a.nav-link').on('click', (e) => {
            const navLinks = window.document.querySelectorAll('.nav-link');
            console.log(navLinks);
            navLinks.forEach((item) => {
                item.classList.remove("active");
            });
            e.currentTarget.classList.add("active");
        });
    </script>
</body>
</html>

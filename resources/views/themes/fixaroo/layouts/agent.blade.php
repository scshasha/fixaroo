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
    <style>

        html,body {
            font-size: 90%;
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

        table#ticket_list_tbl .fa {
            color: #eeeeee !important;
            transition: .5s ease-in-out;
        }
        table#ticket_list_tbl .fa:hover {
            color: #eaeaea !important;
        }

        .alert-success {
            background-color: #dceccb;
        }

        .alert button.close {
            top: 23%;
        }

        strong {
            font-weight: 700 !important;
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
                            <a class="nav-link" href="{{ url('dashboard') }}">
                            <span data-feather="home"></span>
                            <i class="fa fa-dashboard"></i>
                            Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('tickets') }}">
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
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            @yield('content')
            </main>
        </div>
    </div>

    

</body>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/tinymce/tinymce.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>

<script src="/plugins/popper/js/popper-1.16.0.min.js"></script>

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

    $('[data-toggle="tooltip"]').tooltip();

</script>

</html>

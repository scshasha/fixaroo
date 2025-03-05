@include('includes.header.header')
    <div class="position-ref full-height">
        @include('includes.navbar')                        
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
@include('includes.footer.footer')


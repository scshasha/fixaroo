<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('title', 'Welcome')</title>

    <!-- Load CSS -->
    <link rel="stylesheet" href="{{ mix('themes/fixaroo-base/css/app.css') }}">
</head>
<body>
<!-- Include Navbar -->
@include('themes::fixaroo-base.components.navbar')

<!-- Main Content -->
<div class="container">
    @yield('content')
</div>

<!-- Include Footer -->
@include('themes::fixaroo-base.partials.footer')

<!-- Load Combined JS -->
<script src="{{ mix('themes/fixaroo-base/js/all.js') }}"></script>
</body>
</html>
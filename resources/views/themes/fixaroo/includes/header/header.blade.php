<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }} &bull; @yield('title')</title>
        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        
        <!--Bootstrap Stylesheet [ REQUIRED ]-->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!--Dashboard Stylesheet [ REQUIRED ]-->
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style-overrides.css') }}" rel="stylesheet">
        <!--Font Awesome [ OPTIONAL ]-->
        <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <!--Switchery [ OPTIONAL ]-->
        <link href="{{ asset('plugins/switchery/switchery.min.css') }}" rel="stylesheet">
        <!--Bootstrap Select [ OPTIONAL ]-->
        <link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">
        <!-- <link href="{{ asset('plugins/tag-it/jquery.tagit.css') }}" rel="stylesheet"> -->
        <!--Bootstrap Table [ OPTIONAL ]-->
        <link href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet">


        <!-- Scripts -->
        <script src="{{ asset('js/jquery-latest.min.js') }}"></script>
        <script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
        <!-- Tinymce Editor -->
        <script src="{{ asset('plugins/tinymce/tinymce.js') }}"></script>

    </head>
    <body>
        <!-- <div class="hidded" id="spinner"></div> -->
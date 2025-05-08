@extends('themes::fixaroo-base.layouts.app')

@section('title', 'Home')

@section('content')
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
@endsection
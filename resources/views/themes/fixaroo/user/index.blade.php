@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Profile</strong></div>

                <div class="panel-body">
                    @if (session('status'))
                        @include('includes.alert-success')
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

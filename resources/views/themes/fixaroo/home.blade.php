@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Dashboard</strong></div>

                <div class="panel-body">
                    @if (session('status'))
                        @include('includes.alert.alert-success')
                    @endif
                    <p>See all assigned <a href="{{ url('tickets') }}">tickets</a> or <a href="{{ url('ticket/create') }}">open a new ticket</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

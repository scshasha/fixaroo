@extends('layouts.admin')

@section('title', $ticket->title)


@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2 mt-0">{{ $ticket->title }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
    </div>

    <!-- <div class="container"> -->
        <div class="row">
            <!-- <div class="col-md-12"> -->
                <div class="panel panel-default w-100 ml-3 mr-3">
                    <div class="panel-body">
                        @if (session('status'))
                            @include('includes.alert.alert-success')
                        @endif
                        <div class="ticket-data">
                            <table class="table table-stripped table-striped">
                                <tbody>
                                    <tr>
                                        <td>Title</td>
                                        <td>{!! $ticket->title !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Content</td>
                                        <td>{{ $ticket->message }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><span class="label @if ($ticket->status === 'Open') {{ 'label-success' }}@else{{ 'label-danger' }}@endif">{{ $ticket->status }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td><a href="#" style="text-decoration: underline; color: rgba(0,0,0,0.6);">{{ ucfirst($ticket->author_name) }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>E-Mail</td>
                                        <td><a href="#" style="text-decoration: underline; color: rgba(0,0,0,0.6);">{{ ucfirst($ticket->author_email) }}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Created On</td>
                                        <td>{{ $ticket->created_at->diffForHumans() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="clear clear-both" style="width: 99%;padding: 15px;margin: 25px auto;"></div>
                        </div>
                        @if (!$comments->isEmpty())
                        <div id="comments" class="comments nano-content pad-all">
                            <h4 class="sec-title"><span>Comments&nbsp;<span class="badge badge-dark">{{ count($comments) }}</span></span></h4>
                            @foreach ($comments as $comment)
                            <ul class="list-unstyled media-block">
                                <li class="mar-btm">
                                    <div class="@if(Auth::user()->id === $comment->user_id) {{'media-right'}}@else{{'media-left'}}@endif">
                                        <img src="@if ($comment->user_id < 4) {{ url('img/av'.$comment->user_id.'.png') }}@else{{ url('img/user.png') }}@endif" alt="{{ $comment->user->name }}" class="img-responsive img-circle img-sm" />
                                    </div>
                                    <div class="media-body pad-hor @if(Auth::user()->id === $comment->user_id) {{'speech-right'}}@else{{'speech-left'}}@endif">
                                        <div class="speech">
                                            <a href="#" class="media-heading">{{ ucfirst($comment->user->name) }}</a>
                                            <span class="media-meta speech-time"><small>{{ $comment->created_at->diffForHumans() }}</small></span>
                                            <p>
                                                {!! $comment->comment !!}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @endforeach
                        </div>
                        @endif
                        <div class="comment-form">
                            <form class="form" method="POST" action="{{ url('/comment') }}">
                                {!! csrf_field() !!}
                                <h4 class="sec-title">
                                    <span>Leave a Comment</span>
                                </h4>
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    <textarea name="comment" id="comment" rows="5" class="form-control" @if($ticket->status === "Closed") {{ 'disabled' }}@endif></textarea>
                                    @if ($errors->has('comment'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right" @if($ticket->status === "Closed") {{ 'disabled' }}@endif>Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    <!-- </div> -->
@endsection
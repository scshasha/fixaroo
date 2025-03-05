@extends('layouts.app')

@section('title', 'Add Ticket')

@section('content')
    <div class="container">
        <div class="row">
        <!-- col-md-6 m-auto -->
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default mt-5">
                    <div class="panel-heading muted"><strong>Add ticket</strong></div>
                    <div class="panel-body">
                        @if (session('status'))
                            @include('includes.alert.alert-success')
                        @endif
                        <form action="{{ url('/ticket/create') }}" method="post" role="form">
                            {!! csrf_field() !!}


                            <div class="form-group{{ $errors->has('author_name') ?  ' has-error':'' }}">
                                    <input type="text" id="author_name" name="author_name" value="{{ old('author_name') }}" class="form-control" placeholder="Your Name" required />
                                    @if ($errors->has('author_name'))
                                        <span class="help-block text-danger bg-danger">
                                            <strong>{{ $errors->first('author_name') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('author_email') ?  ' has-error':'' }}">
                                    <input type="email" id="author_email" name="author_email" value="{{ old('author_email') }}" class="form-control" placeholder="Your E-mail" required />
                                    @if ($errors->has('author_email'))
                                        <span class="help-block text-danger bg-danger">
                                            <strong>{{ $errors->first('author_email') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('title') ?  ' has-error':'' }}">
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" placeholder="Title" required />
                                    @if ($errors->has('title'))
                                        <span class="help-block text-danger bg-danger">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                            </div>



                            <div class="form-group{{ $errors->has('message') ?  ' has-error':'' }}">
                                    <textarea name="message" id="message" rows="6" class="form-control" placeholder="Content"></textarea>
                                    @if ($errors->has('message'))
                                        <span class="help-block text-danger bg-danger">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">

                                    <button type="submit" class="btn btn-primary btn-sm pull-right">
                                        Create
                                    </button>
                                    <button type="reset" class="btn btn-link pull-right">
                                        Clear
                                    </button>
                            </div>
                            
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.admin')

@section('title', 'Edit Ticket')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2 mt-0">{{ $ticket->title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group">
            <form action="{{ url('admin/tickets/close/'.$ticket->ticket_id) }}" method="POST">
                {!! csrf_field() !!}
                <button class="btn btn-lg btn-outline-success btn-icon icon-lg fa fa-check add-tooltip ml-2" data-placement="top" data-toggle="tooltip" data-original-title="Resolve Ticket" type="submit">
                </button>
            </form>
            <form action="{{ url('admin/tickets/remove/'.$ticket->ticket_id) }}" method="POST">
                {!! csrf_field() !!}
                <button class="btn btn-lg btn-outline-danger btn-icon icon-lg fa fa-trash add-tooltip ml-2" data-placement="top" data-toggle="tooltip" data-original-title="Delete Ticket" type="submit">
                </button>
            </form>
        </div>
    </div>
</div>

@if (session('status'))
    @include('includes.alert.alert-success')
@endif

<div class="row">
    <div class="panel panel-default w-100 ml-3 mr-3">
        <div class="panel-body">
        <form action="{{ url('/admin/tickets/update') }}" method="post" role="form">
            {!! csrf_field() !!}

            <table class="table">
                <tr>
                    <td>Author Name</td>
                    <td>
                        <div class="form-group{{ $errors->has('author_name') ?  ' has-error':'' }}">
                            <input type="text" id="author_name" name="author_name" value="{{ $ticket->author_name }}" class="form-control" placeholder="Your Name" disabled />
                            @if ($errors->has('author_name'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('author_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Author E-mail</td>
                    <td>
                        <div class="form-group{{ $errors->has('author_email') ?  ' has-error':'' }}">
                            <input type="email" id="author_email" name="author_email" value="{{ $ticket->author_email }}" class="form-control" placeholder="Your E-mail" disabled />
                            @if ($errors->has('author_email'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('author_email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>

                <!-- <tr>
                    <td>Reference #</td>
                    <td>
                        <div class="form-group{{ $errors->has('ticket_id') ?  ' has-error':'' }}"> -->
                            <input type="text" id="ticket_id" name="ticket_id" value="{{ $ticket->ticket_id }}" class="form-control" hidden />
                            @if ($errors->has('ticket_id'))
                                <!-- <span class="help-block text-danger">
                                    <strong>{{ $errors->first('ticket_id') }}</strong>
                                </span> -->
                            @endif
                        <!-- </div>
                    </td>
                </tr> -->
                

                <tr>
                    <td>Category</td>
                    <td>
                       <div class="form-group{{ $errors->has('category_id') ? ' has-error': '' }}">
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $key => $category)
                                    <option value="{{ $category->id }}" @if($category->id === $ticket->category_id) {{ 'selected' }}@endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>  
                    </td>
                </tr>
                <tr>
                    <td>Priority</td>
                    <td>
                        <div class="form-group{{ $errors->has('priority') ? ' has-error':'' }}">
                            <select name="priority" id="priority" class="form-control">
                                @if($ticket->priority == null) {!! '<option value="" selected>Select Priority</option>' !!}@endif
                                <option value="low" @if (strtolower($ticket->priority) === 'low') {{ 'selected="true"' }}@endif>Low</option>
                                <option value="medium" @if (strtolower($ticket->priority) === 'medium') {{ 'selected="true"' }}@endif>Medium</option>
                                <option value="high" @if (strtolower($ticket->priority) === 'high') {{ 'selected="true"' }}@endif>High</option>
                            </select>
                            @if ($errors->has('priority'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('priority') }}</strong>
                                </span>
                            @endif
                        </div>                        
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <div class="form-group{{ $errors->has('status') ? ' has-error':'' }}">
                            <select name="status" id="status" class="form-control">
                                @if($ticket->status == null) {!! '<option value="" selected>Select status</option>' !!}@endif
                                <option value="Open" @if (strtolower($ticket->status) === 'open') {{ 'selected="true"' }}@endif>Open</option>
                                <option value="Close" @if (strtolower($ticket->status) === 'close') {{ 'selected="true"' }}@endif>Close</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>                        
                    </td>
                </tr>
                <tr>
                    <td>Assigned Agent</td>
                    <td>
                        <div class="form-group{{ $errors->has('user_id') ? ' has-error':'' }}">
                            <select name="user_id" id="user_id" class="form-control">
                                @if($ticket->user_id == null) {!! '<option value="" selected>Assign to Agent</option>' !!}@endif
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" @if($agent->id === $ticket->user_id) {{ 'selected' }}@endif>{{ $agent->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('user_id') }}</strong>
                                </span>
                            @endif
                        </div>                        
                    </td>
                </tr>

                <tr>
                    <td>Title</td>
                    <td>
                        <div class="form-group{{ $errors->has('title') ?  ' has-error':'' }}">
                            <input type="text" id="title" name="title" value="{{ $ticket->title }}" class="form-control" placeholder="title" disabled />
                            @if ($errors->has('title'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Message</td>
                    <td>
                        <div class="form-group{{ $errors->has('message') ?  ' has-error':'' }}">
                            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Content" required>{!! $ticket->message !!}</textarea>
                            @if ($errors->has('message'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm pull-right">
                                Update
                            </button>
                            <button type="reset" class="btn btn-link pull-right">
                                Clear
                            </button>
                        </div>
                    </td>
                </tr>
            </table>            
        </form>

        </div>
    </div>
</div>
@endsection
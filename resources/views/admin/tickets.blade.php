@extends('layouts.admin')

@section('title', 'Tickets')

@section('content')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2 mt-0">Tickets</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
</div>

@if (session('status'))
    @include('includes.alert.alert-success')
@endif

<div class="row">
<div class="panel bg-light mr-3 ml-3 w-100">
    <div class="panel-body">
        @if (!$tickets->isEmpty())
        <table class="table table-striped" id="ticket_list_tbl">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th colspan="4"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td><a href="{{ url('tickets/'.$ticket->ticket_id) }}">#{{ $ticket->ticket_id }} - {{ $ticket->title }}</a></td>
                    <td>
                        @foreach($categories as $category)
                            @if ($category->id === $ticket->category_id) {!! '<span class="label label-default">'.$category->name.'</span>' !!}@endif
                        @endforeach
                    </td>
                    <td>
                        <span class="label label-@if(strtolower($ticket->priority) === 'high'){{ 'danger' }}@elseif(strtolower($ticket->priority) === 'medium'){{ 'warning' }}@else{{ 'info' }}@endif">{{ ucfirst($ticket->priority) }}</span>
                    </td>
                    <td><span class="label @if (strtolower($ticket->status) === 'open') {{ 'label-success' }}@else{{ 'label-danger' }}@endif">{{ $ticket->status }}</span></td>
                    <td>
                        <a href="{{ url('tickets/'.$ticket->ticket_id) }}" class="btn btn-xs btn-mint btn-icon icon-lg fa fa-comment-o add-tooltip" data-placement="auto" data-toggle="tooltip" data-original-title="Leave a commment">
                        
                        </a>
                    </td>
                    <td>
                        <a href="{{ url('admin/tickets/edit/'.$ticket->ticket_id) }}" class="btn btn-xs btn-warning btn-icon icon-lg fa fa-edit add-tooltip"  data-placement="auto" data-toggle="tooltip" data-original-title="Edit Ticket">
                        
                        </a>
                    </td>
                    <td>
                        <form action="{{ url('admin/tickets/close/'.$ticket->ticket_id) }}" method="POST">
                            {!! csrf_field() !!}
                            <button class="btn btn-xs btn-success btn-icon icon-lg fa fa-check add-tooltip"  data-placement="auto" data-toggle="tooltip" data-original-title="Resolve Ticket" type="submit">
                            
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ url('admin/tickets/remove/'.$ticket->ticket_id) }}" method="POST">
                            {!! csrf_field() !!}
                            <button class="btn btn-xs btn-danger btn-icon icon-lg fa fa-trash add-tooltip"  data-placement="auto" data-toggle="tooltip" data-original-title="Delete Ticket" type="submit">
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tickets->render() }}
        @else
        <p class="text-center">There are currently no ticekts.</p>
        @endif
    </div>
</div>
</div>
<!-- 
                    <div class="panel-body">
                       @if ($tickets->isEmpty())
                            <p>There are currently no tickets.</p>
                        @else
                            <table class="table striped stripped" id="ticket-list">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Last Updated</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>
                                                @foreach ($categories as $category)
                                                    @if ($category->id === $ticket->category_id)
                                                        {{ $category->name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ url('tickets/'.$ticket->ticket_id) }}">
                                                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                                </a>
                                            </td>
                                            <td>
                                                @if ($ticket->status === 'Open')
                                                    <span class="label label-success">{{ $ticket->status }}</span>
                                                @else
                                                    <span class="label label-danger">{{ $ticket->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$ticket->update_at)
                                                    {{ $ticket->updated_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('tickets/'.$ticket->ticket_id) }}" class="btn btn-primary btn-xs">
                                                    Comment
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ url('admin/tickets/close/'.$ticket->ticket_id) }}" method="POST">
                                                    {!! csrf_field() !!}
                                                    <button class="btn btn-danger btn-xs" type="submit">Close</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $tickets->render() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> -->
@endsection
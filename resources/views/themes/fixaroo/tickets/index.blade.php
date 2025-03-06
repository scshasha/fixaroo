@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default mt-5">
                    <div class="panel-heading muted"><strong>Support tickets</strong></div>
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
    </div>
@endsection
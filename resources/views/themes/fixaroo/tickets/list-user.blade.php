@extends('layouts.app')

@section('title', 'Support Tickets')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default mt-5">
                    <div class="panel-heading muted"><strong>Support tickets</strong></div>
                    <div class="panel-body">
                        @if ($tickets->isEmpty())
                            <p class="p paragraph">You have not created any tickets.</p>
                        @else
                            <table class="table striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Last Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>
                                                <a href="{{ url('tickets/'.$ticket->ticket_id) }}">
                                                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                                </a>
                                            </td>
                                            <td>
                                                @foreach ($categories as $category)
                                                    @if ($category->id === $ticket->category_id)
                                                        {{ $category->name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($ticket->status === 'Open')
                                                    <span class="label label-success">{{ $ticket->status }}</span>
                                                @else
                                                    <span class="label label-danger">{{ $ticket->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $ticket->update_at }}
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
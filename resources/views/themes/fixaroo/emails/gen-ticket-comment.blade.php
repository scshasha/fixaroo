@component('mail::message')

<p>
    {!! $ticketComment !!}
</p>

--- <br>
<p>Reply by: {{ $replyBy }}</p>
<p>Title: {{ $ticketTitle }}</p>
<p>Status: {{ $ticketStatus }}</p>

@component('mail::button', ['url' => $ticketUri])
{{ $ticketUrlText }}
@endcomponent

Thanks,<br>
---<br><br>
{{ config('app.name') }} team
@endcomponent
@component('mail::message')
Hello,<br>
A ticket has been assigned to you. View the ticket with the link below.
@component('mail::button', ['url' => $uri])
View Ticket
@endcomponent

Thanks,<br>
---<br>
{{ config('app.name') }} team
@endcomponent
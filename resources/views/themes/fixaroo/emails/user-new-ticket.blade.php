@component('mail::message')
Hello,<br>
Your ticket has been successfully created and we will be in touch. use the link below to check the tickets progress.
@component('mail::button', ['url' => $uri])
View Ticket
@endcomponent

Thanks,<br>
---<br>
{{ config('app.name') }} team
@endcomponent
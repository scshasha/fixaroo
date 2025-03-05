@component('mail::message')
Hello,<br>
A new ticket has been created.
@component('mail::button', ['url' => $uri])
Login
@endcomponent
</div>

Thanks,<br>
---<br>
{{ config('app.name') }} team
@endcomponent
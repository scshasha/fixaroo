@component('mail::message')

<p>Welcome {{ ucfirst($contactName) }},</p><br>

<p>Your user account has been created. Below are the login details you have created:</p>
<hr>
<strong>Username:</strong>: {{ $loginUsername }}<br />
<strong>Password:</strong>: {{ $loginPassword }}

@component('mail::button', ['url' => $loginUri])
{{ $loginUrlText }}
@endcomponent

Thanks,<br>
---<br><br>
{{ config('app.name') }} team
@endcomponent
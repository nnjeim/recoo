@component('mail::message')
@component('mail::panel')
Hello {{ $user->name }},
<br>
<br>
Please click the button below to verify your email address.
<br>
<br>
@component('mail::button', ['url' => $verificationUrl, 'color' => 'primary'])
Verify Email Address
@endcomponent
<br>
If you did not create an account, no further action is required.
<br><br>
Thank you,<br>
The Emmy Awards Team
<br>
<hr>
<p style="margin: 0;"><small>If you’re having trouble clicking the "Verify Email Address " button, copy and paste the URL below into your web browser</small></p>
<p style="margin: 0; font-size: 10px; max-width: 480px;"><small>{{ $verificationUrl }}</small></p>
@endcomponent
@endcomponent

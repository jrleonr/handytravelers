@component('mail::message')
# Hi {{ $user->first_name }},

You’ll need to confirm your email address before you can travel or host people. Once your email address is confirmed, yo can start using Handytravelers.

Click the "Confirm my Email" button to complete the confirmation process.

@component('mail::button', ['url' => 'https://handytravelers.com/en/confirm/' . $user->token ])
Confirm your Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

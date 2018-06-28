@component('mail::message')
# Hey 

{{ $user->first_name }} has cancelled your invitation to {{ $invitation->placeName() }}.

@component('mail::panel')
{{ str_limit($invitation->lastMessage(), 150) }}
@endcomponent

@component('mail::button', ['url' => route('invitation.show', [$invitation->uuid]), 'color' => 'green'])
Go to Handytravelers
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

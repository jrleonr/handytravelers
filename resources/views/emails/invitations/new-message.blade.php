@component('mail::message')
# Hey!

{{ $user->first_name }} sent you have a new message for your Invitation in {{ $invitation->placeName() }}.

@component('mail::panel')
{{ $invitation->lastMessage() }}
@endcomponent

@component('mail::button', ['url' => route('invitation.show', [$invitation->uuid]), 'color' => 'green'])
Go to Handytravelers
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

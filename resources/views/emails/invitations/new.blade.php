@component('mail::message')

Hi {{ $invitation->request->user->first_name }},

{{ $invitation->user->first_name }} has sent you an invitation for your request to {{ $invitation->request->place->name }}

@component('mail::panel')
{{ str_limit($invitation->lastMessage(), 150) }}
@endcomponent

@component('mail::button', ['url' => route('invitation.show', [$invitation->uuid] )])
Response now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

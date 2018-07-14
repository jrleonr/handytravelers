@component('mail::message')
# Hey!

{{ $user->first_name }} sent you have a new message for your request in {{ $request->placeName() }}.

@component('mail::panel')
{{ $request->lastMessage() }}
@endcomponent

@component('mail::button', ['url' => route('request.show', [$request->uuid]), 'color' => 'green'])
Go to Handytravelers
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

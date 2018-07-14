@component('mail::message')
# Good news!

{{ $user->first_name }} Accepted your request to {{ $request->placeName() }}.

@component('mail::panel')
{{ str_limit($request->lastMessage(), 150) }}
@endcomponent


@component('mail::button', ['url' => route('request.show', [$request->uuid]), 'color' => 'green'])
Go to Handytravelers
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

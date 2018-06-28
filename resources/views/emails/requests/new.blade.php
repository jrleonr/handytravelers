@component('mail::message')

Hi {{ $name }},

{{ $request->user->first_name }} is looking for a place to stay in your city. This is 
the requests, feel free to invite this traveler to your home if you like. If you decide to ignore
this request, {{ $name }}, will never know that. Just invite people over your place when you like 
the request.

Thanks for being part of this traveler community, you make Handytravelers a great place.

@component('mail::table')
| From | To | Nights | People | 
| ------------- |:-------------:| --------:| --------:|
| {{ $request->check_in->format('l jS \\of F')  }} | {{ $request->check_out->format('l jS \\of F')  }} | {{ $request->check_in->diffInDays($request->check_out) }} | {{ $request->people }} | 

@endcomponent

@component('mail::panel')
{{ str_limit($request->body, 150) }}
@endcomponent

@component('mail::button', ['url' => route('request.show', [$request->uuid]), 'color' => 'green'])
Go to the Request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

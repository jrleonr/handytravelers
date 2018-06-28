@component('mail::message')
# Hola {{ $user->first_name }},

Necesitas confirmar tu cuenta de correo electrónico antes de poder viajar o alojar a viajeros. Una vez tu cuenta de email esté confirmada podrás utilizar Handytravelers.

Haz click en el botón que dice "Confirmar mi Email" para completar el proceso.

@component('mail::button', ['url' => 'https://handytravelers.com/es/confirmar/' . $user->token ])
Confirmar mi Email
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent

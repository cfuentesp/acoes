<x-mail::message>
# {{$body['header']}}

{{$body['cuerpo']}}

@component('mail::button', ['url' => $body['urlapb'], 'color' => 'success'])
Aprobar solicitud
@endcomponent

@component('mail::button', ['url' => $body['urlrch'], 'color' => 'error'])
Rechazar solicitud
@endcomponent

Saludos cordiales,<br>
{{ config('app.name') }}
</x-mail::message>

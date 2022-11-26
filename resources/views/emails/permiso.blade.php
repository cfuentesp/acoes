<x-mail::message>
<h2 style="font-weight: bold; text-align:center;">{{$body['header']}}</h2>

# Tipo de permiso
{{$body['tipo']}}

# Solicitante
{{$body['solicitante']}}

# Descripcion de solicitud
{{$body['descripcion']}}

# Fecha de inicio del permiso
{{$body['inicio']}}

# Fecha final del permiso
{{$body['final']}}

@component('mail::button', ['url' => $body['urlapb'], 'color' => 'success'])
Aprobar solicitud
@endcomponent

@component('mail::button', ['url' => $body['urlrch'], 'color' => 'error'])
Rechazar solicitud
@endcomponent

Saludos cordiales,<br>
{{ config('app.name') }}
</x-mail::message>

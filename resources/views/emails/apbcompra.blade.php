<x-mail::message>
<h2 style="font-weight: bold; text-align:center;">{{$body['header']}}</h2>

# Descripción de la falla del equipo
{{$body['falla']}}

# Solución al problema del equipo
{{$body['solucion']}}

# Cotización del equipo requerido
{{$body['cotizacion']}}

# Numero de equipo
{{$body['equipo']}}

@component('mail::button', ['url' => $body['urlapb'], 'color' => 'success'])
Aprobar solicitud
@endcomponent

@component('mail::button', ['url' => $body['urlrch'], 'color' => 'error'])
Rechazar solicitud
@endcomponent

Saludos cordiales,<br>
{{ config('app.name') }}
</x-mail::message>

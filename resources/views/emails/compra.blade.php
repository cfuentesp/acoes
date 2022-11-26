<x-mail::message>
<h2 style="font-weight: bold; text-align:center;">{{$body['header']}}</h2>

# Descripcion de la solicitud
{{$body['descripcion']}}

# Solucion al problema del equipo
{{$body['solucion']}}

# Cotizacion del equipo requerido
{{$body['cotizacion']}}

Saludos cordiales,<br>
{{ config('app.name') }}
</x-mail::message>

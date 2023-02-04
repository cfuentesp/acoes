<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table, th, td {
  border: 1px solid;
}
    </style>
</head>
<body>
    <div style="text-align: center;">
    <img style="width:350px; height:200px; text-align: center;" src="{{ asset('images/acoes.png') }}" alt="">
    </div>
    <h2 style="text-align: center;">Reporte de permisos laborales</h2>
    <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
        <tr>
            <th>Solicitante</th>
            <th>Tipo de solicitud</th>
            <th>Fecha de solicitud</th>
            <th>Fecha de inicio</th>
            <th>Fecha final</th>
            <th>Indicador de solicitud</th>
        </tr>
        @foreach($permisos as $item)
        <tr>
            <td>{{$item->PERSONA}}</td>
            <td>{{$item->TIP_SOLICITUD}}</td>
            <td>{{date("d/m/Y", strtotime($item->FEC_SOLICITUD))}}</td>
            <td>{{date("d/m/Y", strtotime($item->FEC_INICIO))}}</td>
            <td>{{date("d/m/Y", strtotime($item->FEC_FINAL))}}</td>
            <td>{{$item->IND_SOLICITUD}}</td>
        </tr>
        @endforeach
    </table>
    <footer>

    </footer> 
</body>
</html>
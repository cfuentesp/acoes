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
    <h2 style="text-align: center;">Reporte de solicitudes de compras</h2>
    <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
        <tr>
            <th>Numero de equipo</th>
            <th>Descripcion de solicitud</th>
            <th>Fecha de solicitud</th>
            <th>Indicador de solicitud</th>
        </tr>
        @foreach($compras as $item)
        <tr>
            <td>{{$item->NUM_EQUIPO}}</td>
            <td>{{$item->DES_SOLICITUD}}</td>
            <td>{{date("d/m/Y", strtotime($item->FEC_SOLICITUD))}}</td>
            <td>{{$item->IND_SOLICITUD}}</td>
        </tr>
        @endforeach
    </table>
    <footer>

    </footer> 
</body>
</html>
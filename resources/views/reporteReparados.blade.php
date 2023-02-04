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
    <h2 style="text-align: center;">Reporte de equipos reparados</h2>
    <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
        <tr>
            <th>Tipo de equipo</th>
            <th>Marca de equipo</th>
            <th>Serie de equipo</th>
            <th>Numero de equipo</th>
            <th>Ingreso a manenimiento</th>
            <th>Salida de mantenimiento</th>
        </tr>
        @foreach($equipos as $item)
        <tr>
            <td>{{$item->TIP_EQUIPO}}</td>
            <td>{{$item->MRC_EQUIPO}}</td>
            <td>{{$item->MDL_SERIE}}</td>
            <td>{{$item->NUM_EQUIPO}}</td>
            <td>{{date("d/m/Y", strtotime($item->FEC_INGRESO))}}</td>
            <td>{{date("d/m/Y", strtotime($item->FEC_SALIDA))}}</td>
        </tr>
        @endforeach
    </table>
    <footer>

    </footer> 
</body>
</html>
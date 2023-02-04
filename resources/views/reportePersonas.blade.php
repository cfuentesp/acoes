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
    <h2 style="text-align: center;">Reporte de personas</h2>
    <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Rol</th>
            <th>Identidad</th>
            <th>Fecha de nacimiento</th>
            <th>Referencia</th>
            <th>Numero referencia</th>
            <th>Correo</th>
        </tr>
        @foreach($personas as $item)
        <tr>
            <td>{{$item->NOM_PERSONA}}</td>
            <td>{{$item->APLL_PERSONA}}</td>
            <td>{{$item->ROL_PERSONA}}</td>
            <td>{{$item->NUM_IDENTIDAD}}</td>
            <td>{{date("d/m/Y", strtotime($item->FEC_NACIMIENTO))}}</td>
            <td>{{$item->DES_REF_PERSONA}}</td>
            <td>{{$item->NUM_REF_PERSONA}}</td>
            <td>{{$item->COR_PERSONA}}</td>
        </tr>
        @endforeach
    </table>
    <footer>

    </footer> 
</body>
</html>
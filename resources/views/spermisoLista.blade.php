@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Lista de Permisos Laborales</h1>
</div>
<div class='card-body'>
    <form action="{{route('nuevoPermiso')}}" method="GET">
      <div>
          <button type="submit" class="btn btn-primary float-right">Agregar nuevo Permiso Laboral</button>
          <br>
          <br>
      </div>
   </form>
    <br>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix">
            <div class="table-responsive">
                <table class="table user-list">
                    <thead>
                        <tr>
                            <th><span>Tipo de Solicitud</span></th>
                            <th><span>Descripcion</span></th>
                            <th><span>Fecha de Solicitud</span></th>
                            <th><span>Fecha de Inicio</span></th>
                            <th><span>Fecha Final</span></th>
                            <th><span>Estado de Solicitud</span></th>
                            <th><span>Justificacion Solicitud</span></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Permiso[0] as $item)
                        <tr>
                            <td>
                                <span class="user-subhead">{{$item['TIP_SOLICITUD']}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{$item['DES_SOLICITUD']}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{$item['FEC_SOLICITUD']}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{$item['FEC_INICIO']}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{$item['FEC_FINAL']}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{$item['IND_FINAL']}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{$item['JST_SOLICITUD']}}</span>
                            <td>
                              <td style="width: 20%;">
                                <a href="{{route('editarPermiso',$item['COD_SOL_PERMISO'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                                <a href="{{route('eliminarPermiso',$item['COD_SOL_PERMISO'])}}" class="table-link danger">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                              </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Aprobaciónes de compra</h1>
</div>
<div class='card-body'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix">
            <div class="table-responsive">
                <input class="form-control" style="width:500px;" id="myInput" type="text" placeholder="Buscar..">
				<br>
                <table id="myTable" class="table user-list">
                    <thead>
                        <tr>
                            <th><span>Numero de equipo</span></th>
                            <th><span>Fecha Solicitud</span></th>
                            <th><span>Estado Solicitud</span></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos[0] as $item)
                        <tr>
                            <td>
                                <span class="user-subhead">{{$item['NUM_EQUIPO']}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{date("Y-m-d", strtotime($item['FEC_SOLICITUD']))}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{$item['IND_SOLICITUD']}}</span>
                            </td>
                            <td>
                              <td style="width: 20%;">
                                <a href="{{route('editarAprobacion',$item['COD_SOL_APB_COMPRA'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                                <a href="{{route('eliminarAprobacion',$item['COD_SOL_APB_COMPRA'])}}" class="table-link danger">
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
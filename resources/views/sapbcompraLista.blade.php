@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Lista de aprobación de compra</h1>
</div>
<div class='card-body'>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">**Dispositivos revisados**</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{route('abrirNuevaAprobacion')}}" method="GET">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
                <div class="form-group">
                  <div class="form-group">
                    <label for="exampleFormControlSelect12">Seleccione un dispositivo</label>
                    <select class="form-control selectpicker" data-live-search="true" id="cod_reparacion" name="cod_reparacion" value="{{old('COD_REPARACION')}}">
                      @foreach ($equipos as $item)
                       <option value="{{$item['COD_REPARACION']}}">{{'Numero de equipo: '.$item['NUM_EQUIPO']}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Seleccionar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
        <div>
          <button type="buttom" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Agregar nueva aprobación de compra</button>
            <br>
            <br>
        </div>
    <br>
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
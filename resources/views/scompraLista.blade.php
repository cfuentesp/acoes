@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Solicitudes de compra</h1>
</div>
<div class='card-body'>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Solicitudes de compra aprobadas </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{route('abrirNuevaCompra')}}" method="GET">
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
                    <label for="exampleFormControlSelect12">Seleccione una solicitud aprobada</label>
                    <select class="form-control selectpicker" data-live-search="true" id="cod_solicitud" name="cod_solicitud" value="{{old('cod_solicitud')}}">
                      <option selected>{{""}}</option>
                      @foreach ($solicitudes as $item)
                       <option value="{{$item['COD_SOL_APB_COMPRA']}}">{{'Numero de equipo: '.$item['NUM_EQUIPO'].'  Estado de solicitud: '.$item['IND_SOLICITUD'] }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              @if($solicitudes)
              <button type="submit" class="btn btn-primary">Seleccionar</button>
              @endif
            </div>
          </form>
          </div>
        </div>
      </div>
        <div>
          <button type="buttom" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Agregar nueva solicitud de Compra</button>
            <br>
            <br>
        </div>
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
                            <th><span>Fecha solicitud</span></th>
                            <th><span>Estado Solicitud</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compras[0] as $item)
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
                                <a href="{{route('editarCompra',$item['COD_SOL_COMPRA'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                                <a href="{{route('eliminarCompra',$item['COD_SOL_COMPRA'])}}" class="table-link danger">
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
<script>
	$(document).ready(function(){
	  $("#myInput").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	  });
	});
	</script>
@endsection

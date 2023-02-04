@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Permisos laborales</h1>
</div>
<div class='card-body'>
@if ($errors->any())
        <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Generar reporte de permisos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<form action="{{route('generarReportePermisoEXCEL')}}" method="GET">
            <div class="modal-body">
			<div class="row">
		<div class="col">
         <label>Fecha desde</label>
		 <input type="date" name="fecha_desde" class="form-control" value="{{old('fecha_desde')}}">
		</div>
		<div class="col">
		<label>Fecha hasta</label>
		 <input type="date" name="fecha_hasta" class="form-control" value="{{old('fecha_hasta')}}">
		</div>
	</div>
            </div>
            <div class="modal-footer">            
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success">Generar</button>
			  </form>
            </div>
          </div>
        </div>
      </div>
        <div>
          <button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Generar reporte de excel</button>
            <br>
            <br>
        </div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Generar reporte de permisos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<form action="{{route('generarReportePermisoPDF')}}" method="GET">
            <div class="modal-body">
			<div class="row">
		<div class="col">
         <label>Fecha desde</label>
		 <input type="date" name="fecha_desde" class="form-control" value="{{old('fecha_desde')}}">
		</div>
		<div class="col">
		<label>Fecha hasta</label>
		 <input type="date" name="fecha_hasta" class="form-control" value="{{old('fecha_hasta')}}">
		</div>
	</div>
            </div>
            <div class="modal-footer">            
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Generar</button>
			  </form>
            </div>
          </div>
        </div>
      </div>
        <div>
          <button type="buttom" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Generar reporte PDF</button>
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
                            <th><span>Solicitante</span></th>
                            <th><span>Fecha de Solicitud</span></th>
                            <th><span>Estado de Solicitud</span></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permisos as $item)
                        <tr>
                            <td>
                                <span class="user-subhead">{{$item['NOM_PERSONA'].' '.$item['APLL_PERSONA']}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{date("Y-m-d", strtotime($item['FEC_SOLICITUD']))}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{$item['IND_SOLICITUD']}}</span>
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

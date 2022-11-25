@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Lista de permisos laborales</h1>
</div>
<div class='card-body'>
    <form action="{{route('abrirNuevoPermiso')}}" method="GET">
      <div>
          <button type="submit" class="btn btn-primary float-right">Solicitar nuevo permiso</button>
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
                            </td>
                              <td style="width: 20%;">
                                <a href="{{route('editarPermisos',$item['COD_SOL_PERMISO'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                                <a href="{{route('eliminarPermisos',$item['COD_SOL_PERMISO'])}}" class="table-link danger">
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

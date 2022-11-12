@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Lista de Compra</h1>
</div>
<div class='card-body'>
    <form action="{{route('abrirNuevaCompra')}}" method="GET">
      <div>
          <button type="submit" class="btn btn-primary float-right">Agregar nuevo Compra</button>
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
                            <th><span>Fecha de la Solicitud</span></th>
                            <th><span>Descripcion</span></th>
                            <th><span>Estado Solicitud</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compras[0] as $item)
                        <tr>
                            <td>
                                <span class="user-subhead">{{$item['FEC_SOLICITUD']}}</span>
                            </td>
                            <td>
                                <span class="user-subhead">{{$item['DES_SOLICITUD']}}</span>
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

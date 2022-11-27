@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Lista de equipos reparados</h1>
</div>
<div class='card-body'>
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
							<th><span>Area de equipo</span></th>
							<th><span>Estado</span></th>
							<th><span>Fecha de ingreso</span></th>
                            <th><span>Fecha de salida</span></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($datos as $item)
						<tr>
							<td>
								<span class="user-subhead">{{$item['NUM_EQUIPO']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['ARA_SOLICITUD']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['EST_EQUIPO']}}</span>
							</td>
							<td>
                                <span class="user-subhead">{{date("Y-m-d", strtotime($item['FEC_INGRESO_MANT']))}}</span>
							</td>
							<td>
                                <span class="user-subhead">{{date("Y-m-d", strtotime($item['FEC_SALIDA']))}}</span>
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
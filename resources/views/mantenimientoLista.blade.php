@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Equipos en mantenimiento</h1>
</div>
<div class='card-body'>
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
							<th><span>Descripcion De Falla</span></th>
                            <th><span>Estado Del Equipo</span></th>
                            <th><span>Fecha De Ingreso</span></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($equipos as $item)
						<tr>
							<td>
								<span class="user-subhead">{{$item['DES_FALLA']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['EST_EQUIPO']}}</span>
							</td>
							<td>
                                <span class="user-subhead">{{$item['FEC_INGRESO']}}</span>
							</td>
							  <td style="width: 20%;">
							  	<a href="{{route('editarMantenimiento',$item['COD_REPARACION'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
							  	<a href="{{route('eliminarMantenimiento',$item['COD_REPARACION'])}}" class="table-link danger">
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
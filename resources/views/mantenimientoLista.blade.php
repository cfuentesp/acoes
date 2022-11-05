@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Registros de mantenimiento</h1>
</div>
<div class='card-body'>
    <form action="{{route('nuevoMantenimiento')}}" method="GET">
      <div>
          <button type="submit" class="btn btn-primary float-right">Agregar registro de mantenimiento</button>
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
							<th><span>Descripcion De Falla</span></th>
							<th><span>Solucion Del Problema</span></th>
                            <th><span>Estado Del Equipo</span></th>
                            <th><span>Fecha De Ingreso</span></th>
							<th><span>Fecha De Salida</span></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($mante[0] as $item)
						<tr>
							<td>
								<span class="user-subhead">{{$item['DES_FALLA']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['SOL_PROBLEMA']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['EST_EQUIPO']}}</span>
							</td>
							<td>
                                <span class="user-subhead">{{$item['FEC_INGRESO']}}</span>
							</td>
							<td>
                                <span class="user-subhead">{{$item['FEC_SALIDA']}}</span>
							</td>
							  <td style="width: 20%;">
							  	<a href="{{route('editarMantenimiento',$item['COD_MANTENIMIENTO'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
							  	<a href="{{route('editarMantenimiento',$item['COD_MANTENIMIENTO'])}}" class="table-link danger">
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
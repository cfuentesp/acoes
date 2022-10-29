@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Lista de equipos</h1>
</div>
<div class='card-body'>
    <form action="{{route('nuevoEquipo')}}" method="GET">
      <div>
          <button type="submit" class="btn btn-primary float-right">Agregar nuevo equipo</button>
          <br>
          <br>
      </div>
   </form>
    <br>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	@if (session('mensaje'))
	    <div class="alert alert-success">{{session('mensaje')}}</div>	
	@endif
<div class="container">
<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="table-responsive">
				<table class="table user-list">
					<thead>
						<tr>
							<th><span>Numero equipo</span></th>
							<th><span>Tipo de equipo</span></th>
                            <th><span>Marca</span></th>
                            <th><span>Modelo/serie</span></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($equipos[0] as $item)
						<tr>
							<td>
								<span class="user-subhead">{{$item['NUM_EQUIPO']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['TIP_EQUIPO']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['MRC_EQUIPO']}}</span>
							</td>
							<td>
                                <span class="user-subhead">{{$item['MDL_SERIE']}}</span>
							</td>
							  <td style="width: 20%;">
							  	<a href="{{route('editarEquipo',$item['COD_EQUIPO'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
							  	<a href="{{route('eliminarEquipo',$item['COD_EQUIPO'])}}" class="table-link danger">
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

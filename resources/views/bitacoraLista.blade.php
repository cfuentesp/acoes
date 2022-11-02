@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Lista de Observacion de Mejora Continua</h1>
</div>
<div class='card-body'>
    <form action="{{route('nuevaObservacion')}}" method="GET">
      <div>
          <button type="submit" class="btn btn-primary float-right">Agregar nueva Observacion</button>
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
							<th><span>Descripcion de la Observacion</span></th>
							<th><span>Fecha de la Observacion</span></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($observaciones[0] as $item)
						<tr>
							<td>
								<span class="user-subhead">{{$item['DES_OBSERVACION']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['FEC_OBSERVACION']}}</span>
							</td>
							</td>
							  <td style="width: 20%;">
							  	<a href="{{route('editarObservacion',$item['COD_BIT_MEJORA'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
							  	<a href="{{route('eliminarObservacion',$item['COD_BIT_MEJORA'])}}" class="table-link danger">
							  		<span class="fa-stack">
							  			<i class="fa fa-square fa-stack-2x"></i>
							  			<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
							  		</span>
							  	</a>
							  </td>
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
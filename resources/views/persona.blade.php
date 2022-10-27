@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Registros de personas</h1>
</div>
<div class='card-body'>
    <form action="{{route('nuevoPersona')}}" method="GET">
      <div>
          <button type="submit" class="btn btn-primary float-right">Nueva Persona</button>
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
							<th><span>Nombres</span></th>
                            <th><span>Apellidos</span></th>
							<th><span>DNI/#Identidad </span></th>
                            <th><span>Correo </span></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($personas[0] as $item)
						<tr>
							<td>
								<span class="user-subhead">{{$item['NOM_PERSONA']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['APLL_PERSONA']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['NUM_IDENTIDAD']}}</span>
							</td>
                            <td>
                                <span class="user-subhead">{{$item['COR_PERSONA']}}</span>
							</td>
							  <td style="width: 20%;">
							  	<a href="{{route('editarPersona',$item['COD_PERSONA'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
							  	<a href="{{route('editarPersona',$item['COD_PERSONA'])}}" class="table-link danger">
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
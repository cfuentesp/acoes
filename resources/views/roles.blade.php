@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Roles</h1>
</div>
<div class='card-body'>
    <form action="{{route('agregarNuevoRol')}}" method="GET">
      <div>
          <button type="submit" class="btn btn-primary float-right">Agregar nuevo rol</button>
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
							<th><span>Nombre rol</span></th>
							<th><span>Descripcion</span></th>
                            <th><span>Creado el</span></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($roles as $item)
						<tr>
							<td>
								<span class="user-subhead">{{$item['name']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['description']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['created_at']}}</span>
							</td>
							  <td style="width: 20%;">
							  	<a href="{{route('getListaPermisos',[$item['name'],$item['id']])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
							  	{{-- <a href="" class="table-link danger">
							  		<span class="fa-stack">
							  			<i class="fa fa-square fa-stack-2x"></i>
							  			<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
							  		</span>
							  	</a> --}}
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

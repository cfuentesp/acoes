@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Correos de solicitudes</h1>
</div>
<div class='card-body'>
    <br>
    <br>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="table-responsive">
				<br>
				<table id="myTable" class="table user-list">
					<thead>
						<tr>
							<th><span>Tipo de correo</span></th>
							<th><span>Correo</span></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($correos[0] as $item)
						<tr>
							<td>
								<span class="user-subhead">{{$item['TIP_CORREO']}}</span>
							</td>
							<td>
								<span class="user-subhead">{{$item['CORREO']}}</span>
							</td>
							</td>
							  <td style="width: 20%;">
							  	<a href="{{route('editarCorreo',$item['COD_CORREO'])}}" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
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
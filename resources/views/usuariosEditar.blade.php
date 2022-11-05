@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar Usuarios</h1>
</div>
<div class='card-body'>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      @if (session('mensaje'))
	      <div class="alert alert-success alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>{{session('mensaje')}}</div>	
	    @endif
    <form action="{{route('agregarUsuarioRol')}}" method="GET">
         <div>
             <button type="submit" class="btn btn-primary float-right">Agregar nuevo rol</button>
         </div>
     </form>
    <div class="mb-3">
        <div class="row">
          <div class="col">
            <input type="text" readonly class="form-control" placeholder="Nombre" value="{{$item['name']}}">
          </div>
          <div class="col">
            <input type="text" readonly class="form-control" placeholder="Email" value="{{$item['email']}}">
          </div>
        </div>
      </div>
</div>
@endsection
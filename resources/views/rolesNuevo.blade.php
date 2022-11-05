@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Agregar nuevo rol</h1>
</div>
<div class='card-body'>
<form action="{{ route('insertarNuevoRol') }}" method="POST">
    @csrf
    @method('PUT')
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
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="nombre_rol" class="form-control" placeholder="Nombre del rol">
          </div>
          <div class="col">
            <input type="text" name="descripcion" class="form-control" placeholder="Descripcion">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar role</button>
          </div>
        </div>
    </form>
</div>
@endsection
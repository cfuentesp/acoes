@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Agregar nuevo equipo</h1>
</div>
<div class='card-body'>
<form action="{{ route('agregarEquipo') }}" method="POST">
    @csrf
    @method('PUT')
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
         </ul>
       </div>
     @endif
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="tipo_equipo" class="form-control" placeholder="Tipo de equipo" value="{{old('tipo_equipo')}}">
          </div>
          <div class="col">
            <input type="text" name="marca_equipo" class="form-control" placeholder="Marca del equipo" value="{{ old('marca_equipo') }}">
          </div>
        </div>
      </div>
     <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="modelo_serie" class="form-control" placeholder="Modelo/serie" value="{{ old('modelo_serie') }}">
          </div>
          <div class="col">
            <input type="text" name="especificaciones" class="form-control" placeholder="Especificaciones tecnicas" value="{{ old('especificaciones') }}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="color_equipo" class="form-control" placeholder="Color de quipo" value="{{ old('color_equipo') }}">
          </div>
          <div class="col">
            <input type="number" name="numero_equipo" class="form-control" placeholder="Numero de equipo" value="{{ old('numero_equipo') }}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="date" name="fecha_ingreso" class="form-control" placeholder="Fecha de ingreso" value="{{ old('fecha_ingreso') }}">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar equipo</button>
          </div>
        </div>
    </form>
</div>
@endsection
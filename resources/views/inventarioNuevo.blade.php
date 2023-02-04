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
            <label for="exampleFormControlSelect12">Tipo de equipo</label>
            <input type="text" name="tipo_equipo" class="form-control"  value="{{old('tipo_equipo')}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Marca del equipo</label>
            <input type="text" name="marca_equipo" class="form-control" value="{{ old('marca_equipo') }}">
          </div>
        </div>
      </div>
     <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Modelo/serie</label>
            <input type="text" name="modelo_serie" class="form-control"  value="{{ old('modelo_serie') }}">
            <br>
            <label for="exampleFormControlSelect12">Color del equipo</label>
            <input type="text" name="color_equipo" class="form-control" value="{{ old('color_equipo') }}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Especificaciones tecnicas</label>
            <textarea type="text" name="especificaciones" rows="5" class="form-control">{{ old('especificaciones') }}</textarea>
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso') }}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Numero de equipo</label>
            <input type="number" name="numero_equipo" class="form-control" value="{{ old('numero_equipo') }}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar equipo</button>
          </div>
        </div>
    </form>
</div>
@endsection
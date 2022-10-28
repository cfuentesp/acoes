@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
<form action="{{route('agregarEquipo')}}" method="POST">
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
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="tipo_equipo" class="form-control" placeholder="Tipo de equipo">
          </div>
          <div class="col">
            <input type="text" name="marca_equipo" class="form-control" placeholder="Marca del equipo">
          </div>
        </div>
      </div>
     <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="modelo_serie" class="form-control" placeholder="Modelo/serie">
          </div>
          <div class="col">
            <input type="text" name="especificaciones" class="form-control" placeholder="Especificaciones tecnicas">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="color_equipo" class="form-control" placeholder="Color de quipo">
          </div>
          <div class="col">
            <input type="number" name="numero_equipo" class="form-control" placeholder="Numero de equipo">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="date" name="fecha_ingreso" class="form-control" placeholder="Fecha de ingreso">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar equipo</button>
          </div>
        </div>
    </form>
</div>
@endsection
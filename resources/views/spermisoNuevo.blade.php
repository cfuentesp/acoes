@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
<form action="{{ route('agregarEquipo') }}" method="POST">
    @csrf
    @method('POST')
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
            <input type="text" name="tipo_solicitud" class="form-control" placeholder="Tipo de solicitud">
          </div>
          <div class="col">
            <input type="text" name="descripcion_solicitud" class="form-control" placeholder="Descripcion">
          </div>
        </div>
      </div>
     <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="fecha_solicitud" class="form-control" placeholder="Fecha Solicitud">
          </div>
          <div class="col">
            <input type="text" name="Inicio_solicitud" class="form-control" placeholder="Inicio Permiso">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="final_solicitud" class="form-control" placeholder="Finalizo Permiso">
          </div>
          <div class="col">
            <input type="number" name="Estado_solicitud" class="form-control" placeholder="Estado Solicitud">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="date" name="justifiacion_solicitud" class="form-control" placeholder="Justificacion de Solicitud">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar Permisos Laborales</button>
          </div>
        </div>
    </form>
</div>
@endsection

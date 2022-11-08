@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Agregar nuevo permiso laboral</h1>
</div>
<div class='card-body'>
<form action="{{ route('agregarPermiso') }}" method="POST">
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
            <label for="exampleFormControlSelect12">Tipo de permiso</label>
            <input type="text" name="tipo_solicitud" class="form-control" placeholder="Tipo de solicitud">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion</label>
            <input type="text" name="descripcion" class="form-control" placeholder="Descripcion">
          </div>
        </div>
      </div>
     <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de solicitud</label>
            <input type="date" name="fecha_solicitud" class="form-control" placeholder="Fecha Solicitud">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de inicio</label>
            <input type="date" name="inicio_permiso" class="form-control" placeholder="Inicio Permiso">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha final</label>
            <input type="date" name="final_permiso" class="form-control" placeholder="Finalizo Permiso">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar permiso</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection

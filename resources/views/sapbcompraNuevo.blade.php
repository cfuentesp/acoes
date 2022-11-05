@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
<form action="{{ route('agregarAprobacionC') }}" method="POST">
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
            <input type="text" name="cotizacion_equipo" class="form-control" placeholder="Cotizacion del Equipo">
          </div>
          <div class="col">
            <input type="text" name="fecha_solicitud" class="form-control" placeholder="Fecha de Solicitud">
          </div>
        </div>
      </div>
     <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" name="estado_solicitud" class="form-control" placeholder="Estado de la Solicitud">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar equipo</button>
          </div>
        </div>
    </form>
</div>
@endsection

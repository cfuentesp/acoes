@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar datos de Aprobación de Compra</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarAprobacionC', $equipo[0]['COD_AprobacionC']) }}" method="POST">
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
    <div class="mb-3">
        <div class="row">
          <div class="col">
            <input type="text" name="cotizacion_equipo" class="form-control" placeholder="Cotizacion del Equipo" value="{{$equipo[0]['COZ_EQUIPO']}}">
          </div>
          <div class="col">
            <input type="text" name="fecha_solicitud" class="form-control" placeholder="Fecha de la Solicitud" value="{{$equipo[0]['FEC_SOLICITUD']}}">
          </div>
        </div>
      </div>
      <div  class="mb-3">
        <div class="row">
          <div class="col">
            <input type="text" name="estado_solicitud" class="form-control" placeholder="Estado de la Solicitud" value="{{$equipo[0]['IND_SOLICITUD']}}">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection

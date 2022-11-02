@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar datos de bitacora de mejora  continua</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarObservacion', $observacion[0]['COD_BIT_MEJORA']) }}" method="POST">
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
            <input type="text" name="descripcion_observacion" class="form-control" placeholder="Descripcion de la observacion de mejora" value="{{$observacion[0]['DES_OBSERVACION']}}">
          </div>
          <div class="col">
            <input type="text" name="fecha_observacion" class="form-control" placeholder="Fecha de la observacion" value="{{$observacion[0]['FEC_OBSERVACION']}}">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar Observacion</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection
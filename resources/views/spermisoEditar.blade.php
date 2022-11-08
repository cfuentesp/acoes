@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar datos de Permiso Laboral</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarPermisos', $permiso[0]['COD_SOL_PERMISO']) }}" method="POST">
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
            <label for="exampleFormControlSelect12">Tipo de permiso</label>
            <input type="text" name="tipo_solicitud" class="form-control" placeholder="Tipo de Solicitud" value="{{$permiso[0]['TIP_SOLICITUD']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion</label>
            <input type="text" name="descripcion" class="form-control" placeholder="Descripcion" value="{{$permiso[0]['DES_SOLICITUD']}}">
          </div>
        </div>
      </div>
      <div  class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de solicitud</label>
            <input type="text" name="fecha_solicitud" class="form-control" placeholder="Fecha de Solicitud" value="{{$permiso[0]['FEC_SOLICITUD']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de inicio</label>
            <input type="text" name="inicio_solicitud" class="form-control" placeholder="Inicio Permiso" value="{{$permiso[0]['FEC_INICIO']}}">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha final</label>
            <input type="text" name="final_solicitud" class="form-control" placeholder="Finalizo Permiso" value="{{$permiso[0]['FEC_FINAL']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Indicador de solicitud</label>
            <input type="text" name="estado_solicitud" class="form-control" placeholder="Estado Solicitud" value="{{$permiso[0]['IND_SOLICITUD']}}">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Justificacion de solicitud</label>
            <input type="text" name="justificacion_solicitud" class="form-control" placeholder="Justificacion de Solicitud" value="{{$permiso[0]['JST_SOLICITUD']}}">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection


@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar permiso laboral</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarPermisos', $permiso[0]['COD_SOL_PERMISO']) }}" method="POST">
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
    <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Tipo de permiso</label>
            <input type="text" name="tipo_solicitud" class="form-control" readonly placeholder="Tipo de Solicitud" value="{{$permiso[0]['TIP_SOLICITUD']}}">
            <br>
            <label for="exampleFormControlSelect12">Solicitante</label>
            <input type="text" name="fecha_solicitud" class="form-control" readonly placeholder="Fecha de Solicitud" value="{{$persona[0]['NOM_PERSONA'].' '.$persona[0]['APLL_PERSONA']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion</label>
            <textarea name="descripcion" readonly class="form-control" rows="3" placeholder="Descripcion">{{$permiso[0]['DES_SOLICITUD']}}</textarea>
          </div>
        </div>
      </div>
      <div  class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha final</label>
            <input type="text" name="final_solicitud" class="form-control" readonly placeholder="Finalizo Permiso" value="{{$permiso[0]['FEC_FINAL']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de inicio</label>
            <input type="text" name="inicio_solicitud" class="form-control"  readonly placeholder="Inicio Permiso" value="{{$permiso[0]['FEC_INICIO']}}">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Justificacion de solicitud</label>
            <textarea type="text" name="justificacion" class="form-control" rows="3" placeholder="Justificacion de Solicitud">{{$permiso[0]['JST_SOLICITUD']}}</textarea>
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Indicador de solicitud</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="estado"  value="Aprobado">
              <label class="form-check-label" for="exampleRadios1">
                Aprobada
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="estado" value="Rechazado">
              <label class="form-check-label" for="exampleRadios2">
                Rechazada
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <div class="row">
          <div class="col">
           
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection


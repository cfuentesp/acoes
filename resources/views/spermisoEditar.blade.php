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
            <input type="text" name="tipo_solicitud" class="form-control" placeholder="Tipo de Solicitud" value="{{$permiso[0]['TIP_SOLICITUD']}}">
            <br>
            <label for="exampleFormControlSelect12">Solicitante</label>
            <input type="text" name="cod_persona" class="form-control" readonly placeholder="Fecha de Solicitud" value="{{$permiso[0]['NOM_PERSONA'].' '.$permiso[0]['APLL_PERSONA']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion</label>
            <textarea name="descripcion"  class="form-control" rows="3" placeholder="Descripcion">{{$permiso[0]['DES_SOLICITUD']}}</textarea>
          </div>
        </div>
      </div>
      <div  class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha final</label>
            <input type="date" name="final_solicitud" class="form-control"  placeholder="Finalizo Permiso" value="{{date("Y-m-d", strtotime($permiso[0]['FEC_FINAL']))}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de inicio</label>
            <input type="date" name="inicio_solicitud" class="form-control"  placeholder="Inicio Permiso" value="{{date("Y-m-d", strtotime($permiso[0]['FEC_INICIO']))}}">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Indicador de solicitud</label>
            <input type="text" class="form-control"  readonly placeholder="Inicio Permiso" value="{{$permiso[0]['IND_SOLICITUD']}}">
          </div>
          <div class="col">
            @if($permiso[0]['IND_SOLICITUD']=='Pendiente')
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
            @endif
          </div>
        </div>
      </div>
    </form>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Generar correo electronico</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('generarCorreoPermiso',$permiso[0]['COD_SOL_PERMISO']) }}" method="GET">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif 
              <label for="exampleFormControlSelect12">La solicitud de permiso se enviara al siguiente correo:</label>
              <input type="text" name="email" readonly class="form-control" value="{{$correo[0]['CORREO']}}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
        <div>
          @if($permiso[0]['IND_SOLICITUD']=='Pendiente')
          <button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Enviar correo electronico</button>
          @endif  
          <br>
            <br>
          </div>
</div>
@endsection


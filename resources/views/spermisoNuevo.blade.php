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
            <label for="exampleFormControlSelect12">Tipo de permiso</label>
            <input type="text" name="tipo_solicitud" class="form-control" placeholder="Tipo de solicitud" value="{{old('tipo_solicitud')}}">
            <br>
            <div class="form-group">
              <label for="exampleFormControlSelect12">Solicitante</label>
              <select class="form-control selectpicker" id="cod_persona" data-live-search="true" name="cod_persona" value="{{old('cod_persona')}}">
                 <option selected>{{""}}</option>
                @foreach ($personas as $item)
                 <option value="{{$item['COD_PERSONA']}}">{{$item['NOM_PERSONA'].' '.$item['APLL_PERSONA']}}</option>
                @endforeach
              </select>
            </div>          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion</label>
            <textarea class="form-control" name="descripcion" rows="3">{{old('descripcion')}}</textarea>
          </div>
        </div>
      </div>
     <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de inicio</label>
            <input type="date" name="inicio_permiso" class="form-control" data-live-search="true" placeholder="Finalizo Permiso" value="{{old('final_permiso')}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha final</label>
            <input type="date" name="final_permiso" class="form-control" placeholder="Inicio Permiso" value="{{old('inicio_permiso')}}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
          </div>
          <div class="col">
          </div>
        </div>
      </div>
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
              @if ($errors->any())
              <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif 
            <label for="exampleFormControlSelect12">Confirme los datos de la solicitud de permiso.!</label>
            <label for="exampleFormControlSelect12">La solicitud de permiso se enviara al siguiente correo:</label>
            <input type="text" name="email" readonly class="form-control" value="{{$correo[0]['CORREO']}}">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Enviar</button>
          </div>
        </form>
        </div>
      </div>
    </div>
      <div>
        <button type="buttom" style="float: right;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Agregar solicitud</button>
        <br>
          <br>
        </div>
</div>
@endsection

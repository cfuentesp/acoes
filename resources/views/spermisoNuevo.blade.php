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
                @foreach ($personas as $item)
                 <option value="{{$item['COD_PERSONA']}}">{{$item['NOM_PERSONA'].' '.$item['APLL_PERSONA']}}</option>
                @endforeach
              </select>
            </div>          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion</label>
            <textarea class="form-control" name="descripcion" rows="3" value="{{old('descripcion')}}"></textarea>
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
            <button type="submit" class="btn btn-primary float-right">Agregar permiso</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection

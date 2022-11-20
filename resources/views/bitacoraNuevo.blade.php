@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Agregar observacion</h1>
</div>
<div class='card-body'>
<form action="{{ route('agregarObservacion')}}" method="POST">
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
      <div class="row mb-4">
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion</label>
              <textarea class="form-control" name="descripcion" rows="3" value="{{old('descripcion')}}"></textarea>
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de la observacion</label>
            <input type="date" name="fecha_observacion" class="form-control" value="{{old('fecha_observacion')}}">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="exampleFormControlSelect12">Evaluador</label>
              <select class="form-control selectpicker" data-live-search="true" id="cod_persona" name="cod_persona" value="{{old('cod_persona')}}">
                @foreach ($personas as $item)
                 <option value="{{$item['COD_PERSONA']}}">{{$item['NOM_PERSONA'].' '.$item['APLL_PERSONA']}}</option>
                 <option selected>{{""}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar Observacion</button>
          </div>
        </div>
    </form>
</div>
@endsection
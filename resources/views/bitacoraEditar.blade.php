@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar observacion</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarObservacion', $observacion[0]['COD_BIT_MEJORA']) }}" method="GET">
    @csrf
      @if ($errors->any())
        <div class="alert alert-danger">
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
            <textarea class="form-control" name="descripcion" rows="3" value="{{$observacion[0]['DES_OBSERVACION']}}">{{$observacion[0]['DES_OBSERVACION']}}</textarea>
        </div>
        <div class="col">
          <label for="exampleFormControlSelect12">Fecha de la observacion</label>
          <input type="date" name="fecha_observacion" class="form-control" value="{{$observacion[0]['FEC_OBSERVACION']}}">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="exampleFormControlSelect12">Evaluador</label>
            <select class="form-control" name="cod_persona" value="{{$personas[0]['COD_PERSONA']}}">
              @foreach ($personas as $item)
               <option value="{{!!$item['COD_PERSONA']!!}}">{{$item['NOM_PERSONA'].' '.$item['APLL_PERSONA']}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col">
          <button type="submit" class="btn btn-primary float-right">Actualizar Observacion</button>
        </div>
      </div>
    </div>
    </form>
</div>
@endsection
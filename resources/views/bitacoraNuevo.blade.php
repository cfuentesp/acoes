@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Agregar Datos de Observacion</h1>
</div>
<div class='card-body'>
<form action="{{ route('agregarObservacion')}}" method="POST">
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
      <div class="row mb-4">
          <div class="col">
              <textarea class="form-control" name="descripcion" rows="5"></textarea>
          </div>
          <div class="col">
            <input type="date" name="fecha_observacion" class="form-control" placeholder="Fecha de la observacion">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Evaluador</label>
              <select class="form-control" id="exampleFormControlSelect1">
                @foreach ($personas as $item)
                 <option value="{{$item['COD_PERSONA']}}">{{$item['NOM_PERSONA']}}</option>
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
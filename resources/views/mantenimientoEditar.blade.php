@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Equipo en mantenimiento</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarMantenimiento', [$id,$solicitud[0]['COD_SOL_MANTENIMIENTO'],$equipo[0]['COD_EQUIPO']]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion De Falla</label>
            <input type="text" class="form-control" name="descripcion_falla" placeholder="Descripcion De Falla" value="{{$equipo[0]['DES_FALLA']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Solucion Del Problema</label>
            <input type="text" class="form-control" name="solucion_problema" placeholder="Solucion Del Problema" value="{{$equipo[0]['SOL_PROBLEMA']}}">
          </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Estado del equipo</label>
            <input type="text" class="form-control" name="estado_equipo" placeholder="Estado Del Equipo" value="{{$equipo[0]['EST_EQUIPO']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de ingreso</label>
            <input type="date" class="form-control" name="fecha_ingreso" placeholder="Fecha De Ingreso" value="{{$equipo[0]['FEC_INGRESO']}}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="exampleFormControlSelect12">Persona responsable</label>
                <select class="form-control" name="cod_persona" value="{{$equipo[0]['COD_PERSONA']}}">
                  @foreach ($personas as $item)
                   <option value="{{$item['COD_PERSONA']}}">{{$item['NOM_PERSONA'].' '.$item['APLL_PERSONA']}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Motivo de solicitud</label>
            <input type="text" class="form-control" name="motivo" placeholder="Estado Del Equipo" value="{{$solicitud[0]['MTV_SOLICITUD']}}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de salida</label>
            <input type="date" class="form-control" name="fecha_salida" placeholder="Fecha De Salida" value="{{$equipo[0]['FEC_SALIDA']}}">
          </div>
          <div class="col">
            <br>
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection
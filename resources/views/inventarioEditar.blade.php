@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
  @php
      $item = "hola";
  @endphp
  <form action="{{ route('actualizarEquipo', $item) }}" method="PUT">
    @csrf
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="TIpo de equipo" value="{{$equipo[0]['TIP_EQUIPO']}}">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Marca del equipo" value="{{$equipo[0]['MRC_EQUIPO']}}">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Modelo/serie" value="{{$equipo[0]['MDL_SERIE']}}">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Especificaciones tecnicas" value="{{$equipo[0]['ECF_TECNICAS']}}">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Color de quipo" value="{{$equipo[0]['CLR_EQUIPO']}}">
          </div>
          <div class="col">
            <input type="number" class="form-control" placeholder="Numero de equipo" value="{{$equipo[0]['NUM_EQUIPO']}}">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input type="number" class="form-control" placeholder="Fecha de ingreso" value="{{($equipo[0]['NUM_EQUIPO'])}}">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
          </div>
        </div>
    </form>
</div>
@endsection
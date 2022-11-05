@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
  @php
      $item = "ACOES";
  @endphp
  <form action="{{ route('actualizarMantenimiento', $item) }}" method="PUT">
    @csrf
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Descripcion De Falla" value="{{$mante[0]['DES_FALLA']}}">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Solucion Del Problema" value="{{$mante[0]['SOL_PROBLEMA']}}">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Estado Del Equipo" value="{{$mante[0]['EST_EQUIPO']}}">
          </div>
          <div class="col">
            <input type="date" class="form-control" placeholder="Fecha De Ingreso" value="{{$mante[0]['FEC_INGRESO']}}">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input type="date" class="form-control" placeholder="Fecha De Salida" value="{{$mante[0]['FEC_SALIDA']}}">
          </div>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar Registro</button>
          </div>
        </div>
    </form>
</div>
@endsection
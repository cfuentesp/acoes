@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
    <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Descripcion De Falla">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Solucion Del Problema">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Estado Del Equipo">
          </div>
          <div class="col">
            <input type="date" class="form-control" placeholder="Fecha De Ingreso">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="date" class="form-control" placeholder="Fecha De Salida">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Registrar Mantenimiento</button>
          </div>
        </div>
      </form>
      <a href="{{route('actualizarMantenimiento',1)}}">ACOES</a>
</div>
@endsection
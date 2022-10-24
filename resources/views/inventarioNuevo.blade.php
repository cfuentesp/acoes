@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
    <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="TIpo de equipo">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Marca del equipo">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Modelo/serie">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Especificaciones tecnicas">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Color de quipo">
          </div>
          <div class="col">
            <input type="number" class="form-control" placeholder="Numero de equipo">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="date" class="form-control" placeholder="Fecha de ingreso">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar equipo</button>
          </div>
        </div>
      </form>
      <a href="{{route('actualizarEquipo',1)}}">hola</a>
</div>
@endsection
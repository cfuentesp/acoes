@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Agregar nueva persona</h1>
</div>
<div class='card-body'>
    <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Nombres">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Apellidos">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="DNI/#Identidad">
          </div>
          <div class="col">
            <input type="date" class="form-control" placeholder="Fecha de nacimiento">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Correo">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Referencia Personal">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Telefono Referencia">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Registrar Persona</button>
          </div>
        </div>
      </form>
</div>
@endsection
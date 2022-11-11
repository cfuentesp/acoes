@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Agregar nueva persona</h1>
</div>
<div class='card-body'>
  <form action="{{route('agregarPersona')}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Nombres</label>
            <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Apellidos</label>
            <input type="text" class="form-control" name="apellido" value="{{old('apellido')}}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Identidad</label>
            <input type="number" class="form-control" name="identidad" value="{{old('identidad')}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Rol de persona</label>
            <input type="text" class="form-control" name="rol" value="{{old('rol')}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Correo electronico</label>
            <input type="text" class="form-control" name="correo" value="{{old('correo')}}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Telefono</label>
            <input type="number" class="form-control" name="telefono" value="{{old('telefono')}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Direccion</label>
            <textarea type="text" rows="2" class="form-control" name="direccion" value="{{old('direccion')}}">{{old('direccion')}}</textarea>
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Numero de referecia personal</label>
            <input type="number" class="form-control" name="num_referencia" value="{{old('num_referencia')}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Referencia personal</label>
            <input type="text" class="form-control" name="referencia"  value="{{old('referencia')}}">
          </div>
        </div>
      </div>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Sexo persona</label>
            <input type="text" class="form-control" name="sex_persona" value="{{old('sex_persona')}}">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar persona</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection
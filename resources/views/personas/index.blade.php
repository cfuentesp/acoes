  @extends('dashboard');

@section('contenido')

<h1> VISTA INDEX </h1>
<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
    <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Nombre Completo">
          </div>
          <div class="col">
            <input type="number" class="form-control" placeholder="DNI/Numero de Identidad">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="date" class="form-control" placeholder="Fecha de nacimiento">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Direccion">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="number" class="form-control" placeholder="Telefono Movil">
          </div>
          <div class="col">
            <input type="number" class="form-control" placeholder="Telefono Fijo">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Referencia Personal">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar Persona</button>
          </div>
        </div>
      </form>
      <a href="{{route('actualizarPersona',1)}}">create</a> 
</div>
@endsection 

<!-- @extends('dashboard')

@section('seccion') 


<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
    <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Nombre Completo">
          </div>
          <div class="col">
            <input type="number" class="form-control" placeholder="DNI/Numero de Identidad">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="date" class="form-control" placeholder="Fecha de nacimiento">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Direccion">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="number" class="form-control" placeholder="Telefono Movil">
          </div>
          <div class="col">
            <input type="number" class="form-control" placeholder="Telefono Fijo">
          </div>
        </div>
      </form>
      <form>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Referencia Personal">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar Persona</button>
          </div>
        </div>
      </form>
      <a href="{{route('actualizarPersona',1)}}">create</a> 
</div>
@endsection -->
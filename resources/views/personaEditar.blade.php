@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar Datos de Persona</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarPersona', $personas[0]['COD_PERSONA']) }}" method="PUT">
    @csrf
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Nombres" value="{{$personas[0]['NOM_PERSONA']}}">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Apellidos" value="{{$personas[0]['APLL_PERSONA']}}">
          </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="DNI/#Identidad" value="{{$personas[0]['NUM_IDENTIDAD']}}">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Fecha de nacimiento" value="{{$personas[0]['FEC_NACIMIENTO']}}">
          </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="number" class="form-control" placeholder="Correo" value="{{$personas[0]['COR_PERSONA']}}">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Referencia Personal" value="{{($personas[0]['DES_REF_PERSONA'])}}">
          </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <input type="number" class="form-control" placeholder="Telefono Referencia" value="{{($personas[0]['NUM_REF_PERSONA'])}}">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
          </div>
    </div>
</div>
    </form>
@endsection
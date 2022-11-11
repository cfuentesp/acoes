@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar datos de persona</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarPersona', $personas[0]['COD_PERSONA']) }}" method="PUT">
    @csrf
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Nombres</label>
            <input type="text" class="form-control" value="{{$personas[0]['NOM_PERSONA']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Apellidos</label>
            <input type="text" class="form-control" value="{{$personas[0]['APLL_PERSONA']}}">
          </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Identidad</label>
            <input type="text" class="form-control" value="{{$personas[0]['NUM_IDENTIDAD']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de nacimiento</label>
            <input type="text" class="form-control" value="{{$personas[0]['FEC_NACIMIENTO']}}">
          </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Rol</label>
            <input type="number" class="form-control"  value="{{$personas[0]['ROL_PERSONA']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Correo</label>
            <input type="text" class="form-control"  value="{{($personas[0]['COR_PERSONA'])}}">
          </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Numero de referencia personal</label>
            <input type="number" class="form-control"  value="{{($personas[0]['NUM_REF_PERSONA'])}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Referencia personal</label>
            <input type="text" class="form-control" value="{{($personas[0]['DES_REF_PERSONA'])}}">
        </div>
    </div>
    <div class="mb-2">
      <div class="row">
        <div class="col">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
        </div>
      </div>
  </div>
</div>
    </form>
@endsection
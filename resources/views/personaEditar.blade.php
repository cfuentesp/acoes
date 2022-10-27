@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>{{$header}}</h1>
</div>
<div class='card-body'>
  @php
      $item = "ACOES";
  @endphp
  <form action="{{ route('actualizarPersona', $item) }}" method="PUT">
    @csrf
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Nombres" value="{{$tiempo[0]['NOM_PERSONA']}}">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Apellidos" value="{{$tiempo[0]['APLL_PERSONA']}}">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="DNI/#Identidad" value="{{$tiempo[0]['NUM_IDENTIDAD']}}">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Fecha de nacimiento" value="{{$tiempo[0]['FEC_NACIMIENTO']}}">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input type="text" class="form-control" placeholder="Direccion" value="{{$tiempo[0]['DIR_PERSONA']}}">
          </div>
          <div class="col">
            <input type="number" class="form-control" placeholder="Telefono Movil" value="{{$tiempo[0]['TEL_PERSONA']}}">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input type="number" class="form-control" placeholder="Correo" value="{{($tiempo[0]['COR_PERSONA'])}}">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Referencia Personal" value="{{($tiempo[0]['DES_REF_PERSONA'])}}">
          </div>
          <div class="row">
          <div class="col">
            <input type="number" class="form-control" placeholder="Telefono Referencia" value="{{($tiempo[0]['NUM_REF_PERSONA'])}}">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
          </div>
        </div>
    </form>
</div>
@endsection
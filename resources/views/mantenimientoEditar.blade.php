@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Equipo en mantenimiento</h1>
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Proceso</a></li>
  <li><a data-toggle="tab" href="#menu1">Datos del equipo</a></li>
  <li><a data-toggle="tab" href="#menu2">Solicitud</a></li>
</ul>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <div class='card-body'>
      <form action="{{ route('actualizarMantenimiento', $id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <div class="row">
              <div class="col">
                <label for="exampleFormControlSelect12">Descripcion De Falla</label>
                <textarea rows="5" class="form-control" name="descripcion_falla" >{{$datos[0]['DES_FALLA']}}</textarea>
              </div>
              <div class="col">
                <label for="exampleFormControlSelect12">Solucion Del Problema</label>
                <textarea rows="5" class="form-control" name="solucion_problema" >{{$datos[0]['SOL_PROBLEMA']}}</textarea>
              </div>
            </div>
        </div>
        <div class="mb-2">
            <div class="row">
              <div class="col">
                <label for="exampleFormControlSelect12">Motivo de solicitud</label>
                <textarea rows="5" class="form-control" readonly >{{$datos[0]['MTV_SOLICITUD']}}</textarea>
              </div>
              <div class="col">   
                <label for="exampleFormControlSelect12">Estado del equipo</label>
                <input type="text" class="form-control" name="estado_equipo" readonly value="{{$datos[0]['EST_EQUIPO']}}">
                <br>
                <label for="exampleFormControlSelect12">Fecha de ingreso a mantenimiento</label>
                <input type="date" class="form-control" readonly name="fecha_ingreso" value="{{date("Y-m-d", strtotime($datos[0]['FEC_INGRESO_MANTENIMIENTO']))}}">
              </div>
            </div>
          </div>
          <div class="mb-2">
            <div class="row">
              <div class="col"> 
              </div>
              <div class="col">
                <br>
                <button type="submit" class="btn btn-primary float-right">Marcar como revisado</button>
              </div>
            </div>
          </div>
        </form>
    </div>
  </div>
  <div id="menu1" class="tab-pane fade">
    <div class='card-body'>
      <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="exampleFormControlSelect12">Tipo de equipo</label>
              <input type="text" name="tipo_equipo" class="form-control" readonly placeholder="TIpo de equipo" value="{{$datos[0]['TIP_EQUIPO']}}">
            </div>
            <div class="col">
              <label for="exampleFormControlSelect12">Marca de equipo</label>
              <input type="text" name="marca_equipo" class="form-control" readonly placeholder="Marca del equipo" value="{{$datos[0]['MRC_EQUIPO']}}">
            </div>
          </div>
        </div>
        <div  class="mb-3">
          <div class="row">
            <div class="col">
              <label for="exampleFormControlSelect12">Modelo/serie</label>
              <input type="text" name="modelo_serie" class="form-control" readonly  value="{{$datos[0]['MDL_SERIE']}}">
              <br>
              <label for="exampleFormControlSelect12">Color de equipo</label>
              <input type="text" name="color_equipo" class="form-control" readonly value="{{$datos[0]['CLR_EQUIPO']}}">
            </div>
            <div class="col">
              <label for="exampleFormControlSelect12">Especificaciones tecnicas</label>
              <textarea type="text" name="especificaciones" rows="5" class="form-control" readonly placeholder="Especificaciones tecnicas">{{$datos[0]['ECF_TECNICAS']}}</textarea>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col">
              <label for="exampleFormControlSelect12">Fecha de ingreso</label>
              <input type="date" name="fecha_ingreso" class="form-control" readonly placeholder="Fecha de ingreso" value="{{date("Y-m-d", strtotime($datos[0]['FEC_INGRESO_EQUIPO']))}}">
            </div>
            <div class="col">
              <label for="exampleFormControlSelect12">Numero de equipo</label>
              <input type="number" name="numero_equipo" class="form-control" readonly placeholder="Numero de equipo" value="{{$datos[0]['NUM_EQUIPO']}}">
            </div>
          </div>
        </div>
  </div>
</div>
  <div id="menu2" class="tab-pane fade"><div class='card-body'>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Tipo de solicitud</label>
            <input type="text" class="form-control" name="nombres"  readonly value="{{$datos[0]['TIP_SOLICITUD']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Area de solicitud</label>
            <input type="text" class="form-control" name="apellidos" readonly value="{{$datos[0]['ARA_SOLICITUD']}}">
          </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Motivo de solicitud</label>
            <textarea rows="5" class="form-control" name="identidad" readonly >{{$datos[0]['MTV_SOLICITUD']}}</textarea>
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de solicitud</label>
            <input type="date" class="form-control" name="fecha_nacimiento" readonly value="{{date("Y-m-d", strtotime($datos[0]['FEC_SOLICITUD']))}}">
          </div>
        </div>
    </div>
</div>
  </div>
  </div>
@endsection
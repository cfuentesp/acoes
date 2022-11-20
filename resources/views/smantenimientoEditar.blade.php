@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Solicitud de mantenimiento</h1>
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Solicitud</a></li>
  <li><a data-toggle="tab" href="#menu1">Datos del equipo</a></li>
</ul>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <div class='card-body'>
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
                  <input type="date" name="fecha_ingreso" class="form-control" readonly placeholder="Fecha de ingreso" value="{{date("Y-m-d", strtotime($datos[0]['FEC_INGRESO']))}}">
                </div>
                <div class="col">
                  <label for="exampleFormControlSelect12">Numero de equipo</label>
                  <input type="number" name="numero_equipo" class="form-control" readonly placeholder="Numero de equipo" value="{{$datos[0]['NUM_EQUIPO']}}">
                </div>
              </div>
            </div>
      </div>
  </div>
</div>
@endsection
@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar solicitud de compra</h1>
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Datos</a></li>
  <li><a data-toggle="tab" href="#menu1">Aprobacion</a></li>
  <li><a data-toggle="tab" href="#menu2">Datos de equipo</a></li>
  <li><a data-toggle="tab" href="#menu3">Mantenimiento</a></li>
</ul>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <div class='card-body'>
      <form action="{{ route('actualizarCompra', $datos[0]['COD_SOL_COMPRA']) }}" method="POST">
          @csrf
          @method('PUT')
          @if ($errors->any())
          <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>
            <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
               </ul>
             </div>
           @endif
          <div class="mb-2">
              <div class="row">
                <div class="col">
                  <label for="exampleFormControlSelect12">Descripcion de solicitud</label>
                  <textarea rows="5" name="descripcion" class="form-control">{{$datos[0]['DES_SOLICITUD']}}</textarea>
                </div>
                <div class="col">
                  <label for="exampleFormControlSelect12">Fecha de solicitud</label>
                  <input type="date" name="fecha_solicitud" class="form-control" value="{{date("Y-m-d", strtotime($datos[0]['FEC_SOLICITUD']))}}">
                  <br>
                  <button type="submit" class="btn btn-primary float-right">Actualizar solicitud</button>
                </div>
              </div>
            </div>
          </form>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Generar correo electronico</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('generarCorreoAprobacion',$datos[0]['COD_SOL_APB_COMPRA']) }}" method="GET">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
              </form>
              </div>
            </div>
          </div>
            <div>
              <button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Enviar correo electronico</button>
                <br>
                <br>
              </div>
      </div>
  </div>
  <div id="menu1" class="tab-pane fade">
    <div class='card-body'>
      <br>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Cotizacion de equipo</label>
            <textarea rows="5" name="cotizacion" readonly class="form-control" >{{$datos[0]['COZ_EQUIPO']}}</textarea>
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de solicitud</label>
            <input type="date" name="fecha_solicitud" readonly class="form-control" value="{{date("Y-m-d", strtotime($datos[0]['FEC_SOLICITUD']))}}">
            <br>
          </div>
        </div>
      </div>
  </div>
  </div>
  <div id="menu2" class="tab-pane fade">
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
              <input type="date" name="fecha_ingreso" class="form-control" readonly placeholder="Fecha de ingreso" value="{{$datos[0]['FEC_INGRESO']}}">
            </div>
            <div class="col">
              <label for="exampleFormControlSelect12">Numero de equipo</label>
              <input type="number" name="numero_equipo" class="form-control" readonly placeholder="Numero de equipo" value="{{$datos[0]['NUM_EQUIPO']}}">
            </div>
          </div>
        </div>
  </div>
</div>
  <div id="menu3" class="tab-pane fade">
    <div class='card-body'>
      <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion de falla</label>
            <textarea class="form-control" readonly rows="5" name="identidad">{{$datos[0]['DES_FALLA']}}</textarea>
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Solucion al problema</label>
            <textarea class="form-control" readonly rows="5" name="identidad">{{$datos[0]['SOL_PROBLEMA']}}</textarea>
          </div>
        </div>
    </div>
    <div class="mb-2">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Estado del equipo</label>
            <input type="text" readonly class="form-control" name="rol" value="{{$datos[0]['EST_EQUIPO']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de ingreso a mantenimiento</label>
            <input type="date" readonly class="form-control" name="fecha_nacimiento" value="{{date("Y-m-d", strtotime($datos[0]['FEC_INGRESO']))}}">
          </div>
        </div>
    </div>
  </div>
  </div>
  </div>
@endsection
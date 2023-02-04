@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar datos de persona</h1>
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Datos personales</a></li>
  <li><a data-toggle="tab" href="#menu1">Direcciones</a></li>
  <li><a data-toggle="tab" href="#menu2">Telefonos</a></li>
</ul>
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <div class='card-body'>
      <form action="{{ route('actualizarPersona', $personas[0]['COD_PERSONA']) }}" method="POST">
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
                <label for="exampleFormControlSelect12">Nombres</label>
                <input type="text" class="form-control" name="nombre" value="{{$personas[0]['NOM_PERSONA']}}">
              </div>
              <div class="col">
                <label for="exampleFormControlSelect12">Apellidos</label>
                <input type="text" class="form-control" name="apellido" value="{{$personas[0]['APLL_PERSONA']}}">
              </div>
            </div>
        </div>
        <div class="mb-2">
            <div class="row">
              <div class="col">
                <label for="exampleFormControlSelect12">Identidad</label>
                <input type="text" class="form-control" name="identidad" value="{{$personas[0]['NUM_IDENTIDAD']}}">
              </div>
              <div class="col">
                <label for="exampleFormControlSelect12">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="{{date("Y-m-d", strtotime($personas[0]['FEC_NACIMIENTO']))}}">
              </div>
            </div>
        </div>
        <div class="mb-2">
            <div class="row">
              <div class="col">
                <label for="exampleFormControlSelect12">Rol</label>
                <input type="text" class="form-control" readonly name="rol" value="{{$personas[0]['ROL_PERSONA']}}">
              </div>
              <div class="col">
                <label for="exampleFormControlSelect12">Correo</label>
                <input type="email" class="form-control" name="correo" value="{{($personas[0]['COR_PERSONA'])}}">
              </div>
            </div>
        </div>
        <div class="mb-2">
            <div class="row">
              <div class="col">
                <label for="exampleFormControlSelect12">Numero de referencia personal</label>
                <input type="number" class="form-control" name="num_referencia" value="{{($personas[0]['NUM_REF_PERSONA'])}}">
              </div>
              <div class="col">
                <label for="exampleFormControlSelect12">Referencia personal</label>
                <input type="text" class="form-control" name="referencia" value="{{($personas[0]['DES_REF_PERSONA'])}}">
            </div>
        </div>
        </div>
        <div class="mb-2">
          <div class="row">
            <div class="col">
              <label for="exampleFormControlSelect12">Sexo persona</label>
              <input type="text" class="form-control" name="sexo" value="{{($personas[0]['SEX_PERSONA'])}}">
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  <div id="menu1" class="tab-pane fade">
    <div class='card-body'>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nueva direccion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{route('agregarDireccion', $personas[0]['COD_PERSONA'])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Direccion</label>
                  <textarea class="form-control" name="direccion" rows="3" id="recipient-name"></textarea>
                </div>
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar direccion</button>
            </div>
          </form>
          </div>
        </div>
      </div>
        <div>
          <button type="buttom" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Agregar direccion</button>
            <br>
            <br>
        </div>
      <br>
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="main-box clearfix">
        <div class="table-responsive">
          <table class="table user-list">
            <thead>
              <tr>
                <th><span>Direccion</span></th>
                <th><span>Creado por</span></th>
                <th><span>Creado el</span></th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($direcciones as $item)
              <tr>
                <td>
                  <span class="user-subhead">{{$item['DES_DIRECCION']}}</span>
                </td>
                <td>
                  <span class="user-subhead">{{$item['USR_ADICION']}}</span>
                </td>
                <td>
                  <span class="user-subhead">{{date("Y-m-d", strtotime($item['FEC_ADICION']))}}</span>
                </td>
                </td>
                  <td style="width: 20%;">
                    <a href="{{route('eliminarDireccion',$item['COD_DIRECCION'])}}" class="table-link danger">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <div id="menu2" class="tab-pane fade">
    <div class='card-body'>
      <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nuevo telefono</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{route('agregarTelefono', $personas[0]['COD_PERSONA'])}}" method="POST">
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
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Telefono</label>
                  <input type="number" class="form-control" name="telefono">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar telefono</button>
            </div>
          </form>
          </div>
        </div>
      </div>
        <div>
          <button type="buttom" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Agregar telefono</button>
            <br>
            <br>
        </div>
      <br>
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="main-box clearfix">
        <div class="table-responsive">
          <table class="table user-list">
            <thead>
              <tr>
                <th><span>Telefono</span></th>
                <th><span>Creado por</span></th>
                <th><span>Creado el</span></th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($telefonos as $item)
              <tr>
                <td>
                  <span class="user-subhead">{{$item['NUM_TELEFONO']}}</span>
                </td>
                <td>
                  <span class="user-subhead">{{$item['USR_ADICION']}}</span>
                </td>
                <td>
                  <span class="user-subhead">{{date("Y-m-d", strtotime($item['FEC_ADICION']))}}</span>
                </td>
                </td>
                  <td style="width: 20%;">
                    <a href="{{route('eliminarTelefono',$item['COD_TELEFONO'])}}" class="table-link danger">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
</div>
@endsection
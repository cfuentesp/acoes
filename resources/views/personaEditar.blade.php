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
      </form>
    </div>
  </div>
  <div id="menu1" class="tab-pane fade">
    <div class='card-body'>
      <form action="{{route('abrirNuevo')}}" method="GET">
        <div>
            <button type="submit" class="btn btn-primary float-right">Agregar nueva observacion</button>
            <br>
            <br>
        </div>
     </form>
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
                <th><span>Fecha de la Observacion</span></th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($observaciones[0] as $item)
              <tr>
                <td>
                  <span class="user-subhead">{{$item['NOM_PERSONA'].' '.$item['APLL_PERSONA']}}</span>
                </td>
                <td>
                  <span class="user-subhead">{{date("Y-m-d", strtotime($item['FEC_OBSERVACION']))}}</span>
                </td>
                </td>
                  <td style="width: 20%;">
                    <a href="{{route('editarObservacion',$item['COD_BIT_MEJORA'])}}" class="table-link">
                                      <span class="fa-stack">
                                          <i class="fa fa-square fa-stack-2x"></i>
                                          <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                      </span>
                                  </a>
                    <a href="{{route('eliminarObservacion',$item['COD_BIT_MEJORA'])}}" class="table-link danger">
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
    <h3>Menu 2</h3>
    <p>Some content in menu 2.</p>
  </div>
</div>
@endsection
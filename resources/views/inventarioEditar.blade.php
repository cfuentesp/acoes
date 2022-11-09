@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar datos de equipo</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarEquipo', $equipo[0]['COD_EQUIPO']) }}" method="POST">
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
    <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Tipo de equipo</label>
            <input type="text" name="tipo_equipo" class="form-control" placeholder="TIpo de equipo" value="{{$equipo[0]['TIP_EQUIPO']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Marca de equipo</label>
            <input type="text" name="marca_equipo" class="form-control" placeholder="Marca del equipo" value="{{$equipo[0]['MRC_EQUIPO']}}">
          </div>
        </div>
      </div>
      <div  class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Modelo/serie</label>
            <input type="text" name="modelo_serie" class="form-control" placeholder="Modelo/serie" value="{{$equipo[0]['MDL_SERIE']}}">
            <br>
            <label for="exampleFormControlSelect12">Color de equipo</label>
            <input type="text" name="color_equipo" class="form-control" placeholder="Color de quipo" value="{{$equipo[0]['CLR_EQUIPO']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Especificaciones tecnicas</label>
            <textarea type="text" name="especificaciones" rows="5" class="form-control" placeholder="Especificaciones tecnicas">{{$equipo[0]['ECF_TECNICAS']}}</textarea>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" placeholder="Fecha de ingreso" value="{{$equipo[0]['FEC_INGRESO']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Numero de equipo</label>
            <input type="number" name="numero_equipo" class="form-control" placeholder="Numero de equipo" value="{{$equipo[0]['NUM_EQUIPO']}}">
          </div>
        </div>
      </div>
      <div class="mb-3">
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
@endsection
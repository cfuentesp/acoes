@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar datos de compra</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarCompra', $compra[0]['COD_SOL_COMPRA']) }}" method="POST">
    @csrf
    @method('PUT')
      @if ($errors->any())
        <div class="alert alert-danger">
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
            <label for="exampleFormControlSelect12">Descripcion de la falla</label>
            <textarea type="text" rows="3" name="Fecha_solicitud" readonly class="form-control" placeholder="Fecha de Solicitud">{{$compra[0]['DES_FALLA']}}</textarea>
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Cotizacion</label>
            <textarea type="text" rows="3" readonly name="des_solicitud" class="form-control" placeholder="Descripcion">{{$compra[0]['COZ_EQUIPO']}}</textarea>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Solucion al problema</label>
            <textarea type="text" rows="3" name="Fecha_solicitud" readonly class="form-control" placeholder="Fecha de Solicitud">{{$compra[0]['SOL_PROBLEMA']}}</textarea>
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Fecha de ingreso a mantenimiento</label>
            <input type="date" name="Fecha_solicitud" readonly class="form-control" placeholder="Fecha de Solicitud" value="{{$compra[0]['FEC_INGRESO']}}">
          </div>
        </div>
      </div>
      <div  class="mb-3">
        <div class="row">
          <div class="col">
            <label for="exampleFormControlSelect12">Descripcion</label>
            <textarea type="text" rows="3" name="descripcion" class="form-control" placeholder="Fecha de Solicitud">{{$compra[0]['DES_SOLICITUD']}}</textarea>
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection

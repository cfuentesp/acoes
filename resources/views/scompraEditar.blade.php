@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar datos de Compra</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarCompra', $Compra[0]['COD_COMPRA']) }}" method="POST">
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
            <input type="text" name="Fecha_solicitud" class="form-control" placeholder="Fecha de Solicitud" value="{{$Compra[0]['FEC_SOLICITUD']}}">
          </div>
          <div class="col">
            <input type="text" name="des_solicitud" class="form-control" placeholder="Descripcion" value="{{$Compra[0]['DES_SOLICITUD']}}">
          </div>
        </div>
      </div>
      <div  class="mb-3">
        <div class="row">
          <div class="col">
            <input type="text" name="ind_solicitud" class="form-control" placeholder="Estado Solicitud" value="{{$compra[0]['IND_SOLICITUD']}}">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Actualizar datos</button>
          </div>
        </div>
      </div>
    </form>
</div>
@endsection

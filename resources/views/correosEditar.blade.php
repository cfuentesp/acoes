@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Editar datos de equipo</h1>
</div>
<div class='card-body'>
  <form action="{{ route('actualizarCorreo', $correo[0]['COD_CORREO']) }}" method="POST">
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
            <label for="exampleFormControlSelect12">Tipo de correo</label>
            <input type="text" class="form-control" readonly placeholder="TIpo de equipo" value="{{$correo[0]['TIP_CORREO']}}">
          </div>
          <div class="col">
            <label for="exampleFormControlSelect12">Correo electronico</label>
            <input type="text" name="correo" class="form-control"  value="{{$correo[0]['CORREO']}}">
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
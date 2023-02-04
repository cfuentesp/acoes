@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Actualizar roles a usuario {{$nombre}}</h1>
</div>
<div class='card-body'>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR CONTRASEÑA</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{route('actualizarContraseniaUser', $id)}}" method="GET">
                @csrf
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Nueva contraseña</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Confirmar contraseña</label>
                  <input type="password" class="form-control" name="password_confirm">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </form>
          </div>
        </div>
      </div>
      <button type="buttom" class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">Cambiar contraseña</button>
      <br><br>
      <form action="{{route('agregarRoleUsuario',$id)}}" method="GET">
      @csrf
      <div class="mb-3">
        <div class="col">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Roles</label>
              <select class="form-control selectpicker" data-live-search="true" name="role">
                <option selected>{{""}}</option>
                @foreach ($roles as $rol)
                 <option value="{{$rol['id']}}">{{$rol->name.' - '.$rol->description}}</option>
                @endforeach
              </select>
            </div>
          </div>
      </div>
      <div class="mb-3">
        <div class="row">
          <div class="col">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary float-right">Agregar rol</button>
          </div>
        </div>
      </div>
    </form>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Role</th>
            <th scope="col">Descripcion</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($rolesUser as $item)        
          <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection
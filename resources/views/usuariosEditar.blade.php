@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Actualizar rol a usuario {{$nombre}}</h1>
</div>
<div class='card-body'>
  <form action="{{route('agregarRoleUsuario',$id)}}" method="GET">
    @csrf
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
        <div class="col">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Roles</label>
              <select class="form-control selectpicker" data-live-search="true" name="role">
                <option selected>{{""}}</option>
                @foreach ($roles as $rol)
                 <option value="{{$rol['id']}}">{{$rol['name']}}</option>
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
            <td>{{$item['name']}}</td>
            <td>{{$item['description']}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection
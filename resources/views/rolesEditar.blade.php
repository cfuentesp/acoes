@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Actualizar permisos a rol {{$nombre}}</h1>
</div>
<div class='card-body'>
  <form action="{{route('insertPermissionRole',$id)}}" method="GET">
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
              <label for="exampleFormControlSelect1">Permisos</label>
              <select class="form-control selectpicker" data-live-search="true" id="select" name="permiso">
                 <option selected>{{""}}</option>
                @foreach ($permission as $permisos)
                 <option value="{{$permisos['id']}}">{{$permisos['name'].' - '.$permisos['description']}}</option>
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
            <button type="submit" class="btn btn-primary float-right">Agregar permiso</button>
          </div>
        </div>
      </div>
    </form>
    <table class="table user-list">
        <thead>
          <tr>
            <th><span>Permiso</span></th>
						<th><span>Descripcion</span></th>
						<th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($permissionRole as $permisoRole)        
          <tr>
            <td>
              <span class="user-subhead">{{$permisoRole->name}}</span>
            </td>
            <td>
              <span class="user-subhead"> {{$permisoRole->description}}</span>
             
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection
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
      @if (session('mensaje'))
	      <div class="alert alert-success alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>{{session('mensaje')}}</div>	
	    @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>{{session('error')}}</div>	
      @endif
    <div class="mb-3">
        <div class="col">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Permisos</label>
              <select class="form-control" name="permiso">
                @foreach ($permission as $permisos)
                 <option value="{{$permisos['id']}}">{{$permisos['name']}}</option>
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
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Permiso</th>
            <th scope="col">Descripcion</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($permissionRole as $permisoRole)        
          <tr>
            <td>{{$permisoRole['name']}}</td>
            <td>{{$permisoRole['description']}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection
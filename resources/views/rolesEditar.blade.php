@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Actualzizar permisos a role</h1>
</div>
<div class='card-body'>
  <form action="" method="POST">
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
      @if (session('mensaje'))
	      <div class="alert alert-success alert-dismissable fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>{{session('mensaje')}}</div>	
	    @endif
    <div class="mb-3">
        <div class="col">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Permisos</label>
              <select class="form-control" name="id">
                @foreach ($permission as $item)
                 <option value="{{$item['id']}}">{{$item['name']}}</option>
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
            <th scope="col">#</th>
            <th scope="col">Permiso</th>
            <th scope="col">Descripcion</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($permisos as $item)        
          <tr>
            <th scope="row">1</th>
            <td>{{$item['name']}}</td>
            <td>{{$item['desciption']}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection
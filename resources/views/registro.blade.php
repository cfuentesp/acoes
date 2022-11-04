@extends('dashboard')

@section('seccion')
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card-body p-5">
            <h2 class="text-uppercase text-center mb-5">CREAR CUENTA</h2>

            <form method="POST" action="{{ route('register') }}">
              @csrf
              
              <div class="form-outline mb-4">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus />
                <label class="form-label" for="name">Nombre</label>
                @error('name')
                   <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                   </span>
                 @enderror
              </div>

              <div class="form-outline mb-4">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email"/>
                <label class="form-label" for="email">Correo</label>
                @error('email')
                   <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-outline mb-4">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>
                <label class="form-label" for="password">Contraseña</label>
                @error('password')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                   </span>
                @enderror
              </div>

              <div class="form-outline mb-4">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                <label class="form-label" for="password-confirm">Repite la contraseña</label>
              </div>

              <div class="d-flex justify-content-center">
                <button type="submit"
                  class="btn btn-primary btn-lg">Registrar usuario</button>
              </div>
              <br>
            </form>
          </div>
        </div>
    </div>
  </div>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
   <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AcoesSystem</title>
    <style>
.gradient-custom-3 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5))
}
.gradient-custom-4 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgb(255, 255, 255), rgba(255, 255, 255, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(1255, 255, 255, 1), rgba(255, 255, 255 1))
}
    </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <section class="vh-100 bg-image"
    style="background-image: url('https://img.freepik.com/free-vector/copy-space-wavy-white-background-layers_23-2148845469.jpg?w=2000');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-5">
                <h2 class="text-uppercase text-center mb-5">CREAR CUENTA</h2>
  
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  
                  <div class="form-outline mb-4">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus />
                    <label class="form-label" for="name">Usuario</label>
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
                      class="btn btn-primary btn-lg">Registrarse</button>
                  </div>
                  <br>
                  <p class="form-link">Ya tienes una cuenta? <a href="/"
                      class="form-link"><u>Inicia sesion</u></a></p>
  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


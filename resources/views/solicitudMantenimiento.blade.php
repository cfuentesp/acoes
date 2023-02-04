<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acoes Honduras</title>
    <style>
      @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script>
		const mobileScreen = window.matchMedia("(max-width: 990px )");
$(document).ready(function () {
    $(".dashboard-nav-dropdown-toggle").click(function () {
        $(this).closest(".dashboard-nav-dropdown")
            .toggleClass("show")
            .find(".dashboard-nav-dropdown")
            .removeClass("show");
        $(this).parent()
            .siblings()
            .removeClass("show");
    });
    $(".menu-toggle").click(function () {
        if (mobileScreen.matches) {
            $(".dashboard-nav").toggleClass("mobile-show");
        } else {
            $(".dashboard").toggleClass("dashboard-compact");
        }
    });
});
	</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
<section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img style="height: 330px;" src="{{ asset('images/acoes.png') }}">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-md-0 mb-md-5 px-md-2">Solicitud de mantenimiento de equipos</h3>
            <form action="{{route('insertMantenimiento')}}" method="GET">
            @if ($errors->any())
    <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
         </ul>
       </div>
     @endif
     @if (session('mensaje'))
                            <div class="alert alert-success alert-dismissable fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>{{session('mensaje')}}</div>	
                              @endif
                              @if (session('error'))
                                <div class="alert alert-danger alert-dismissable fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>{{session('error')}}</div>	
                            @endif
              <div class="col-md-6 mb-4">
              <div class="form-group">
                      <label for="exampleFormControlSelect12">Tipo de solicitud</label>
                      <select class="form-control selectpicker" data-live-search="true" name="tip_solicitud" value="{{old('tip_solicitud')}}">
                         <option selected>{{""}}</option>
                         <option value="Mantenimiento preventivo">Mantenimiento preventivo</option>
                         <option value="Mantenimiento correctivo">Mantenimiento correctivo</option>
                      </select>
                    </div>
             </div>
             
              <div class="form-outline mb-4">
                <label for="exampleFormControlSelect12">Area de solicitud</label>
                <div class="form-row"> 
                    <input type="text" class="form-control" name="area" value="{{old('area')}}">
                 </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="exampleDatepicker1" class="form-label">Motivo de solicitud</label>
                    <textarea name="motivo" id="" class="form-control" style="height: 108px">{{old('motivo')}}</textarea>
                </div>
              </div>

              <div class="form-row">
                    <div class="form-group">
                      <label for="exampleFormControlSelect12">Numero de equipo</label>
                      <select class="form-control selectpicker" data-live-search="true" name="cod_equipo" value="{{old('cod_equipo')}}">
                         <option selected>{{""}}</option>
                        @foreach ($equipos as $item)
                         <option value="{{$item['COD_EQUIPO']}}">{{$item['NUM_EQUIPO']}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br><br>

              <button type="submit" class="btn btn-success btn-lg mb-1">Agregar solicitud</button>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
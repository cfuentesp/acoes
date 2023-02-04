@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <div class="row">
        <div class="col" style="text-align: right;">
        <h1>Bienvenido: {{auth()->user()->name}}</h1>
        </div>
        <div class="col">
        <img width="180" height="100" src="{{ asset('images/acoes.png') }}" alt="">
        </div>
    </div>
</div>
<div class="card-body">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.min.js" integrity="sha512-tQYZBKe34uzoeOjY9jr3MX7R/mo7n25vnqbnrkskGr4D6YOoPYSpyafUAzQVjV6xAozAqUFIEFsCO4z8mnVBXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
<div class="row">
<div  class="col-6">
    <h5 style="text-align: center;">Registros en proceso</h5>
  <canvas id="myChart" width="800" height="750"></canvas>
</div>

<div class="col-6">
    <h4 style="text-align: center;">Total registros</h4>
<canvas id="pie-chart" width="800" height="450"></canvas>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  var array = JSON.parse('{!! json_encode($array) !!}');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Equipos en mantenimiento', 'Solicitud de aprobacion', 'Solicitud de compra','Solicitud de permisos'],
      datasets: [{
        label: 'Cantidad',
        data: array,
        backgroundColor: [
      'rgba(54, 162, 235, 0.2)',
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',

    ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
            suggestedMin: 1,
            suggestedMax: 20
        }
      }
    }
  });
</script>

<script>
var array2 = JSON.parse('{!! json_encode($array2) !!}');

new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["Equipos", "Equipos reparados", "Personas", "Solicitu de permisos", "Solicitud de compra", "Usuarios"],
      datasets: [{
        label: "Cantidad",
        backgroundColor: ["#3e95cd","#FFFFB3","#3cba9f","#e8c3b9","#8e5ea2","#c45850"],
        data: array2
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Datos'
      }
    }
});
</script>
<br>
</div>    
@endsection
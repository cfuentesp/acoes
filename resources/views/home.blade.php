@extends('dashboard')

@section('seccion')
<div class='card-header'>
    <h1>Bienvenido: {{auth()->user()->name}}</h1>
</div>
<div  style="text-align: center;" class='card-body'>
    <img src="https://www.wapsi.org/sites/default/files/logo_acoes_honduras.png" alt="">
</div>    
@endsection
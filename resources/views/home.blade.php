@extends('layout.master')
@push('plugin-styles')
<style>  
  .carousel-inner img {
    width: 100%;
    height: 385px;
  }
  </style>
@endpush
@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h3>BIENVENIDOS  FAMILIA INMODE</h3>
        <p>El  colegio Instituto Moderno Desepaz cada vez avanza más en la era tecnologica, por eso te invita a qué optimizes el tiempo de tus procesos con EDUSOFT.</p>
      </div>
      </div>
      </div>
      </div>

<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/images/1.jpeg" alt="Los Angeles" width="1100" height="100">
      <div class="carousel-caption">
        <h3>DIA DEL IDIOMA</h3>
        <p>Conmemoraci&oacute;n!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="/images/2.jpeg" alt="Chicago" width="1100" height="100">
      <div class="carousel-caption">
        <h3>CELEBRACI&Oacute;N DIA DEL NIÑO</h3>
        <p>ABRIL</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="/images/4.jpeg" alt="New York" width="1100" height="100">
      <div class="carousel-caption">
        <h3>AULA SISTEMAS</h3>
        <p>Informatica</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
</div>
</div>
</div>
</div>
@endsection
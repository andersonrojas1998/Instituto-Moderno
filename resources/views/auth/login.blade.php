@extends('layout.master-mini')
@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">        
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="row">
            <img class="rounded" src="{{ asset('/icon.jpg') }}" height="100" width="100">
        </div><br>
        <p ><b>Ingrese sus credenciales</b></p>
          <div class="form-group">
            <label class="label">Identificaci&oacute;n :</label>
            <div class="input-group">
              <input type="text" name="identificacion" class="form-control" placeholder="Ingrese Identificacion" required>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="label">Contraseña :</label>
            <div class="input-group">
              <input type="password" class="form-control" name="password" placeholder="*********" required>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block">Iniciar sesi&oacute;n</button>
          </div>
          <div class="form-group d-flex justify-content-between">
            <!--<div class="form-check form-check-flat mt-0">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
            </div>-->
            <a href="#" class="text-small forgot-password text-primary">¿Olvido Contraseña ?</a>
          </div>
          <div class="form-group">
            <button class="btn btn-block g-login">
              <img class="mr-3" src="{{ url('assets/images/file-icons/icon-google.svg') }}" alt="">Log in with Google</button>
          </div>
          <div class="text-block text-center my-3">
            <span class="text-small font-weight-semibold">Not a member ?</span>
            <a href="{{ url('/user-pages/register') }}" class="text-black text-small">Create new account</a>
          </div>
        </form>
      </div>
      <ul class="auth-footer">
        <li>
          <a href="#">Conditions</a>
        </li>
        <li>
          <a href="#">Help</a>
        </li>
        <li>
          <a href="#">Terms</a>
        </li>
      </ul>
      <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
    </div>
  </div>
</div>
@endsection
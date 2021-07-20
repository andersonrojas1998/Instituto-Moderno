@extends('layout.master-mini')
@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">        
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="row w-100">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <img class="rounded" src="{{ asset('/icon.jpg') }}" height="102" width="108">                        
        </div>            
        <div class="col-lg-12">
        <figcaption class="blockquote-footer text-center">
        Instruye al niño en su camino que a&uacute;n aunque fuera viejo no se apartar&aacute; de &eacute;l. <cite title="Source Title">Proverbio 22:6</cite>
        </figcaption>        
        </div>
        </div>        
        <br>
        <b class="text-center">Ingrese sus credenciales de usuario</b></p>        
          <div class="form-group">
            <label class="label">Identificaci&oacute;n :</label>
            <div class="input-group">
              <input type="text" name="identificacion" class="form-control" placeholder="Ingrese Identificacion" required>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-account-key"></i>
                </span>
              </div>              
            </div>
            @if($errors->has('identificacion'))
              <p class="text-danger p-1">Por favor valida la identificaci&oacute;n </p>              
              @endif
          </div>
          <div class="form-group">
            <label class="label">Contraseña :</label>
            <div class="input-group">
              <input type="password" class="form-control" name="password" placeholder="*********" required>
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi mdi-lock"></i>
                </span>
              </div>              
            </div>
            @if($errors->has('identificacion'))
              <p class="text-danger p-1">Por favor valida la contraseña </p>
              @endif
          </div>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block">Iniciar Sesi&oacute;n  <i class="mdi mdi-login"></i></button>
          </div>
          <div class="form-group d-flex justify-content-between">
            <div class="form-check form-check-flat mt-0">
              <label class="form-check-label">
                <!-- <input type="checkbox" class="text-primary" name="remember" {{ old('remember') ? 'checked' : '' }} > Recordarme </label> -->
            </div>
            <a href="#" class="text-small forgot-password text-primary">¿Olvido Contraseña ?</a>
          </div>
          <!--<div class="form-group">
            <button class="btn btn-block g-login">
              <img class="mr-3" src="{{ url('assets/images/file-icons/icon-google.svg') }}" alt="">Log in with Google</button>
          </div>-->
          <div class="text-block text-center my-3">
            <!--<span class="text-small font-weight-semibold">Not a member ?</span>
            <a href="" class="text-black text-small">Create new account</a>-->
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
      <p class="footer-text text-center">copyright © 2021 Instituto Moderno Decepez.</p>
    </div>
  </div>
</div>
@endsection

@push('custom-scripts')    
<style>
.error{
  border-color:#ff0017 !important;  
  color:#ff0017 !important;  
}
</style>
@endpush

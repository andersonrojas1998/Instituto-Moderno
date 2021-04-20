<!DOCTYPE html>
<html>
<head>
  <title>Instituto Moderno Desepaz</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">
  
  <link rel="shortcut icon" href="{{ asset('/icon.jpg') }}">

  <!-- plugin css -->
  {!! Html::style('assets/plugins/@mdi/font/css/materialdesignicons.min.css') !!}
  {!! Html::style('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') !!}
  <!-- end plugin css -->

      
  @stack('plugin-styles')

  <!-- common css -->
  {!! Html::style('css/app.css') !!}
  <!-- end common css -->    
      {!! Html::style('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css') !!}
      
      {!! Html::style('https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css') !!}      
      {!! Html::style('https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css') !!}
  
  

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <div class="container-scroller" id="app">
    @include('layout.header')
    <div class="container-fluid page-body-wrapper">
      @include('layout.sidebar')
      <div class="main-panel">
        <div class="content-wrapper">       
        @yield('content')               
        </div>
        @include('layout.footer')
      </div>
    </div>
  </div>

  <!-- base js -->
  {!! Html::script('js/app.js') !!}
  {!! Html::script('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') !!}

  {!! Html::script('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js') !!}      
  {!! Html::script('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') !!}
  {!! Html::script('https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js') !!}

  
  {!! Html::script('//cdn.jsdelivr.net/npm/sweetalert2@10') !!}  
  {!! Html::script('lib/global.js') !!}
  <!-- end base js -->

  <!-- plugin js -->
  @stack('plugin-scripts')
  <!-- end plugin js -->

  <!-- common js -->
  {!! Html::script('assets/js/off-canvas.js') !!}
  {!! Html::script('assets/js/hoverable-collapse.js') !!}
  {!! Html::script('assets/js/misc.js') !!}
  {!! Html::script('assets/js/settings.js') !!}
  {!! Html::script('assets/js/todolist.js') !!}
  <!-- end common js -->

  @stack('custom-scripts')

</body>
</html>
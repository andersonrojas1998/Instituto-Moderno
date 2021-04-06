@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">           
        <h4 class="mb-0">Administraci&oacute;n de calificaciones</h4>                
</div>
    <div class="card-body">
    <div class="row">
    <p class="text-capitalize">Por favor adjutar el  formato de planilla de nota  correspondiente por cada grupo asignado</p>           
    </div>  
<br>


<div class="row">
<div class="col-lg-6">
                        <form enctype="multipart/form-data" id="formExcelLoad"  method="post" >
                        <meta name="csrf-token" content="{{ csrf_token() }}">                          
                                <label>Plantilla: </label>
                                <div class="file-loading">
                                    <input  name="file" id="fileExcelLoad" type="file" >
                                </div>                                                                         
                        </form>
</div>
<div class="col-lg-2">
<button type="button" id="loadExcel" class="btn btn-success btn-fw">Cargar</button>
</div>
                    </div>
</div>  
</div>

    
    

  
  
@endsection
@push('style')    
    <!-- <link href="{{-- asset('/lib/fileInput/css/fileinput.css') --}}" media="all" rel="stylesheet"> -->
@endpush
@push('custom-scripts')    
    <!-- <script src="{{-- asset('/lib/fileInput/js/fileinput.js') --}}"></script>  -->
    <script src="{{ asset('/lib/qualification.js') }}"></script>       
@endpush

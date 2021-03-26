@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">
           
        <h4 class="mb-0">Administraci&oacute;n de estudiantes</h4>
    

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight"><div class="dropdown">
            <button type="button" id="dropdownMenuButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle"> Descargar </button>
            <div aria-labelledby="dropdownMenuButton5" class="dropdown-menu" style="">
            <h6 class="dropdown-header">opciones descarga</h6> 
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">Excel</a>
            </div></div></div>            
        </div>

    

</div>


    <div class="card-body">
    <div class="row">
            <div class="col-lg-12">
                        
            </div>
    </div>
    </div>  
    </div>
  
  
@endsection

@push('custom-scripts')    
    <script src="{{ asset('/lib/students.js') }}"></script>    
@endpush

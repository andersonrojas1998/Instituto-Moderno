@extends('layout.master')
@section('content')
<div class="row">

<div class="col-lg-12  grid-margin stretch-card">
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
        <button type="button" id="loadExcel" class="btn btn-success btn-fw">Cargar <i class="mdi mdi-file-excel"></i></button>
        </div>
        </div>
        </div>  
        <br>
        </div>
</div>


    <div class="col-lg-12  grid-margin stretch-card">
        <div class="card">
        <div class="p-4  bg-light ">           
            <h4 class="mb-0  text-primary">Resumen Calificaci&oacute;n</h4>
        </div>
        <div class="card-body">
            <div class="row">
                   <div class="col-lg-12">
                   <table class="table table-bordered table-hover table-striped" id="dt_qualificationsPeriod" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                <th colspan="7" class="bg-secondary">PLANILLA DE EVALUACI&Oacute;N</th>
                                </tr>        
                                <tr class="text-center">
                                    <th colspan="4"></th>
                                    <th colspan="3" >Periodo</th>                
                                </tr>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Matricula</th>
                                <th>Alumno</th>
                                <th>Grado</th>            
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>            
                            </tr>        
                        </thead>
                    </table>   
                   </div>                 
            </div>
            </div>
        </div>
    </div>

</div>




@endsection
@push('custom-scripts')        
    <script src="{{ asset('/lib/qualification.js') }}"></script>       
@endpush

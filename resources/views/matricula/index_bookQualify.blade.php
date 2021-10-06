@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">                   
<div class="jumbotron">
  <h1 class="display-4">Administraci&oacute;n de Libro  de Matriculas !</h1>
  <p class="lead">En el cual podremos imprimir libro de matriculas de los estudiantes.  <i class="mdi mdi-cloud-print"></i></p>
  <hr class="my-4">    
</div>      
</div>
    <div class="card-body">
    <div class="row">            
            <div class="col-lg-5 offset-3">
                 <div class="card card-border-outset">
                 <img class="card-img-top" src="/images/print.png" height="60"  alt="Imprimir" style="width:100px;align-self:center;margin:12px;">
                        <div class="card-body">
                        <div class="row">
                        <p class="text-capitalize text-center">Grados :</p>
                        <div class="col-lg-12">
                        <ul class="list-group">                          
                            <li class="list-group-item">                                
                            <strong class="col-lg-12">Grado  :</strong>
                            <select class="form-control select2" id="sel_gradesPrint" style="width:100%;"> 
                                <option value="">Seleccione</option>
                            </select>                                                                                    
                            </li>                                                                                    
                        </ul>
                        </div>
                        </div>                                                    
                        </div>
                        <div class="card-footer">
                        <div class="row">
                                <div class="col-lg-12">        
                                        <button type="button" class="btn btn-info btn-block btn-rounded"  id="btn_bookQualify"  data-toggle="tooltip" data-placement="top" title="Genera el boletin en formato PDF">Generar  <i class="mdi mdi-printer"></i></button>
                                    </div>
                        </div>
                        </div>
                        </div>
            </div>                           
    </div>        
    </div>  
    </div>  
@endsection
@push('custom-scripts')    
    <script src="{{ asset('/lib/bulletin.js') }}"></script>
@endpush
@push('style')
<style type="text/css">
.card-border-outset{
    background:#fdfdee;padding:7px;border:outset;border-color:bisque;
}
</style>
@endpush
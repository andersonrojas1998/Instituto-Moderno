@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">                   
<div class="jumbotron">
  <h1 class="display-4">Administraci&oacute;n de Boletines !</h1>
  <p class="lead">En el cual podremos imprimir los resultados academicos por cada estudiente.</p>
  <hr class="my-4">    
</div>      
</div>
    <div class="card-body">
    <div class="row">
    <div class="col-lg-2"></div>

            <div class="col-lg-4">
                 <div class="card card-border-outset mb-3" >
                 <img class="card-img-top img-circle" src="/images/print.png" height="60"  alt="Imprimir" style="width:100px;align-self:center;margin:12px;">                        
                        <div class="card-body">
                        <div class="row">
                        <p class="text-capitalize text-center">Boletin por Estudiantes</p>
                        <div class="col-lg-12">
                        <ul class="list-group">                           
                            <li class="list-group-item">
                            <strong class="col-lg-12">Grado  :</strong>
                            <select class="form-control select2" id="sel_gradeStudents" style="width:100%;"> 
                                <option value="">Seleccione</option>                                
                            </select>                                                                                    
                            </li>
                            <li class="list-group-item">
                            <strong class="col-lg-12">Estudiantes :</strong>
                            <select class="form-control select2" id="sel_studentsForGrade" style="width:100%;">                               
                            </select>                                                                                     
                            </li>
                            <li class="list-group-item">
                            <strong class="col-lg-12">Periodo :</strong>
                            <select class="form-control select2" id="sel_printPeriod" style="width:100%;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>                                                                                     
                            </li>
                            <li class="list-group-item">
                            <strong class="col-lg-12">Fecha expedici&oacute;n :</strong>
                            <input type="date" class="form-control" id="date_expedition" value="{{ date('Y-m-d') }}">
                            </li>
                        </ul>
                        </div>
                        </div>                                                    
                        </div>
                        <div class="card-footer">
                        <div class="row">
                                <div class="col-lg-12">        
                                            <button type="button" class="btn btn-info btn-block btn-rounded" id="prt_bulletinStudent" data-toggle="tooltip" data-placement="top" title="Genera el boletin en formato PDF">Generar</button>
                                    </div>
                        </div>
                        </div>
                        </div>
            </div> 
            <div class="col-lg-4">
                 <div class="card card-border-outset">
                 <img class="card-img-top" src="/images/print.png" height="60"  alt="Imprimir" style="width:100px;align-self:center;margin:12px;">
                        <div class="card-body">
                        <div class="row">
                        <p class="text-capitalize text-center">Boletin por Grados</p>
                        <div class="col-lg-12">
                        <ul class="list-group">                          
                            <li class="list-group-item">
                            <strong class="col-lg-12">Grado  :</strong>
                            <select class="form-control select2" id="sel_gradesPrint" style="width:100%;"> 
                                <option value="">Seleccione</option>
                            </select>                                                                                    
                            </li>
                            <li class="list-group-item">
                            <strong class="col-lg-12">Periodo :</strong>
                            <select class="form-control select2" style="width:100%;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>                                                                                     
                            </li>
                            <li class="list-group-item">
                            <strong class="col-lg-12">Fecha expedici&oacute;n :</strong>
                            <input type="date" class="form-control" id="date_expedition" value="{{ date('Y-m-d') }}">
                            </li>
                        </ul>
                        </div>
                        </div>                                                    
                        </div>
                        <div class="card-footer">
                        <div class="row">
                                <div class="col-lg-12">        
                                            <button type="button" class="btn btn-info btn-block btn-rounded " data-toggle="tooltip" data-placement="top" title="Genera el boletin en formato PDF">Generar</button>
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
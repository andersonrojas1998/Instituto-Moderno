@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">                   
<div class="jumbotron">
  <h1 class="display-4">Administraci&oacute;n de Certificados !</h1>
  <p class="lead">En el cual podremos imprimir los certificados dependiendo el Año .   <i class="mdi mdi-certificate"></i></p>
  <hr class="my-4">    
</div>      
</div>
    <div class="card-body">
    <div class="row">    
            <div class="col-lg-5 offset-3">
                 <div class="card card-border-outset mb-3" >
                 <img class="card-img-top img-circle" src="/images/print1.png" height="60"  alt="Imprimir" style="width:100px;align-self:center;margin:12px;">                        
                        <div class="card-body">
                        <p class="text-capitalize text-center">Certificado por Estudiantes</p>


                        <div class="row">                        
                        <div class="col-lg-12">                            
                                <strong class="col-lg-12">Grado  :</strong>
                                <select class="form-control select2" id="sel_gradeStudents" style="width:100%;"> 
                                    <option value="">Seleccione</option>                                
                                </select>                                                                                    
                        </div>
                        </div> <br> 
                        <div class="row">                        
                        <div class="col-lg-12">                            
                                <strong class="col-lg-12">Año  :</strong>
                                <select class="form-control select2" id="sel_yearCert" style="width:100%;"> 
                                <option value="0">Seleccione</option>
                                @for($year=2020;$year<=date('Y'); $year++)                                
                                <option value="{{$year}}" >{{$year}}</option>
                                @endfor
                               </select>                                                                                    
                        </div>
                        </div> <br>                                                                                                                          
                        <div class="row">                        
                        <div class="col-lg-12">                                
                                <strong class="col-lg-12">Estudiantes :</strong>
                                <select class="form-control select2" id="sel_studentsCert" style="width:100%;">                               
                                </select>                                                                                     
                        </div>
                        </div><br>
                        <div class="row">                        
                        <div class="col-lg-12">                                
                                <strong class="col-lg-12">Fecha expedici&oacute;n :</strong>
                                <input type="date" class="form-control" id="date_expedition" value="{{ date('Y-m-d') }}">
                        </div>
                        </div>
                        </div>
                        <div class="card-footer">
                        <div class="row">
                                <div class="col-lg-12">        
                                            <button type="button" class="btn btn-success btn-block btn-rounded" id="btn_generateCertificated" data-toggle="tooltip" data-placement="top" title="Genera el certificado PDF">Generar  <i class="mdi mdi-printer"></i></button>
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
    <script src="{{ asset('/lib/certificate.js') }}"></script>   
@endpush
@push('style')
<style type="text/css">
.card-border-outset{
    background:#fdfdee;padding:7px;border:outset;border-color:bisque;
}
</style>
@endpush

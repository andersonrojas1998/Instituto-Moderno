@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">
           
        <h4 class="mb-0">Administraci&oacute;n de Boletines</h4>
    


    

</div>


    <div class="card-body">
    <div class="row">
    <div class="col-lg-2"></div>

            <div class="col-lg-4">
                 <div class="card border-primary mb-3" >
                 <img class="card-img-top" src="/images/print.png" height="60"  alt="Imprimir" style="width:100px;align-self:center;margin:12px;">                        
                        <div class="card-body">
                        <div class="row">
                        <p class="text-capitalize text-center">Boletin por Estudiantes</p>
                        <div class="col-lg-12">
                        <ul class="list-group">
                            <li class="list-group-item">
                            <strong class="label col-lg-12">Tipo de Papel :</strong>
                            <select class="form-control select2" id="paperPrint1" style="width:100%;">
                                <option value="1">Carta</option>
                                <option value="2">Oficcio</option>
                            </select>                                                        
                            </li>
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
                        </ul>
                        </div>
                        </div>                                                    
                        </div>
                        <div class="card-footer">
                        <div class="row">
                                <div class="col-lg-12">        
                                            <button type="button" class="btn btn-info btn-block btn-rounded" id="prt_bulletinStudent">Generar</button>
                                    </div>
                        </div>
                        </div>
                        </div>
            </div> 
            <div class="col-lg-4">
                 <div class="card" >
                 <img class="card-img-top" src="/images/print.png" height="60"  alt="Imprimir" style="width:100px;align-self:center;margin:12px;">
                        <div class="card-body">
                        <div class="row">
                        <p class="text-capitalize text-center">Boletin por Grados</p>
                        <div class="col-lg-12">
                        <ul class="list-group">
                            <li class="list-group-item">
                            <strong class="label col-lg-12">Tipo de Papel :</strong>
                            <select class="form-control select2" style="width:100%;">
                                <option value="1">Carta</option>
                                <option value="2">Oficcio</option>
                            </select>                                                        
                            </li>
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
                        </ul>
                        </div>
                        </div>                                                    
                        </div>
                        <div class="card-footer">
                        <div class="row">
                                <div class="col-lg-12">        
                                            <button type="button" class="btn btn-info btn-block btn-rounded ">Generar</button>
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

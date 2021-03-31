@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">           
        <h4 class="mb-0">Administraci&oacute;n de calificaciones</h4>                
</div>
    <div class="card-body">
    <div class="row">
            <div class="col-lg-4">
            <strong>Docentes :</strong>
                <select class="form-control " name="sel_teacher" id="sel_teacher" style="width:100%" >
                <option value=""></option>
                </select>                  
            </div>

            <div class="col-lg-2">
            <strong>Grados :</strong>
                <select class="form-control" name="sel_grades" id="sel_grades" style="width:100%" >
                <option value=""></option>
                </select>                  
            </div>

            <div class="col-lg-2">
            <strong>Asignatura :</strong>
                <select class="form-control" name="sel_course" id="sel_course" style="width:100%" >
                <option value=""></option>
                </select>                  
            </div>

            <div class="col-lg-1">
            <strong>Periodo :</strong>
                <select class="form-control select2" name="sel_perid" id="sel_perid" style="width:100%" >
                <option value="1">1P</option>
                <option value="2">2P</option>
                <option value="3">3P</option>
                </select>                  
            </div>

            <div class="col-lg-2">
                <button type="button" id="btn_qualify" class="btn btn-primary btn-rounded btn-fw">Calificar <i class="mdi mdi-account-star"></i></button>
            </div>
    </div>  

<br><br>

<div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight"><div class="dropdown">
            <button type="button" id="dropdownMenuButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle"> Descargar </button>
            <div aria-labelledby="dropdownMenuButton5" class="dropdown-menu" style="">
            <h6 class="dropdown-header">opciones descarga</h6> 
            <div class="dropdown-divider"></div>
            <a id="generateExcel" class="dropdown-item"><i class="mdi mdi-file-excel text-success"></i> Excel  </a>
            </div></div></div>            
        </div>
<div class="row"> 



<div class="col-lg-12">
<table class="table table-bordered table-hover table-striped" id="dt_qualifications" style="width:100%;">
        <thead>
            <tr class="text-center">
            <th colspan="17" class="bg-secondary">PLANILLA DE EVALUACI&Oacute;N</th>
            </tr>        
            <tr class="text-center">
                <th colspan="4"></th>
                <th colspan="3" >Periodo</th>
                <th colspan="4" >Cognitivo</th>
                <th colspan="3" >Personal</th>
                <th colspan="2" >Autoe</th>
                <th colspan="2" >Def</th>                
            </tr>
        <tr class="text-center">
            <th>#</th>
            <th>Matricula</th>
            <th>Alumno</th>
            <th>Grado</th>            
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>        
    </thead>
</table>

</div>






</div>


    </div>  
    </div>

    
    

  
  
@endsection

@push('custom-scripts')    
    <script src="{{ asset('/lib/qualification.js') }}"></script>    
@endpush

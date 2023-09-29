@extends('layout.master')
@section('content')
<div class="card">
<div class="p-3  bg-light ">
    <div class="card-title  text-center mb-0 display-1"><h4>Administraci&oacute;n de Cursos  por Grados</h4></div>
</div>
<!-- <p class="text-capitalize">Nota: Recuerde que al eliminar una materia se vera reflejado en el boletin</p> -->
<div class="card-body">

<p class="text-mounted"><b>Nota :</b> Recuerde que las asignaturas  asignadas se visualizaran en el boletin . </p>
<div class="d-flex flex-row-reverse bd-highlight">
    <div class="p-2 bd-highlight">
        <div data-toggle="tooltip" data-placement="top" title="Creacion de Cursos"><a data-toggle="modal" data-target="#mdl_create_grades" id="show_create_course_grade"  class="btn btn-primary text-white" >Creaci&oacute;n <i class="mdi mdi-tag-text-outline icon-lg"  ></i> </a></div>
    </div>            
</div>


<div class="row">
<div class="col-lg-4">
    <strong>Grados : </strong>    
    <select class="form-control" id="sel_gradeStudents">
        <option value="">Seleccione Grado</option>
    </select>
</div>
</div>

<hr>
<div class="row">
    <div class="table-responsive">
                <table id="dt_courseGrades" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr class="text-center">
                        <th>#</th>
                        <th>Grado</th>
                        <th>Docente</th>
                        <th>Asignatura ( tag )</th>
                        <th>Intensidad Horaria</th>
                        </tr>
                    </thead>
                    <tbody>                            
                    </tbody>
                    </table>  
    </div>
    </div>
    </div>

<div class="modal fade" id="mdl_create_grades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width:70%;">
    <div class="modal-content " style="background:white;">
      <div class="modal-header d-block bg-primary">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title text-uppercase text-center text-white">Asignaci&oacute;n Asignatura Grado</h5>        
      </div>
      <div class="modal-body">
      <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="row">
            <div class="col-lg-3">
                <label>Grado :  <span class="text-danger">*</span></label>
                <select class="form-control " id="sel_grade_cour">
                </select>
            </div>
            <div class="col-lg-3">
                <label>Docente :  <span class="text-danger">*</span></label>
                <select class="form-control " id="sel_teacher_cour">
                </select>
            </div>

            <div class="col-lg-3">
                <label>Materia :  <span class="text-danger">*</span></label>
                <select class="form-control " id="sel_cour_cour">
                </select>
            </div>
            <div class="col-lg-3">
            <label>Intensidad Horaria:  <span class="text-danger">*</span></label>
            <input type="number" class="form-control"  id="ih_cour" min="1"  >
            </div>            
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12"><p class="text-danger">Campos obligatorios con (*)</p></div>            
        </div>
        <br>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success " id="btn_saveCourseGrade">Guardar</button>
      </div>
    </div>
  </div>
</div> 
    </div>  
@endsection

@push('custom-scripts')    
    <script src="{{ asset('/lib/courseGrades.js') }}"></script>    
@endpush

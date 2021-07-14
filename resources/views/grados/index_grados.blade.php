@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light text-center">           
        <h4 class="mb-0">Administraci&oacute;n de Grados</h4>            
</div>
    <div class="card-body">
    <div class="d-flex flex-row-reverse bd-highlight mb-5">
            <div class="p-2 bd-highlight">
                <div data-toggle="tooltip" data-placement="top" data-title="Creacion de Grados"><a data-toggle="modal" data-target="#mdl_create_grades" id="show_create_grade"  class="btn btn-primary text-white" >Creaci&oacute;n <i class="mdi mdi-numeric icon-lg"  ></i> </a></div>
            </div>            
        </div>   
    <div class="row">
    <div class="table-responsive">
                <table id="dt_grades" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-info text-white">
                        <th>#</th>
                        <th>Nombre</th>                        
                        <th>Grupo </th>
                        <th>Jornada</th>
                        <th>Docente</th>  
                        <th>Alumnos</th> 
                        <th></th>                     
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
        <h5 class="modal-title text-uppercase text-center text-white">Creaci&oacute;n Grados</h5>        
      </div>
      <div class="modal-body">
      <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="row">
            <div class="col-lg-4">
            <label>Nombre:  <span class="text-danger">*</span></label>
            <input class="form-control text-uppercase" type="text" id="nombre" placeholder="Ej: ONCE">
            </div>
        
            <div class="col-lg-4">
            <label>Grupo:  <span class="text-danger">*</span></label>
            <input class="form-control" id="grupo"  type="text" placeholder="Ej:  11-1" >
            </div>

            <div class="col-lg-4">
            <label>Jornada:  <span class="text-danger">*</span></label>
            <select class="form-control sel_jornadas"  id="sel_jornadas">            
            </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-4">
                <label>Tag:  <span class="text-danger">*</span></label>
                <input class="form-control" type="text"  id="tag" placeholder="11">
            </div>
            <div class="col-lg-4">
                <label>Nivel educativo:  <span class="text-danger">*</span></label>
                <select class="form-control sel_educativo" id="sel_educativo">
                </select>
            </div>

            <div class="col-lg-4">
                <label>Director grupo:  <span class="text-danger">*</span></label>
                <select class="form-control sel_teacher" id="sel_teacher">
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success btn-save-grade">Guardar</button>
      </div>
    </div>
  </div>
</div> 

<div class="modal fade" id="mdl_edit_grades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width:70%;">
    <div class="modal-content " style="background:white;">
      <div class="modal-header d-block bg-warning">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title text-uppercase text-center">EDIDAR GRADO</h5>        
      </div>
      <div class="modal-body">
      <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="row">
            <div class="col-lg-4">
            <label>Nombre:  <span class="text-danger">*</span></label>
            <input class="form-control text-uppercase" id="nombre_edit" placeholder="Ej: ONCE">
            </div>
        
            <div class="col-lg-4">
            <label>Grupo:  <span class="text-danger">*</span></label>
            <input class="form-control" id="grupo_edit" placeholder="Ej:  11-1"  disabled>
            </div>

            <div class="col-lg-4">
            <label>Jornada:  <span class="text-danger">*</span></label>
            <select class="form-control sel_jornadas" id="sel_jornadas_edit">            
            </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-4">
                <label>Tag:  <span class="text-danger">*</span></label>
                <input class="form-control"  id="tag_edit" placeholder="11">
            </div>            
            <div class="col-lg-4">
                <label>Director grupo:  <span class="text-danger">*</span></label>
                <select class="form-control sel_teacher" id="sel_teacher_edit">
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success btn-update-grade">Guardar</button>
      </div>
    </div>
  </div>
</div>
    </div>  
@endsection

@push('custom-scripts')    
    <script src="{{ asset('/lib/grades.js') }}"></script>    
@endpush

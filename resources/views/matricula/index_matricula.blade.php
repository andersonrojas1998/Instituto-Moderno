@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">           
        <h4 class="mb-0">Administraci&oacute;n de estudiantes Matriculados para el año  {{ date('Y') }}</h4>  
</div>
    <div class="card-body">
    <div class="row">
    <div class="table-responsive">
                <table id="dt_enrollment" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-secondary">                        
                        <th>Matricula</th> 
                        <th>Fecha Matricula</th>
                        <th>Grado / Jornada</th>                                               
                        <th>Estudiante</th>                        
                        <th>Estado</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>                            
                    </tbody>
                    </table>  
    </div>
    </div>
    </div>  
    </div>  

    <!-- Modal -->
<div class="modal fade" id="mdl_showEnrollement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-white" >EDITAR MATRICULA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-white">
      <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="row p-10">
            <div class="col-lg-6">
                <label>Cambiar de Grado :</label>
                <select class="form-control" id="sel_gradeStudents" style="width:100%;">                    
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-10">
                <p class="text-muted"> ¿ Deseas cambiar el estado de la  matricula del estudiante ?</p>
            </div>
            <div class="col-lg-2">
            
                                <label class="switch ">
                                    <input type="checkbox" class="primary switchChange">
                                    <span class="slider round"></span>
                                </label>
            
            </div>                        
        </div>
<br>
    <div class="row pnl_change" style="display:none;">
            <div class="col-lg-6">
                <label>Estado :</label>
                <select class="form-control" id="statusEnrollement" style="width:100%;">
                    <option></option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Motivo :</label>
                <select class="form-control" id="motiveEnrollement" style="width:100%;">
                    <option></option>
                </select>
            </div>
        </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success btn_edit_enrollement">Guardar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('custom-scripts')    
    <script src="{{ asset('/lib/enrollment.js') }}"></script>    
@endpush
@push('style')
    {!! Html::style('lib/enrollmentStudent/outside.css') !!}
@endpush
@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light">           
        <h1 class="card-title  text-center mb-0 display-1" style="font-size:20px;" >Administraci&oacute;n de Periodos</h1>  
</div>
    <div class="card-body">
    <div class="row">
    <div class="table-responsive">
                <table id="dt_periodos" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-secondary">                        
                            <th>#</th> 
                            <th>Nombre</th>
                            <th>Porcentaje</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>                        
                            <th>Habilitaci&oacute;n</th>
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
    
<div class="modal fade" id="mdl_edit_period" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width:70%;">
    <div class="modal-content">
      <div class="modal-header bg-warning d-block">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title text-uppercase text-center" >Editar Periodo   <i class="mdi mdi-account-card-details"></i></h5>
      </div>
      <form  id="form_editPeriod" enctype="multipart/form-data" method="post">
      <fieldset>
      <div class="modal-body" style="background:white;">      
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
    
    <div class="row">
        <div class="col-lg-4">
            <label>Periodo :</label>
            <input type="text" name="perido_edit" id="perido_edit" class="form-control" readonly>
        </div>                            
        <div class="col-lg-3">
            <label>Porcentaje % :</label>
            <input type="number" name="porcentaje" class="form-control">
        </div>                
    </div>
    <br>
    <div class="row">
    <div class="col-lg-4">
            <label>Fecha Inicio :</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
        </div>

        <div class="col-lg-4">
            <label>Fecha Fin :</label>
            <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
        </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-lg-3">
            <label>Habilitaci&oacute;n : </label>
            <input type="number"  id="habilitacion" name="habilitacion" placeholder="Ingrese numero de dias" class="form-control">
        </div>
        
        <div class="col-lg-6">
            <p class="text-muted"><b>Nota:</b>  Ingrese el numero de dias  en el caso de extender el periodo para habilitar calificaciones</p>        
        </div>        
        <div class="col-lg-3">
            <p class="text-danger hab-date-txt"></p>
        </div>
        <input type="hidden" name="hab-date-val" class="habilitacion-date">
    </div>        
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="btn_edit_period" class="btn btn-success">Guardar</button>
      </div>
      </fieldset>
    </form>
    </div>
  </div>
</div>     
@endsection

@push('custom-scripts')    
    <script src="{{ asset('/lib/period.js') }}"></script>    
@endpush

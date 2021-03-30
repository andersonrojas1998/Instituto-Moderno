@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">           
        <h4 class="mb-0">Administraci&oacute;n de calificaciones</h4>                
</div>
    <div class="card-body">
    <div class="row">
            <div class="col-lg-4">
            <label>Docentes :</label>
                <select class="form-control " name="sel_teacher" id="sel_teacher" style="width:100%" >
                <option value=""></option>
                </select>                  
            </div>

            <div class="col-lg-3">
            <label>Grados :</label>
                <select class="form-control select2" name="" id="" style="width:100%" >
                <option value=""></option>
                </select>                  
            </div>

            <div class="col-lg-3">
            <label>Asignatura :</label>
                <select class="form-control select2" name="" id="" style="width:100%" >
                <option value=""></option>
                </select>                  
            </div>

            <div class="col-lg-2">
                <button type="button" class="btn btn-success btn-rounded btn-fw">Calificar <i class="mdi mdi-file-excel"></i></button>
            </div>
    </div>  

<br>
<div class="row"> 

<table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Alumno</th>
        </tr>
        
        </thead>
        
        
        </table>



</div>


    </div>  
    </div>

    
    

  
  
@endsection

@push('custom-scripts')    
    <script src="{{ asset('/lib/qualification.js') }}"></script>    
@endpush

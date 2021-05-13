@extends('layout.master')
@section('content')
<div class="row">

    <div class="col-lg-12  grid-margin stretch-card">
        <div class="card">
        <div class="p-4" style="background:#FFF4DE;">           
            <h4 class="mb-0 text-center text-warning">Puntuaci&oacute;n y Promedios  <i class="mdi mdi-certificate "></i></h4>
        </div>
        <div class="card-body">

        <div class="row">
        <div class="col-lg-6 pt-20" >
            <h4 class="text-primary">Calificar objetivos de aprendizaje generales:</h4>    
        </div>        
        <div class="col-lg-6">
            <ul>
            <li><b>Puesto :</b> <p>muestra los puestos ocupados por Periodo y Grado</p> </li>
            <li><b>Promedio :</b> <p>muestra la puntuaci&oacute;n promedio de todas las calificaciones</p> </li>
            <li><b>Puntuación m&aacute;s alta :</b> <p>muestra la calificación más alta  por grado seleccionado</p> </li>
            </ul>
        </div>
        
        </div>    

        <div class="row pt-5">
        <div class="col-lg-4 grid-margin stretch-card">
                <strong class="col-lg-5">Grados :</strong>
                <select class="form-control" id="sel_gradeScore" style="width:100%;">        
                </select>                                                                                     
                </div>


                <div class="col-lg-4 grid-margin stretch-card">
                <strong class="col-lg-5">Periodo :</strong>
                <select class="form-control select2" id="sel_periodScore" style="width:100%;">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>                                                                                     
                </div>

                <div class="col-lg-2">
                    <button type="button" class="btn btn-icons btn-rounded btn-success" data-toggle="tooltip" data-placement="top" data-title="Consultar Promedios y Puestos" id="btn_showScoreGrades"><i class="mdi mdi-account-search" style="font-size:20px;"></i></button>                
                </div>                
        </div>
        
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">                    
                    <div class="table-responsive">
                        <table class="table" id="dt_scoreStudents" >
                            <thead>
                                <tr>                                    
                                    <th>Alumno</th>                                     
                                    <th>Puesto</th>
                                    <th>Promedio</th>                                    
                                </tr>
                            </thead> 
                            <tbody>
                            </tbody>
                        </table>
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
    <script src="{{ asset('/lib/scoreStudent.js') }}"></script>    
@endpush

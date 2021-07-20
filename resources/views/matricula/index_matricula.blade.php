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
@endsection

@push('custom-scripts')    
    <script src="{{ asset('/lib/enrollment.js') }}"></script>    
@endpush

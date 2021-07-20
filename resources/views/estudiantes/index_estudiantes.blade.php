@extends('layout.master')
@section('content')
<div class="card">
<div class="p-3  bg-light ">           
        <div class="card-title  text-center mb-0 display-1"><h4 class="mb-0">Administraci&oacute;n de Estudiantes</h4></div>            
</div>
    <div class="card-body">
    <div class="row">
    <div class="table-responsive">
                <table id="dt_alumn" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-secondary">
                        <th>#</th>
                        <th>Identificacion</th>                        
                        <th>Primer Apellido </th>
                        <th>Segundo Apellido</th>
                        <th>Primer Nombre</th>
                        <th>Segundo Nombre</th>
                        <th>Genero</th>
                        <th>Eps</th>
                        <th>Direcci&oacute;n</th>
                        <th>Telefono</th>                                                
                        <th>Acudiente</th>  
                        <th>Tel. Acudiente</th>                        
                        <th>Estado</th>
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
    <script src="{{ asset('/lib/students.js') }}"></script>    
@endpush

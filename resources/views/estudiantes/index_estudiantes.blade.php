@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">
           
        <h4 class="mb-0">Administraci&oacute;n de estudiantes</h4>
    

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight"><div class="dropdown">
            <button type="button" id="dropdownMenuButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle"> Descargar </button>
            <div aria-labelledby="dropdownMenuButton5" class="dropdown-menu" style="">
            <h6 class="dropdown-header">opciones descarga</h6> 
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">Excel</a>
            </div></div></div>            
        </div>    
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
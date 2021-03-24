@extends('layout.master')
@section('content')
<!--http://repository.lasallista.edu.co/dspace/bitstream/10567/741/1/Sistema_notas_SAGA.pdf
crear tabla resumen final  , materias vistas por el estudiantes en el año x notas , aprobo o no aprobo
-->    
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
    <div class="col-lg-12">
                <table id="example" class="table table-bordered" style="width:100%">
                    <thead>
                    <tr class="bg-secondary">
                    <th>#</th>
                    <th>Identificacion</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Barrio</th>
                    <th>Telefono</th>
                    <th>Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>

                            </tr>

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

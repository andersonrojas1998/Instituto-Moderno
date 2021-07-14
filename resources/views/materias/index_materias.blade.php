@extends('layout.master')
@section('content')
<div class="card">
<div class="p-4  bg-light ">           
    <h4 class="mb-0 text-center">Administraci&oacute;n de Materias</h4>
</div>
    <div class="card-body">
    <div class="row">
    <div class="table-responsive">
                <table id="dt_materias" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-success text-white">
                        <th>#</th>
                        <th>Nombre</th>                        
                        <th>Tag </th>
                        <th>Orden Imprimir</th>                        
                        <!-- <th></th>                      -->
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
    <script src="{{ asset('/lib/materias.js') }}"></script>    
@endpush

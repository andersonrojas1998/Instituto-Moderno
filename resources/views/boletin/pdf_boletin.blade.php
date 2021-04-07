<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Boletin</title>
        <meta name="description" content="Boletin Instituto Moderno">
        <meta name="viewport" content="width=device-width, initial-scale=1">                        
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style type="text/css">
        .padding-3{
            padding:3px 3px !important;
        }
        </style>
</head>
<div class="w3-row w3-tiny w3-padding-1   w3-margin-0">

    <div class="w3-col">
        <img class="rounded" src="{{ asset('/icon.jpg') }}" height="85" width="85">
    </div>
    <div class="w3-col w3-center" >
            <b>INSTITUTO MODERNO DESEPAZ</b>
            <p>Resolución No 4143.010.21.9981 del 18 de Diciembre de 2017 de la Secretaría de Educación.</p>
            <p>NIVELES PREESCOLAR, BÁSICA Y MEDIA</p>
            <p class="w3-serif ">Instruye al niño en su camino que aún aunque fuera viejo no se apartará de él. Proverbio 22:6</p>
            <b>INFORME DE AVANCES PRIMER PERIODO  ({{ date('Y') }})</b>
    </div>

</div>
    


<table class="w3-table w3-tiny" border="1"  >
        <tr class="w3-tiny" >
            <th  style="width:19%;" class="w3-light-grey padding-3">ESTUDIANTE:</th>
            <td class="padding-3">{{ $head[0]->nombre1 .' ' .$head[0]->nombre2 .' '. $head[0]->apellido1 . ' '. $head[0]->apellido2 }}</td>
            <th class="w3-light-grey padding-3">GRADO:</th>
            <td class="padding-3">{{ $head[0]->grupo }}</td>            
        </tr>
        <tr>
        <th class="w3-light-grey padding-3">DIRECTOR DE GRUPO: </th>            
            <td class="padding-3">{{ $head[0]->docente }}</td>
            <th style="width:20%;" class="w3-light-grey padding-3"> JORNADA:</th>
            <td class="padding-3">{{ $head[0]->jornada }}</td>        
        </tr>
        <tr>
            <th class="w3-light-grey padding-3">ACUDIENTE: </th>
            <td class="padding-3">{{ $head[0]->acudiente}}</td>
            <th class="w3-light-grey padding-3">CALENDARIO:</th>
            <td class="padding-3">CALENDARIO A</td>
        </tr>
        <tr>
            <th class="w3-light-grey padding-3">MODALIDAD: </th>
            <td class="padding-3">ACADEMICA</td>
            <th class="w3-light-grey padding-3">FECHA EXPED:</th>
            <td class="padding-3">{{  $expedition }}</td>
        </tr>                            
    </table>


<p class="w3-tiny">CONVENCIONES: APA = Actividades pedagógicas de apoyo, NMP = Nota mínima para ganar el siguiente periodo, ACUM = Acumulado.</p>    
<h6 class="w3-center w3-small">RESUMEN DE EVALUACIONES</h6>
<div class="row">

<div class="w3-col s6">

<table class="w3-table w3-tiny" border="1" >
        <thead>
        <tr class="w3-light-grey">
            <td class="padding-3 w3-center">ÁREAS O ASIGNATURAS</td>
            <td class=" w3-center padding-3">IH</td>
            <th class="w3-center padding-3">1P 35%</th>
            <td class="w3-center padding-3">AP1</td>
            <td class="w3-center padding-3">ACUM</td>
        </tr>
        </thead>
        <tbody>
        @foreach($course as $all)
        <tr>
            <td class="padding-3">{{ $all->nombre }}</td>
            <td class="w3-center padding-3">{{ $all->intensidad_horaria }}</td>
            <td class="w3-center padding-3">{{ $all->primerPeriodo }}</td>
            <td class="w3-center padding-3"></td>
            <td class="w3-center padding-3"></td>            
        </tr>
        @endforeach   
        </tbody>        
    </table>

 </div>

</div>

    <!-- <div class="w3-row"> -->
    <!-- <div class="w3-tiny"> -->

    
<!-- </div>         -->
<!-- </div>    -->

<!--
<div class="w3-row w3-padding-16">
<div class="w3-half w3-container w3-tiny">
    <b class="w3-center"> CIENCIAS SOCIALES</b>    
<table class="w3-table" border="1">    
            <tbody>
            <tr>
                <td>CIENCIAS SOCIALES</td>
                <td>4.0</td>
                <td>4.0</td>
                <td>4.0</td>
                <td>4.0</td>
            </tr>
            <tr>
                <td>10. CÁTEDRA DE PAZ</td>
                <td>4.0</td>
                <td>4.0</td>
                <td>4.0</td>
                <td>4.0</td>
            </tr>            
            </tbody>            
        </table>
</div>    
</div>

    <div class="w3-row w3-padding-16">    
        <div class="w3-half w3-container w3-tiny">
        <b class="w3-center ">ÉTICA Y VALORES</b>    
        <table class="w3-table" border="1">        
                <tbody>
                <tr>
                    <td>CIENCIAS SOCIALES</td>
                    <td>4.0</td>
                    <td>4.0</td>
                    <td>4.0</td
                    <td>4.0</td>
                </tr>
                </tbody>
                
            </table>
        </div>    
    </div>-->


    
    <div class="w3-row w3-padding-5">
    <table class="w3-table w3-striped w3-border">
    <tr>
    <td><h6 class="w3-center w3-small">CUADRO ESTADISTICO DE VALORACIONES</h6></td>
    </tr>
    <tr>
    <td><img src="{{ $url }}"></td>
    </tr>
        
        </table>
    </div>
    

    

<br>
    <div class="w3-container w3-margin-left">
            <!-- <img src="{{ asset('/icon.jpg') }}" width="30" height=25> -->
            <p  class="w3-small">________________________</p> 
            <p class="w3-small text-capitalize">ANDERSON ROJAS <br>
            Coordinador General
            </p>            
    </div>
  
         
         
         
        @include('boletin.footer')                             
        
    </body>
</html>
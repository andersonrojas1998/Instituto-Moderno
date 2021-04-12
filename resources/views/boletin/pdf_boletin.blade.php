<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Boletin  {{ $head[0]->grupo }} </title>
        <meta name="description" content="Boletin Instituto Moderno">
        <meta name="viewport" content="width=device-width, initial-scale=1">                        
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style type="text/css">
        .padding-1{
            padding:1px 1px  !important;            
        }
        .padding-2{
            padding:2px 2px  !important;            
        }
        @page {
                margin-top: 15px;
            }
         
        </style> 
</head>
<header >
<div class="w3-row w3-tiny">
    <div class="w3-col">
        <img class="rounded"  src="{{ asset('/icon.jpg') }}" height="80" width="80">
    </div>
    <div class="w3-col w3-center">
           <p><b class="w3-small">INSTITUTO MODERNO DESEPAZ</b> <br>
           Resolución No 4143.010.21.9981 del 18 de Diciembre de 2017 de la Secretaría de Educación. <br>
           NIVELES PREESCOLAR, BÁSICA Y MEDIA <br>           
           <div  class="w3-serif padding-1 ">Instruye al niño en su camino que aún aunque fuera viejo no se apartará de él. Proverbio 22:6</div>
           <b class="w3-small"> INFORME DE AVANCES {{ $periodtx }} PERIODO  ({{ date('Y') }})</b>
           </p>             
    </div>
</div>
</header>
   
<table class="w3-table w3-tiny" border="1"  >
        <tr class="w3-tiny" >
            <th  style="width:19%;" class="w3-light-grey padding-1">ESTUDIANTE:</th>
            <td class="padding-1">{{ $head[0]->nombre1 .' ' .$head[0]->nombre2 .' '. $head[0]->apellido1 . ' '. $head[0]->apellido2 }}</td>
            <th class="w3-light-grey padding-1">GRADO:</th>
            <td class="padding-1">{{ $head[0]->grupo }}</td>            
        </tr>
        <tr>
        <th class="w3-light-grey padding-1">DIRECTOR DE GRUPO: </th>            
            <td class="padding-1">{{ $head[0]->docente }}</td>
            <th style="width:20%;" class="w3-light-grey padding-1"> JORNADA:</th>
            <td class="padding-1">{{ $head[0]->jornada }}</td>        
        </tr>
        <tr>
            <th class="w3-light-grey padding-1">ACUDIENTE: </th>
            <td class="padding-1">{{ $head[0]->acudiente}}</td>
            <th class="w3-light-grey padding-1">CALENDARIO:</th>
            <td class="padding-1">CALENDARIO A</td>
        </tr>
        <tr>
            <th class="w3-light-grey padding-1">MODALIDAD: </th>
            <td class="padding-1">ACADEMICA</td>
            <th class="w3-light-grey padding-1">FECHA EXPED:</th>
            <td class="padding-1">{{  $expedition }}</td>
        </tr>                            
    </table>


<p class="w3-tiny">CONVENCIONES: APA = Actividades pedagógicas de apoyo, NMP = Nota mínima para ganar el siguiente periodo, ACUM = Acumulado.</p>    
<h6 class="w3-center w3-tiny"><b >RESUMEN DE EVALUACIONES</b></h6>
<div class="w3-row">

<div class="w3-col s6 ">
<table class="w3-table w3-tiny" border="1" >
        <thead>
        <tr class="w3-light-grey">            
            <td class="padding-1 w3-center">ÁREAS O ASIGNATURAS</td>
            <td class=" w3-center padding-1">IH</td>
            <th class="w3-center padding-1">1P 35%</th>
            <td class="w3-center padding-1">AP1</td>

            @if($period==2)
            <th class="w3-center padding-1">2P 35%</th>
            <td class="w3-center padding-1">AP2</td>
            @endif            
            <td class="w3-center padding-1">ACUM</td>
        </tr>
        </thead>
        <tbody>
        @foreach($course as $all)
        <tr>            
            <td class="padding-1">{{ $all->nombre }}</td>
            <td class="w3-center padding-1">{{ $all->intensidad_horaria }}</td>
            <td class="w3-center padding-1 w3-light-grey">{{ $all->primerPeriodo }}</td>
            <td class="w3-center padding-1"></td>
            @if($period==2)
            <td class="w3-center padding-1 w3-light-grey">{{ $all->segundoPeriodo }}</td>
            <td class="w3-center padding-1"></td>
            @endif
            <td class="w3-center padding-1"></td>            
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


   
    <!--<div class="w3-row w3-padding-12">
    <table class="w3-table w3-striped w3-border">
    <tr>
    <td class="padding-1"><h6 class="w3-center w3-small">CUADRO ESTADISTICO DE VALORACIONES</h6></td>
    </tr>
    <tr>
    <td><img src="{{-- $url --}}"></td>
    </tr>
        
        </table>
    </div> 
    -->
    <div class="w3-row">
    <h6 class="w3-center w3-tiny"><b>CUADRO ESTADISTICO DE VALORACIONES</b></h6>
    <div class="w3-col">
        <img src="{{ $url }}">    
    </div>    
    </div>        
    <div class="w3-row" >
    <h6 class="w3-center w3-tiny"><b>RENDIMIENTO ACADÉMICO DEL ESTUDIANTE</b></h6>       
      <!--  <div class="w3-col m4">
        <table class="w3-table w3-striped  w3-tiny"  style="width:80%"  >
                <thead>
                    <tr>
                        <td  colspan="2" class="w3-center" >ESCALA DE RANGOS</td>            
                    </tr>
                </thead>    
                <tbody>
                <tr>
                    <td class="padding-1">Superior</td>
                    <td class="padding-1">4.6 - 5.0</td>    
                </tr>
                <tr>
                    <td class="padding-1">Alto</td>
                    <td class="padding-1">4.0 - 4.5</td>    
                </tr>
                <tr>
                    <td class="padding-1">Básico</td>
                    <td class="padding-1">3.0 - 3.9</td>    
                </tr>
                <tr>
                    <td class="padding-1">Bajo</td>
                    <td class="padding-1">1.0 - 2.9</td>    
                </tr>
                </tbody>            
                </table>   
  </div>-->        
  <div class="w3-col m6">
                    <table class="w3-table w3-striped w3-tiny" style="width:70%" border="1" >
                  
                    <tr>
                                <td class="padding-1">Número de estudiantes en el curso:</td>
                                <td ></td>    
                            </tr>
                            <tr>
                                <td class="padding-1">Número de faltas:</td>
                                <td ></td>    
                            </tr>
                            <tr>
                                <td class="padding-1">Puesto ocupado en el curso:</td>
                                <td></td>    
                            </tr>   
                 
                                     
                        </table>                                
                </div>
</div>

<h6 class="w3-center w3-tiny"><b>OBSERVACIONES ACAD&Eacute;MICAS O COMPORTAMENTALES</b></h6>

<p class="w3-sans-serif   w3-tiny">{{  $observation[0]->descripcion }}.</p>

            
         
        @include('boletin.footer')                             
        
    </body>
</html>
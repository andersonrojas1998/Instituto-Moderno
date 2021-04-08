<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Boletin  {{ $head[0]->grupo }} </title>
        <meta name="description" content="Boletin Instituto Moderno">
        <meta name="viewport" content="width=device-width, initial-scale=1">                        
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style type="text/css">
        .padding-3{
            padding:2px 2px  !important;            
        }
        </style>
</head>
<div class="w3-row w3-tiny w3-padding-small">
    <div class="w3-col">
        <img class="rounded" src="{{ asset('/icon.jpg') }}" height="80" width="80">
    </div>
    <div class="w3-col w3-center w3-padding-small " >
           <p><b>INSTITUTO MODERNO DESEPAZ</b> <br>
           Resolución No 4143.010.21.9981 del 18 de Diciembre de 2017 de la Secretaría de Educación. <br>
           NIVELES PREESCOLAR, BÁSICA Y MEDIA
           <p  class="w3-serif ">Instruye al niño en su camino que aún aunque fuera viejo no se apartará de él. Proverbio 22:6</p>
           <b> INFORME DE AVANCES {{ $periodtx }} PERIODO  ({{ date('Y') }})</b>
           </p>             
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

<div class="w3-col s6  w3-padding-small">
<table class="w3-table w3-tiny" border="1" >
        <thead>
        <tr class="w3-light-grey">
            <td class="padding-3 w3-center">ÁREAS O ASIGNATURAS</td>
            <td class=" w3-center padding-3">IH</td>
            <th class="w3-center padding-3">1P 35%</th>
            <td class="w3-center padding-3">AP1</td>

            @if($period==2)
            <th class="w3-center padding-3">2P 35%</th>
            <td class="w3-center padding-3">AP2</td>
            @endif            
            <td class="w3-center padding-3">ACUM</td>
        </tr>
        </thead>
        <tbody>
        @foreach($course as $all)
        <tr>
            <td class="padding-3">{{ $all->nombre }}</td>
            <td class="w3-center padding-3">{{ $all->intensidad_horaria }}</td>
            <td class="w3-center padding-3 w3-light-grey">{{ $all->primerPeriodo }}</td>
            <td class="w3-center padding-3"></td>
            @if($period==2)
            <td class="w3-center padding-3 w3-light-grey">{{ $all->segundoPeriodo }}</td>
            <td class="w3-center padding-3"></td>
            @endif
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


   
    <!--<div class="w3-row w3-padding-12">
    <table class="w3-table w3-striped w3-border">
    <tr>
    <td class="padding-3"><h6 class="w3-center w3-small">CUADRO ESTADISTICO DE VALORACIONES</h6></td>
    </tr>
    <tr>
    <td><img src="{{ $url }}"></td>
    </tr>
        
        </table>
    </div>-->
    <div class="w3-row w3-padding-small">
    <h6 class="w3-center w3-small text-shadow">CUADRO ESTADISTICO DE VALORACIONES</h6>
    <div class="w3-col">
        <img src="{{ $url }}">    
    </div>
    

    </div>
    


    <h6 class="w3-center w3-small">RENDIMIENTO ACADÉMICO DEL ESTUDIANTE</h6>
    <div class="w3-row" >
           
      <!--  <div class="w3-col m4">
        <table class="w3-table w3-striped  w3-tiny"  style="width:80%"  >
                <thead>
                    <tr>
                        <td  colspan="2" class="w3-center" >ESCALA DE RANGOS</td>            
                    </tr>
                </thead>    
                <tbody>
                <tr>
                    <td class="padding-3">Superior</td>
                    <td class="padding-3">4.6 - 5.0</td>    
                </tr>
                <tr>
                    <td class="padding-3">Alto</td>
                    <td class="padding-3">4.0 - 4.5</td>    
                </tr>
                <tr>
                    <td class="padding-3">Básico</td>
                    <td class="padding-3">3.0 - 3.9</td>    
                </tr>
                <tr>
                    <td class="padding-3">Bajo</td>
                    <td class="padding-3">1.0 - 2.9</td>    
                </tr>
                </tbody>            
                </table>   
  </div>-->        
  <div class="w3-col m6">
                    <table class="w3-table w3-striped w3-tiny" style="width:70%" border="1" >
                  
                    <tr>
                                <td class="padding-3">Número de estudiantes en el curso:</td>
                                <td ></td>    
                            </tr>
                            <tr>
                                <td class="padding-3">Número de faltas:</td>
                                <td ></td>    
                            </tr>
                            <tr>
                                <td class="padding-3">Puesto ocupado en el curso:</td>
                                <td></td>    
                            </tr>   
                 
                                     
                        </table>                                
                </div>
</div>

<h6 class="w3-center w3-small">OBSERVACIONES ACADÉMICAS O COMPORTAMENTALES</h6>

<p class="w3-sans-serif   w3-tiny">Norway has a total area of 385,252 square kilometers and a population of 5,438,657 (December 2020). Norway is bordered by Sweden, Finland and Russia to the north-east, and the Skagerrak to the south, with Denmark on the other side.</p>



  <br><br>
    <div class="w3-container w3-padding-16 w3-margin-left ">                      
            <p class="w3-tiny">
            ________________________ <br>
            ANDERSON ROJAS <br>
            Coordinador General
            </p>            
    </div>
  
         
         
         
        @include('boletin.footer')                             
        
    </body>
</html>
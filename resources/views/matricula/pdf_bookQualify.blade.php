<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Estudiante  {{ $student[0]->id_matricula }}  </title>
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
<body>
<div class="w3-row w3-tiny">
    <div class="w3-col">
        <img class="rounded"  src="{{ asset('/icon.jpg') }}" height="80" width="80">
    </div>
    <div class="w3-col w3-center">
           <p><b class="w3-small">INSTITUTO MODERNO DESEPAZ</b> <br>
           Resolución No 4143.010.21.9981 del 18 de Diciembre de 2017 de la Secretaría de Educación. <br>
           NIVELES PREESCOLAR, BÁSICA Y MEDIA <br>           
           <div  class="w3-serif padding-1 ">Instruye al niño en su camino que aún aunque fuera viejo no se apartará de él. Proverbio 22:6</div>
           <b class="w3-small"> INFORME FINAL DE VALORACI&Oacute;N</b>
           </p>             
    </div>
</div>
</header>
   
<table class="w3-table w3-tiny" border="1"  >
        <tr class="w3-tiny" >
            <td  style="width:19%;" colspan="2" class=" padding-1 "><b>ESTUDIANTE:</b>  {{ $fullname }}</td>            
            <td class=" padding-1" colspan="2"><b>DOCUMENTO:</b>  {{ $student[0]->identificacion }}</td>            
        </tr>
        <tr>
            <td class="padding-1"><b>JORNADA:</b>  {{ $student[0]->jornada }} </td>
            <td style="width:20%;" class=" padding-1"><b>MATRICULA:</b>    {{ $student[0]->id_matricula }}</td>
            <th class=" padding-1">FOLIO: </th>
            <td class=" padding-1"><b>FECHA EXPEDICI&Oacute;N:</b>  {{  date('Y-m-d') }}  </td>
        </tr>
        <tr class="w3-tiny" >
            <td  style="width:19%;" colspan="2" class="padding-1"><b>GRADO:</b>  {{ $student[0]->grupo }}  </td>
            <td class=" padding-1" colspan="2"><b>NIVEL:</b>  {{ $student[0]->nivel }}   </td>
        </tr>
        <tr>
            <td class=" padding-1"><b>CALENDARIO</b> A </td>            
            <td class=" padding-1" colspan="2"><b>MODALIDAD:</b>   ACAD&Eacute;MICA</td>           
            <td class=" padding-1"><b>AÑO LECTIVO:</b>  {{ date('Y') }}  </td>            
        </tr>                            
    </table>

<h6 class="w3-center w3-tiny"><b >RESUMEN DE EVALUACIONES</b></h6>
<div class="w3-row">

<div class="w3-col s12 ">
<table class="w3-table w3-tiny" border="1" >
        <thead>
        <tr class="w3-light-grey">            
            <td class="padding-1 w3-center">ÁREAS O ASIGNATURAS</td>
            <td class=" w3-center padding-1">IH</td>
            <th class="w3-center padding-1">1P</th>            
            <th class="w3-center padding-1">2P</th>
            <th class="w3-center padding-1">3P</th>                        
            <td class="w3-center padding-1">TOTAL</td>            
            <td class="w3-center padding-1">DESEMPEÑO</td>
        </tr>
        </thead>
        <tbody> 
        @foreach($allPeriods as $value)
        @php         
            $firstPeriod=explode('-',$value->primerPeriodo);
            $def1=isset($firstPeriod[0])? $firstPeriod[0]:'';

            $twoPeriod=explode('-',$value->segundoPeriodo);
            $def2=isset($twoPeriod[0])? $twoPeriod[0]:'';

            $threePeriod=explode('-',$value->tercerPeriodo);
            $def3=isset($threePeriod[0])? $threePeriod[0]:'';

            $rango=isset($threePeriod[1])? $threePeriod[1]:'';
        @endphp
        <tr>            
            <td class="padding-1">{{ $value->nombre }} </td>
            <td class="w3-center padding-1">{{ $value->intensidad_horaria }}</td>                                    
            <td class="w3-center padding-1">{{ number_format(floatval($def1),1)  }}</td>
            <td class="w3-center padding-1">{{  number_format(floatval($def2),1) }}</td>
            <td class="w3-center padding-1">{{ number_format(floatval($def3),1) }}</td>
            <td class="w3-center padding-1">{{ number_format(floatval($value->acumulativo),1) }}</td>                                    
            <td class="w3-center padding-1">{{ $rango }}</td>
        </tr>
        @endforeach        
        </tbody>        
</table>
<p class="w3-small">SITUACI&Oacute;N ACAD&Eacute;MICA :  {{  ($aprobo==1)? 'APROBO':'REPROBO' }}</p>
 </div>
</div>    
    @include('matricula.component.footerPdfBook')                                     
    </body>
</html>

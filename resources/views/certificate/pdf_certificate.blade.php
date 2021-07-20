<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $title .' '. $fullname }} </title>
        <meta name="description" content="Boletin Instituto Moderno">
        <meta name="viewport" content="width=device-width, initial-scale=1">                        
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style type="text/css">
        .padding-1{
            padding:1px 1px  !important;            
        }        
        @page {
                margin-top: 25px;
            }
        .bodyJust{
            font-family: Garamond !important;
            text-align: justify !important;
            text-justify: inter-word !important;
            padding:0.01em 100px !important;
        } 
        </style> 
</head>
@include('certificate.header')
<body>
<div class="bodyJust">
<br>
<div class="w3-container w3-padding-16 ">
   <p class="w3-small ">La suscrita Rectora del Colegio INSTITUTO MODERNO DESEPAZ de Cali Instituci&oacute;n de car&aacute;cter 
        Privado Genero Mixto, Calendario A, con reconocimiento Oficial de los estudios correspondientes a 
        los niveles de Preescolar, Grado Transici&oacute;n, Educación B&aacute;sica, Ciclo Primaria, Grado 1º a 5º, Ciclo 
        Secundaria Grados 6º a 9º seg&uacute;n Resoluci&oacute;n No. 1709 del 30 de Octubre de 2001 emanada de la  
        Secretaria de Educaci&oacute;n Departamental.
    </p>   
</div>   
   <h5 class="w3-center w3-small">CERTIFICAN</h5>

   <div class="w3-container w3-padding-6">
        <p class="w3-small">Que el Alumno(a) Que el Alumno(a) <b> {{ $fullname }} </b>
        Identificado(a) con {{ $student[0]->tipo_doc }} No. <b> {{ $student[0]->identificacion }} </b> curso y {{ ($aprobo==1)? 'aprobó':'No aprobó' }}  en este Colegio el Grado <b>{{ $student[0]->nombre }} ({{ $student[0]->tag  }}º) </b> de 
        Educaci&oacute;n B&aacute;sica Secundaria Durante el <b> Año Lectivo {{ $year }} </b> con la intensidad y valoraci&oacute;n que a 
        continuaci&oacute;n se relacionan.
        </p>
   </div>

   <table class="w3-table w3-tiny" border="1" >
        <thead>
        <tr class="w3-light-grey">
            <th class="padding-1 w3-center">GRUPO DE AREAS</th>
            <th class="w3-center padding-1">INTENSIDAD</th>
            <th class="w3-center padding-1">VALORACI&Oacute;N</th>
        </tr>
        </thead>
        <tbody>        
        @foreach($course as $value)
        @php $point=explode('-',$value->periodoNotas);
             $definitiva=isset($point[0])? $point[0]:'';
             $rango=isset($point[1])? $point[1]:'';
        @endphp
        <tr>            
            <td class="padding-1">{{ $value->nombre }} </td>
            <td class="w3-center padding-1">{{ $value->intensidad_horaria }}</td>                                    
            <td class="w3-center padding-1">{{ $definitiva .' '. $rango }}</td>
        </tr>
        @endforeach                
        </tbody>        
    </table>
     @if($aprobo==1)
        @php  $data=(!empty($student[0]->grado_next))? 1:0;  @endphp
        <p class="w3-small">El estudiante Fue promovido(a) {{ ($data)? 'al grado':'' }}   <b>{{ $student[0]->grado_next}} </b>    de acuerdo a la ley de promoción y evolución según decreto 1290. </p>
    @endif    
    <p class="w3-small">Expedido en Santiago de Cali, a los {{ date('d',strtotime($date)) }} d&iacute;as del mes  {{  date('m',strtotime($date))}} de {{date('Y',strtotime($date)) }}.</p>                   
        <p  class="w3-small" style="position:fixed;padding-left:120px;bottom:120px;" >
        _____________________ <br>
        {{ $footerCoor }}<br>
        {{ $footerDni }} <br>
        {{ $footerCar }}
        </p>               
@include('certificate.footer')
</div>
</body>
</html>
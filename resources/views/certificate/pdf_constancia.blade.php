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
        .bodyJust{   
            font-family: Garamond !important;         
            text-align: justify !important;
            text-justify:inter-word;
            padding:0.01px 100px !important;
            font-size:12px;
        } 
        </style> 
</head>
@include('certificate.header')

<body>
<div class="bodyJust">



<h5 class="w3-center w3-small w3-padding-48">El suscrito Coordinador General del  Instituto Moderno Desepaz</h5>
<h5 class="w3-center w3-small  w3-padding-48"><b>HACE CONSTAR </b></h5>

<div class="w3-padding-16">
   <p>Que el (a) estudiante <b>{{ $fullname }}</b> con {{ $student[0]->tipo_doc }}.  No.  <b>{{ $student[0]->identificacion }}</b> de Cali Valle, 
        se encuentra debidamente matriculado (a) en esta instituci&oacute;n en el grado <b>{{ $student[0]->nombre }} ({{ $student[0]->tag  }}º)  de 
        EDUCACI&Oacute;N MEDIA TECNICA CON ESPECIALIDAD COMERCIO CON ENFASIS EN CONTABILIDAD, </b>
        jornada de la mañana correspondiente al año lectivo {{ date('Y') }} 
    </p>
</div>  
<br>
<p class="w3-small">Para constancia se firma en Santiago de Cali, a los {{ date('d',strtotime($date)) }} días del mes de {{ date('m',strtotime($date)) }} del  {{date('Y',strtotime($date)) }}.</p>                       
    

    

       <p class="w3-small" style="position:relative; margin: 260px 0 0 10px;">
       _____________________ <br>
       {{ $footerCoor }}<br>
       {{ $footerDni }} <br>
       {{ $footerCar }}
       </p> 

@include('certificate.footer')
</div>
</body>
</html>
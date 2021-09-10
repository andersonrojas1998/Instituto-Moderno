<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $title }} </title>
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
       /* .bodyJust{
            font-family: Garamond !important;
            text-align: justify !important;
            text-justify: inter-word !important;
            padding:0.01em 100px !important;
        }*/ 
        </style> 
</head>
@include('matricula.component.header')
<body>
<div class="bodyJust">


<p class="w3-tiny">PARA TENER EN CUENTA: Antes de escribir, lea con cuidado las observaciones. Diligencie en letra imprenta con bolígrafo de tinta negra. El Instituto Moderno Desepaz es un colegio que forma estudiantes con principios cristianos en las dimensiones Espiritual, Ética, Cognitiva y Corporal; para fortalecer su capacidad de amar, pensar, comunicar y producir en beneficio de la familia, el medio ambiente y la sociedad; por lo tanto, no se matricula sólo el estudiante, también la familia.</p>
   
   <table class="w3-table w3-tiny" border="1" >
        <thead>
        <tr class="w3-light-grey">
            <th class="padding-1 w3-center " colspan="3">Solicitud de ingreso para el grado</th>            
            <th class="w3-center padding-1">Periodo lectivo 2022</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td >
                        
                            <p>Preescolar</p><br>
                            <p>Jardin  </p> <div style="border-radius:20px;border:outset;width: 20px;background:red;"></div>
                            <p>Preescolar</p><br>
                            <p>Jardin  <div style="border-radius:20px;"></div></p>
                        
                </td>
                <td >
                <div class="w3-row">
                            <p>Preescolar</p><br>
                            <p>Jardin  <div style="border-radius:20px;"></div></p>
                            <p>Preescolar</p><br>
                            <p>Jardin  <div style="border-radius:20px;"></div></p>
                        </div>
                </td>
                <td >
                <div class="w3-row">
                            <p>Preescolar</p><br>
                            <p>Jardin  <div style="border-radius:20px;"></div></p>
                            <p>Preescolar</p><br>
                            <p>Jardin  <div style="border-radius:20px;"></div></p>
                        </div>
                </td>
                <td class="w3-center">                
                </td>
            </tr>
        </tbody>        
    </table>

    

    

      

</div>
</body>
</html>
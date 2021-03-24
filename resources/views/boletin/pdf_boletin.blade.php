<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Boletin</title>
        <meta name="description" content="Reporte de Cuidadores , Cuidarte en casa S.A.S">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
       <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">       
    </head>    
    <body>

<div class="w3-row w3-tiny w3-padding-16">

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
    

<div class="w3-row">
<table class="w3-table  w3-padding-0 w3-tiny" border="1" >
        <tr class="w3-tiny">
            <th  style="width:20%;" class="w3-light-grey">ESTUDIANTE:</th>
            <td>Anderson Rojas</td>
            <th class="w3-light-grey">GRADO:</th>
            <td>5-B</td>            
        </tr>
        <tr>
        <th class="w3-light-grey">DIRECTOR DE GRUPO: </th>            
            <td>Jessica castro</td>
            <th  style="width:20%;" class="w3-light-grey"> JORNADA:</th>
            <td>TARDE</td>        
        </tr>
        <tr>
            <th class="w3-light-grey">ACUDIENTE: </th>
            <td>Amparo Capera</td>
            <th class="w3-light-grey">CALENDARIO:</th>
            <td>CALENDARIO A</td>
        </tr>
        <tr>
            <th class="w3-light-grey">MODALIDAD: </th>
            <td>ACADEMICA</td>
            <th class="w3-light-grey">FECHA EXPED:</th>
            <td>{{ date('Y-m-d')}}</td>
        </tr>                            
    </table>

</div>
<!-- https://www.w3schools.com/w3css/w3css_padding.asp -->
<p class="w3-tiny">CONVENCIONES: APA = Actividades pedagógicas de apoyo, NMP = Nota mínima para ganar el siguiente periodo, ACUM = Acumulado.</p>                 
<h6 class="w3-center w3-small">RESUMEN DE EVALUACIONES</h6>
    <div class="w3-row">
    <div class="w3-half w3-container w3-tiny">

    <table class="w3-table" border="1" >
        <thead >
        <tr>
            <td>ÁREAS O ASIGNATURAS</td>
            <td class="w3-light-grey">IH</td>
            <td class="w3-light-grey">1P 35%</td>
            <td> AP1</td>
            <td>ACUM</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1. MATEMATICAS</td>
            <td class="text-center">6</td>
            <td class="text-center">4.0</td>
            <td></td>
            <td class="text-center">3.9</td>
        </tr>
        <tr>
            <td>1. MATEMATICAS</td>
            <td class="text-center">6</td>
            <td class="text-center">4.0</td>
            <td></td>
            <td class="text-center">3.9</td>
        </tr>
        <tr>
            <td>1. MATEMATICAS</td>
            <td class="text-center">6</td>
            <td class="text-center">4.0</td>
            <td></td>
            <td class="text-center">3.9</td>
        </tr>
        <tr>
            <td>1. MATEMATICAS</td>
            <td class="text-center">6</td>
            <td class="text-center">4.0</td>
            <td></td>
            <td class="text-center">3.9</td>
        </tr>        
        </tbody>        
    </table>
</div>        
</div>        
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
    </div>


<div class="w3"></div>
    <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="p-4 border-bottom bg-light">
        <h4 class="card-title mb-0">Bar Chart</h4>
      </div>
      <div class="card-body">
        <div class="d-sm-flex justify-content-between align-items-center pb-4">
          <h4 class="card-title mb-0">Sales Revenue</h4>
          <div id="bar-traffic-legend"></div>
        </div>
        <p class="mb-4">17% increase in sales than last week</p>
        <canvas id="barChart" style="height:250px"></canvas>
      </div>
    </div>
  </div>


    
    
         
         
         
         

        <div class="page"></div>                        
    </body>
</html>
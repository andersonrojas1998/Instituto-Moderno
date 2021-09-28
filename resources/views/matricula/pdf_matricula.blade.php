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
        .padding-3{
            padding:3px 3px  !important;            
        }
        .pt-5{
            padding-top:8px !important;
        }

        @page {
                margin-top: 25px;
            }
            .uppercase{
                text-transform: uppercase;
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



   <br>
   <table class="w3-table w3-tiny" border="1" >
        <thead>
        <tr class="w3-light-grey">
            <th class="padding-1 w3-center ">GRADO</th>            
            <th class="w3-center padding-1">JORNADA</th>
        </tr>
        </thead>        
        <tbody>
            <tr>
                <td class="w3-center padding-1">{{ $student[0]->grado }}</td>
                <td class="w3-center padding-1">{{ $student[0]->jornada }}</td>
            </tr>
            
        </tbody>        
    </table>

<table class="w3-table w3-tiny pt-5" border="1" >
        <thead>
        <tr class="w3-light-grey " >
                <th colspan="4" class="w3-center padding-3">DATOS DEL ESTUDIANTE</th>
        </tr>        
        </thead>        
        <tbody>
            <tr>
                <td class="padding-3 uppercase"><b>APELLIDOS:</b>  &nbsp;  {{  $student[0]->apellido1 }}  {{  $student[0]->apellido2 }} </td>
                <td class="padding-3 uppercase"><b>NOMBRES:</b>  &nbsp; {{  $student[0]->nombre1 }} {{  $student[0]->nombre2 }}</td>
                <td class="padding-3 uppercase" colspan="2"><b>CODIGO ESTUDIANTE:</b>  &nbsp; {{  $student[0]->id_matricula }}</td>
            </tr>
            <tr>
                <td class="padding-3 uppercase"><b>LUGAR DE NACIMIENTO:</b>   &nbsp; {{  $student[0]->lugar_nacimiento }}</td>
                <td class="padding-3 uppercase"><b>NACIONALIDAD:</b>   &nbsp; {{  $student[0]->pais }}</td>
                <td class="padding-3 uppercase"><b>FECHA DE NACIMIENTO:</b>   &nbsp; {{  $student[0]->fecha_nacimiento }}</td>
                <td class="padding-3 uppercase"><b>EDAD:</b>  &nbsp; {{  $student[0]->edad }}</td>
            </tr>
            <tr>
                <td class="padding-3 uppercase"><b>IDENTIFICACION:</b> &nbsp; {{  $student[0]->identificacion }} </td>
                <td class="padding-3 uppercase"><b>EXPEDIDA EN:</b>  &nbsp; {{  $student[0]->lugar_expedicion }}</td>
                <td class="padding-3 uppercase" colspan="2"><b>DIRECCION:</b>  &nbsp; {{  $student[0]->direccion }}</td>
            </tr>
            <tr>
                <td class="padding-3 uppercase"><b>TELEFONO:</b> &nbsp; {{  $student[0]->telefono }}</td>
                <td class="padding-3 uppercase"><b>EPS/SISBEN:</b> &nbsp; {{  $student[0]->eps }}</td>
                <td class="padding-3 uppercase"><b>SEXO:</b> &nbsp; {{  $student[0]->genero }}</td>
                <td class="padding-3 uppercase"><b>ESTRATO:</b> &nbsp;</td>
            </tr>
        </tbody>        
</table>

<table class="w3-table w3-tiny pt-5" border="1" >
        <thead>
        <tr class="w3-light-grey " >
                <th colspan="4" class="w3-center padding-3">DATOS FAMILIARES</th>
        </tr>        
        </thead>        
        <tbody>
            <tr>
                <td class="padding-3 uppercase"><b>PADRE:</b> &nbsp; {{  isset($father[0]->nombre)? $father[0]->nombre:'' }}</td>
                <td class="padding-3 uppercase" ><b>VIVE:</b> &nbsp; {{ isset($father[0]->viveCon)? $father[0]->viveCon:'' }}</td>
                <td class="padding-3 uppercase"><b>MADRE:</b> &nbsp; {{  isset($mother[0]->nombre)? $mother[0]->nombre:'' }}</td>
                <td class="padding-3 uppercase"><b>VIVE:</b> &nbsp; {{  isset($mother[0]->viveCon)? $mother[0]->viveCon:'' }}</td>
            </tr>
            <tr>
                <td class="padding-3 uppercase" colspan="2"><b>DIRECCION RESIDENCIA:</b> &nbsp; {{  isset($father[0]->direccion)? $father[0]->direccion:'' }}</td>
                <td class="padding-3 uppercase" colspan="2"><b>DIRECCION RESIDENCIA:</b> &nbsp; {{  isset($mother[0]->direccion)? $mother[0]->direccion:'' }}</td>                
            </tr>
            <tr>
                <td class="padding-3 uppercase" ><b>BARRIO RESIDENCIA:</b> &nbsp; {{  isset($father[0]->barrio)?  $father[0]->barrio:'' }}</td>
                <td class="padding-3 uppercase" ><b>TELEFONO:</b> &nbsp; {{  isset($father[0]->telefono)? $father[0]->telefono:'' }}</td>                
                <td class="padding-3 uppercase" ><b>BARRIO RESIDENCIA:</b> &nbsp; {{  isset($mother[0]->barrio)?  $mother[0]->barrio:''}}</td>
                <td class="padding-3 uppercase" ><b>TELEFONO:</b> &nbsp; {{  isset($mother[0]->telefono)? $mother[0]->telefono:''}}</td>
            </tr>
            <tr>
                <td class="padding-3 uppercase" colspan="2"><b>OCUPACION:</b> &nbsp; {{  isset($father[0]->profesion)? $father[0]->profesion:'' }}</td>
                <td class="padding-3 uppercase" colspan="2"><b>OCUPACION:</b> &nbsp; {{  isset($mother[0]->profesion)? $mother[0]->profesion:'' }}</td>                
            </tr>
            <tr>
                <td class="padding-3 uppercase" ><b>EMPRESA:</b> &nbsp; {{  isset($father[0]->empresa)? $father[0]->empresa:'' }}</td>
                <td class="padding-3 uppercase" ><b>TELEFONO:</b> &nbsp; {{  isset($father[0]->telefono)? $father[0]->telefono:'' }}</td>                
                <td class="padding-3 uppercase" ><b>EMPRESA:</b>&nbsp; {{  isset($mother[0]->empresa)? $mother[0]->empresa:'' }}</td>
                <td class="padding-3 uppercase" ><b>TELEFONO:</b> &nbsp; {{  isset($mother[0]->telefono)? $mother[0]->telefono:'' }}</td>                
            </tr>
            <tr>
                <td class="padding-3 uppercase" colspan="2"><b>IDENTIFICACION:</b> &nbsp; {{  isset($father[0]->identificacion)? $father[0]->identificacion:'' }}</td>
                <td class="padding-3 uppercase" colspan="2"><b>IDENTIFICACION:</b> &nbsp; {{  isset($mother[0]->identificacion)? $mother[0]->identificacion:'' }}</td>                
            </tr>
            <tr>
                <td class="padding-3" colspan="4"><b>ESTADO CIVIL DE LOS PADRES:</b> &nbsp;
                <input type="checkbox"  class="w3-medium">CASADOS  &nbsp;
                <input type="checkbox" class="w3-medium">UNION LIBRE &nbsp;
                <input type="checkbox" class="w3-medium">SEPARADOS &nbsp;
                OTRO:
            </td>                

            <tr>
                <td class="padding-3 uppercase" colspan="2" ><b>NOMBRE DEL ACUDIENTE:</b> &nbsp; {{  isset($responzable[0]->nombre)? $responzable[0]->nombre:'' }}</td>
                <td class="padding-3 uppercase" ><b>IDENTIFICACION:</b> &nbsp; {{  isset($responzable[0]->identificacion)? $responzable[0]->identificacion:'' }}</td>                
                <td class="padding-3 uppercase" ><b>PARENTESCO:</b> &nbsp; {{  isset($responzable[0]->parentesco)? $responzable[0]->parentesco:'' }}</td>                
            </tr>
            <tr>
                <td class="padding-3 uppercase" colspan="2" ><b>DIRECCION DEL ACUDIENTE:</b>  &nbsp; {{  isset($responzable[0]->direccion)? $responzable[0]->direccion:'' }}</td>
                <td class="padding-3 uppercase" ><b>BARRIO:</b> &nbsp; {{  isset($responzable[0]->barrio)? $responzable[0]->barrio:'' }}</td>                
                <td class="padding-3 uppercase" ><b>TELEFONO:</b> &nbsp; {{  isset($responzable[0]->telefono)? $responzable[0]->telefono:'' }}</td>                
            </tr>
            </tr>            
        </tbody>        
</table>
    

<table class="w3-table w3-tiny pt-5" border="1" >
        <thead>
        <tr class="w3-light-grey " >
                <th colspan="5" class="w3-center padding-3">DATOS GENERALES</th>
        </tr>        
        </thead>        
        <tbody>            
            <tr>            
                <td class="padding-3"><b>No. DE HERMANOS:</b>  &nbsp;  {{  $student[0]->total_hermanos }}  {{  $student[0]->total_hermanos }}</td>
                <td class="padding-3"><b>MUJERES HOMBRES:</b> &nbsp;  {{  $student[0]->no_mujeres }}  {{  $student[0]->no_mujeres }}</td>
                <td class="padding-3"><b>LUGAR QUE OCUPA:</b> &nbsp;  {{  $student[0]->lugar_ocupa_hermanos }}  {{  $student[0]->lugar_ocupa_hermanos }}</td>
                <td class="padding-3"><b>CUANTOS VIVEN CON EL:</b></td>
                <td class="padding-3"><b>CON QUIEN PERMANECE MAS TIEMPO:</b></td>
            </tr>
            <tr>
                <td class="padding-3" colspan="3"><b>AREA DE ESTUDIOS PREFERIDA:</b></td>
                <td class="padding-3" colspan="2"><b>AREA DE MAYOR DIFICULTAD:</b></td>                
            </tr>
            
            <tr>
                <td class="padding-3" colspan="5"><b>APTITUDES PARA:</b> &nbsp;
                <input type="checkbox"  class="w3-medium">DEPORTE  &nbsp;
                <input type="checkbox" class="w3-medium">TEATRO &nbsp;
                <input type="checkbox" class="w3-medium">CANTO &nbsp;
                <input type="checkbox" class="w3-medium">INVESTIGACION &nbsp;
                OTRO:
            </td>                
            <tr>
                <td class="padding-3" colspan="5" ><b>HISTORIA CLINICA DEL ESTUDIANTE:</b> _________________________________________________________________________________________________________________________________<br>
                _________________________________________________________________________________________________________________________________<br>
                _________________________________________________________________________________________________________________________________<br>
            </td>        
            <tr>
                <td class="padding-3" colspan="5" ><b>OBSERVACIONES:</b> _________________________________________________________________________________________________________________________________<br>
                _________________________________________________________________________________________________________________________________<br>
                _________________________________________________________________________________________________________________________________<br>
            </td>        
            </tr>

            </tr>            
        </tbody>        
</table>
      
@include('matricula.component.footerPdf')                             
</div>
</body>
</html>
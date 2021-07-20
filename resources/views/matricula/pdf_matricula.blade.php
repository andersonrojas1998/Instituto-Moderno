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
@include('certificate.header')
<body>
<div class="bodyJust">


   
   <table class="w3-table w3-tiny" border="1" >
        <thead>
        <tr class="w3-light-grey">
            <th class="padding-1 w3-center">GRADO :  </th>
            <th class="w3-center padding-1">JORNADA</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="w3-center"></td>
                <td class="w3-center"></td>
            </tr>
        </tbody>        
    </table>

    

    

      
@include('certificate.footer')
</div>
</body>
</html>
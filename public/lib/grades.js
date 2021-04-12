$(document).ready(function() {
    dt_grades();
  } );
  
  
  var dt_grades=function(){
    $('#dt_grades').DataTable({ 
        responsive: true,
        ajax: {
            url: "/dt_grades",
            method: "GET", 
            dataSrc: function (json) {
                if (!json.data) {
                    return [];
                } else {
                    return json.data;
                }
              }               
            },      
        columnDefs: [{"className": "text-center", "targets": "_all"},],
        columns: 
        [
            { "data": "con" , render(data){return '<b>'+data+'</b>';}},
            { "data": "nombre" },
            { "data": "grupo",render(data,type,row){ return '<div class="text-info">'+  data +'</div>'; }},
            { "data": "jornada",render(data,type,row){ return '<div class="text-info">'+  data +'</div>'; }},
            { "data": "name",render(data,type,row){ return '<div class="text-capitalize">'+  data +'</div>'; }},
            { "data": "alumnos",render(data,type,row){ return '<span class="badge badge-success text-white">'+  data +'</span>'; }},
            { "data": "actions",render(data,type,row){ 
                return '<i  data-toggle="tooltip" data-placement="top" data-original-title="Editar" class=" icon-md mdi mdi-pencil-box-outline text-primary"></i>'+
                '<i class=""></i>'
                
            }}
        ]
    });
  }
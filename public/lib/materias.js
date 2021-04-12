$(document).ready(function() {
    dt_materias();
  } );
  
  
  var dt_materias=function(){
    $('#dt_materias').DataTable({ 
        responsive: true,
        ajax: {
            url: "/dt_materias",
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
            { "data": "tag",render(data,type,row){ return '<div class="text-info">'+  data +'</div>'; }},            
            { "data": "orden_print",render(data,type,row){ return '<span class="badge badge-success text-white">'+  data +'</span>'; }},
            { "data": "actions",render(data,type,row){ 
                return '<i  data-toggle="tooltip" data-placement="top" data-original-title="Editar" class=" icon-md mdi mdi-pencil-box-outline text-primary"></i>'+
                '<i class="icon-md  mdi mdi-delete-forever text-danger"></i>';
                
            }}
        ]
    });
  }
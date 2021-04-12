$(document).ready(function() {
    "use strict";
    dt_teacher();
} );


var dt_teacher=function(){
    $('#dt_teacher').DataTable({
        destroy: true,
        searching:true,            
        ajax: {
            url: "/dt_user",
            method: "GET", 
            dataSrc: function (json) {
                if (!json.data) {
                    return [];
                } else {
                    return json.data;
                }
              }               
            },
        deferRender: true,            
        columnDefs: [{"className": "text-center", "targets": "_all"},],
        columns: 
        [
                { "data": "con" , render(data){return '<b>'+data+'</b>';}},
                { "data": "dni" },
                { "data": "name",render(data,type,row){ return '<div class="text-info">'+  data +'</div>'; }},
                { "data": "celular"},
                { "data": "genero", render(data){ return '<div class="text-info">'+ (data=='M')? 'Masculino':'Femenino'  +'</div>'; }},
                { "data": "sede"},
                {"data": "cargo"},                 
                {"data": "estado", render(data){ let st=(data)? 'Activo':'Inactivo'; let color=(data)? 'success':'danger'; return  '<label class="badge text-white badge-'+color+' ">'+ st  +'</label>'; }},
        ]
    });
}
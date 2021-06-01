$(document).ready(function() {
    dt_enrollment();
  });
  
  
  var dt_enrollment=function(){
    var table=$('#dt_enrollment').DataTable({ 
       ajax: {
            url: "/matricula/listEnrollment",
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
                { "data": "id" , render(data){return '<b>'+data+'</b>';}},
                { "data": "fecha_matricula",render(data,type,row){ return '<div class="text-info">'+  data +'</div>'; }},
                { "data": "grado" },
                { "data": "name"},                                                
                {"data": "estado", render(data){ let color=(data=='ACTIVO')? 'success':'danger'; return  '<label class="badge text-white badge-'+color+' ">'+ data  +'</label>'; }},
                { "data": "actions" , render(data,ps,d){ 
                    let button='';
                    button+='<div><i  class="mdi mdi-pencil-box-outline text-primary" style="font-size:25px;"></i></div>';
                    button+='&nbsp;<div><i  class="mdi mdi-information-outline text-info" style="font-size:25px;"></i></div>';
                return button;
                }},
        ]
    });    

  }
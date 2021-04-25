$(document).ready(function() {

    dt_summaryRating(1);
    $(document).on("change","#sel_periodSummay",function(){ 
        var p=$(this).val();
        dt_summaryRating(p);
    });
    
    $(document).on("click","#btn_showQ",function(){        
        var g=$(this).attr('data-grade');
        var p=$(this).attr('data-period');
        var t=$(this).attr('data-teacher');
        var c=$(this).attr('data-course');
        dt_qualificationsPeriod(g,p,t,c);
    });    

});

function dt_summaryRating(period){
    $('#dt_summaryRating').DataTable({        
        lengthChange: false,        
        responsive: true,
        destroy: true,   
        searching:false, 
        "ordering": false,
        lengthMenu:false,
        paginate:false,
        ajax: {
            url: "/Calificaciones/summaryRating/"+period,
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
                { "data": "conc" , render(data){return '<b>'+data+'</b>';}},
                { "data": "nombre" },
                { "data": "grupo"},
                { "data": "asignatura"},
                { "data": "created"},
                { "data": "status", render(data){ return  '<label class="badge badge-success text-white p-1">Calificado</label>';  }},
                { "data": "actions", render(data,ps,d){ return '<div id="btn_showQ" data-grade='+d.id_grado+' data-period='+period+' data-teacher='+d.actions+' data-course='+d.id_asignatura+' data-toggle="modal" data-target="#mdl_showQualification"><img src="/images/details_open.png" style="width:20px;height:20px;"> </div>';     } }                
        ]
    });

}
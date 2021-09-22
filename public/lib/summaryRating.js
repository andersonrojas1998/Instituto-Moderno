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
    
    $(document).on("click","#btn_delQualifications",function(){        
        
        let period=$(this).attr('data-period');
        let course=$(this).attr('data-course');
        let grade=$(this).attr('data-grade');
        Swal.fire({
            title: '\u00A1Atenci\u00f3n!',
            text: "Estas seguro que deseas ELIMINAR las calificaciones , esta acción no se podra reversar !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar '
          }).then((result) => {
            if (result.isConfirmed) {
                sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',6000);
                $.ajax({
                    url: '/Calificaciones/delQualifications/'+period+'/'+course+'/'+grade,
                    method: 'get',
                    dataType: "JSON",
                    success: function(data){
                        sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');                        
                        setTimeout(function () { location.reload() }, 2000)
                 },error:function(res,tx,status){                    
                     if(res.status==500){                        
                        sweetMessage('\u00A1Atenci\u00f3n!',"ERROR AL ELIMINAR  ", 'error');
                     }                    
                 }
                });
              

            }
          });
    });

});

function dt_summaryRating(period){
    $('#dt_summaryRating').DataTable({  
        dom: 'Bfrtip',
          buttons: [
            'excel', 'pdf', 'print'
          ],      
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
                { "data": "actions", render(data,ps,d){                     
                    let del=(d.validate.result)? '<div id="btn_delQualifications"  data-grade='+d.id_grado+' data-period='+period+' data-teacher='+d.actions+' data-course='+d.id_asignatura+' ><img src="/images/details_close.png" style="width:20px;height:20px;" data-toggle="tooltip" data-placement="top" data-title="Eliminar Calificaciones"> </div>':'';
                    let buttons='<div id="btn_showQ" data-grade='+d.id_grado+' data-period='+period+' data-teacher='+d.actions+' data-course='+d.id_asignatura+' data-toggle="modal" data-target="#mdl_showQualification"><img src="/images/details_open.png" style="width:20px;height:20px;"> </div>'+del;
                    return  buttons;     
                } }                
        ]
    });

}
$(document).ready(function() {
    dt_periodos();

    $(document).on("click","#btn_closeTime_period",function(){      
        let id=$(this).attr('data-id');
        Swal.fire({
            title: '\u00A1Atenci\u00f3n!',
            text: "Estas seguro que deseas Cerrar el periodo de Habilitacion !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Inactivar'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/periodos/closeTime/'+id,                    
                    method: 'GET',
                    dataType: "JSON",                    
                success: function(data){                          
                    sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');                  
                    setTimeout(function () { location.reload() }, 2000);
                 }
                });              
            }
          });


    });

    $(document).on("click","#btn_show_period",function(){        
        let id=$(this).attr('data-id');
        $('#btn_edit_period').attr('data-id',id);
        $.ajax({
            url:"/periodos/show/"+id,
            type:"GET",
            data:{id:id},
            dataType:"JSON",
            success:function(data){
                $("input[name='perido_edit']").val(data.nombre);
                $('input[name="porcentaje"]').val(data.porcentaje);
                $('input[name="fecha_inicio"]').val(data.inicio_periodo);
                $('input[name="fecha_fin"]').val(data.fin_periodo);
                $('.hab-date-txt').text(data.habilitacion);
                $('input[name="hab-date-val"]').val(data.habilitacion);
            }
        });
    });
    
    $(document).on("click","#btn_edit_period",function(e){
        e.preventDefault();
        let id_periodo=$(this).attr('data-id');
        let formData = new FormData($('#form_editPeriod')[0]);
        formData.append('id_periodo',id_periodo)
        $.ajax({
            url:"/periodos/edit",
            type:"POST",
            data:formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                    
           success:function(data){
               if(data==1){
                sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                setTimeout(function () { location.reload() }, 2000);
               }

           }
        });

    });
});
  
  
  var dt_periodos=function(){
    $('#dt_periodos').DataTable({ 
        responsive: true,
        ajax: {
            url: "/periodos/all",
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
            { "data": "porcentaje",render(data,type,row){ return '<div class="text-info">'+  data +'<b>%</b></div>'; }},            
            { "data": "inicio_periodo",render(data,type,row){ return '<span class="badge badge-success text-white">'+  data +'</span>'; }},
            { "data": "fin_periodo",render(data,type,row){ return '<span class="badge badge-success text-white">'+  data +'</span>'; }},
            { "data": "habilitacion",
            render(data,p,d){
                let show='<p class="text-info">-</p>';
                  if(data != null){
                    show='<ul><li><p>Dias Habilitados  <b>'+d.dias+'</b> </p> </li><li><strong class="text-danger">'+data+'</strong>  </li> </ul>';
                  } 
                return show;   
            }
            },
            { "data": "actions",render(data,type,row){ 
                let actions;
                let cierre=(row.habilitacion != null)? '<div data-toggle="tooltip" data-placement="top" data-title="Cierre de Periodo" id="btn_closeTime_period" data-id="'+row.id_periodo+'"><i class="icon-md mdi mdi-alarm-off text-warning"></i></div>':'';
                actions='<div data-target="#mdl_edit_period" data-toggle="modal" data-id="'+row.id_periodo+'" id="btn_show_period"><i  data-toggle="tooltip" data-placement="top" data-original-title="Editar" class=" icon-md mdi mdi-pencil-box-outline text-primary"></i></div>&nbsp;'+cierre;
                return actions;
            }}
        ]
    });
  }
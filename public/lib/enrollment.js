
$(document).ready(function() {
    dt_enrollment();

    
    $(document).on("click","#btn_showEditEnrollement",function(){ 
      let idGrade=$(this).attr('data-grade');
      let idMat=$(this).attr('data-idMat');
      $('.btn_edit_enrollement').attr('data-mat',idMat);
      $('#sel_gradeStudents >option[value='+idGrade+']').attr('selected',true).trigger('change');
    });
    
    $(document).on("click",".btn_edit_enrollement",function(){ 

      let id_grado=$("#sel_gradeStudents").val();      
      let id_matricula=$(this).attr('data-mat');
      let prop=$(".switchChange").prop('checked');
      let data={id_grado:id_grado,id_matricula:id_matricula};
      if(prop){
        data['estado']=$('#statusEnrollement').val();
        data['motivo']=$('#motiveEnrollement').val();
      }
      $.ajax({
        url:"/matricula/edit_enrollement",
        type:"POST",
        data:data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType:"JSON",
        success:function(data){
            if(data){
                sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                setTimeout(function () { location.reload() }, 2000);
            }
            
        }
    });

    });



    $(document).on("click",".switchChange",function(){ 
      
      if($(this).prop('checked')){
        $('.pnl_change').css('display','flex');
        $.ajax({ url:"/matricula/listChangeStatus",type:"GET",dataType:"JSON", success:function(data){
          let estado=data.estados;
          let motivos=data.motivos;
          let tr=[];
          for(let i=0;i<estado.length;i++){ 
             tr[i]='<option   value="'+estado[i].id_estado+'" >'+ firstLetter(estado[i].nombre.toLowerCase())  +'</option>';                                
          }
          $('#statusEnrollement').html(tr);
          let tr1=[];
          for(let i=0;i<motivos.length;i++){                    
            tr1[i]='<option   value="'+motivos[i].id_motivos_retiro+'" >'+ firstLetter(motivos[i].descripcion.toLowerCase())  +'</option>';            
        }
        $('#motiveEnrollement').html(tr1);              
          $('#statusEnrollement').select2();
          $('#motiveEnrollement').select2();        
      }
      });

      }else{
        $('.pnl_change').css('display','none');
        $('#statusEnrollement').select2('destroy');
        $('#motiveEnrollement').select2('destroy');
      }
      
    });
    

  });
  
  
  var dt_enrollment=function(){
    var table=$('#dt_enrollment').DataTable({ 
      dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
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
                    button+='<div data-toggle="modal" id="btn_showEditEnrollement" data-idMat='+d.id +' data-grade='+d.idGrado+' data-target="#mdl_showEnrollement"><i  class="mdi mdi-pencil-box-outline text-primary" style="font-size:25px;"></i></div>';                    
                return button;
                }},
        ]
    });    

  }
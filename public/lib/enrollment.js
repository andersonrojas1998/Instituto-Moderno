
$(document).ready(function() {
    dt_enrollment();

    
    $(document).on("click","#btn_showEditEnrollement",function(){ 
      let idGrade=$(this).attr('data-grade');
      $('#sel_gradeStudents >option[value='+idGrade+']').attr('selected',true).trigger('change');
    });

    $(document).on("click",".switchChange",function(){ 
      
      if($(this).prop('checked')){
        $('.pnl_change').css('display','flex');

        $.ajax({ url:"/matricula/listChangeStatus",type:"GET",dataType:"JSON", success:function(data){
          let estado=data.estados;
          let motivos=data.motivos;
          for(let i=0;i<estado.length;i++){                    
              $('#statusEnrollement').append('<option   value="'+estado[i].id_estado+'" >'+ firstLetter(estado[i].nombre.toLowerCase())  +'</option>');              
          }
          for(let i=0;i<motivos.length;i++){                    
            $('#motiveEnrollement').append('<option   value="'+motivos[i].id_motivos_retiro+'" >'+ firstLetter(motivos[i].descripcion.toLowerCase())  +'</option>');              
        }
          $('#statusEnrollement').select2();
          $('#motiveEnrollement').select2();        
      }
      });

      }else{
        $('.pnl_change').css('display','none');
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
                    button+='<div data-toggle="modal" id="btn_showEditEnrollement" data-grade='+d.idGrado+' data-target="#mdl_showEnrollement"><i  class="mdi mdi-pencil-box-outline text-primary" style="font-size:25px;"></i></div>';                    
                return button;
                }},
        ]
    });    

  }
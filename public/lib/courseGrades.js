$(document).ready(function() {

    $(document).on("change","#sel_gradeStudents",function(){ 
        let id=$(this).val();
        dt_courseGrades(id);
    });
    $(document).on("click","#show_create_course_grade",function(){ 
        sel_option("/showTeacher",'#sel_teacher_cour'); 
        sel_option("/showAsinaturas",'#sel_cour_cour'); 
        $.ajax({ url:"/grades",type:"GET",success:function(data){
            let arr=JSON.parse(data);
            for(let i=0;i<arr.length;i++){
                $('#sel_grade_cour').append('<option   value="'+arr[i].id_grado+'" >'+ firstLetter(arr[i].grupo.toLowerCase())  +'</option>');
            }
            $('#sel_grade_cour').select2();
        }
        });

    });

    

    $(document).on("click","#btn_saveCourseGrade",function(){ 
        let id_grade=$('#sel_grade_cour').val();
        let teacher=$('#sel_teacher_cour').val();
        let cour=$('#sel_cour_cour').val();
        let ih=$('#ih_cour').val();
        if(id_grade!="" && teacher!="" && cour!="" && ih!=""){
            $.ajax({
                url:"/cursos/addCourseGrade",
                type:"POST",
                data:{id_grado:id_grade,id_docente:teacher,id_materia:cour,ih:ih},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType:"JSON",
                success:function(data){
                    if(data){
                        sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                        setTimeout(function () { location.reload() }, 2000);
                    }else{
                        sweetMessage('\u00A1Atenci\u00f3n!', 'La materia seleccionada ya se encuentra asignada al grado .', 'warning');
                    }
                    
                }
            });

        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }
    });


});

var dt_courseGrades=function(id){
    $('#dt_courseGrades').DataTable({ 
        dom: 'Bfrtip',
        buttons: [
          'excel', 'pdf', 'print'
        ],
        responsive: true,
        destroy:true,
        ajax: {
            url: "/cursos/grado/"+id,
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
            { "data": "grado" },
            { "data": "docente",render(data,type,row){ return '<div class="text-capitalize text-bold">'+  data +'</div>'; }},
            { "data": "asignatura",render(data,type,row){ return '<div class="text-capitalize">'+  data +'</div>'; }},            
            { "data": "ih",render(data,type,row){ return '<span class="badge badge-success text-white">'+  data +'</span>'; }},
            /*{ "data": "actions",render(data,type,row){ 
                return '<i  id="btn_show_edit" data-id='+row.id+' data-toggle="modal" data-target="#mdl_edit_grades" class=" icon-md mdi mdi-pencil-box-outline text-primary"></i>'+
                '<i class=""></i>'
                
            }}*/
        ]
    });
  }
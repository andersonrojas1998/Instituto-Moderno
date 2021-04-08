$(document).ready(function() {

    
    $.ajax({ url:"/showTeacher",type:"GET",success:function(data){
        let arr=JSON.parse(data);
        for(let i=0;i<arr.length;i++){                    
            $('#sel_teacher').append('<option   value="'+arr[i].id+'" >'+ firstLetter(arr[i].name.toLowerCase())  +'</option>');
        }
        $('#sel_teacher').select2();
    }
    });
    

    $(document).on("click","#loadExcel",function(){        
        var formData = new FormData($("#formExcelLoad")[0]);        
        Swal.fire({
            title: '\u00A1Atenci\u00f3n!',
            text: "Estas seguro que deseas cargar el boletin de calificaciones !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si !'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/readEnrollmentQualification',
                    data: formData,
                    method: 'post',
                    cache: false,
                    contentType: false,
                    processData: false,                                                            
                    dataType: "JSON",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(data){                     
                        sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!'); setTimeout(function () { location.reload() }, 2000);                    
                 },error:function(res,tx,status){                    
                     if(res.status==500){
                        var data=JSON.parse(res.responseText);                    
                        sweetMessage('\u00A1Atenci\u00f3n!',JSON.parse(data.message).message, 'error');
                     }                    
                 }
                });
              

            }
          })



        

    });

    $(document).on("change","#sel_teacher",function(){
        let idUser=$(this).val();
        $.ajax({ url:"/showGradesAssign",type:"GET",data:{idTeacher:idUser},success:function(data){
            let arr=JSON.parse(data);
            $('#sel_grades').select2().empty();
            $('#sel_course').select2().empty(); 
            $('#sel_grades').append('<option value="">Seleccione</option>');
            for(let i=0;i<arr.length;i++){                                    
                $('#sel_grades').append('<option   value="'+arr[i].id_grado+'" >'+ firstLetter(arr[i].grupo.toLowerCase())  +'</option>');
            }
            $('#sel_grades').select2();
        }
        });
    });

    $(document).on("change","#sel_grades",function(){
        let idUser=$("#sel_teacher").val();  
        let idgrade=$(this).val();  
        $.ajax({ url:"/assignmentCourseTeacher",type:"GET",data:{idTeacher:idUser,idgrade:idgrade},success:function(data){
            let arr=JSON.parse(data);          
            $('#sel_course').select2().empty(); 
            for(let i=0;i<arr.length;i++){                                    
                $('#sel_course').append('<option   value="'+arr[i].id_asignatura+'" >'+ firstLetter(arr[i].nombre.toLowerCase())  +'</option>');
            }
            $('#sel_course').select2();
        }
        });
    });

    $(document).on("click","#btn_qualify",function(){
      
        let idgrade=$("#sel_grades").val();  
        let sel_perid=$("#sel_perid").val(); 
        let teacher=$("#sel_teacher").val();
        let course=$("#sel_course").val();
        if(teacher!=""  &&  idgrade!="" && course!="" && sel_perid!=""){
            dt_qualifications(idgrade,sel_perid,teacher,course);
        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }                          
    });

    $(document).on("click","#generateExcel",function(){        
        let grade=$("#sel_grades").val();  
        let gradeText=$("#sel_grades option:selected").text();  
        let idTeacher=$("#sel_teacher").val();                 
        let period=$("#sel_perid").val();
        let course=$("#sel_course").val();
        if(idTeacher!=""  &&  grade!="" && course!="" && period!=""){
            let url='/QualificationExcel/'+grade+'/'+idTeacher+'/'+period+'/'+course;
            var xhr = new XMLHttpRequest();
            xhr.open("GET",url);
            xhr.responseType = 'arraybuffer';        
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");        
            xhr.onload = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    var blob = new Blob([this.response], {type:"application/octetstream"});                
                    var downloadUrl = URL.createObjectURL(blob);
                        var a = document.createElement("a");
                        a.href = downloadUrl;
                        a.download = "Planilla-Notas."+gradeText+".xls";
                        document.body.appendChild(a);
                        a.click();
                }            
            };
            xhr.send(null);
        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }        
    });
    



} );


var dt_qualifications=function(grade,perid,teacher,course){
    $('#dt_qualifications').DataTable({        
        lengthChange: false,        
        responsive: true,
        destroy: true,   
        searching:false, 
        "ordering": false,
        lengthMenu:false,
        paginate:false,
        ajax: {
            url: "/QualificationTable/",
            method: "GET", 
            data:{grade:grade,perid:perid,teacher:teacher,course:course},
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
                { "data": "mat" },                
                { "data": "alumn"},
                { "data": "grupo"},                                
                { "data": "period1"},
                { "data": "period2"},
                { "data": "period3"},
                { "data": "notas"},
                { "data": "notas"},
                { "data": "notas"},
                { "data": "notas"},
                { "data": "notas"},
                { "data": "notas"},
                { "data": "notas"},
                { "data": "notas"},
                { "data": "notas"},
                { "data": "notas"},               
        ]
    });
}
/**
 *  var xhr = new XMLHttpRequest();
        xhr.open("POST",url);
        xhr.responseType = 'arraybuffer';
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        xhr.send("dt="+dt);  
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                var blob = new Blob([this.response], {type:'application/pdf'});
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                window.open(link);
            }
            if (this.status === 500) { sweetMessage("ERROR!", "Error al visualizar la factura !", "error", "#1976D2", false); }
        }


          var xhr = new XMLHttpRequest();
        xhr.open("GET",url);
        xhr.responseType = 'arraybuffer';
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                var blob = new Blob([this.response], { type:'application/pdf'});
                var url = URL.createObjectURL(blob);
                _iFrame = document.createElement('iframe');
                _iFrame.setAttribute('src', url);
                _iFrame.setAttribute('style', 'width:100%;height:800px');
                 $("#mdlpdf").modal('show');
                 $("#appPdf").html(_iFrame); 
            }
            if(this.status === 500){sweetMessage("ERROR!", "El archivo no fue posible ubicarlo !", "error", "#1976D2", false);}
        };
         xhr.send();
 * 
 * 
 */
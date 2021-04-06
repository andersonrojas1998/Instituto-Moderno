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

        $.ajax({
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            dataType: "JSON", headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '/readEnrollmentQualification',
         success:function(data){
            Swal.fire({
                title: 'Error!',
                text: 'Do you want to continue',
                icon: 'error',
                confirmButtonText: 'Cool'
              });
         },error:function(data){

         }


        });

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
        dt_qualifications(idgrade,sel_perid);
    });

    $(document).on("click","#generateExcel",function(){
        
        let grade=$("#sel_grades").val();  
        let gradeText=$("#sel_grades option:selected").text();  
        let idTeacher=$("#sel_teacher").val();                 
        let period=$("#sel_perid").val();
        let course=$("#sel_course").val();
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
    });
    



} );


var dt_qualifications=function(grade,perid){
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
            data:{grade:grade,perid:perid},
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
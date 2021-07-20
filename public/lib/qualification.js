$(document).ready(function() {
   
    if($("#sel_grades").length>0){
        $.ajax({ url:"/showGradesAssign",type:"GET",success:function(data){
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
    }

    $(document).on("change","#sel_perid",function(){      
        let id=$(this).val();
        if(id!=""){
            $.ajax({
                url:"/periodos/validateTimePeriod/"+id,
                type:"GET",
                data:{id:id},
                dataType:"JSON",
                success:function(res) {
                    if(!res.result){                        
                        let fin;
                        fin=(res.data.hab)?  res.data.habilitacion:res.data.fin_periodo;
                        let nm=res.data.nombre;
                        $('.txt-call').html('El  '+ nm + ' se cerro el dia   ' + fin);
                        $('.pnl-close-period').css('display','block');
                        $('.pnl-load').css('display','none');
                        $('.btn-qualification').attr('disabled',true);
                        $('#btn-save-qualifications-online').attr('disabled',true);
                    }else{
                        $('.pnl-close-period').css('display','none');
                        $('.pnl-load').css('display','flex');
                        $('.btn-qualification').attr('disabled',false);
                        $('#btn-save-qualifications-online').attr('disabled',false);
                        
                    }
                }
            });
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
            confirmButtonText: 'Si, Calificar '
          }).then((result) => {
            if (result.isConfirmed) {
                sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',6000);
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
                        let p=data.period;
                        let t=data.teacher;
                        let cour=data.course;
                        let gd=data.gradeId;
                        sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                        dt_qualificationsPeriod(gd,p,t,cour);
                 },error:function(res,tx,status){                    
                     if(res.status==500){                        
                        sweetMessage('\u00A1Atenci\u00f3n!',"ERROR AL CARGAR ARCHIVO  "+ JSON.parse(res.responseText).message, 'error');
                     }                    
                 }
                });
              

            }
          });
    });
    $(document).on("change","#sel_grades",function(){
        let idUser=$("#idUser").val();  
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

    $(document).on("focus keyup",".maxValue",function(){
        if(parseFloat($(this).val()) > '5.0' ){
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor Ingrese una nota valida  entre  0  a  5.0 .', 'warning');
            $(this).val(0);
        }
    
    });

    $(document).on("click","#btn-save-qualifications-online",function(){

        let arry=[];
        let i1=$('input[name="i1[]"]');
        let i2=$('input[name="i2[]"]');
        let i3=$('input[name="i3[]"]');
        let i4=$('input[name="i4[]"]');

        let a1=$('input[name="a1[]"]');
        let a2=$('input[name="a2[]"]');
        let a3=$('input[name="a3[]"]');
        

        let p1=$('input[name="p1[]"]');
        let p2=$('input[name="p2[]"]');
        let p3=$('input[name="p3[]"]');

        let s1=$('input[name="s1[]"]');
        let s2=$('input[name="s2[]"]');
        let s3=$('input[name="s3[]"]');


        let au1=$('input[name="au1[]"]');
        let au2=$('input[name="au2[]"]');

       let acum=$('input[name="acomulativo[]"]'); 

        $('input[name="matricula[]"]').each((i,vl)=>{  
            let obj={}
            obj['matricula']=$(vl).val();
            obj['i1']=parseFloat(i1[i].value);
            obj['i2']=parseInt(i2[i].value);
            obj['i3']=i3[i].value;
            obj['i4']=i4[i].value;

            obj['a1']=a1[i].value;
            obj['a2']=a2[i].value;
            obj['a3']=a3[i].value;

            obj['p1']=p1[i].value;
            obj['p2']=p2[i].value;
            obj['p3']=p3[i].value;


            obj['s1']=s1[i].value;
            obj['s2']=s2[i].value;
            obj['s3']=s3[i].value;

            obj['au1']=au1[i].value;
            obj['au2']=au2[i].value;

            obj['def']=acum[i].value;
            arry.push(obj);
        });        
        let period=$('#sel_perid').val();
        let course=$('#sel_course').val();
        let teacher=$('#idUser').val();
        let grade=$('#sel_grades').val();
        var data={ qualifications:JSON.stringify(arry),period:period,course:course,teacher:teacher,grade:grade };
        if(period!="" && course!="" && teacher!="" && grade!=""){
            $.ajax({
                url:"/Calificaciones/qualificationsOnline",
                type:"POST",
                data:data,
                dataType:"JSON",
                headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend:function(){
                    sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',6000);
                },
                success:function(result) {
                    sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                    location.replace('/Calificaciones/resumen');
                },
                error: function( jqXHR, textStatus, res ) {
                    sweetMessage('\u00A1Atenci\u00f3n!',"ERROR AL CALIFICAR  "+ JSON.parse(jqXHR.responseText).message, 'error');                    
                }

            }).fail(function  (jqXHR, textStatus, res ){                
                sweetMessage('\u00A1Atenci\u00f3n!',"ERROR AL CALIFICAR  "+ JSON.parse(jqXHR.responseText).message, 'error');
            });
                
        }
        

    });

    $(document).on("click","#btn_qualify",function(){
      
        let idgrade=$("#sel_grades").val();  
        let sel_perid=$("#sel_perid").val(); 
        let teacher=$("#idUser").val();
        let course=$("#sel_course").val();
        if(idgrade!="" && course!="" && sel_perid!=""){
            dt_qualifications(idgrade,sel_perid,teacher,course);
        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }                          
    });

    $(document).on("click","#generateExcel",function(){        
        let grade=$("#sel_grades").val();  
        let gradeText=$("#sel_grades option:selected").text();  
        let idTeacher=$("#idUser").val();                 
        let period=$("#sel_perid").val();
        let course=$("#sel_course").val();
        if(grade!="" && course!="" && period!=""){
            let url='/QualificationExcel/'+grade+'/'+idTeacher+'/'+period+'/'+course;
            var xhr = new XMLHttpRequest();
            xhr.open("GET",url);
            xhr.responseType = 'arraybuffer';        
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");   
            sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',4000);     
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
});
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
            url: "/QualificationTable",
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
                { "data": "notas",render(data,p,d){
                    return '<input type="number" name="i1[]" min="0" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">'+
                    '<input type="hidden" name="matricula[]" value="'+d.mat+'">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0" name="i2[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0" name="i3[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0" name="i4[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0" name="a1[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0"  name="a2[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0" name="a3[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0" name="p1[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0" name="p2[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0"  name="p3[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0" name="s1[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0"  name="s2[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0"  name="s3[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0"  name="au1[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "notas",render(data){
                    return '<input type="number" min="0"  name="au2[]" class="form-control maxValue" style="padding-right:5px;padding-left:12px;width: 60px;">';
                }},
                { "data": "acumulativo",render(data){
                    return '<h5>'+data+'</h5><input type="hidden"  name="acomulativo[]" value="'+data+'" >';
                }},
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
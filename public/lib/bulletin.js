$(document).ready(function() {
   
    
    $.ajax({ url:"/modalidad",type:"GET",success:function(data){
        let arr=JSON.parse(data);
        for(let i=0;i<arr.length;i++){                    
            $('#sel_modalidad').append('<option   value="'+arr[i].id+'" >'+ arr[i].nombre  +'</option>');
            $('#sel_modalidadAll').append('<option   value="'+arr[i].id+'" >'+ arr[i].nombre  +'</option>');
        }
        $('#sel_modalidad').select2();
        $('#sel_modalidadAll').select2();        
    }
    });

    $.ajax({ url:"/obsBulletin",type:"GET",success:function(data){
        let arr=JSON.parse(data);
        for(let i=0;i<arr.length;i++){                    
            $('#sel_observations').append('<option   value="'+arr[i].id_nota+'" >'+ arr[i].descripcion  +'</option>');
            $('#sel_observationsAll').append('<option   value="'+arr[i].id_nota+'" >'+ arr[i].descripcion  +'</option>');
        }
        $('#sel_observations').select2();
        $('#sel_observationsAll').select2();        
    }
    });

    
    $(document).on("change","#sel_gradeStudents",function(){
        let idGrade=$(this).val();
        $('#sel_studentsForGrade').select2().empty();
        $.ajax({ url:"/students/"+idGrade,type:"GET",success:function(data){
            let arr=JSON.parse(data);           
            $('#sel_studentsForGrade').append('<option value="">Seleccione</option>');
            for(let i=0;i<arr.length;i++){            
                let twoName=(arr[i].nombre2==null)? '':arr[i].nombre2;                        
                let name=arr[i].nombre1+ ' '+  twoName  + ' '+ arr[i].apellido1 + ' ' + arr[i].apellido2;
                $('#sel_studentsForGrade').append('<option   value="'+arr[i].id_matricula+'" >'+ name   +'</option>');
            }
            $('#sel_studentsForGrade').select2();
        }
        });
    });

    

    $(document).on("click","#btn_bookQualify",function(){             
        let grade=$("#sel_gradesPrint").val();
        if(grade!=""){            
            let url='/libro-calificador-pdf/'+grade;
            var xhr = new XMLHttpRequest();
            xhr.open("GET",url);
            xhr.responseType = 'arraybuffer';           
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            xhr.send(null);
            sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',8000);
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {                                        
                    var blobURL = new Blob([this.response], {type:'application/pdf'});
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blobURL);
                    window.open(link);
                    sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                }
                if (this.status === 500) { sweetMessage("ERROR!", "Error al generar el pdf !", "error", "#1976D2", false); }
            }
        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }                          
    });
    $(document).on("click","#btn_fichaAllGrades",function(){             
        let grade=$("#sel_gradesPrint").val();
        if(grade!=""){
            
            let url='/pdfEnrollment/'+0+'/'+2+'/'+grade;
            var xhr = new XMLHttpRequest();
            xhr.open("GET",url);
            xhr.responseType = 'arraybuffer';           
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            xhr.send(null);
            sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',8000);
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {                                        
                    var blobURL = new Blob([this.response], {type:'application/pdf'});
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blobURL);
                    window.open(link);
                    sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                }
                if (this.status === 500) { sweetMessage("ERROR!", "Error al generar el pdf !", "error", "#1976D2", false); }
            }
        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }
    });
    $(document).on("click","#btn_showFichaStudent",function(){             
        let grade=$("#sel_gradeStudents").val(); 
        let students=$("#sel_studentsForGrade").val();
        
        if(grade!=""  &&  students!=""){
            
            let url='/pdfEnrollment/'+students+'/'+1;
            var xhr = new XMLHttpRequest();
            xhr.open("GET",url);
            xhr.responseType = 'arraybuffer';           
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            xhr.send(null);
            sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',8000);
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {                                        
                    var blobURL = new Blob([this.response], {type:'application/pdf'});
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blobURL);
                    window.open(link);
                    sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                }
                if (this.status === 500) { sweetMessage("ERROR!", "Error al generar el pdf !", "error", "#1976D2", false); }
            }
        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }                          
    });

    $(document).on("click","#prt_bulletinStudent",function(){
      
       
        let grade=$("#sel_gradeStudents").val(); 
        let students=$("#sel_studentsForGrade").val();
        let period=$("#sel_printPeriod").val();
        let date_expedition=$("#date_expedition").val();
        let obs=$("#sel_observations").val();
        let letter=$("#sel_numberOrLetterSt").val();
        let modalidad=$("#sel_modalidad").val();
        if(grade!=""  &&  students!=""){
            
            let url='/genetedBulletin/'+students+'/'+date_expedition+'/'+period+'/'+obs+'/'+grade+'/'+letter+'/'+modalidad;
            var xhr = new XMLHttpRequest();
            xhr.open("GET",url);
            xhr.responseType = 'arraybuffer';           
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            xhr.send(null);
            sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',8000);
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {                                        
                    var blobURL = new Blob([this.response], {type:'application/pdf'});
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blobURL);
                    window.open(link);
                    sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                }
                if (this.status === 500) { sweetMessage("ERROR!", "Error al generar el pdf !", "error", "#1976D2", false); }
            }
        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }                          
    });

    $(document).on("click","#prt_bulletinStudentAllGrades",function(){
      
       
        let grade=$("#sel_gradesPrint").val();
        let period=$("#sel_periodAll").val();
        let date_expedition=$("#date_expeditionAll").val();
        let obs=$("#sel_observationsAll").val();
        let letter=$("#sel_numberOrLetterAll").val();
        let modalidad=$("#sel_modalidadAll").val();
        if(grade!=""){
            
            let url='/genetedBulletinForGrades/'+grade+'/'+date_expedition+'/'+period+'/'+obs+'/'+letter+'/'+modalidad;            
            var xhr = new XMLHttpRequest();
            xhr.open("GET",url);
            xhr.responseType = 'arraybuffer';           
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            xhr.send(null);
            sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',9000);
            xhr.onreadystatechange = function () {
                
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                                        
                    var blobURL = new Blob([this.response], {type:'application/pdf'});
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blobURL);
                    window.open(link);
                    sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                }
                if (this.status === 500) { sweetMessage("ERROR!", "Error al generar el pdf !", "error", "#1976D2", false); }
            }
        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }                          
    });
    
});
/*var link = document.createElement('a');
link.download =grade+'Md.pdf';
link.href=blobURL;
link.click();  */
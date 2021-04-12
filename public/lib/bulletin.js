$(document).ready(function() {
   


    $.ajax({ url:"/grades",type:"GET",success:function(data){
        let arr=JSON.parse(data);
        for(let i=0;i<arr.length;i++){                    
            $('#sel_gradeStudents').append('<option   value="'+arr[i].id_grado+'" >'+ firstLetter(arr[i].grupo.toLowerCase())  +'</option>');
            $('#sel_gradesPrint').append('<option   value="'+arr[i].id_grado+'" >'+ firstLetter(arr[i].grupo.toLowerCase())  +'</option>');
        }
        $('#sel_gradeStudents').select2();
        $('#sel_gradesPrint').select2();        
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


    

    $(document).on("click","#prt_bulletinStudent",function(){
      
        let paper=$("#paperPrint1").val();  
        let grade=$("#sel_gradeStudents").val(); 
        let students=$("#sel_studentsForGrade").val();
        let period=$("#sel_printPeriod").val();
        let date_expedition=$("#date_expedition").val();
        let obs=$("#sel_observations").val();
        if(grade!=""  &&  students!=""){
            
            let url='/genetedBulletin/'+students+'/'+date_expedition+'/'+period+'/'+obs;
            var xhr = new XMLHttpRequest();
            xhr.open("GET",url);
            xhr.responseType = 'arraybuffer';           
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            xhr.send(null);            
            sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',7000);
            xhr.onreadystatechange = function () {
                
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                                        
                    var blobURL = new Blob([this.response], {type:'application/pdf'});
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blobURL);
                    window.open(link);

                    /*var link = document.createElement('a');
                    link.download =grade+'Md.pdf';
                    link.href=blobURL;
                    link.click();  */

                    /*
                     */
                    sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
                }
                if (this.status === 500) { sweetMessage("ERROR!", "Error al generar el pdf !", "error", "#1976D2", false); }
            }


            
        }else{
            sweetMessage('\u00A1Atenci\u00f3n!', 'Por favor complete  los campos requeridos.', 'warning');
        }                          
    });
    
});
$(document).ready(function() {

    $(document).on("change","#sel_gradeStudents",function(){
        let idGrade=$('#sel_gradeStudents').val();
        var anio = (new Date).getFullYear();
        $('#sel_studentsCert').select2().empty();
        $.ajax({ 
            url:'/studentsGrades/'+idGrade+'/'+anio,
            type:"GET",
            success:function(data){
                let arr=JSON.parse(data);           
                $('#sel_studentsCert').append('<option value="">Seleccione</option>');
                for(let i=0;i<arr.length;i++){            
                    let twoName=(arr[i].nombre2==null)? '':arr[i].nombre2;                        
                    let name=arr[i].nombre1+ ' '+  twoName  + ' '+ arr[i].apellido1 + ' ' + arr[i].apellido2;
                    $('#sel_studentsCert').append('<option   value="'+arr[i].id_matricula+'" >'+ name   +'</option>');
                }
                $('#sel_studentsCert').select2();
        }
        });
    });


    $(document).on("click","#btn_generateConstancy",function(){        
        
        let student=$("#sel_studentsCert").val();
        let date=$("#date_expedition").val();
        if(student!="" && date!=""){
            
            let url='/constanciaPdf/'+student+'/'+date;
            var xhr = new XMLHttpRequest();
            xhr.open("GET",url);
            xhr.responseType = 'arraybuffer';           
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
            xhr.send(null);
            sweetMessageTimeOut('Procesando ...', '\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ',5000);
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
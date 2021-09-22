$(document).ready(function() {

    $.ajax({ url:"/gradesAll",type:"GET",success:function(data){
        let arr=JSON.parse(data);
        $('#sel_gradeScore').select2().empty();       
        $('#sel_gradeScore').append('<option value="">Seleccione</option>');
        for(let i=0;i<arr.length;i++){                                    
            $('#sel_gradeScore').append('<option   value="'+arr[i].id_grado+'" >'+ firstLetter(arr[i].grupo.toLowerCase())  +'</option>');
        }
        $('#sel_gradeScore').select2();
    }
    });

    $(document).on("click","#btn_showScoreGrades",function(){        
        var g=$("#sel_gradeScore").val();
        var p=$("#sel_periodScore").val();
        if(g!=0){
            dt_scoreStudents(g,p);
        }        
        
    });    

});

function dt_scoreStudents(grade,period){
    $('#dt_scoreStudents').DataTable({
        dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ],
        responsive: true,
        destroy: true,           
        "ordering": false,
        lengthMenu:false,
        paginate:false,
        ajax: {
            url: "/Calificaciones/scoreStudents/"+grade+'/'+period,
            method: "GET",             
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
                { "data": "alumno"},
                { "data": "puesto" ,
                render(data){
                    let bt;                    
                    switch (true) {
                        case (parseInt(data) == 1):
                            bt='<h4><div class="badge badge-warning">'+data+'</div></h4><img src="/images/scoreP.png" style="width:90px;height:40px;">';
                        break;
                        case (parseInt(data) > 1 && parseInt(data) <= 5):
                            bt='<h4><div class="badge badge-success text-white">'+data+'</div></h4><img class="img-rounded" src="/images/scoreT.png" style="width:20px;height:20px;">';    
                        break;
                        default:
                            bt='<h4><div class="badge badge-primary">'+data+'</div></h4>';    
                        break;
                    }
                    return bt;
                }},
                { "data": "promedio", render:function(data){  return '<b>'+data+'</b>' }}                
        ],
        rowCallback:function(row,data,index){
            let puesto=data.puesto;
            switch(true){                
                case (parseInt(puesto) >= 1 && parseInt(puesto) <= 5):
                    $('td', row).css('background-color', 'rgba(238, 249, 71, 0.35)');
                break;                
            }
        }
    });

}
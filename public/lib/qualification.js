$(document).ready(function() {

    
    $.ajax({ url:"/showTeacher",type:"GET",success:function(data){
        let arr=JSON.parse(data);
        for(let i=0;i<arr.length;i++){                    
            $('#sel_teacher').append('<option   value="'+arr[i].id+'" >'+ firstLetter(arr[i].name.toLowerCase())  +'</option>');
        }
        $('#sel_teacher').select2();
    }
    });

} );
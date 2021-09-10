$(document).ready(function(){

    var current_fs, next_fs, previous_fs;
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    
    setProgressBar(current);
    
    $(".next").click(function(){
            
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    console.log(next_fs);

    console.log(current_fs);
    console.log(next_fs);
    console.log($("fieldset").index(next_fs));
    console.log($("fieldset"));
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    next_fs.css({'opacity': opacity});
    },
    duration: 500
    });
    setProgressBar(++current);
    });
    
    $(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();
    
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
    step: function(now) {
    // for making fielset appear animation
    opacity = 1 - now;
    
    current_fs.css({
    'display': 'none',
    'position': 'relative'
    });
    previous_fs.css({'opacity': opacity});
    },
    duration: 500
    });
    setProgressBar(--current);
    });
    
    function setProgressBar(curStep){
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar")
    .css("width",percent+"%")
    }
    
    $(".submit").click(function(){
    return false;
    })



    $(document).on("click",".switchDs",function() {
        if($(this).prop('checked')){
            $('.pnlDs').css('display','flex');
        }else{
            $('.pnlDs').css('display','none');
        }        
    });

    $(document).on("click",".switchEt",function() {
        if($(this).prop('checked')){
            $('.pnlEt').css('display','block');
        }else{
            $('.pnlEt').css('display','none');
        }        
    });

    $(document).on("blur","#dni",function() {
        let val=$(this).val();
        if(val!=""){
            $.ajax({
                url:"/matricula/searching/student/"+val,
                type:"get",
                data:{dni:val},
                success:function(data) {
                    
                    console.log(data);
                }

            });

        }

    });
    
    });


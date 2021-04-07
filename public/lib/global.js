$(document).ready(function() {
    $('.select2').select2();

    $('[data-toggle="tooltip"]').tooltip();

    
} );


function firstLetter(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
  }


var sweetMessage= function(title,msg,type='success'){
    swal.fire(title,msg,type);
}

/**
 * Muestra  mensaje de confirmacion con peticion al servidor ajax 
 * @param {Object} obj -  Object responsable  de retorno del sweetalert confirm
 * @param {string} obj.title  - title alert
 * @param {string} obj.text  - text alert
 * @param {string} obj.icon  - icon alert
 * @param {boolean} obj.ajax  -  true : false 
 * @param {boolean} obj.delRow  -  Elimina columna table
 * @param {boolean} obj.delfull  -  Elimina columna fullCalendar
 * @param {string} obj.calendarId  -Eliminar objecto del fullCalendar
 * @param {int} obj.reload  -   Recarga la pagina 1:0 
 * @param {string} obj.url  -  Url ajax
 * @param {string} obj.type  -  POST : GET 
 * @param {Object} obj.data  -  data Ajax
 */
 function sweetMessageConfirm(obj){
    Swal.fire({
        title: obj.title,
        html: obj.text,
        icon: obj.icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.value) {
          if(obj.ajax){          
            ajaxIon(obj);
          }else{
            sweetMessage('Eliminaci\u00F3n!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!');
            (obj.delRow)?  $(obj.row).parents('tr').remove():'';
          }
                  
        }
      });
  }

  var ajaxIon= function(obj){
    $.ajax({ url:obj.url,type:obj.type,data:obj.data,dataType:"JSON",headers:{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success:function(result){
              if(result==1){
                sweetMessage('\u00A1Registro exitoso!', '\u00A1 Se ha realizado con \u00E9xito su solicitud!'); 
                (obj.reload!=0)?  setTimeout(function () { location.reload() }, 2000):'';                                                        
                (obj.delRow)?  $(obj.row).parents('tr').remove():'';
              }
              if(obj.delfull){              
                let calendarId=obj.calendarId;
                var event = calendarId.getEventById(result.idtable);              
                event.remove();
              }
                
  
            }
  
          });
  }

  var sweetMessageTimeOut=function(title,text,time=2000){
    let timerInterval
  Swal.fire({
    title: title,
    html: text,
    timer: time,
    timerProgressBar: true,
    onBeforeOpen: () => {
      Swal.showLoading()
      timerInterval = setInterval(() => {
        const content = Swal.getContent()
        if (content) {
          const b = content.querySelector('b')
          if (b) {
            b.textContent = Swal.getTimerLeft()
          }
        }
      }, 100)
    },
    onClose: () => {
      clearInterval(timerInterval)
    }
  }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
     
    }
  })
  }
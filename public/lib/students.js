$(document).ready(function() {
  dt_alumn();
} );


var dt_alumn=function(){
  var table=$('#dt_alumn').DataTable({ 
    dom: 'Bfrtip',
    buttons: [
      'excel', 'pdf', 'print'
    ],
      ajax: {
          url: "/dt_alumn",
          method: "GET", 
          dataSrc: function (json) {
              if (!json.data) {
                  return [];
              } else {
                  return json.data;
              }
            }               
          },      
      columnDefs: [{"className": "text-center", "targets": "_all"},],
      columns: 
      [
              { "data": "con" , render(data){return '<b>'+data+'</b>';}},
              { "data": "dni" },
              { "data": "apellido1",render(data,type,row){ return '<div class="text-info">'+  data +'</div>'; }},
              { "data": "apellido2",render(data,type,row){ return '<div class="text-info">'+  data +'</div>'; }},
              { "data": "nombre1",render(data,type,row){ return '<div class="text-info">'+  data +'</div>'; }},
              { "data": "nombre2",render(data,type,row){ return '<div class="text-info">'+  data +'</div>'; }},
              { "data": "genero"},
              {"data": "eps"}, 
              { "data": "direccion"},
              {"data": "telefono"},                             
              {"data": "acudiente"},
              {"data": "telAcudiente"},
              {"data": "estado", render(data){ let st=(data)? 'Activo':'Inactivo'; let color=(data)? 'success':'danger'; return  '<label class="badge text-white badge-'+color+' ">'+ st  +'</label>'; }}
      ]
  });
}


/**
 * 
 * var dt_subProgrammer =$('#dt_subProgrammer').DataTable({
      responsive: true,
      orderable : true,
      destroy : true,
      dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      ajax: {
        url:'/Programmer/activeOrders',
        type: 'get',      
        dataSrc: function (json) {
        if (!json.data) {
            return [];
        } else {
            return json.data;
        }}
      },
      columnDefs: [{"className": "text-center", "targets": "_all"}],
      columns: [            
        {
          "className":      'details-control',
          "orderable":      false,
          "data":           null,
          "defaultContent": ''
      },  
        {data: 'order' ,render:function(data){ return '<b>'+data+'</b>' }},
        {data: 'pacienteName',render:function(data,type,full,meta){   return '</div><a class="text-success" href="/Paciente/'+full.pacienteId+'" target="_blank"><b>'+full.pacienteName+'</b></a>';  }},
        {data: 'pacienteSede'},        
        {data: 'pacienteEps'},        
        {data: 'orderDesde'},
        {data: 'orderHasta'},

        {data:'alert',render:function(data,type,row,meta){


          let alerts =[];
              let option ='';
              let sw = 0;
              if(row.status==7)
              {
               sw=1;
                alerts.push('<li class="navi-item">\
                <a class="navi-link" >\
                    <span class="navi-icon"><i class="flaticon2-drop"></i></span>\
                    <span class="navi-text">Orden pendiente de copago</span>\
                </a>\
              </li>');
                    
              }
              if(row.autorizacion==null){
                sw=1;
                alerts.push('<li class="navi-item">\
                <a class="navi-link" >\
                    <span class="navi-icon"><i class="flaticon2-drop"></i></span>\
                    <span class="navi-text">Orden Sin autorizacion</span>\
                </a>\
              </li>');   
              }
              $.each(alerts,function(k,v){
                option = option + v ;
    
              })
              if(sw==1)
                    return '<div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">\
                    <a href="#" class="btn btn-clean btn-hover-light-success btn-sm btn-icon-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                    <i class="flaticon2-warning text-warning"></i>\
                    </a>\
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">\
                    <ul class="navi navi-hover py-5">\
                    '+option+'\
                    </ul>\
                    </div>\
                          </div>';
              else
                    return '';
        }},
        {data: 'packageName'},
        {data: 'resume',render:function(row){             
            var color='';
            switch(true){
            case (row<=0):
                color='bg-danger';
              break;
             case  (row > 0 &&  70 >= row ): 
                color='bg-warning';
             break;              
             case  (row > 70): 
                color='bg-success';
             break;
            }           
          let width=(row==0)? 100:row;
           return '<div class="progress"><div data-placement="top" data-title="Porcentaje cumplimiento" data-toggle="tooltip" class="progress-bar  progress-bar-striped progress-bar-animated '+color+'" role="progress-bar" aria-valuenow="' + row + '" style="width:' +width+ '%">' + row + '%</div></div>'; 
         }
        },
        {data: 'action',render:function(data,type,row,meta){
          let copago = '';
          if(row.status==7){
            copago = '<li class="navi-item">\
            <a style="cursor:pointer" class="navi-link" data-toggle="modal" data-target="#McopagoCall" data-order="'+row.order+'" data-pcte="'+row.pacienteId+'">\
                <span class="navi-icon"><i class="flaticon2-drop"></i></span>\
                <span class="navi-text">Lllamada de copago</span>\
            </a>\
          </li>';
          }
          return '<div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">\
                  <a href="#" class="btn btn-clean btn-hover-light-success btn-sm btn-icon-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                      <i class="ki ki-bold-more-ver"></i>\
                  </a>\
                  <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">\
                  <ul class="navi navi-hover py-5">\
                  <li class="navi-item">\
                    <a href="/OrdendeTrabajo/'+row.order+'" class="navi-link" target="blank">\
                        <span class="navi-icon"><i class="flaticon2-drop"></i></span>\
                        <span class="navi-text">Ver Orden</span>\
                    </a>\
                  </li>\
                  <li class="navi-item">\
                    <a href="#" id="" class="navi-link" data-toggle="modal" data-target="#" data-order="' + row.order +'" >\
                        <span class="navi-icon"><i class="flaticon2-bell-2"></i></span>\
                        <span class="navi-text">Editar Orden</span>\
                    </a>\
                  </li>\
                  '+copago+'\
                  </ul>\
                </div>\
              </div>';
      }
      },
      ]
    });
 * 
 *  // Add event listener for opening and closing details
  $('#dt_subProgrammer tbody').on('click', 'td.details-control', function () {
      var tr = $(this).closest('tr');
      var row = dt_subProgrammer.row( tr );
      if ( row.child.isShown() ) {          
          row.child.hide();
          tr.removeClass('shown');
      }
      else {                 
        row.child( format(row.data()) ).show();            
        tr.addClass('shown');
          
      }
  } );

 * function format ( d ) {
  
  var tr=$.ajax({
          url:'/Programmer/Order/'+d.orderID,
          method:'GET',
          dataType: 'html',
          context: document.body,
          global: false,
          async:false,
          success:function(data){
            return data;                                          
          }            
        }).responseText;

        let data=JSON.parse(tr);
        var tbody='';
        if(data.length>0){
          for(let i=0;i<data.length;i++){
            tbody+= '<tr><th>'+(i+1) +'</th><td>'+data[i].id+'</td><td>'+data[i].service+'</td><td>'+data[i].prf+'</td><td>'+data[i].numAct+'</td><td>'+data[i].pending+'</td><td>'+data[i].progress+'</td><td>'+data[i].action+'</td></tr>';
          }
        }
  return '<table class="table table-borderless"  cellspacing="0" border="0" style="width:100%">'+
        '<thead>'+
        '<tr>'+
            '<th>#</th>'+
            '<th>OSA</th>'+
            '<th>SERVICIO</th>'+
            '<th>PROFESIONAL</th>'+
            '<th>ASIG</th>'+
            '<th>REAL</th>'+
            '<th>PEND</th>'+
            '<td></td>'+            
      '</tr>'+
  '</thead>'+
    '<tbody>'+tbody+'</tbody>'+
  '</table>';
} 
 * 
 * 
 */
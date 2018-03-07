$( document ).ready(function(){
  //campos numericos
  $("#codigo").numeric({ decimal: false, negative: false });
  $("#cantidad").numeric({ decimalPlaces: 3, negative: false });

  $(document).on('submit', '#formrecibido', function () {
    $.ajax({
      url: base_url + 'pventa/concretarVenta',
      data: $(this).serialize(),
      type: 'POST',
      dataType: "json",
      success: function (resp) {
        if(resp['cambio']< 0)
        {
          $("#cobrar").click();
          return false;
        }
        else {
          $("#libuscar").addClass("hidden");
          $("#general").html('<center><button type="button" class="btn btn-default" onclick="location.reload();">Venta finalizada</button><center>');
          $(".modal-header-mini").html('<span class="text-right" style="font-size:17px"><i class="fa fa-money" aria-hidden="true"></i> Cambio</span><button type="button" class="close" data-dismiss="modal" onclick="location.reload();" aria-label="Close"><span aria-hidden="true"><font color="#FF0000"><i class="fa fa-times" aria-hidden="true"></i></font></span></button><br>');

          if(impuesto)
          {
            $(".modal-body-mini").html("<center>"+
            "<h3 class='sin-margen'>Gracias por su compra</h3>"+
            "<label class='text-success sin-margen'>Total: "+monedaString + new oNumero(resp['total']).formato(2, true)+"</label>"+
            "<br>"+
            "<label class='text-warning sin-margen'>Recibido: "+monedaString + new oNumero(resp['recibido']).formato(2, true)+"</label>"+
            "<br>"+
            "<label class='text-primary sin-margen'>Cambio: "+monedaString + new oNumero(resp['cambio']).formato(2, true)+"</label>"+
            "<br><button type=\"button\" class=\"btn btn-negro\ impVenta\"><i class=\"fa fa-print\" aria-hidden=\"true\"></i> Imprimir</button>"+
            "</center>");
          }
          else {
            $(".modal-body-mini").html("<center><h2>Gracias por su compra</h2><label class='text-success'>Total: $"+new oNumero(resp['total']).formato(2, true)+"</label><br><label class='text-warning'>Recibido: $"+new oNumero(resp['recibido']).formato(2, true)+"</label><br><label class='text-primary'>Cambio: $"+new oNumero(resp['cambio']).formato(2, true)+"</label></center>");
          }

          $(".modal-footer-mini").html("");
          $(".modal-footer").html('<button type="button" class="btn btn-default" autofocus onclick="location.reload();">Finalizar</button>');
          $('#ModalMini').modal({
            backdrop: 'static',
            keyboard: false
          });
          $("#ModalMini").modal("show");
          return false;
        }
      },
      error: function (data) {
        alerta('Error interno', data['responseText'], '');
      }
    });
    return false;
  });



  $("body").on('click', '.impVenta', function () {
    var idVenta=$("#idVentax").html();
    $.ajax({
      url: base_url + 'pventa/impVenta',
      data: {idVenta:idVenta},
      type: 'POST',
      success: function (html) {
        if (window.print) {
          // ------------------------------------
          var ventimp = window.open(' ', 'popimpr');
          ventimp.document.write( html );
          ventimp.document.close();
          ventimp.print( );
          ventimp.close();
          // ------------------------------------
        } else {
          alert("La funciÃ³n de impresion no esta soportada por su navegador.");
        }
      }
    });
    // location.reload();
  });




  $("body").on('click', '#cobrar', function () {
    var total = $("#miTotalx").html();
    var idVenta=$("#idVentax").html();

    if(impuesto=="1"){
      total=$("#miTotal2x").html();
    }
    total = parseFloat(total).toFixed(2);

    if(total<=0)
    {
      $(".modal-header-mini").html('<span class="text-right" style="font-size:17px"><i class="fa fa-money" aria-hidden="true"></i> Cobrar</span><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FF0000"><i class="fa fa-times" aria-hidden="true"></i></font></span></button><br>');
      $(".modal-body-mini").html("<center><h2>Lista Vacia</h2></center>");
      $(".modal-footer-mini").html("");
      $(".modal-footer").html('<button type="button" class="btn btn-default" autofocus data-dismiss="modal">Aceptar</button>');
      $("#ModalMini").modal("show");
      return false;
    }
    $.ajax({
      url: base_url + 'pventa/v_recibido',
      data: {total:total,idVenta:idVenta,impuesto:impuesto},
      type: 'POST',
      success: function (html) {
        $(".modal-header-mini").html('<span class="text-right" style="font-size:17px"><i class="fa fa-money" aria-hidden="true"></i> Cobrar</span><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FF0000"><i class="fa fa-times" aria-hidden="true"></i></font></span></button><br>');
        $(".modal-body-mini").html(html);
        $(".modal-footer-mini").html("");
        $('#ModalMini').modal({
          backdrop: 'static',
          keyboard: false
        });
        $("#ModalMini").modal("show");
        $("#recibido").numeric({ decimalPlaces: 2, negative: false });
        $("#recibido").focus();
      }
    });
  });



  $("body").on('click', '#btnNV', function () {
    $.ajax({
      url: base_url + 'pventa/NuevaVenta',
      data: {},
      type: 'POST',
      success: function (idVenta) {
        $("#miVenta").removeClass("hidden");
        $("#idVenta").removeClass("hidden");
        $("#libuscar").removeClass("hidden");
        $("#idVentax").html(idVenta);
        $("#divbtnnv").html("");
      },
      error: function (data) {
        alerta('Error interno x3', data['responseText'], '');
      }
    });


    $("body").on('click', '#buscarpr', function () {
      $.ajax({
        url: base_url + 'pventa/buscarpr',
        data: {},
        type: 'POST',
        success: function (msg) {
          $(".modal-header").html('<span class="text-right" style="font-size:17px"><i class="fa fa-binoculars" aria-hidden="true"></i> Buscar Producto</span><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FF0000"><i class="fa fa-times" aria-hidden="true"></i></font></span></button><br>');
          $(".modal-body").html(msg);
          $(".modal-footer").html("");
          callDatatableBuscar();
          $("#Modal").modal("show");
        },
        error: function (data) {
          alerta('Error interno x4', data['responseText'], '');
        }
      });
      return false;
    });



    $("body").on('click', '.addCar', function () {
      var code=$(this).data("code");
      $("#codigo").val(code);
      $("#Modal").modal("hide");
      addProducto();
      return false;
    });





  });


  /* ********************************************************
  detecta nuvo registro ya existente
  ********************************************************* */
  $("#codigo").delayPasteKeyUp(function(){
    addProducto();
  }, 200);


  $('body').on('submit', '#formventaCodigo', function () {
    $("#cantidad").blur();
    $("#codigo").focus();
    return false;
  });




  $(document).on('click', '.delFila', function (event) {
    event.preventDefault();
    var codigo = $(this).closest('tr').find("td")[0].innerHTML;
    var cantidad = $(this).closest('tr').find("td")[3].innerHTML;
    var idVenta = $("#idVentax").html();
    var miTotal = parseFloat($("#miTotalx").html());
    $.ajax({
      url: base_url + 'pventa/importe',
      data: {codigo:codigo,cantidad:cantidad},
      type: 'POST',
      success: function (resultado) {
        var nuevoTotal = miTotal-resultado;
        $("#miTotalx").html(   nuevoTotal   );
        $("#miTotal").html(   new oNumero(nuevoTotal).formato(2, true)   );
        if(impuesto=="1"){
          var totalImpuesto =nuevoTotal*impuestoPorciento/100;
          var miTotal2 = nuevoTotal+totalImpuesto;
          $("#miImpuestox").html(   totalImpuesto   );
          $("#miImpuesto").html(   new oNumero(totalImpuesto).formato(2, true)   );
          $("#miTotal2x").html(   miTotal2   );
          $("#miTotal2").html(   new oNumero(miTotal2).formato(2, true)   );
        }
      },
      error: function (data) {
        alerta('Error interno', data['responseText'], '');
      }
    });
    $.ajax({
      url: base_url + 'pventa/delItemToVenta',
      data: {codigo:codigo,idVenta:idVenta},
      type: 'POST',
      success: function (resultadox2) {
        if(resultadox2!="1")
        {
          alerta("Error al eliminar fila",resultadox2,"");
        }
      },
      error: function (data) {
        alerta('Error interno', data['responseText'], '');
      }
    });
    $(this).closest('tr').remove();
  });
});



// ****************************************************************
// funciones
// ****************************************************************
function addProducto() {
  var codigo = $("#codigo").val();
  var cantida = $("#cantidad").val();
  if(cantida<=0){
    $("#cantidad").val(1);
    $("#codigo").val("");
    return false;
  }
  if(codigo.length>12){
    $.ajax({
      url: base_url + 'pventa/verificarProducto',
      data: {codigo: codigo},
      type: 'POST',
      success: function (resultado) {
        if(resultado)
        {
          // OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
          $.ajax({
            url: base_url + 'pventa/getItem',
            data: {codigo: codigo},
            type: 'POST',
            dataType: "json",
            success: function (resultadoItem) {
              cantidad = parseFloat(cantida);
              var precio=resultadoItem['precio'];
              if(cantidad<resultadoItem['cantidadMayoreo'])
              {
                var importe = cantidad*parseFloat(resultadoItem['precio']);
              }
              else{
                var importe = cantidad*parseFloat(resultadoItem['precioMayoreo']);
                precio = resultadoItem['precioMayoreo'];
              }
              $('#tbventa tr:last').after("<tr><td>"+resultadoItem['codigo']+"</td><td>"+resultadoItem['descripcion']+"</td><td>"+monedaString+" "+precio+"</td><td>"+cantidad+"</td><td>"+monedaString+" "+new oNumero(importe).formato(2, true)+"</td><td class='text-center'><button class='delFila btn btn-danger btn-xs'><i class='fa fa-times-circle' aria-hidden='true'></i></button></td><td class='hidden'>"+importe+"</td></tr>");
              $("#cantidad").val(1);
              $("#codigo").val("");
              // WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW
              var idVenta=$("#idVentax").html();
              var idItem = resultadoItem['id'];
              var codigo = resultadoItem['codigo'];
              $.ajax({
                url: base_url + 'pventa/addItemToVenta',
                data: {idVenta: idVenta,idItem:idItem, cantidad:cantidad},
                type: 'POST',
                dataType: "json",
                success: function (r) {
                  if(r['validante']=="r")
                  {
                    $("#tbventa tr").find('td:eq(0)').each(function () {
                      //obtenemos el codigo de la celda
                      icodigo = $(this).html();
                      if(codigo==icodigo){
                        $(this).closest('tr').remove();
                      }
                    });
                    //actualizamos el importe
                    if(r['ncantidad']<resultadoItem['cantidadMayoreo'])
                    {
                      var importe = r['ncantidad']*parseFloat(resultadoItem['precio']);
                    }
                    else{
                      var importe = r['ncantidad']*parseFloat(resultadoItem['precioMayoreo']);
                      precio = resultadoItem['precioMayoreo'];
                    }
                    // agregamos una nueva fila con el codigo
                    $('#tbventa tr:last').after("<tr><td>"+resultadoItem['codigo']+"</td><td>"+resultadoItem['descripcion']+"</td><td>"+monedaString+" "+precio+"</td><td>"+r['ncantidad']+"</td><td>"+monedaString+" "+new oNumero(importe).formato(2, true)+"</td><td class='text-center'><button class='delFila btn btn-danger btn-xs'><i class='fa fa-times-circle' aria-hidden='true'></i></button></td><td class='hidden'>"+importe+"</td></tr>");
                  }
                  // recorremos la tabla para calcular el importe
                  var nuevoTotal=0;
                  $("#tbventa tr").find('td:eq(6)').each(function () {
                    nuevoTotal += parseFloat($(this).html());
                  });
                  //Actualizamos el total
                  $("#miTotalx").html(   nuevoTotal   );
                  $("#miTotal").html(   new oNumero(nuevoTotal).formato(2, true)   );
                  if(impuesto=="1"){
                    var totalImpuesto =nuevoTotal*impuestoPorciento/100;
                    var miTotal2 = nuevoTotal+totalImpuesto;
                    $("#miImpuestox").html(   totalImpuesto   );
                    $("#miImpuesto").html(   new oNumero(totalImpuesto).formato(2, true)   );
                    $("#miTotal2x").html(   miTotal2   );
                    $("#miTotal2").html(   new oNumero(miTotal2).formato(2, true)   );
                  }
                },
                error: function (data) {
                  alerta('Error interno x2', data['responseText'], '');
                }
              });
              // WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW
            },
            error: function (data) {
              alerta('Error interno x2', data['responseText'], '');
            }
          });
          // OOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
        }
        else{
          alerta("Mensaje","No hay registros que coincidan con el cÃ³digo ingresado.","");
          $("#codigo").val('');
        }
      },
      error: function (data) {
        alerta('Error interno x1', data['responseText'], '');
      }
    });
  }

}




$.fn.delayPasteKeyUp = function(fn, ms)
{
  var timer = 0;
  $(this).on("propertychange input", function()
  {
    clearTimeout(timer);
    timer = setTimeout(fn, ms);
  });
};


function miAlerta(tipo,titulo,mensaje) {
  var msj='<div class="alert alert-'+tipo+' alert-dismissible" role="alert">'+
  '<button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close"><i class="fa fa-times fa-lg" aria-hidden="true"></i></button>'+
  '<strong>'+titulo+' </strong>'+mensaje+'.'+
  '</div>';
  return msj;
}



function esconderAlerta(){
  setTimeout(function() {
    $("#msj").fadeOut(1500);
  },1500);
  setTimeout(function() {
    $("#msj").html("");
    $("#msj").fadeIn(1);
  },3000);
}








/* ********************************************************
DataTable
********************************************************* */
function callDatatableBuscar() {


var table = $('#tbBuscar').DataTable( {

  language: {
    processing: "<i class='fa fa-spinner fa-1x fa-spin fa-fw' aria-hidden='true'></i>",
    search: "<i class='fa fa-search' aria-hidden='true'></i>",
    lengthMenu:     "Mostrando _MENU_ productos",
    info:           "Mostrando del _START_ al _END_ de _TOTAL_ productos",
    infoEmpty:      "Mostrando 0 al 0 de 0 coincidencias",
    infoFiltered: "(filtrado de un total de _MAX_ elementos)",
    infoPostFix: "",
    loadingRecords: "<i class='fa fa-spinner fa-1x fa-spin fa-fw' aria-hidden='true'></i>",
    zeroRecords: "No se encontraron coincidencias",
    emptyTable: "No hay datos para mostrar",
    paginate: {
      first: "<i class='fa fa-fast-backward' aria-hidden='true'></i>",
      previous: "<i class='fa fa-backward' aria-hidden='true'></i>",
      next: "<i class='fa fa-forward' aria-hidden='true'></i>",
      last: "<i class='fa fa-fast-forward' aria-hidden='true'></i>"
    }
    //,
    //aria: {
    //    sortAscending: ": activate to sort column ascending",
    //    sortDescending: ": activate to sort column descending"
    //}
  },
  lengthMenu: [
    [ 5 ],
    [ '5' ]
  ],
  columnDefs:[
    { orderable: false, targets: [0] },{ orderable: false, targets: [3] }
  ],
  order:[
    [ 1, 'asc' ]
  ]
} );

}
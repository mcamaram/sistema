var tabla;
//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
$('.pasar').click(function() {
return !$('#origen option:selected').remove().appendTo('#destino');
});
$('.quitar').click(function() {
 return !$('#destino option:selected').remove().appendTo('#origen');
});
$('.pasartodos').click(function() {
 $('#origen option').each(function() { $(this).remove().appendTo('#destino');
  });
});
$('.quitartodos').click(function() {
$('#destino option').each(function() { $(this).remove().appendTo('#origen');
  });
});
//$('.submit').click(function() { $('#destino option').prop('selected', 'selected'); });
//Mostramos los permisos
	$.post("../ajax/modulos.php?op=listar1",function(r){
	        $("#origen").html(r);
	});

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})
}

//Función limpiar
function limpiar()
{
	$("#idcategoria").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').DataTable(
	{
	  destroy:true,
	  dom: 'lBfrtip',//Definimos los elementos del control de tabla
	  language: {
      processing: "<i class='fa fa-spinner fa-2x fa-spin fa-fw' aria-hidden='true'></i>",
      search: "<i class='fa fa-search' aria-hidden='true'></i>",
      lengthMenu:     "Mostrando _MENU_ perfiles",
      info:           "Mostrando del _START_ al _END_ de _TOTAL_ perfiles",
      infoEmpty:      "Mostrando 0 al 0 de 0 coincidencias",
      infoFiltered: "(filtrado de un total de _MAX_ elementos)",
      infoPostFix: "",
      loadingRecords: "<i class='fa fa-spinner fa-2x fa-spin fa-fw' aria-hidden='true'></i>",
      zeroRecords: "No se encontraron coincidencias",
      emptyTable: "No hay datos para mostrar",
      paginate: {
        first: "<i type='buttons' class='fa fa-fast-backward fa-lg' aria-hidden='true'></i>",
        previous: "<i class='fa fa-backward fa-lg' aria-hidden='true'></i>",
        next: "<i class='fa fa-forward fa-lg' aria-hidden='true'></i>",
        last: "<i class='fa fa-fast-forward fa-lg' aria-hidden='true'></i>"
      }
      //,
      //aria: {
      //    sortAscending: ": activate to sort column ascending",
      //    sortDescending: ": activate to sort column descending"
      //}
    },
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
     buttons: [
      { extend: 'colvis', text: '<i class="fa fa-eye" aria-hidden="true"></i>' },
      { extend: 'copy', text: '<i class="fa fa-clipboard" aria-hidden="true"></i>' },
      { extend: 'excel', text: '<i class="fa fa-file-excel-o text-success" aria-hidden="true"></i>',title: 'Mi Inventario' },
      { extend: 'pdf', text: '<i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i>',title: 'Mi Inventario' },
      { extend: 'print', text: '<i class="fa fa-print" aria-hidden="true"></i>' }

    ],
		"ajax":
				{
					url: '../ajax/perfiles.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		columnDefs:[
      { orderable: false, targets: [0] },{ orderable: false, targets: [2] }
    ],
    order:[
      [ 1, 'asc' ]
    ],
    stateSave: true
    //select: true
	//"bDestroy": true,
    //"iDisplayLength": 5,//Paginación
	//"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	});
	tabla.buttons().container().appendTo( $('.col-sm-6:eq(0)', tabla.table().container() ) );
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/categoria.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
	          bootbox.alert(datos);
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idcategoria)
{
	$.post("../ajax/categoria.php?op=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#descripcion").val(data.descripcion);
 		$("#idcategoria").val(data.idcategoria);

 	})
}

//Función para desactivar registros
function desactivar(idcategoria)
{
	bootbox.confirm("¿Está Seguro de desactivar la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/categoria.php?op=desactivar", {idcategoria : idcategoria}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(idcategoria)
{
	bootbox.confirm("¿Está Seguro de activar la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/categoria.php?op=activar", {idcategoria : idcategoria}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}


init();

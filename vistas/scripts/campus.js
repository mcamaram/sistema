var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

   // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = tabla.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });
    
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all checkboxes in the table
      tabla.$('input[type="checkbox"]').each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element 
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               );
            }
         } 
      });

      // FOR TESTING ONLY
      
      // Output form data to a console
      $('#example-console').text($(form).serialize()); 
      console.log("Form submission", $(form).serialize()); 
       
      // Prevent actual form submission
      e.preventDefault();
   });
}

//Función limpiar
function limpiar()
{
	$("#nombre").val("");
	$("#direccion").val("");
	$("#ciudad").val("");
	$("#colonia").val("");
	$("#codigo_postal").val("");
	$("#estado").val("");
	$("#pais").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#idcampus").val("");
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
      lengthMenu:     "Mostrando _MENU_ productos",
      info:           "Mostrando del _START_ al _END_ de _TOTAL_ productos",
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
					url: '../ajax/campus.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},

		columnDefs:[
      { orderable: false, targets: [0] },{
      	 orderable:false,
         targets: [1],
         searchable:false,
         /*checkboxes:{ seletRow: true
         }*/
         classname: 'dt-body-center',
          render :  function (data, type, full, meta){
             return '<input class="dt-body-center" type="checkbox" name="id[]" value="' 
             + $('<div/>').text(data).html() + '">';
        } 
      },{ orderable: false, targets: [5] }
    ],
    select:{
                style: 'multi'
              },

    order:[
      [ 1, 'asc' ]
    ],
    stateSave: true
    //select: true
	//"bDestroy": true,
    //"iDisplayLength": 5,//Paginación
	//"order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	});
	tabla.buttons().container()
  .appendTo( $('.col-sm-6:eq(0)', tabla.table().container() ) );

}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/campus.php?op=guardaryeditar",
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

function mostrar(idcampus)
{
	$.post("../ajax/campus.php?op=mostrar",{idcampus : idcampus}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#direccion").val(data.direccion);
		$("#ciudad").val(data.ciudad);
		$("#colonia").val(data.colonia);
		$("#codigo_postal").val(data.codigo_postal);
		$("#estado").val(data.estado);
		$("#pais").val(data.pais);
		$("#telefono").val(data.telefono);
		$("#email").val(data.email);
 		$("#idcampus").val(data.idcampus);
		

 	})
}

//Función para eliminar registros
function eliminar(idcampus)
{
	bootbox.confirm("¿Está Seguro de eliminar el campus?", function(result){
		if(result)
        {
        	$.post("../ajax/campus.php?op=eliminar", {idcampus : idcampus}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();
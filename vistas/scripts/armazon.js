var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(1);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}




//Función limpiar
function limpiar()
{
	$("#id_armazon").val("");
	$("#modelo").val("");
	$("#precio_compra").val("");
	$("#precio_venta").val("");
	$("#stock").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	console.log(flag);
	switch(flag){
		case 0:
			$("#formid").hide();
			$("#listadoregistros").hide();
			$("#formularioregistros").show();
			$("#btnGuardar").prop("disabled",false);
			$("#btnagregar").hide();
		break;
		case 1:
			$("#listadoregistros").show();
			$("#formularioregistros").hide();
			$("#btnagregar").show()
		break;
		case 2:
			
			$("#formid").hide();
			$("#listadoregistros").hide();
			$("#formularioregistros").show();
			$("#btnGuardar").prop("disabled",false);
			$("#btnagregar").hide();
		break;
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(1);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            
		        ],
		"ajax":
				{
					url: '../ajax/armazon.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/armazon.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(1);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(id_armazon)
{
	$.post("../ajax/armazon.php?op=mostrar",{id_armazon : id_armazon}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(0);

		$("#id_armazon").val(data.id_armazon);
		$("#modelo").val(data.modelo);
		$("#precio_compra").val(data.precio_compra);
		$("#precio_venta").val(data.precio_venta);
		$("#stock").val(data.stock);


 	})
}
function mostrar2(id_armazon)
{
	$.post("../ajax/armazon.php?op=mostrar",{id_armazon : id_armazon}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(2);

		$("#id_armazon").val(data.id_armazon);
		$("#modelo").val(data.modelo);
		$("#precio_compra").val(data.precio_compra);
		$("#precio_venta").val(data.precio_venta);
		$("#stock").val(data.stock);

 	})
}
//Función para desactivar registros
function desactivar(curp)
{
	bootbox.confirm("¿Está Seguro de desactivar la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/cliente.php?op=desactivar", {curp : curp}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function eliminar(id_armazon)
{
	$.post("../ajax/armazon.php?op=eliminar", {id_armazon : id_armazon}, function(e){
		bootbox.alert(e);
		tabla.ajax.reload();
	});	
}
//Función para activar registros
function activar(curp)
{
	bootbox.confirm("¿Está Seguro de activar la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/cliente.php?op=activar", {curp : curp}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();
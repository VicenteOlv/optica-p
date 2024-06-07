var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}




//Función limpiar
function limpiar()
{
	$("#curp").val("");
	$("#nombre").val("");
	$("#telefono").val("");
	$("#celular").val("");
	$("#email").val("");
	$("#fecha").val("");
	$("#direccion").val("");
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
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          

		        ],
		"ajax":
				{
					url: '../ajax/cliente.php?op=listar',
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
		url: "../ajax/cliente.php?op=guardaryeditar",
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

function mostrar(curp)
{
	$.post("../ajax/cliente.php?op=mostrar",{curp : curp}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#curp").val(data.curp);
		$("#nombre").val(data.nombre_completo);
		$("#telefono").val(data.telefono);
		$("#celular").val(data.celular);
		$("#email").val(data.email);
		$("#fecha").val(data.fecha_nacimiento);
		$("#direccion").val(data.direccion);

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

function eliminar(curp)
{
	$.post("../ajax/cliente.php?op=eliminar", {curp : curp}, function(e){
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
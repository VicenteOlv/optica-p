var tabla;
var ed = false;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
    $.post("../ajax/fiscal.php?op=selectCliente", function(r){
        $("#curp").html(r);
        $('#curp').selectpicker('refresh');
});
}




//Función limpiar
function limpiar()
{
	$("#rfc").val("");
	$("#regimen").val("");
	$("#curp").val("");
}

    // Llenar el select de CURPs al cargar la página

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
					url: '../ajax/fiscal.php?op=listar',
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
	console.log(ed);
	if(ed){
		str1="../ajax/fiscal.php?op=guardaryeditar";
	}else{
		str1="../ajax/fiscal.php?op=editar";
	}

	$.ajax({
		
		url: str1,
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


function mostrar(rfc)
{
	$.post("../ajax/fiscal.php?op=mostrar",{rfc : rfc}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#rfc").val(data.rfc);
		$("#regimen").val(data.regimen);
		$("#curp").val(data.curp);


 	})
}

function editar(flag, rfc){
	console.log("Entró");
	if(flag==true){
		ed=true;
	}
	else{
		ed=false;
		mostrar(rfc);
	}
}
//Función para desactivar registros
function desactivar(curp)
{
	bootbox.confirm("¿Está Seguro de desactivar la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/fiscal.php?op=desactivar", {curp : curp}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function eliminar(rfc)
{
	$.post("../ajax/fiscal.php?op=eliminar", {rfc : rfc}, function(e){
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
        	$.post("../ajax/fiscal.php?op=activar", {curp : curp}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();
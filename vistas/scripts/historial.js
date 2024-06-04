var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
    $.post("../ajax/historial.php?op=selectCliente", function(r){
        $("#curp").html(r);
        $('#curp').selectpicker('refresh');
    });
}



//Función limpiar
function limpiar()
{
	$("#id_historia").val("");
	$("#fecha").val("");
	$("#curp").val("");
    $("#observaciones").val("");

	$("#id_ojo_izq").val("");
	$("#esferico_izq").val("");
	$("#cilindrico_izq").val("");
	$("#eje_izq").val("");
    $("#add_izq").val("");
	$("#prisma_izq").val("");
	$("#altura_oblea_izq").val("");
	$("#av_izq").val("");

	$("#id_ojo_der").val("");
	$("#esferico_der").val("");
	$("#cilindrico_der").val("");
	$("#eje_der").val("");
    $("#add_der").val("");
	$("#prisma_der").val("");
	$("#altura_oblea_der").val("");
	$("#av_der").val("");
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
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/historial.php?op=listar',
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
		url: "../ajax/historial.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {       
            
            
                $.ajax({
                    url: "../ajax/ojo_izq.php?op=guardaryeditar",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
            
                    success: function(datos)
                    {           
                        $.ajax({
                            url: "../ajax/ojo_der.php?op=guardaryeditar",
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
                        bootbox.alert(datos);	          
                        mostrarform(false);
                        tabla.ajax.reload();
                    }
            
                });         
                bootbox.alert(datos);	          
                mostrarform(false);
                tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(id_historia, id_ojo_izq, id_ojo_der)
{
	console.log("Entró");
	console.log(id_historia);
	console.log(id_ojo_izq);
	console.log(id_ojo_der);


	//Tenemos que mandar a llamar a las tablas
	
	var ojoIzq = JSON.parse(id_ojo_izq);
	var ojoDer = JSON.parse(id_ojo_der);

	console.log(ojoIzq.id_historia);
	console.log(ojoDer.id_historia);

	var data = $.post("../ajax/historial.php?op=mostrar", { id_historia: id_historia });
    var ojoDerPromise = $.post("../ajax/ojo_der.php?op=mostrar", { id_ojo_der: id_ojo_der });
    var ojoIzqPromise = $.post("../ajax/ojo_izq.php?op=mostrar", { id_ojo_izq: id_ojo_izq });

	
	data = JSON.parse(data);		

    // Luego, usamos $.when para esperar a que todas las promesas se resuelvan
    $.when(historiaPromise, ojoDerPromise, ojoIzqPromise).done(function(historiaData, ojoDerData, ojoIzqData) {
        // Aquí procesamos los datos recibidos de cada solicitud

        mostrarform(true);

        // Datos de historial
        $("#id_historia").val(data.id_historia);
	    $("#fecha").val(data.fecha);
	    $("#curp").val(data.curp);
        $("#observaciones").val(data.observaciones);

        // Datos de ojo derecho
        $("#id_ojo_der").val(ojoDer);
		$("#esferico_der").val(data.esferico_der);
		$("#cilindrico_der").val(data.cilindrico_der);
		$("#eje_der").val(data.eje_der);
		$("#add_der").val(data.add_der);
		$("#prisma_der").val(data.prisma_der);
		$("#altura_oblea_der").val(data.altura_oblea_der);
		$("#av_der").val(data.av_der);

        // Datos de ojo izquierdo
        $("#id_ojo_izq").val(ojoIzq.id_ojo_izq);
        $("#esferico_izq").val(ojoIzq.esferico_izq);
        $("#cilindrico_izq").val(ojoIzq.cilindrico_izq);
        $("#eje_izq").val(ojoIzq.eje_izq);
        $("#add_izq").val(ojoIzq.add_izq);
        $("#prisma_izq").val(ojoIzq.prisma_izq);
        $("#altura_oblea_izq").val(ojoIzq.altura_oblea_izq);
        $("#av_izq").val(ojoIzq.av_izq);
    }).fail(function() {
        // Manejo de errores si alguna de las solicitudes falla
        console.error("Error al obtener los datos.");
    });

	/*
	$.post("../ajax/historial.php?op=mostrar",{id_historia : id_historia}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#id_historia").val(data.id_historia);
	    $("#fecha").val(data.fecha);
	    $("#curp").val(data.curp);
        $("#observaciones").val(data.observaciones);

		$("#id_ojo_der").val(data.id_ojo_der);
		$("#esferico_der").val(data.esferico_der);
		$("#cilindrico_der").val(data.cilindrico_der);
		$("#eje_der").val(data.eje_der);
		$("#add_der").val(data.add_der);
		$("#prisma_der").val(data.prisma_der);
		$("#altura_oblea_der").val(data.altura_oblea_der);
		$("#av_der").val(data.av_der);
	  

 	})

	$.post("../ajax/ojo_der.php?op=mostrar",{id_ojo_der : id_ojo_der}, function(data, status)
	{
		 data = JSON.parse(data);		
	 
		$("#id_ojo_der").val(data.id_ojo_der);
		$("#esferico_der").val(data.esferico_der);
		$("#cilindrico_der").val(data.cilindrico_der);
		$("#eje_der").val(data.eje_der);
		$("#add_der").val(data.add_der);
		$("#prisma_der").val(data.prisma_der);
		$("#altura_oblea_der").val(data.altura_oblea_der);
		$("#av_der").val(data.av_der);
	  
	})

	$.post("../ajax/ojo_izq.php?op=mostrar",{id_ojo_izq : id_ojo_izq}, function(data, status)
	{
		data = JSON.parse(data);		

		$("#id_ojo_izq").val(data.id_ojo_izq);
		$("#esferico_izq").val(data.esferico_izq);
		$("#cilindrico_izq").val(data.cilindrico_izq);
		$("#eje_izq").val(data.eje_izq);
		$("#add_izq").val(data.add_izq);
		$("#prisma_izq").val(data.prisma_izq);
		$("#altura_oblea_izq").val(data.altura_oblea_izq);
		$("#av_izq").val(data.av_izq);

 	})
	*/
}

//Función para desactivar registros


function eliminar(id_historia)
{
	$.post("../ajax/historial.php?op=eliminar", {id_historia : id_historia}, function(e){
		bootbox.alert(e);
		tabla.ajax.reload();
	});	
}


init();
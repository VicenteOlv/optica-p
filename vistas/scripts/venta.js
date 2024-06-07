var tabla;
var precio_armazon
var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha').val(today);

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
	//Cargamos los items al select cliente
	$.post("../ajax/venta.php?op=selectCliente", function(r){
	            $("#rfc").html(r);
	            $('#rfc').selectpicker('refresh');
	});
	$.post("../ajax/venta.php?op=selectArmazon", function(r){
		$("#id_armazon").html(r);
		$('#id_armazon').selectpicker('refresh');
	});
	
	$('#mVentas').addClass("treeview active");
    $('#lVentas').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#idcliente").val("");
	//$("#fecha").val("");
	$("#id_venta").val("");
	$("#material").val("");
	$("#recubrimiento").val("");
	$("#precio_cristal").val(0);

	$("#total_venta").val("");
	$(".filas").remove();
	$("#total").html("0");

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha').val(today);

    //Marcamos el primer tipo_documento
    $("#id_historia").val("");
	$("#id_historia").selectpicker('refresh');
}
$(document).ready(function(){
    // Escuchar el evento change del select "rfc"
    $("#rfc").change(function(){
        // Obtener el valor seleccionado del select "rfc"
        var rfcList = $(this).val();
        console.log(rfcList);
        // Realizar la petición AJAX para obtener los historiales del cliente seleccionado
        $.post("../ajax/venta.php?op=selectHistorial", { rfc: rfcList }, function(r){
            // Actualizar el contenido del select "id_historia" con la respuesta del servidor
            $("#id_historia").html(r);
			//bootbox.alert(r);
            // Actualizar el plugin SelectPicker
            $('#id_historia').selectpicker('refresh');
        });
    });
});

//Función mostrar formulario
function mostrarform(flag)
{
	//limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").show();
		detalles=0;
		var rfcList = document.getElementById("rfc").options[document.getElementById("rfc").selectedIndex].value;
		console.log(rfcList);
		$.post("../ajax/venta.php?op=selectHistorial",{ rfc : rfcList }, function(r){
			//bootbox.alert(r);
			$("#id_historia").html(r);
			$('#id_historia').selectpicker('refresh');
		});
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}

	
}
function mostrarprecio(id_armazon)
{
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/venta.php?op=precio_armazon",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {   
			//bootbox.alert(datos);	                 
			var data = JSON.parse(datos);    
	        //bootbox.alert(datos);	    
			$("#precio_venta").val(data.precio_venta);
			precio_armazon=data.precio_venta;
			//console.log(precio_armazon);
	          //mostrarform(false);
	        //listar();
			$("#btnAgregarArt").hide();
			agregarDetalle(precio_armazon);
	    }

	});
	/*
	$.get("../ajax/venta.php?op=precio_armazon")
			.done(function(response) {
				bootbox.alert(response);
				var data = JSON.parse(response);
				$("#precio_venta").val(data.precio_venta);
			})
			.fail(function(error) {
			  console.error("Error:", error);
	});
	
	//var data = $.post("../ajax/historial.php?op=mostrar", { id_historia: id_historia });
	$.post("../ajax/venta.php?op=precio_venta",{id_armazon : id_armazon}, function(data, status)
	{
		//console.log(data);
		bootbox.alert(data);
		data = JSON.parse(data);		
		//console.log(data);
		$("#precio_armazon").val(data.precio_venta);

	})*/
	
}
function mostrarArticulo(){
	var id_armazon = document.getElementById("id_armazon").value;
	console.log(id_armazon);
	mostrarprecio(id_armazon);
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
						url: '../ajax/venta.php?op=listar',
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
	/*
	tabla=$('#tbllistado').dataTable(
	{
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/venta.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"language": {
            "lengthMenu": "Mostrar : _MENU_ registros",
            "buttons": {
            "copyTitle": "Tabla Copiada",
            "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
                }
            }
        },
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();*/
}


//Función ListarArticulos
function listarArticulos()
{
	tabla=$('#tblarticulos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            
		        ],
		"ajax":
				{
					url: '../ajax/venta.php?op=listarArticulosVenta',
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
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/venta.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          listar();
	    }

	});
	limpiar();
}

function mostrar(id_venta)
{
	$.post("../ajax/venta.php?op=mostrar",{id_venta : id_venta}, function(data, status)
	{
		//bootbox.alert(data);	   
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcliente").val(data.idcliente);
		$("#idcliente").selectpicker('refresh');
		$("#fecha").val(data.fecha);
		$("#fecha").selectpicker('refresh');
		//$("#impuesto").val(data.impuesto);
		$("#id_venta").val(data.id_venta);
		$("#material").val(data.material);
		$("#recubrimiento").val(data.recubrimiento);
		$("#precio_cristal").val(data.precio_cristal);
		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
 	});

 	$.post("../ajax/venta.php?op=listarDetalle&id="+id_venta,function(r){
	        $("#detalles").html(r);
	});	
}

//Función para anular registros
function anular(idventa)
{
	bootbox.confirm("¿Está Seguro de anular la venta?", function(result){
		if(result)
        {
        	$.post("../ajax/venta.php?op=anular", {idventa : idventa}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function eliminar(id_venta)
{
	bootbox.confirm("¿Está Seguro de anular la venta?", function(result){
		if(result)
        {
        	$.post("../ajax/venta.php?op=eliminar", {id_venta : id_venta}, function(e){
        		//bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto=18;
var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto()
  {
  	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
  	if (tipo_comprobante=='Factura')
    {
        $("#impuesto").val(impuesto); 
    }
    else
    {
        $("#impuesto").val("0"); 
    }
  }

function agregarDetalle(precio_venta)
  {
  	var cantidad=1;
    var descuento=0;
	var valor_cristal = document.getElementById("precio_cristal").value;
	var valor_armazon = precio_venta;
	//console.log(valor_cristal);
	//console.log(precio_armazon);
	var valor_lente = parseInt(valor_armazon) + parseInt(valor_cristal);
	$("#precio_lentes").val(valor_lente);
	console.log(precio_venta);
    	var subtotal=cantidad*(valor_lente);
    	var fila='<tr class="filas" id="fila'+cont+'">'+
    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    	'<td><input type="number" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
    	'<td><input type="number" name="precio_venta[]" id="precio_venta[]" value="'+valor_lente+'"></td>'+
    	'<td><input type="number" name="descuento[]" value="'+descuento+'"></td>'+
    	'<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
    	'<td><button type="button" onclick="modificarSubototales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
    	'</tr>';
    	cont++;
    	detalles=detalles+1;
		$("#subtotal_2").val(subtotal);
    	$('#detalles').append(fila);
    	modificarSubototales();

  }

  function modificarSubototales()
  {
  	var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_venta[]");
    var desc = document.getElementsByName("descuento[]");
    var sub = document.getElementsByName("subtotal");

    for (var i = 0; i <cant.length; i++) {
    	var inpC=cant[i];
    	var inpP=prec[i];
    	var inpD=desc[i];
    	var inpS=sub[i];

    	inpS.value=(inpC.value * inpP.value)-inpD.value;
    	document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
		$("#subtotal_2").val(inpS.value);
    }
    calcularTotales();

  }
  function calcularTotales(){
  	var sub = document.getElementsByName("subtotal");
  	var total = 0.0;

  	for (var i = 0; i <sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}
	$("#total").html("S/. " + total);
    $("#total_venta").val(total);
    evaluar();
  }

  function evaluar(){
  	if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide(); 
      cont=0;
    }
  }

  function eliminarDetalle(indice){
  	$("#fila" + indice).remove();
  	calcularTotales();
  	detalles=detalles-1;
  	evaluar()
  }

init();
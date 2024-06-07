<?php
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
if (!isset($_SESSION["nombre"]))
{
  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
}
else
{
//Validamos el acceso solo al usuario logueado y autorizado.
if ($_SESSION['ventas']==1)
{
require_once "../modelos/Venta.php";

$venta=new Venta();

$id_venta=isset($_POST["id_venta"])? limpiarCadena($_POST["id_venta"]):"";
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$id_usuario=$_SESSION["idusuario"];
$total=isset($_POST["subtotal_2"])? limpiarCadena($_POST["subtotal_2"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$id_armazon=isset($_POST["id_armazon"])? limpiarCadena($_POST["id_armazon"]):"";
//$precio_venta=isset($_POST["precio_venta"])? limpiarCadena($_POST["precio_venta"]):"";
$precio_lentes=isset($_POST["precio_lentes"])? limpiarCadena($_POST["precio_lentes"]):"";
$id_historia=isset($_POST["id_historia"])? limpiarCadena($_POST["id_historia"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_venta)){
			$rspta=$venta->insertar($rfc,$id_usuario,$total,$fecha,($_POST["cantidad"])[0],$_POST["descuento"][0],$id_armazon,$id_historia,$_POST["precio_cristal"],$_POST["material"],$_POST["recubrimiento"],$precio_lentes);
			echo $rspta ? "Venta registrada" : "No se pudieron registrar todos los datos de la venta";
		}
		else {
		}
	break;

	case 'selectCliente':
		require_once "../modelos/Fiscal.php";
		$fiscal = new Fiscal();
	
		$rspta = $fiscal->listarN();
	
		while ($reg = $rspta->fetch_object())
		{
			echo '<option value=' . $reg->rfc . '>' . $reg->nombre_completo . '</option>';
		}
		break;
	
	case 'selectArmazon':
			require_once "../modelos/Armazon.php";
			$armazon = new Armazon();
		
			$rspta = $armazon->listar();
		
			while ($reg = $rspta->fetch_object())
			{
				echo '<option value=' . $reg->id_armazon . '>' . $reg->modelo . '</option>';
			}
	break;	

	case 'selectHistorial':
		require_once "../modelos/Historial.php";
		$historial = new Historial();
	
		$rspta = $historial->listarCurp($rfc);
		echo '<option value="">Sin historial</option>';
		while ($reg = $rspta->fetch_object())
		{
			echo '<option value=' . $reg->id_historia . '>' . $reg->fecha . '</option>';
		}
	break;
	case 'anular':
		$rspta=$venta->anular($id_venta);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;
	case 'eliminar':
		$rspta=$venta->eliminar($id_venta);
 		echo $rspta ? "Venta eliminada" : "Venta no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$venta->mostrar($id_venta);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $venta->listarDetalle($id);
		$total=0;
		echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td></td><td>'.$reg->cantidad.'</td><td>'.$reg->precio_venta.'</td><td>'.$reg->descuento.'</td><td>'.$reg->total.'</td></tr>';
					$total=$total+($reg->precio_venta*$reg->cantidad-$reg->descuento);
				}
		echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/.'.$total.'</h4><input type="hidden" name="total_venta" id="total_venta"></th> 
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$venta->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

 			$data[]=array(
				"0" => "<button class='btn btn-warning' onclick=mostrar('$reg->id_venta')><i class='fa fa-eye'></i></button>	" .
					"<button class='btn btn-danger' onclick=eliminar('$reg->id_venta')><i class='fa fa-close'></i></button>",
 				"1"=>$reg->fecha,
 				"2"=>$reg->nombre_completo,
 				"3"=>$reg->nombre,
 				"4"=>$reg->total,
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
			/*
	
	case 'listarArticulosVenta':
		require_once "../modelos/Articulo.php";
		$articulo=new Articulo(); //Sustituir por los lentes ya armados

		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idarticulo.',\''.$reg->nombre.'\',\''.$reg->precio_venta.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->codigo,
 				"4"=>$reg->stock,
 				"5"=>$reg->precio_venta,
 				"6"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >"
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;*/
	case 'precio_armazon':
		$rspta = $venta->precioArmazon($id_armazon);
		//var_dump($rspta);
		//var_dump(json_encode($rspta));
		echo (json_encode($rspta));
	break;
}
//Fin de las validaciones de acceso
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();
?>
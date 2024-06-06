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
if ($_SESSION['armazones']==1)
{
require_once "../modelos/Armazon.php";

$armazon=new Armazon();


$modelo=isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";
$precio_compra=isset($_POST["precio_compra"])? limpiarCadena($_POST["precio_compra"]):"";
$precio_venta=isset($_POST["precio_venta"])? limpiarCadena($_POST["precio_venta"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$id_armazon=isset($_POST["id_armazon"])? limpiarCadena($_POST["id_armazon"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_armazon)){
			$rspta=$armazon->insertar($modelo,$precio_compra,$precio_venta,$stock);
			echo $rspta ? "Armazón registrado" : "Armazón no se pudo registrar";
		}
		else {
			$rspta=$armazon->editar($id_armazon,$modelo,$precio_compra,$precio_venta,$stock);
			echo $rspta ? "Armazón actualizado" : "Armazón no se pudo actualizar";
		}
	break;
	
	case 'eliminar':
		$rspta=$armazon->eliminar($id_armazon);
 		echo $rspta ? "Armazon eliminado" : "Armazon no se puede desactivar";
 		break;

	case 'mostrar':
		$rspta=$armazon->mostrar($id_armazon);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;

	case 'listar':
		$rspta=$armazon->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>"<button class='btn btn-warning' onclick=mostrar2('$reg->id_armazon')><i class='fa fa-pencil'></i></button>	".
					"<button class='btn btn-danger' onclick=eliminar('$reg->id_armazon')><i class='fa fa-close'></i></button>",
				"1"=>$reg->id_armazon,
				"2"=>$reg->modelo,
                "3"=>$reg->precio_compra,
				"4"=>$reg->precio_venta,
				"5"=>$reg->stock
                //"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				//'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);

			echo json_encode($results);
			
	break;
}
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();
?>
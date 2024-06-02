<?php 
require_once "../modelos/Armazon.php";

$armazon=new Armazon();


$modelo=isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";
$precio=isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
$id_armazon=isset($_POST["id_armazon"])? limpiarCadena($_POST["id_armazon"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_armazon)){
			$rspta=$armazon->insertar($modelo,$precio);
			echo $rspta ? "Armazón registrado" : "Armazón no se pudo registrar";
		}
		else {
			$rspta=$armazon->editar($id_armazon,$modelo,$precio);
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
                "3"=>$reg->precio
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
?>
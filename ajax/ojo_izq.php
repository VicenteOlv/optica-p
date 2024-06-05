<?php
require_once "../modelos/Ojo_izq.php";

$ojoI = new Ojo_izq();


$id_ojo_izq = isset($_POST["id_ojo_izq"]) ? limpiarCadena($_POST["id_ojo_izq"]) : "";
$esferico_izq = isset($_POST["esferico_izq"]) ? limpiarCadena($_POST["esferico_izq"]) : "";
$cilindrico_izq = isset($_POST["cilindrico_izq"]) ? limpiarCadena($_POST["cilindrico_izq"]) : "";
$eje_izq = isset($_POST["eje_izq"]) ? limpiarCadena($_POST["eje_izq"]) : "";
$add_izq = isset($_POST["add_izq"]) ? limpiarCadena($_POST["add_izq"]) : "";
$prisma_izq = isset($_POST["prisma_izq"]) ? limpiarCadena($_POST["prisma_izq"]) : "";
$altura_oblea_izq = isset($_POST["altura_oblea_izq"]) ? limpiarCadena($_POST["altura_oblea_izq"]) : "";
$av_izq = isset($_POST["av_izq"]) ? limpiarCadena($_POST["av_izq"]) : "";
$id_historia = isset($_POST["id_historia"]) ? limpiarCadena($_POST["id_historia"]) : "";
//$id_historia = ($ultimos = $ojoI->ultimo())["id_historia"];

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if (empty($id_ojo_izq)) {
			if(empty($id_historia)){
				$id_historia = ($ultimos = $ojoI->ultimo())["id_historia"];
			}
			$rspta = $ojoI->insertar($esferico_izq,$cilindrico_izq,$eje_izq,$add_izq,$prisma_izq,$altura_oblea_izq,$av_izq,$id_historia);
			echo $rspta ? "Cliente registrado" : "Cliente no se pudo registrar";
		} else {
			$rspta = $ojoI->editar($id_ojo_izq,$esferico_izq,$cilindrico_izq,$eje_izq,$add_izq,$prisma_izq,$altura_oblea_izq,$av_izq,$id_historia);
			echo $rspta ? "Cliente actualizado" : "Cliente no se pudo actualizar";
		}
		break;

	case 'eliminar':
		$rspta = $ojoI->eliminar($id_ojo_izq);
		echo $rspta ? "Cliente eliminado" : "Categoría no se puede desactivar";
		break;

	case 'desactivar':
		$rspta = $ojoI->desactivar($id_ojo_izq);
		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
		break;

	case 'activar':
		$rspta = $ojoI->activar($id_ojo_izq);
		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
		break;

	case 'mostrar':
		$rspta = $ojoI->mostrar($id_historia);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		break;

	case 'listar':
		$rspta = $ojoI->listar();
		//Vamos a declarar un array
		$data = array();

		while ($reg = $rspta->fetch_object()) {
			$data[] = array(
				"0" => "<button class='btn btn-warning' onclick=mostrar('$reg->curp')><i class='fa fa-pencil'></i></button>	" .
					"<button class='btn btn-danger' onclick=eliminar('$reg->curp')><i class='fa fa-close'></i></button>",
				"1" => $reg->curp,
				"2" => $reg->nombre_completo,
				"3" => $reg->telefono,
				"4" => $reg->celular,
				"5" => $reg->email,
				"6" => $reg->fecha_nacimiento,
				"7" => $reg->direccion
				//"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
				//'<span class="label bg-red">Desactivado</span>'
			);
		}
		$results = array(
			"sEcho" => 1, //Información para el datatables
			"iTotalRecords" => count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
			"aaData" => $data
		);

		echo json_encode($results);

		break;
}

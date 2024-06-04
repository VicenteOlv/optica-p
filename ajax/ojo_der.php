<?php
require_once "../modelos/Ojo_der.php";

$ojoD = new Ojo_der();


$id_ojo_der = isset($_POST["id_ojo_izq"]) ? limpiarCadena($_POST["id_ojo_izq"]) : "";
$esferico_der = isset($_POST["esferico_der"]) ? limpiarCadena($_POST["esferico_der"]) : "";
$cilindrico_der = isset($_POST["cilindrico_der"]) ? limpiarCadena($_POST["cilindrico_der"]) : "";
$eje_der = isset($_POST["eje_der"]) ? limpiarCadena($_POST["eje_der"]) : "";
$add_der = isset($_POST["add_der"]) ? limpiarCadena($_POST["add_der"]) : "";
$prisma_der = isset($_POST["prisma_der"]) ? limpiarCadena($_POST["prisma_der"]) : "";
$altura_oblea_der = isset($_POST["_der"]) ? limpiarCadena($_POST["_der"]) : "";
$av_der = isset($_POST["av_der"]) ? limpiarCadena($_POST["av_der"]) : "";
$id_historia = isset($_POST["id_historia"]) ? limpiarCadena($_POST["id_historia"]) : "";

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if (empty($id_ojo_der)) {
			$rspta = $ojoD->insertar($esferico_der,$cilindrico_der,$eje_der,$add_der,$altura_oblea_der,$av_der,$id_historia);
			echo $rspta ? "Cliente registrado" : "Cliente no se pudo registrar";
		} else {
			$rspta = $ojoD->editar($id_ojo_der,$esferico_der,$cilindrico_der,$eje_der,$add_der,$altura_oblea_der,$av_der,$id_historia);
			echo $rspta ? "Cliente actualizado" : "Cliente no se pudo actualizar";
		}
		break;

	case 'eliminar':
		$rspta = $ojoD->eliminar($id_ojo_der);
		echo $rspta ? "Cliente eliminado" : "Categoría no se puede desactivar";
		break;

	case 'desactivar':
		$rspta = $ojoD->desactivar($id_ojo_der);
		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
		break;

	case 'activar':
		$rspta = $ojoD->activar($id_ojo_der);
		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
		break;

	case 'mostrar':
		$rspta = $ojoD->mostrar($id_ojo_der);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		break;

	case 'listar':
		$rspta = $ojoD->listar();
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

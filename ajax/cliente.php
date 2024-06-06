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
require_once "../modelos/Cliente.php";

$cliente = new Cliente();


$curp = isset($_POST["curp"]) ? limpiarCadena($_POST["curp"]) : "";
$nombre = isset($_POST["nombre_completo"]) ? limpiarCadena($_POST["nombre_completo"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$celular = isset($_POST["celular"]) ? limpiarCadena($_POST["celular"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$fecha = isset($_POST["fecha_nacimiento"]) ? limpiarCadena($_POST["fecha_nacimiento"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";

switch ($_GET["op"]) {
	case 'guardaryeditar':

		if (!($cliente->existe($curp))) {
			$rspta = $cliente->insertar($curp, $nombre, $telefono, $celular, $email, $fecha, $direccion);
			echo $rspta ? "Cliente registrado" : "Cliente no se pudo registrar";
		} else {
			$rspta = $cliente->editar($curp, $nombre, $telefono, $celular, $email, $fecha, $direccion);
			echo $rspta ? "Cliente actualizado" : "Cliente no se pudo actualizar";
		}
		break;

	case 'eliminar':
		$rspta = $cliente->eliminar($curp);
		echo $rspta ? "Cliente eliminado" : "Categoría no se puede desactivar";
		break;

	case 'desactivar':
		$rspta = $cliente->desactivar($curp);
		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
		break;

	case 'activar':
		$rspta = $cliente->activar($curp);
		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
		break;

	case 'mostrar':
		$rspta = $cliente->mostrar($curp);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
		break;

	case 'listar':
		$rspta = $cliente->listar();
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
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();
?>
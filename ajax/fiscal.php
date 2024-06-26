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
require_once "../modelos/Fiscal.php";
$current_user = $_SESSION['idusuario'];
$fiscal=new Fiscal();



$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$regimen=isset($_POST["regimen"])? limpiarCadena($_POST["regimen"]):"";
$curp=isset($_POST["curp"])? limpiarCadena($_POST["curp"]):"";
$editado_por=isset($_POST["editado_por"])? limpiarCadena($_POST["editado_por"]):"";
$fecha_actualizado=isset($_POST["fecha_actualizado"])? limpiarCadena($_POST["fecha_actualizado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		
			$rspta = $fiscal->insertar($rfc, $regimen, $curp,$current_user);
			echo $rspta ? "fiscal registrado" : "fiscal no se pudo registrar";
		
		
	break;
	case 'editar':
		$rspta = $fiscal->editar($rfc, $regimen, $curp,$current_user);
		echo $rspta ? "fiscal actualizado" : "fiscal no se pudo actualizar";
	break;
    case 'selectCliente':
		require_once "../modelos/Cliente.php";
		$cliente = new Cliente();

		$rspta = $cliente->listar();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->curp . '>' . $reg->nombre_completo . '</option>';
				}
	break;
	case 'eliminar':
		$rspta=$fiscal->eliminar($rfc);
 		echo $rspta ? "fiscal eliminado" : "Categoría no se puede desactivar";
 		break;

	case 'desactivar':
		$rspta=$fiscal->desactivar($curp);
 		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
 		break;

	case 'activar':
		$rspta=$fiscal->activar($curp);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
 		break;

	case 'mostrar':
		$rspta=$fiscal->mostrar($rfc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;

	case 'listar':
		$rspta=$fiscal->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$formatted_date = date("d-m-Y H:i:s", strtotime($reg->fecha_actualizado));
 			$data[]=array(
				"0"=>"<button class='btn btn-warning' onclick=editar(false,'$reg->rfc')><i class='fa fa-pencil'></i></button>	".
					"<button class='btn btn-danger' onclick=eliminar('$reg->rfc')><i class='fa fa-close'></i></button>",
				"1"=>$reg->rfc,
                "2"=>$reg->regimen,
                "3"=>$reg->curp,
				"4" => $reg->editado_por . ' (' . $formatted_date . ')',
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
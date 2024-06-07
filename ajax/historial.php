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
if ($_SESSION['historiales']==1)
{
require_once "../modelos/Historial.php";
require_once "../modelos/Ojo_der.php";
require_once "../modelos/Ojo_izq.php";
$current_user = $_SESSION['idusuario'];
$historial = new Historial();
$ojo_der = new Ojo_der();
$ojo_izq = new Ojo_izq();


$id_historia = isset($_POST["id_historia"]) ? limpiarCadena($_POST["id_historia"]) : "";
$fecha = isset($_POST["fecha"]) ? limpiarCadena($_POST["fecha"]) : "";
$curp = isset($_POST["curp"]) ? limpiarCadena($_POST["curp"]) : "";
$observaciones = isset($_POST["observaciones"]) ? limpiarCadena($_POST["observaciones"]) : "";
$editado_por=isset($_POST["editado_por"])? limpiarCadena($_POST["editado_por"]):"";
$fecha_actualizado=isset($_POST["fecha_actualizado"])? limpiarCadena($_POST["fecha_actualizado"]):"";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if(empty($id_historia)){
            $rspta = $historial->insertar($fecha,$curp,$observaciones,$current_user);
            echo $rspta ? "Historial registrado" : "Historial no se pudo registrar";

        }else{
            $rspta = $historial->editar($id_historia,$fecha,$curp,$observaciones,$current_user);
            echo $rspta ? "Historial actualizado" : "Historial no se pudo actualizar";
        }
        break;
    case 'editar':
        $rspta = $historial->editar($id_historia,$fecha,$curp,$observaciones,$current_user);
        echo $rspta ? "Historial actualizado" : "Historial no se pudo actualizar";
        break;
    case 'ultimo':
            $rspta = $historial->ultimo();
            echo json_encode($rspta);
        break;
    case 'selectCliente':
        require_once "../modelos/Cliente.php";
        $cliente = new Cliente();

        $rspta = $cliente->listar();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->curp . '>' . $reg->nombre_completo . '</option>';
        }
        break;
    case 'eliminar':
        $rspta = $historial->eliminar($id_historia);
        echo $rspta ? "Historial eliminado" : "Categoría no se puede desactivar";
        break;

    case 'mostrar':
        $rspta = $historial->mostrar($id_historia);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $historial->listar();
        
        //Vamos a declarar un array
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $rspta2 = $ojo_der->mostrarID($reg->id_historia);
            $rspta1 = $ojo_izq->mostrarID($reg->id_historia);
            

            $var2 = json_encode($ojo_der->mostrarID($reg->id_historia));
            $var1 = json_encode($ojo_izq->mostrarID($reg->id_historia));

            $formatted_date = date("d-m-Y H:i:s", strtotime($reg->fecha_actualizado));
            $data[] = array(
                "0" => "<button class='btn btn-warning' onclick=mostrar('$reg->id_historia','$var1','$var2')><i class='fa fa-pencil'></i></button>	" .
                    "<button class='btn btn-danger' onclick=eliminar('$reg->id_historia')><i class='fa fa-close'></i></button>",
                "1" => $reg->id_historia,
                "2" => $reg->fecha,
                "3" => $reg->curp,
                "4" => $reg->observaciones,
                "5" => $reg->editado_por . ' (' . $formatted_date . ')',
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
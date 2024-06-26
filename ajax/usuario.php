<?php
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$rol=isset($_POST["rol"])? limpiarCadena($_POST["rol"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}

		else {
			if ($_SESSION['armazones']==1)
			{

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}
		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clave);

		if (empty($idusuario)) {
			$permiso = isset($_POST['permiso']) ? $_POST['permiso'] : array();
			$rspta = $usuario->insertar($nombre, $telefono, $direccion, $rol, $login, $clavehash, $imagen, $permiso);
			echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
		} else {
			$permiso = isset($_POST['permiso']) ? $_POST['permiso'] : array();
			$rspta = $usuario->editar($idusuario, $nombre, $telefono, $direccion, $rol, $login, $clavehash, $imagen, $permiso);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}

		}
		else
		{
	  	require 'noacceso.php';
		}
	 }
	break;

	case 'desactivar':

		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else {
			//Validamos el acceso solo al usuario logueado y autorizado.
			if ($_SESSION['armazones']==1)
				{
					$rspta=$usuario->desactivar($idusuario);
					 echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
				//Fin de las validaciones de acceso
				}
			else
				{
				require 'noacceso.php';
				}
		}
	break;

	case 'activar':
		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			//Validamos el acceso solo al usuario logueado y autorizado.
			if ($_SESSION['armazones']==1)
			{
				$rspta=$usuario->activar($idusuario);
 				echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
			//Fin de las validaciones de acceso
			}
			else
			{
		  	require 'noacceso.php';
			}
		}	
	break;

	case 'mostrar':
		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			//Validamos el acceso solo al usuario logueado y autorizado.
			if ($_SESSION['armazones']==1)
			{
				$rspta=$usuario->mostrar($idusuario);
		 		//Codificar el resultado utilizando json
		 		echo json_encode($rspta);
			//Fin de las validaciones de acceso
			}
			else
			{
		  	require 'noacceso.php';
			}
		}		
	break;

	case 'listar':
		 if (!isset($_SESSION["nombre"]))
		 {
		   header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		 }
		 else
		 {
			 //Validamos el acceso solo al usuario logueado y autorizado.
			 if ($_SESSION['armazones']==1)
			 {
				 $rspta=$usuario->listar();
				  //Vamos a declarar un array
				  $data= Array();
 
				  while ($reg=$rspta->fetch_object()){
					$data[]=array(
						"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
							' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
							'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
							' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
						"1"=>$reg->nombre,
						"2"=>$reg->telefono,
						"3"=>$reg->direccion,
						"4"=>$reg->rol,
						"5"=>$reg->login,
						"6"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px' >",
						"7"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
						'<span class="label bg-red">Desactivado</span>'
						);
				  }
				  $results = array(
					  "sEcho"=>1, //Información para el datatables
					  "iTotalRecords"=>count($data), //enviamos el total registros al datatable
					  "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
					  "aaData"=>$data);
				  echo json_encode($results);
			 //Fin de las validaciones de acceso
			 }
			 else
			 {
			   require 'noacceso.php';
			 }
		 }
	break;

	case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
				}
	break;

	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['login']=$fetch->login;

	        //Obtenemos los permisos del usuario
	    	$marcados = $usuario->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			in_array(2,$valores)?$_SESSION['armazones']=1:$_SESSION['armazones']=0;
			in_array(3,$valores)?$_SESSION['historiales']=1:$_SESSION['historiales']=0;
			in_array(4,$valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
			in_array(5,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;

	    }
	    echo json_encode($fetch);
	break;

	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;
}
ob_end_flush();
?>
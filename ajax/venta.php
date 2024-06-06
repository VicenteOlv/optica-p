<?php

require_once "../modelos/Venta.php";

$venta=new Venta();

$id_venta=isset($_POST["id_venta"])? limpiarCadena($_POST["id_venta"]):"";
$rfc=isset($_POST["rfc"])? limpiarCadena($_POST["rfc"]):"";
$id_usuario="";//$_SESSION["id_usuario"];
$total=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idventa)){
			$rspta=$venta->insertar($rfc,$id_usuario,$total,$fecha,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_venta"],$_POST["descuento"],$_POST["id_armazon"],$_POST["id_historia"],$_POST["precio_cristal"],$_POST["material"],$_POST["recubrimiento"]);
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
	
		$rspta = $historial->listar();
	
		while ($reg = $rspta->fetch_object())
		{
			echo '<option value=' . $reg->id_historial . '>' . $reg->fecha . '</option>';
		}
	break;/*
	case 'anular':
		$rspta=$venta->anular($idventa);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$venta->mostrar($idventa);
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
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->cantidad.'</td><td>'.$reg->precio_venta.'</td><td>'.$reg->descuento.'</td><td>'.$reg->subtotal.'</td></tr>';
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
 			if($reg->tipo_comprobante=='Ticket'){
 				$url='../reportes/exTicket.php?id=';
 			}
 			else{
 				$url='../reportes/exFactura.php?id=';
 			}

 			$data[]=array(
 				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.
 					' <button class="btn btn-danger" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
 					'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>',
 				"1"=>$reg->fecha,
 				"2"=>$reg->$fiscal,
 				"3"=>$reg->usuario,
 				"4"=>$reg->tipo_comprobante,
 				"5"=>$reg->serie_comprobante.'-'.$reg->num_comprobante,
 				"6"=>$reg->total_venta,
 				"7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'selectCliente':
		require_once "../modelos/Cliente.php";
		$cliente = new Cliente();

		$rspta = $cliente->listar();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idcliente . '>' . $reg->nombre . '</option>';
				}
	break;
	
	case 'listarArticulosVenta':
		require_once "../modelos/Articulo.php";
		$articulo=new Articulo(); //Sustituir por los lentes ya armados

		$rspta=$articulo->listarActivosVenta();
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

?>
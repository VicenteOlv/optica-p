<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Venta
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($rfc,$id_usuario,$total,$fecha,$cantidad,$descuento,$id_armazon,$id_historia,$precio_cristal,$material,$recubrimiento,$precio_lentes)
	{
		$id_cristales_new="";
		$sql="INSERT INTO ventas (total,rfc,id_usuario,fecha)
		VALUES ('$total','$rfc','$id_usuario','$fecha')";
		//return ejecutarConsulta($sql);
		$idventanew=ejecutarConsulta_retornarID($sql);

		if(!empty($id_historia)){
			//Aqui hay que crear el cristal, sacando los dos daignosticos de ojos, y por último creamos los dettalles
			$sql = "SELECT id_ojo_der FROM ojo_der WHERE id_historia='$id_historia'";
			$idOjoDer = ejecutarConsultaSimpleFila($sql)['id_ojo_der'];
			$sql = "SELECT id_ojo_izq FROM ojo_izq WHERE id_historia='$id_historia'";
			$idOjoIzq = ejecutarConsultaSimpleFila($sql)['id_ojo_izq'];

			$sql_cristal = "INSERT INTO cristales (id_ojo_izq, id_ojo_der, precio_cristal, material, recubrimiento) VALUES ('$idOjoIzq','$idOjoDer','$precio_cristal','$material','$recubrimiento')";
			$id_cristales_new=ejecutarConsulta_retornarID($sql_cristal);
		}

		$sql_lentes = "INSERT INTO lentes (id_cristales, id_armazon, precio_lentes) VALUES ('$id_cristales_new','$id_armazon','$precio_lentes')";
		$codigo_barras_new=ejecutarConsulta_retornarID($sql_lentes);

		$sql_detalle = "INSERT INTO detalle_venta(codigo_barras,id_venta,cantidad,precio_venta,descuento) VALUES ('$codigo_barras_new','$idventanew','$cantidad','$precio_lentes','$descuento')";
		ejecutarConsulta($sql_detalle);

		/*$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_venta(codigo_barras, id_venta,cantidad,precio_venta,descuento) VALUES ('$idventanew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_venta[$num_elementos]','$descuento[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}*/

		return ejecutarConsulta($sql_detalle);;
	}

	public function listarN()
	{
		$sql = "SELECT c.rfc, p.curp, p.nombre 
				FROM ficales c 
				JOIN clientes p ON c.curp = p.curp";
		return ejecutarConsulta($sql);
	}

	public function listar()
	{
		$sql="SELECT ventas.id_venta as id_venta, ventas.fecha as fecha, clientes.nombre_completo as nombre_completo, usuarios.nombre as nombre, ventas.total as total
		FROM ventas
		JOIN fiscales ON ventas.rfc = fiscales.rfc
		JOIN clientes ON fiscales.curp = clientes.curp
		JOIN usuarios ON ventas.id_usuario = usuarios.idusuario;";
		
		return ejecutarConsulta($sql);		
	}
	public function precioArmazon($id_armazon){
			$sql = "SELECT precio_venta FROM armazon WHERE id_armazon = '$id_armazon' LiMIT 1";        
			return ejecutarConsultaSimpleFila($sql);
		}
	
	//Implementamos un método para anular la venta
	public function anular($idventa)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($id_venta)
	{
		/*
		$sql="DELETE FROM detalle_venta WHERE id_venta = '$id_venta'";
		ejecutarConsulta($sql);
		$sql="DELETE FROM lentes WHERE id_venta = '$id_venta'";
		ejecutarConsulta($sql);
		return ejecutarConsulta($sql);*/

		// Incluye el archivo de conexión y funciones

		// Paso 1: Obtener el código de barras y el id_cristales antes de eliminar el registro de detalle_venta
		$sql_select_lente = "SELECT l.codigo_barras, l.id_cristales 
							FROM detalle_venta d 
							INNER JOIN lentes l ON d.codigo_barras = l.codigo_barras 
							WHERE d.id_venta = '$id_venta' LIMIT 1";
		$result_lente = ejecutarConsulta($sql_select_lente);
		$codigo_barras = null;
		$id_cristales = null;
		if ($row = $result_lente->fetch_assoc()) {
			$codigo_barras = $row['codigo_barras'];
			$id_cristales = $row['id_cristales'];
		}

		// Paso 2: Eliminar el registro de detalle_venta
		$sql_detalle = "DELETE FROM detalle_venta WHERE id_venta = '$id_venta'";
		if (ejecutarConsulta($sql_detalle)) {
			// Paso 3: Eliminar el registro de lentes correspondiente al código de barras obtenido
			if ($codigo_barras) {
				$sql_lente = "DELETE FROM lentes WHERE codigo_barras = '$codigo_barras'";
				if (ejecutarConsulta($sql_lente)) {
					// Paso 4: Eliminar el registro de cristales correspondiente al id_cristales obtenido
					if ($id_cristales) {
						$sql_cristales = "DELETE FROM cristales WHERE id_cristales = '$id_cristales'";
						if (ejecutarConsulta($sql_cristales)) {
							$sql="DELETE FROM ventas WHERE id_venta = '$id_venta'";
							return ejecutarConsulta($sql);
						} else {
							echo "Error al eliminar el registro de la tabla cristales.";
						}
					} else {
						echo "No se encontró un id_cristales para eliminar en la tabla cristales.";
					}
				} else {
					echo "Error al eliminar el registro de la tabla lentes.";
				}
			} else {
				echo "No se encontró un código de barras para eliminar en la tabla lentes.";
			}
		} else {
			echo "Error al eliminar el registro de la tabla detalle_venta.";
		}

	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_venta)
	{
		$sql="SELECT v.fecha as fecha, c.nombre_completo as nombre_completo, d.codigo_barras, l.id_cristales, cr.precio_cristal, cr.material, cr.recubrimiento, h.fecha as fecha_historial
		FROM ventas v
		INNER JOIN fiscales f ON v.rfc = f.rfc
		INNER JOIN clientes c ON f.curp = c.curp
		INNER JOIN historia_clinicas h ON h.curp = c.curp
		INNER JOIN detalle_venta d ON v.id_venta = d.id_venta
		INNER JOIN lentes l ON l.codigo_barras = d.codigo_barras
		INNER JOIN cristales cr ON cr.id_cristales = l.id_cristales
		WHERE v.id_venta = $id_venta
		LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($id_venta)
	{
		$sql="SELECT d.cantidad as cantidad, d.precio_venta as precio_venta, d.descuento as descuento, v.total as total
		FROM detalle_venta d
		INNER JOIN ventas v ON v.id_venta = d.id_venta
		WHERE v.id_venta = $id_venta
		LIMIT 1";
		return ejecutarConsulta($sql);
	}
/*
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha,v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario ORDER by v.idventa desc";
		return ejecutarConsulta($sql);		
	}

	public function ventacabecera($idventa){
		$sql="SELECT v.idventa,v.idcliente,p.nombre as cliente,p.direccion,p.tipo_documento,p.num_documento,p.email,p.telefono,v.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,date(v.fecha_hora) as fecha,v.impuesto,v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function ventadetalle($idventa){
		$sql="SELECT a.nombre as articulo,a.codigo,d.cantidad,d.precio_venta,d.descuento,(d.cantidad*d.precio_venta-d.descuento) as subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}
	*/
}
?>
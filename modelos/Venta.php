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
	public function insertar($rfc,$id_usuario,$total,$fecha,$codigo_barras,$cantidad,$precio_venta,$descuento,$id_armazon,$id_historia,$precio_cristal,$material,$recubrimiento)
	{
		$id_cristales_new="";
		$sql="INSERT INTO venta (total,rfc,id_usuario,fecha)
		VALUES ('$total','$rfc','$id_usuario','$fecha')";
		//return ejecutarConsulta($sql);
		$idventanew=ejecutarConsulta_retornarID($sql);

		if(!empty($id_historia)){
			//Aqui hay que crear el cristal, sacando los dos daignosticos de ojos, y por último creamos los dettalles
			$sql = "SELECT id_ojo_der FROM ojo_der WHERE id_hitoria='$id_historia'";
			$idOjoDer = ejecutarConsultaSimpleFila($sql)['id_ojo_der'];
			$sql = "SELECT id_ojo_izq FROM ojo_izq WHERE id_hitoria='$id_historia'";
			$idOjoIzq = ejecutarConsultaSimpleFila($sql)['id_ojo_izq'];

			$sql_cristal = "INSERT INTO cristales (id_ojo_izq, id_ojo_der, precio_cristal, material, recubrimiento) VALUES ('$idOjoIzq','$idOjoDer','$precio_cristal','$material','$recubrimiento')";
			$id_cristales_new=ejecutarConsulta_retornarID($sql_cristal);
		}
		$sql_precioarmazon = "SELECT precio_venta";
		//Falta crear el lente
		$sql_lentes = "INSERT INTO lentes (id_cristales, id_armazon, precio_lentes) VALUES ('$id_cristales_new','$id_armazon','$precio_cristal+$')";

		$sql_detalle = "INSERT INTO detalle_venta(codigo_barras,id_venta,cantidad,precio_venta,descuento) VALUES ('$codigo_barras','$idventanew','$cantidad','$precio_venta','$descuento')";
		ejecutarConsulta($sql_detalle) or $sw = false;

		/*$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_venta(codigo_barras, id_venta,cantidad,precio_venta,descuento) VALUES ('$idventanew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_venta[$num_elementos]','$descuento[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}*/

		return $sw;
	}

	public function listarN()
	{
		$sql = "SELECT c.rfc, p.curp, p.nombre 
				FROM ficales c 
				JOIN clientes p ON c.curp = p.curp";
		return ejecutarConsulta($sql);
	}
	public function precioArmazon($id_armazon){
			$sql = "SELECT precio_venta FROM armazon WHERE id_armazon = '$id_armazon' LiMIT 1";        
			return ejecutarConsultaSimpleFila($sql);
		}
	/*
	//Implementamos un método para anular la venta
	public function anular($idventa)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idventa)
	{
		$sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha,v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idventa)
	{
		$sql="SELECT dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta,dv.descuento,(dv.cantidad*dv.precio_venta-dv.descuento) as subtotal FROM detalle_venta dv inner join articulo a on dv.idarticulo=a.idarticulo where dv.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

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
<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Armazon
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($modelo,$precio_compra,$precio_venta,$stock)
	{
		$sql="INSERT INTO armazon (modelo, precio_compra, precio_venta, stock)
		VALUES ('$modelo','$precio_compra','$precio_venta','$stock')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_armazon,$modelo,$precio_compra,$precio_venta,$stock)
	{
		$sql="UPDATE armazon SET modelo='$modelo', precio_compra='$precio_compra', precio_venta='$precio_venta', stock='$stock' WHERE id_armazon='$id_armazon'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($curp)
	{
		$sql="UPDATE clientes SET condicion='0' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}
	public function eliminar($id_armazon)
	{
		$sql="DELETE FROM armazon WHERE id_armazon = '$id_armazon'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para activar categorías
	public function activar($curp)
	{
		$sql="UPDATE clientes SET condicion='1' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_armazon)
	{
		$sql="SELECT * FROM armazon WHERE id_armazon='$id_armazon'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM armazon";
		return ejecutarConsulta($sql);		
	}
}

?>
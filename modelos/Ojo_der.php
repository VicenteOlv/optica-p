<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ojo_der
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($esferico_der,$cilindrico_der,$eje_der,$add_der,$altura_oblea_der,$av_der,$id_historia)
	{
		$sql="INSERT INTO ojo_der (esferico_der,cilindrico_der,eje_der,add_der,prisma,altura_oblea_der,av_der,id_historia)
		VALUES ('$esferico_der','$cilindrico_der','$eje_der','$add_der','$altura_oblea_der','$av_der','$id_historia')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_ojo_der,$esferico_der,$cilindrico_der,$eje_der,$add_der,$altura_oblea_der,$av_der,$id_historia)
	{
		$sql="UPDATE ojo_der SET esferico_der='$esferico_der', cilindrico_der='$cilindrico_der', eje_der='$eje_der', add_der='$add_der', altura_oblea_der='$altura_oblea_der', av_der='$av_der', id_historia='$id_historia' WHERE id_ojo_der='$id_ojo_der'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($curp)
	{
		$sql="UPDATE ojo_der SET condicion='0' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}
	public function eliminar($id_ojo_der)
	{
		$sql="DELETE FROM ojo_der WHERE id_ojo_der = '$id_ojo_der'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para activar categorías
	public function activar($curp)
	{
		$sql="UPDATE ojo_der SET condicion='1' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_ojo_der)
	{
		$sql="SELECT * FROM ojo_der WHERE id_ojo_der='$id_ojo_der'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function existe($id_ojo_der)
	{
		$sql="SELECT * FROM ojo_der WHERE id_ojo_der='$id_ojo_der'";
		$result = ejecutarConsulta($sql);
        return $result->num_rows > 0;
	}
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM ojo_der";
		return ejecutarConsulta($sql);		
	}

	public function mostrarID($id_historia)
	{
		$sql="SELECT id_ojo_der FROM ojo_der WHERE id_historia='$id_historia'";
		return ejecutarConsultaSimpleFila($sql);
	}
	
}

?>
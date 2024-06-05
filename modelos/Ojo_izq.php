<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ojo_izq
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($esferico_izq,$cilindrico_izq,$eje_izq,$add_izq,$prisma_izq,$altura_oblea_izq,$av_izq,$id_historia)
	{
		$sql="INSERT INTO ojo_izq (esferico_izq,cilindrico_izq,eje_izq,add_izq,prisma_izq,altura_oblea_izq,av_izq,id_historia)
		VALUES ('$esferico_izq','$cilindrico_izq','$eje_izq','$add_izq','$prisma_izq','$altura_oblea_izq','$av_izq','$id_historia')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_ojo_izq,$esferico_izq,$cilindrico_izq,$eje_izq,$add_izq,$prisma_izq,$altura_oblea_izq,$av_izq,$id_historia)
	{
		$sql="UPDATE ojo_izq SET esferico_izq='$esferico_izq', cilindrico_izq='$cilindrico_izq', eje_izq='$eje_izq', add_izq='$add_izq',prisma_izq='$prisma_izq',altura_oblea_izq='$altura_oblea_izq', av_izq='$av_izq', id_historia='$id_historia' WHERE id_ojo_izq='$id_ojo_izq'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($curp)
	{
		$sql="UPDATE ojo_izq SET condicion='0' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}
	public function eliminar($id_ojo_izq)
	{
		$sql="DELETE FROM ojo_izq WHERE id_ojo_izq = '$id_ojo_izq'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para activar categorías
	public function activar($curp)
	{
		$sql="UPDATE ojo_izq SET condicion='1' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_historia)
	{
		$sql="SELECT * FROM ojo_izq WHERE id_historia='$id_historia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function existe($id_ojo_izq)
	{
		$sql="SELECT * FROM ojo_izq WHERE id_ojo_izq='$id_ojo_izq'";
		$result = ejecutarConsulta($sql);
        return $result->num_rows > 0;
	}
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM ojo_izq";
		return ejecutarConsulta($sql);		
	}

	public function mostrarID($id_historia)
	{
		$sql="SELECT id_ojo_izq FROM ojo_izq WHERE id_historia='$id_historia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function ultimo(){
        $sql = "SELECT id_historia FROM historia_clinicas ORDER BY id_historia DESC LIMIT 1";        
        return ejecutarConsultaSimpleFila($sql);
    }
}

?>
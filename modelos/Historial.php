<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Historial
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($fecha,$curp,$observaciones)
	{
		$sql="INSERT INTO historia_clinicas (fecha,curp,observaciones)
		VALUES ('$fecha','$curp','$observaciones')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_historia,$fecha,$curp,$observaciones)
	{
		$sql="UPDATE historia_clinicas SET fecha='$fecha', curp='$curp', observaciones='$observaciones' WHERE id_historia='$id_historia'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($id_historia)
	{	
		$sql = "DELETE FROM ojo_izq WHERE id_historia = '$id_historia'";
		ejecutarConsulta($sql);
		$sql = "DELETE FROM ojo_der WHERE id_historia = '$id_historia'";
		ejecutarConsulta($sql);
        //Probablemente se tendrá que eliminar primero los estudios de los ojos
		$sql="DELETE FROM historia_clinicas WHERE id_historia = '$id_historia'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para activar categorías
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_historia)
	{
		$sql="SELECT * FROM historia_clinicas WHERE id_historia='$id_historia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function existe($rfc)
	{
		$sql="SELECT * FROM historia_clinicas WHERE rfc='$rfc'";
		$result = ejecutarConsulta($sql);
        return $result->num_rows > 0;
	}
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM historia_clinicas";
		return ejecutarConsulta($sql);		
	}
    public function obtenerCurps(){
        $sql = "SELECT curp FROM clientes";
        return ejecutarConsulta($sql);
    }
    public function ultimo(){
        $sql = "SELECT id_historia FROM historia_clinicas ORDER BY id_historia DESC LIMIT 1";        
        return ejecutarConsultaSimpleFila($sql);
    }
}

?>
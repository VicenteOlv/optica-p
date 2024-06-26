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
	public function insertar($fecha,$curp,$observaciones,$editado_por)
	{
		$sql="INSERT INTO historia_clinicas (fecha,curp,observaciones,editado_por, fecha_actualizado)
		VALUES ('$fecha','$curp','$observaciones','$editado_por', CURRENT_TIMESTAMP)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_historia,$fecha,$curp,$observaciones,$editado_por)
	{
		$sql="UPDATE historia_clinicas SET fecha='$fecha', curp='$curp', observaciones='$observaciones', editado_por='$editado_por', 
			fecha_actualizado=CURRENT_TIMESTAMP WHERE id_historia='$id_historia'";
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
		$sql = "SELECT historia_clinicas.*, usuarios.nombre as editado_por 
        FROM historia_clinicas 
        LEFT JOIN usuarios ON historia_clinicas.editado_por = usuarios.idusuario";
		return ejecutarConsulta($sql);		
	}
	public function listarCurp($rfc)
	{
		$sql_curp = "SELECT c.curp as curp
					FROM clientes c
					JOIN fiscales ON c.curp = fiscales.curp
					WHERE fiscales.rfc = '$rfc' LIMIT 1";
		$curp_result = ejecutarConsultaSimpleFila($sql_curp);
		echo $rfc;
		var_dump($curp_result);
		// Suponiendo que $curp_result contiene el array que muestras
		$curp = $curp_result['curp'];

		// Ahora puedes hacer lo que quieras con el valor de la CURP
		echo "La CURP del cliente es: " . $curp;

		$sql = "SELECT id_historia, fecha
        		FROM historia_clinicas 
        		WHERE curp = '$curp'";
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
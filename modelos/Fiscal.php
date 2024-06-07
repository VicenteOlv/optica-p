<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Fiscal
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($rfc,$regimen,$curp, $editado_por)
	{
		$sql="INSERT INTO fiscales (rfc,regimen,curp, editado_por, fecha_actualizado)
		VALUES ('$rfc','$regimen','$curp', '$editado_por', CURRENT_TIMESTAMP)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($rfc,$regimen,$curp, $editado_por)
	{
		$sql="UPDATE fiscales SET regimen='$regimen', curp='$curp', editado_por='$editado_por', 
				fecha_actualizado=CURRENT_TIMESTAMP WHERE rfc='$rfc'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($curp)
	{
		$sql="UPDATE fiscales SET condicion='0' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}
	public function eliminar($rfc)
	{
		$sql="DELETE FROM fiscales WHERE rfc = '$rfc'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para activar categorías
	public function activar($curp)
	{
		$sql="UPDATE fiscales SET condicion='1' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($rfc)
	{
		$sql="SELECT * FROM fiscales WHERE rfc='$rfc'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function existe($rfc)
	{
		$sql="SELECT * FROM fiscales WHERE rfc='$rfc'";
		$result = ejecutarConsulta($sql);
        return $result->num_rows > 0;
	}
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT fiscales.*, usuarios.nombre as editado_por 
        FROM fiscales 
        LEFT JOIN usuarios ON fiscales.editado_por = usuarios.idusuario";
		return ejecutarConsulta($sql);		
	}
    public function obtenerCurps(){
        $sql = "SELECT curp FROM clientes";
        return ejecutarConsulta($sql);
    }
}

?>
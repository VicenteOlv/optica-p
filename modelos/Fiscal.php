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
	public function insertar($rfc,$regimen,$curp)
	{
		$sql="INSERT INTO fiscales (rfc,regimen,curp)
		VALUES ('$rfc','$regimen','$curp')";
		return ejecutarConsulta($sql);
	}
	public function listarN()
	{
		$sql = "SELECT c.rfc, p.curp, p.nombre_completo 
				FROM fiscales c 
				JOIN clientes p ON c.curp = p.curp";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($rfc,$regimen,$curp)
	{
		$sql="UPDATE fiscales SET regimen='$regimen', curp='$curp' WHERE rfc='$rfc'";
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
		$sql="SELECT * FROM fiscales";
		return ejecutarConsulta($sql);		
	}
    public function obtenerCurps(){
        $sql = "SELECT curp FROM clientes";
        return ejecutarConsulta($sql);
    }
}

?>
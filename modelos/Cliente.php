<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cliente
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($curp,$nombre,$telefono,$celular,$email,$fecha,$direccion, $editado_por)
	{
		$sql="INSERT INTO clientes (curp,nombre_completo,telefono,celular,email,fecha_nacimiento,direccion, editado_por, fecha_actualizado)
		VALUES ('$curp','$nombre','$telefono','$celular','$email','$fecha','$direccion', '$editado_por', CURRENT_TIMESTAMP)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($curp,$nombre,$telefono,$celular,$email,$fecha,$direccion, $editado_por)
	{
		$sql="UPDATE clientes SET nombre_completo='$nombre', telefono='$telefono', celular='$celular', email='$email', fecha_nacimiento='$fecha', direccion='$direccion', editado_por='$editado_por', 
				fecha_actualizado=CURRENT_TIMESTAMP  WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($curp)
	{
		$sql="UPDATE clientes SET condicion='0' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}
	public function eliminar($curp)
	{
		$sql="DELETE FROM clientes WHERE curp = '$curp'";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para activar categorías
	public function activar($curp)
	{
		$sql="UPDATE clientes SET condicion='1' WHERE curp='$curp'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($curp)
	{
		$sql="SELECT * FROM clientes WHERE curp='$curp'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function existe($curp)
	{
		$sql="SELECT * FROM clientes WHERE curp='$curp'";
		$result = ejecutarConsulta($sql);
        return $result->num_rows > 0;
	}
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT clientes.*, usuarios.nombre as editado_por 
        FROM clientes 
        LEFT JOIN usuarios ON clientes.editado_por = usuarios.idusuario";
		return ejecutarConsulta($sql);		
	}
}

?>
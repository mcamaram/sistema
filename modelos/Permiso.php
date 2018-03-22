<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Permiso
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="select * from permiso";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para listar los registros
	public function listar_permisos_x_modulo($idmodulo)
	{
		$sql="CALL sp_get_permisos_by_modulo_id('".$idmodulo."')";
		return ejecutarConsulta($sql);
	}

}

?>

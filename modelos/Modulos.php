<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Modulos
{
	//Implementamos nuestro constructor
	public function __construct()
	{
     
	}

	//Implementamos un método para insertar registros
	public function insertar($codmodulo,$modulo,$descripcion)
	{
		$sql="CALL sp_insert_module('".$codmodulo."','".$modulo."','".$descripcion."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idmodulo,$codmodulo,$modulo,$descripcion)
	{
		$sql="CALL sp_update_module(".$idmodulo.",'".$codmodulo."','".$modulo."','".$descripcion."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idmodulo)
	{
		$sql="CALL sp_deactivate_module(".$idmodulo.")";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idmodulo)
	{
		$sql="CALL sp_activate_module(".$idmodulo.")";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmodulo)
	{
		$sql="CALL sp_list_modules_by_id(".$idmodulo.")";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="CALL sp_list_all_module()";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="CALL sp_list_modules_activated()";
		return ejecutarConsulta($sql);		
	}
}

?>
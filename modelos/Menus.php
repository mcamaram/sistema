<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Menus
{
	//Implementamos nuestro constructor
	public function __construct()
	{
     
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="CALL sp_insertar_cargo('".$nombre."','".$descripcion."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcargo,$nombre,$descripcion)
	{
		$sql="CALL sp_update_charge(".$idcargo.",'".$nombre."','".$descripcion."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcargo)
	{
		$sql="CALL sp_deactivate_charge(".$idcargo.")";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idcargo)
	{
		$sql="CALL sp_activate_charge(".$idcargo.")";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmenu)
	{
		$sql="CALL sp_get_charge_by_id(".$idmenu.")";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="CALL sp_get_all_menus()";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="CALL sp_get_all_menus_activated()";
		return ejecutarConsulta($sql);		
	}
}

?>
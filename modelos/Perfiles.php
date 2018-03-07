<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Perfiles
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($codperfil,$perfil,$descripcion,$destino)
	{
		$sql="CALL sp_insert_profile('".$codperfil."','".$perfil."','".$descripcion."')";
		$idperfilnew= ejecutarConsulta_retornarID($sql);
		//sentencia para insertar en la tabla perfil_modulo

	}

	//Implementamos un método para editar registros
	public function editar($idperfil,$codperfil,$perfil,$descripcion)
	{
		$sql="CALL sp_update_profile(".$idperfil.",'".$codperfil."','".$perfil."','".$descripcion."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idperfil)
	{
		$sql="CALL sp_deactivate_profile(".$idperfil.")";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idperfil)
	{
		$sql="CALL sp_activate_profile(".$idperfil.")";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idperfil)
	{
		$sql="CALL sp_get_profile_by_id(".$idperfil.")";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="CALL sp_get_all_profiles()";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="CALL sp_get_profiles_activated()";
		return ejecutarConsulta($sql);
	}
}

?>

<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Departamento
{
	//Implementamos nuestro constructor
	public function __construct()
	{
     
	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion,$presupuesto_anual)
	{
		$sql="CALL sp_insert_departament('".$nombre."','".$descripcion."','".$presupuesto_anual."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($iddepartamento,$nombre,$descripcion,$presupuesto_anual)
	{
		$sql="CALL sp_update_departament(".$iddepartamento.",'".$nombre."','".$descripcion."','".$presupuesto_anual."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($iddepartamento)
	{
		$sql="CALL sp_deactivate_departament(".$iddepartamento.")";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($iddepartamento)
	{
		$sql="CALL sp_activate_departament(".$iddepartamento.")";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($iddepartamento)
	{
		$sql="CALL sp_get_departament_by_id(".$iddepartamento.")";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="CALL sp_get_all_departament()";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="CALL sp_get_all_departament_activated()";
		return ejecutarConsulta($sql);		
	}
}

?>
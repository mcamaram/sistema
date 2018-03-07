<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Campus
{
	
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$direccion,$ciudad,$colonia,$codigo_postal,$estado,$pais,$telefono,$email)
	{
		$sql="CALL sp_insert_campus('".$nombre."','".$direccion."','".$ciudad."','".$colonia."','".$codigo_postal."','".$estado."','".$pais."',
		'".$telefono."','".$email."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcampus,$nombre,$direccion,$ciudad,$colonia,$codigo_postal,$estado,$pais,$telefono,$email)
	{
		$sql= "CALL sp_update_campus(".$idcampus.",'".$nombre."','".$direccion."','".$ciudad."','".$colonia."','".$codigo_postal."','".$estado."','".$pais."','".$telefono."','".$email."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idarticulo)
	{
		$sql="CALL sp_deactivate_article(".$idarticulo.")";
		return ejecutarConsulta($sql);
	}

	
	//Implementamos un método para eliminar categorías
	public function eliminar($idcampus)
	{
		$sql="CALL sp_delete_campus(".$idcampus.")";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcampus)
	{
		$sql="CALL sp_get_campus_by_id(".$idcampus.")";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="CALL sp_get_all_campus()";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros 
	public function listarc()
	{
		$sql="SELECT * FROM persona WHERE tipo_persona='Cliente'";
		return ejecutarConsulta($sql);		
	}
}

?>

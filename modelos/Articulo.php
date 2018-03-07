<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Articulo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idcategoria,$idcampus,$codigo,$nombre,$descripcion,$manufactory,$modelo,$stock,$costo,$p_venta,$numero_serie,$ubicacion,$imagen)
	{
		$sql="CALL sp_insert_article(".$idcategoria.",".$idcampus.",'".$codigo."','".$nombre."','".$descripcion."','".$manufactory."',
		'".$modelo."',".$stock.",".$costo.",".$p_venta.",'".$numero_serie."','".$ubicacion."','".$imagen."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idarticulo,$idcategoria,$idcampus,$codigo,$nombre,$descripcion,$manufactory,$modelo,$stock,$costo,$p_venta,$numero_serie,$ubicacion,$imagen)
	{
		$sql= "CALL sp_update_article(".$idarticulo.",".$idcategoria.",".$idcampus.",'".$codigo."','".$nombre."','".$descripcion."','".$manufactory."','".$modelo."',".$stock.",".$costo.",".$p_venta.",'".$numero_serie."','".$ubicacion."','".$imagen."')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idarticulo)
	{
		$sql="CALL sp_deactivate_article(".$idarticulo.")";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql="CALL sp_activate_article(".$idarticulo.")";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idarticulo)
	{
		$sql="CALL sp_get_article_by_id(".$idarticulo.")";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="CALL sp_get_all_article()";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="CALL sp_get_all_article_activated()";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosVenta()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}
}

?>
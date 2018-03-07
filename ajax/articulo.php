<?php 
require_once "../modelos/Articulo.php";

$articulo=new Articulo();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$idcampus =isset($_POST["idcampus"])? limpiarCadena($_POST["idcampus"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$manufactory=isset($_POST["manufactory"])? limpiarCadena($_POST["manufactory"]):"";
$modelo=isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$costo=isset($_POST["costo"])? limpiarCadena($_POST["costo"]):"";
$p_venta=isset($_POST["precio_venta"])? limpiarCadena($_POST["precio_venta"]):"";
$numero_serie=isset($_POST["numero_serie"])? limpiarCadena($_POST["numero_serie"]):"";
$ubicacion=isset($_POST["localizacion"])? limpiarCadena($_POST["localizacion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $imagen);
			}
		}
		if (empty($idarticulo)){
			$rspta=$articulo->insertar($idcategoria,$idcampus,$codigo,$nombre,$descripcion,$manufactory,$modelo,$stock,$costo,$p_venta,$numero_serie,$ubicacion,$imagen);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else 
		{
			$rspta=$articulo->editar($idarticulo,$idcategoria,$idcampus,$codigo,$nombre,$descripcion,$manufactory,$modelo,$stock,$costo,$p_venta,$numero_serie,$ubicacion,$imagen);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($idarticulo);
 		echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$articulo->activar($idarticulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idarticulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button  class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button  class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>':
 					'<button  class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button  class="btn btn-primary btn-xs" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->campus,
 				"4"=>$reg->codigo,
 				"5"=>$reg->descripcion,
 				"6"=>$reg->manufactory,
 				"7"=>$reg->modelo,
 				"8"=>$reg->stock,
 				"9"=>$reg->p_costo,
 				"10"=>$reg->p_venta,
 				"11"=>$reg->numero_serie,
 				"12"=>$reg->ubicacion,
 				"13"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
 				"14"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'selectCategoria':
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
				break;

	case "selectCampus":
		require_once "../modelos/Campus.php";
		$campus = new Campus();

		$rspta = $campus->listar();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcampus . '>' . $reg->nombre . '</option>';
				}
				break;
				
	
}
?>
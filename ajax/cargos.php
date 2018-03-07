<?php 
require_once "../modelos/Cargos.php";

$cargos = new Cargos();

$idcargo=isset($_POST["idcargo"])? limpiarCadena($_POST["idcargo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcargo)){
			$rspta=$cargos->insertar($nombre,$descripcion);
			echo $rspta ? "cargo registrado" : "cargo no se pudo registrar";
		}
		else {
			$rspta=$cargos->editar($idcargo,$nombre,$descripcion);
			echo $rspta ? "cargo actualizado" : "cargo no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$cargos->desactivar($idcargo);
 		echo $rspta ? "cargo Desactivado" : "cargo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$cargos->activar($idcargo);
 		echo $rspta ? "cargo activado" : "cargo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$cargos->mostrar($idcargo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cargos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->status)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcargo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idcargo.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcargo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idcargo.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
 				"3"=>($reg->status)?'<span class="label bg-green">Activado</span>':
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
}
?>
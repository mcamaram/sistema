<?php
require_once "../modelos/Modulos.php";

$modulos = new Modulos();

$idmodulo=isset($_POST["idmodulo"])? limpiarCadena($_POST["idmodulo"]):"";
$codmodulo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$modulo=isset($_POST["modulo"])? limpiarCadena($_POST["modulo"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idmodulo)){
			$rspta=$modulos->insertar($codmodulo,$modulo,$descripcion);
			echo $rspta ? "Modulo registrado correctamente!!" : "Modulo no se pudo registrar";
		}
		else {
			$rspta=$modulos->editar($idmodulo,$codmodulo,$modulo,$descripcion);
			echo $rspta ? "Modulo actualizado correctamente!!" : "Modulo no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$modulos->desactivar($idmodulo);
 		echo $rspta ? "Modulo desactivado correctamente!!" : "Modulo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$modulos->activar($idmodulo);
 		echo $rspta ? "Modulo activado correctamente!!" : "Modulo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$modulos->mostrar($idmodulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$modulos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->status)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idmodulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idmodulo.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idmodulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idmodulo.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->codmodulo,
 				"2"=>$reg->modulo,
 				"3"=>$reg->descripcion,
 				"4"=>($reg->status)?'<span class="label bg-green">Activado</span>':
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

	case 'listar1':
		$rspta=$modulos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object())
 		{
 			//echo '<option value='.$reg->idmodulo.'>'.$reg->modulo.'</option>';
			echo '<li id="'.$reg->idmodulo.'" data-checkstate="unchecked">'.$reg->modulo.'</li>';

 		}


	break;
}

<?php 
require_once "../modelos/Perfiles.php";

$perfiles = new Perfiles();

$idperfil=isset($_POST["idperfil"])? limpiarCadena($_POST["idperfil"]):"";
$codperfil=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idperfil)){
			$rspta=$perfiles->insertar($codperfil,$nombre,$descripcion);
			echo $rspta ? "Perfil registrado correctamente!!" : "Perfil no se pudo registrar";
		}
		else {
			$rspta=$perfiles->editar($idperfil,$codperfil,$nombre,$descripcion);
			echo $rspta ? "Perfil actualizado correctamente!!" : "Perfil no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$perfiles->desactivar($idperfil);
 		echo $rspta ? "Perfil desactivado correctamente!!" : "Perfil no se puede desactivar";
	break;

	case 'activar':
		$rspta=$perfiles->activar($idperfil);
 		echo $rspta ? "Perfil activado correctamente!!" : "Perfil no se puede activar";
	break;

	case 'mostrar':
		$rspta=$perfiles->mostrar($idperfiles);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$perfiles->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->status)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idperfil.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idperfil.')"><i class="fa fa-close"></i></button>'.'<span class="btn btn-primary btn-xs" onclick="">Asignar modulos al perfil</span>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idperfil.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->idperfil.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->codperfil,
 				"2"=>$reg->perfil,
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
}
?>
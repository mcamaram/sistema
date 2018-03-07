<?php 
require_once "../modelos/Departamento.php";

$departamento = new Departamento();

$iddepartamento=isset($_POST["iddepartamento"])? limpiarCadena($_POST["iddepartamento"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$presupuesto_anual=isset($_POST["presupuesto_anual"])? limpiarCadena($_POST["presupuesto_anual"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($iddepartamento)){
			$rspta=$departamento->insertar($nombre,$descripcion,$presupuesto_anual);
			echo $rspta ? "Departamento registrado" : "Departamento no se pudo registrar";
		}
		else {
			$rspta=$departamento->editar($iddepartamento,$nombre,$descripcion,$presupuesto_anual);
			echo $rspta ? "Departamento actualizado" : "Departamento no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$departamento->desactivar($iddepartamento);
 		echo $rspta ? "Departamento Desactivada" : "Departamento no se puede desactivar";
	break;

	case 'activar':
		$rspta=$departamento->activar($iddepartamento);
 		echo $rspta ? "Departamento activada" : "Departamento no se puede activar";
	break;

	case 'mostrar':
		$rspta=$departamento->mostrar($iddepartamento);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$departamento->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->status)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->iddepartamento.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->iddepartamento.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->iddepartamento.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary btn-xs" onclick="activar('.$reg->iddepartamento.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
 				"3"=>$reg->presupuesto_anual,
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
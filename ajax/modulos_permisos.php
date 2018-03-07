<?php 
require_once "../modelos/Modulos.php";
require_once "../modelos/Permiso.php";

$modulo = new Modulos();
$permiso = new Permiso();

$idcampus=isset($_POST["idcampus"])? limpiarCadena($_POST["idcampus"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$colonia=isset($_POST["direccion"])? limpiarCadena($_POST["colonia"]):"";
$codigo_postal =isset($_POST["codigo_postal"])? limpiarCadena($_POST["codigo_postal"]):"";
$estado =isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$pais=isset($_POST["pais"])? limpiarCadena($_POST["pais"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcampus)){
			$rspta= $campus->insertar($nombre,$direccion,$ciudad,$colonia,$codigo_postal,$estado,$pais,$telefono,$email);
			echo $rspta ? "Campus registrado correctamente" : "El campus no se pudo registrar";
		}
		else {
			$rspta=$campus->editar($idcampus,$nombre,$direccion,$ciudad,$colonia,$codigo_postal,$estado,$pais,$telefono,$email);
			echo $rspta ? "Campus actualizado correctamente" : "El campus no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$campus->eliminar($idcampus);
 		echo $rspta ? "Campus eliminado correctamente" : "El campus no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$campus->mostrar($idcampus);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar_permisos_x_modulo':
		$modulos=$modulo->listar();
		
		///----------------------------
        if(mysql_num_rows(modulos) > 0)
        {
           
            ///recorrer el array de modulos
 		    while ($reg=$modulos->fetch_object())
 		    {
 			  echo '<li id="'.$reg->idmodulo.'" data-checkstate="unchecked">'.$reg->modulo.'</li>';
 			  $permisos=$permiso->listar_permisos_x_modulo($reg->idmodulo);
 			  while ($reg1 = $permisos->fetch_object())
 			  {
 			  	echo '<ul><li id="'.$reg1->idpermiso.'" data-checkstate="unchecked">'.$reg->nombre.'</li></ul>';
 			  }
 		    }
 		    
 	    }
        

	break;

	case 'listarc':
		$rspta=$campus->listarc();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcampus.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->idcampus.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->direccion,
 				"3"=>$reg->ciudad,
 				"4"=>$reg->colonia,
 				"5"=>$reg->codigo_postal,
 				"6"=>$reg->estado,
 				"7"=>$reg->pais,
 				"8"=>$reg->telefono,
 				"9"=>$reg->email
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
<?php
require_once('../../../modelo/log.php');


$cadenaIniciada = false;


if ((isset($_GET['fechaFinal'])) && (isset($_GET['fechaInicio']))){
	$cadena ="'" . $_GET['fechaInicio'] . "'" . "< fecha and fecha < " . "'" . $_GET['fechaFinal']. "'"  ;
	$cadena .= " and (";
	$cadenaIniciada = true;
}


if (isset($_GET['operacionDelete'])){
	if ($_GET['operacionDelete'] == "Eliminado"){
		$cadena .= " operacion = 'Eliminado' or";
		$cadenaIniciada = true;
	}
}
if (isset($_GET['operacionInsert'])){
	if ($_GET['operacionInsert'] == "Insertado"){
		$cadena .=" operacion = 'Insertado' or";
		$cadenaIniciada = true;
	}
}
if (isset($_GET['operacionEdit'])){
	if ($_GET['operacionEdit'] == "Editado"){
		$cadena .=" operacion = 'Editado' or";
		$cadenaIniciada = true;
	}
}
if (isset($_GET['operacionSql'])){
	if ($_GET['operacionSql'] == "Consulta"){
		$cadena .=" operacion = 'Consulta' or";
		$cadenaIniciada = true;
	}
}
if ($cadenaIniciada ){
	$cadena .=  " operacion ='')";	
}else{
	$cadena = "1";
}

# Traer los datos de todos los usuarios
$log1 = new log();
$arraylog = $log1->Listar($cadena);
echo json_encode($arraylog);

?>
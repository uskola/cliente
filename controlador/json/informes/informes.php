<?php
require_once('../../../modelo/informes.php');


$cadenaIniciada = false;
$cadenaIniciada2 = false;

if ((isset($_GET['fechaFinal'])) && (isset($_GET['fechaInicio']))){
	$cadena ="'" . $_GET['fechaInicio'] . "'" . "< fecha and fecha < " . "'" . $_GET['fechaFinal']. "'"  ;
	$cadena .= " and (";
	$cadenaIniciada = true;
}



	if (isset($_GET['operacionAbierta'])){
		if ($_GET['operacionAbierta'] == "Abierta"){
			$cadena .= " proveedor = 0 or ";
			$cadenaIniciada = true;
			$cadenaIniciada2 = true;
		}
	}
	if (isset($_GET['operacionCerrada'])){
		if ($_GET['operacionCerrada'] == "Cerrada"){
			$cadena .=" proveedor > 0 or ";
			$cadenaIniciada = true;
			$cadenaIniciada2 = true;
		}
	}


if ($cadenaIniciada ){
	if ($cadenaIniciada2 ){
		$cadena .=  " proveedor ='')";
	}else{
		$cadena .=  " proveedor < 999999999  )";	
	}
}else{
	$cadena = "1";
}

# Traer los datos de todos los usuarios
$informe1 = new Informe();
$arraylog = $informe1->Listar($cadena);
echo json_encode($arraylog);

?>
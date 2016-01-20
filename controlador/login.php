<?php
	error_reporting (E_ALL);
	include_once "carga.php";

if (isset($_GET['desconectar'])){
	$Sesion->Desconectar();
	
}
	
if ($_POST['usuario'] && $_POST['pass'] ){

	if ($Sesion->GetLogin($_POST['usuario'], $_POST['pass'])){
		$Sesion->CambiarSesion($_POST['usuario']);
		$user = $Sesion->usuario;
		$sesion = $Sesion->sesion;
		$Sesion->SetSession($sesion, $user);
	}else {

	}
}
	
	header('Location: index.php'); 
?>


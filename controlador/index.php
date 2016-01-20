<?php

	$paginaInicio = " navbar-default ";
	include_once "carga.php";
	$Sesion->CheckSesion();
	
	if (!isset($_SESSION["usuario"])){
		include_once "vista/indexof.php";
	}else{
		include_once "vista/indexon.php";	
	}
	
?>








	
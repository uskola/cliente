<?php
	$paginaUsuarios = " navbar-default ";
	include_once "carga.php";
	$Sesion->CheckSesion();
	include_once "vista/usuario.php";	
	if ((int)$Sesion->usuarios ==0){header('Location: index.php'); }
?>

<?php
error_reporting (E_ALL);
include_once "carga.php";
//require_once('class/usuarios_model.php');
include_once "controlador/sesiones.php";

$Sesion -> GetLoginSesion($Sesion->usuario, $Sesion->sesion);
//echo "<br>" . $usuario1->usuarios . "<br>";	

?>

	 <a href="index.php" class="navbar-brand <?php if (isset($paginaInicio)) echo $paginaInicio;?>">
		<i class="glyphicon glyphicon-home"></i>
		<span class="heading-font">Inicio</span>
	</a>
	
<?php if ($Sesion->clientes > 10){ ?>
	 <a href="#" class="navbar-brand <?php  if (isset($paginaClientes)) echo $paginaClientes;?>">
		<i class="glyphicon glyphicon-tower"></i>
		<span class="heading-font">Clientes</span>
	</a>
<?php } ?>



<?php if ($Sesion->proveedores){ ?>
	 <a href="proveedores.php" class="navbar-brand <?php if (isset($paginaProveedores)) echo $paginaProveedores ;?>">
		<i class="glyphicon glyphicon-copyright-mark"></i>
		<span class="heading-font">Proveedores</span>
	</a>
	<?php } ?>
<?php if ($Sesion->proveedores){ ?>
	 <a href="productoproveedor.php" class="navbar-brand <?php  if (isset($paginaProveedoresProducto)) echo $paginaProveedoresProducto;?>">
		<i class="glyphicon glyphicon-copyright-mark"></i>
		<span class="heading-font">P/P</span>
	</a>
	<?php } ?>
<?php if ($Sesion->productos){ ?>
	 <a href="productos.php" class="navbar-brand <?php  if (isset($paginaProductos)) echo $paginaProductos;?>">
		<i class="glyphicon glyphicon-barcode"></i>
		<span class="heading-font">Productos</span>
	</a>
	<?php } ?>
<?php if ($Sesion->usuarios){ ?>
	<a href="usuario.php" class="navbar-brand <?php  if (isset($paginaUsuarios)) echo $paginaUsuarios ;?>">
		<i class="glyphicon glyphicon-user"></i>
		<span class="heading-font">Usuarios</span>
	</a>
	<?php } ?>
<?php if ($Sesion->pedidos){ ?>
	 <a href="pedidos.php" class="navbar-brand <?php  if (isset($paginaPedidos))  echo $paginaPedidos;?>">
		<i class="glyphicon glyphicon-shopping-cart"></i>
		<span class="heading-font">Pedidos</span>
	</a>
	<?php } ?>
<?php if ($Sesion->logs){ ?>
	 <a href="informes.php" class="navbar-brand <?php  if (isset($paginaInformes)) echo $paginaInformes;?>">
		<i class="glyphicon glyphicon-flag"></i>
		<span class="heading-font">Informes</span>
	</a>
	<?php } ?>
<?php if ($Sesion->logs){ ?>
	 <a href="log.php" class="navbar-brand <?php  if (isset($paginaLogs)) echo $paginaLogs;?>">
		<i class="glyphicon glyphicon-list-alt"></i>
		<span class="heading-font">Logs</span>
	</a>
	<?php } ?>

	

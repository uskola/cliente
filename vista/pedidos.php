<!DOCTYPE html>
<html ng-app="Pedidos">
<head>
    <title>Panel de Gestión - Pedidos</title>
    <meta charset="utf-8"> 

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	 <link rel="stylesheet" type="text/css" href="css/datepicker.css">

</head>
<body ng-controller="MainController">



    <div class="wrapper">
        
        <!-- Header -->
        <header class="header header-fixed navbar container-fluid">
            <div class="row">
                <div class="brand col-sm-3">
				<?php if (isset($_SESSION["usuario"])){
                   echo '<a href="login.php?desconectar=true" class="navbar-brand">
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="heading-font">'. $_SESSION["usuario"] . "</a></span>";
				}else{
					header('Location: index.php'); 
				}
				?>
                  
				</div>
        <?php
		include_once "cabecera.php";
		?>
		 </div>
        </header>
    
		
	
	
        <div class="box">
            <div class="row">
              
                <!-- sidebar -->
                <div class="column col-sm-3" id="sidebar">
                    <p class="nav-title">
                      Pedidos &nbsp;<input type="text" ng-model="hacer.filtro" id="hacer.filtro" name="filtro" >  <a ng-click="showWindow()" href="#" class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></a>
<br>
					<input type='checkbox' ng-click='setCurrentEstado("<?php echo $_SESSION["usuario"]; ?>")' ng-model="varpedidos.mio" ng-true-value="1" ng-false-value="0">Mios.
					<input type='checkbox' ng-click='setCurrentEstado("<?php echo $_SESSION["usuario"]; ?>")' ng-model="varpedidos.abiertos" ng-true-value="1" ng-false-value="0">Abiertos.
					<input type='checkbox' ng-click='setCurrentEstado("<?php echo $_SESSION["usuario"]; ?>")' ng-model="varpedidos.cerrados" ng-true-value="1" ng-false-value="0">cerrados.
            
					 <a href="#" class="pull-left"><i class="glyphicon glyphicon-search"></i></a>
					  </p>	
		
                      <ul class="nav">
                        <li ng-repeat="pedido in pedidos | filter:hacer.filtro" ng-class="{active: isCurrentPedido(pedido)}">
						<span ng-if="pedido.proveedor > 0">
							<a href="#" ng-click="setCurrentPedidoCerrado(pedido)"> <i class="glyphicon glyphicon-ok"></i> 
							{{pedido.nombre}}</a>
						</span>	
						<span ng-if="pedido.proveedor == 0">
							<a href="#" ng-click="eliminarPedido(pedido)"> <i class="glyphicon glyphicon-remove"></i></a> 
							&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" ng-click="setCurrentPedido(pedido)"> 
							{{pedido.nombre}}</a>
						</span>							

 
						</li>
						
						
						<br><b>Finalizar Pedido.</b><br>
					
                      <li ng-repeat="precio in listaprecios">
						<span ng-if="precio.masbarato > 0">
							<a href="#" ng-click="FinalizarPedido(precio.pedido, precio.proveedor_id, precio.precio, varpedidos.usuario)"><i class="glyphicon glyphicon-thumbs-up"></i> 
							{{precio.nombre}} - {{precio.precio}} €</a><br>
						</span>	
						<span ng-if="precio.masbarato == 0">
							<a href="#" ng-click="FinalizarPedido(precio.pedido, precio.proveedor_id, precio.precio, varpedidos.usuario)"><i class="glyphicon glyphicon-thumbs-down"></i> 
							{{precio.nombre}} - {{precio.precio}} €</a><br>
						</span>							

 
						</li>

					
						
						
                    </ul>
  
                    </p>


			</div>
                <!-- /sidebar -->
              
                <!-- main -->
                <div class="column col-sm-6" id="main">
                    <div class="padding">
                      <div class="full col-sm-9">
                        <br><br>
                          <!-- content -->
				<br>
				&nbsp;&nbsp; Filtro Productos&nbsp;<input type="text" ng-model="hacer.filtroproductos" id="hacer.filtroproductos" name="filtroproductos" >  
				 <a href="#" class="pull-left"><i class="glyphicon glyphicon-search"></i></a>
						<li ng-repeat="user in users | filter:hacer.filtroproductos" ng-class="{active: isCurrentProveedor(proveedor)}"> 
                  
						
                           {{user.nombre}}

						   </ul>
										
							  
							
			<form method="get" action="#" name="formulario">
			
			<span ng-if="user.precio == 0">
			<a ng-click="actualizar(user.idproducto, user.idpedido, user.cantidad); setCurrentPedido(user.idpedido)" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</a>						  
			<a ng-click="remove(user.idproducto, user.idpedido); setCurrentPedido(user.idpedido)" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
			</span>
			
              <div class="form-group" ng-class="{'has-error':registroForm.cantidad.$invalid && registroForm.cantidad.$dirty}">
                  <label for="nombre">{{nombre}}</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-bookmark"></i>
                    </div>
					<input type="hidden" name="id_producto" ng-value="user.id_producto" />
					<input type="hidden" name="id_proveedor" ng-value="user.id_proveedor" />
				
                    <input ng-model="user.cantidad"  required minlength="1" maxlength="50" name="cantidad" id="cantidad" class="form-control" type="text" placeholder="Introduzca la cantidad">
 
 	<span ng-if="user.precio > 0">
	Precio:
                    <input ng-model="user.precio" name="precio" id="precio" class="form-control" type="text" placeholder="Introduzca el precio">
	</span>

					<span ng-if="registroForm.cantidad.$invalid && registroForm.cantidad.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.cantidad.$invalid && registroForm.cantidad.$dirty" class="help-block">La cantidad es requerido.</span>
                </div>
				



				</form>
    					</li>		
	

						
									</ul>
                      </div><!-- /col-9 -->
                    </div><!-- /padding -->
                </div>
                <!-- /main -->
                <div class="column col-sm-3" id="main">
                  
                      
						<br><br><<br>
						
							<br>
				  <i class="glyphicon glyphicon-search"></i> Filtro Productos<input type="text" ng-model="hacer.filtronoproductos" id="hacer.filtronoproductos" name="filtronoproductos" >  
				 <a href="#" class="pull-left"></a>

                      <ul class="nav">
                        <li ng-repeat="nouser in nousers | filter:hacer.filtronoproductos" ng-class="{active: isCurrentProveedor(proveedor)}">
 <?php if ($Sesion->proveedores > 1){ ?>	
						<a ng-click="save(nouser.id, currentPedido); setCurrentPedidoId(currentPedido)" href="#" class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></a>
 <?php } ?> 
						<a href="#" ng-click="save(nouser.id, currentPedido); setCurrentPedidoId(currentPedido)"> <i class="glyphicon glyphicon-tags"></i> {{nouser.nombre}}</a>
                        </li>
                    </ul>
					
	
    </div>
			  
			  
            </div>
        </div>
    </div>

			


    <!-- Registro form -->
      <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel">Pedido</h4>
            </div>
            <div class="modal-body">
              
              <form name="registroForm" id="registroForm">
                <p>Rellene la ficha por favor.</p>

          
                <div class="form-group" ng-class="{'has-error':registroForm.nombre.$invalid && registroForm.nombre.$dirty}">
                  <label for="nombre">Referencia</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-bookmark"></i>
                    </div>
                    <input ng-model="registro.nombre"  required minlength="5" maxlength="50" name="nombre" id="nombre" class="form-control" type="text" placeholder="Introduzca la referencia">
                    <span ng-if="registroForm.nombre.$invalid && registroForm.nombre.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.nombre.$invalid && registroForm.nombre.$dirty" class="help-block">La referencia es requerida.</span>
                </div>
	
				
				</form>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button ng-click="CrearPedido(registro, '<?php echo $_SESSION["usuario"]; ?>')" type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </div>
        </div>
      </div>







    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/pedidos.js"></script>
	
 <script>
    $(document).ready(function(){
		angular.element(document.body).scope().setCurrentEstado("<?php echo $_SESSION["usuario"]; ?>");
	
    });
 
 </script>	
	
</body>
</html>
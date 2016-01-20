<!DOCTYPE html>
<html ng-app="ProductosProveedores">
<head>
    <title>Panel de Gestión - Productos - Proveedores</title>
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
                      Proveedores &nbsp;<input type="text" ng-model="hacer.filtro" id="hacer.filtro" name="filtro" >  

                  
 <?php if ($Sesion->proveedores > 1){ ?>	
					
 <?php } ?>
					 <a href="#" class="pull-left"><i class="glyphicon glyphicon-search"></i></a>
					  </p>	
		
                      <ul class="nav">
                        <li ng-repeat="proveedor in proveedores | filter:hacer.filtro" ng-class="{active: isCurrentProveedor(proveedor)}">
                            <a href="#" ng-click="setCurrentProveedor(proveedor)"> <i class="glyphicon glyphicon-tags"></i> {{proveedor.nombre}}</a>
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
				&nbsp;&nbsp; Filtro Productos Proveedor&nbsp;<input type="text" ng-model="hacer.filtroproductos" id="hacer.filtroproductos" name="filtroproductos" >  
				 <a href="#" class="pull-left"><i class="glyphicon glyphicon-search"></i></a>
						<li ng-repeat="user in users | filter:hacer.filtroproductos" ng-class="{active: isCurrentProveedor(proveedor)}"> 
                  
						
                           {{user.nombre}}

						   </ul>
										
							  
							
			<form method="get" action="#" name="formulario">
			  							
			<a ng-click="actualizar(user.id_producto, user.id_proveedor, user.precio);setCurrentProveedorId(currentProveedor)" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</a>						  
			<a ng-click="remove(user.id_producto, user.id_proveedor);setCurrentProveedorId(currentProveedor)" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>

              <div class="form-group" ng-class="{'has-error':registroForm.precio.$invalid && registroForm.precio.$dirty}">
                  <label for="nombre">{{nombre}}</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-bookmark"></i>
                    </div>
					<input type="hidden" name="id_producto" ng-value="user.id_producto" />
					<input type="hidden" name="id_proveedor" ng-value="user.id_proveedor" />
                    <input ng-model="user.precio"  required minlength="1" maxlength="50" name="precio" id="precio" class="form-control" type="text" placeholder="Introduzca el Precio">
                    <span ng-if="registroForm.precio.$invalid && registroForm.precio.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.precio.$invalid && registroForm.precio.$dirty" class="help-block">El precio es requerido.</span>
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
					<a ng-click="save(nouser.id_producto, proveedor); setCurrentProveedorId(currentProveedor)" href="#" class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></a>
 <?php } ?> 
						<a href="#" ng-click="save(nouser.id_producto, proveedor); setCurrentProveedorId(currentProveedor)"> <i class="glyphicon glyphicon-tags"></i> {{nouser.nombre}}</a>
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
              <h4 class="modal-title" id="myModalLabel">Proveedor</h4>
            </div>
            <div class="modal-body">
              
              <form name="registroForm" id="registroForm">
                <p>Rellene la ficha por favor.</p>

          
                <div class="form-group" ng-class="{'has-error':registroForm.nombre.$invalid && registroForm.nombre.$dirty}">
                  <label for="nombre">Nombre</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-bookmark"></i>
                    </div>
                    <input ng-model="registro.nombre"  required minlength="5" maxlength="50" name="nombre" id="nombre" class="form-control" type="text" placeholder="Introduzca el Nombre">
                    <span ng-if="registroForm.nombre.$invalid && registroForm.nombre.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.nombre.$invalid && registroForm.nombre.$dirty" class="help-block">El nombre es requerido.</span>
                </div>

                <div class="form-group" ng-class="{'has-error':registroForm.direccion.$invalid && registroForm.direccion.$touched}">
                  <label for="direccion">Dirección</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.direccion" required minlength="5" maxlength="50" name="direccion" id="direccion" class="form-control" type="text" placeholder="Introduzca la dirección">
                    <span ng-if="registroForm.direccion.$invalid && registroForm.direccion.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.direccion.$error.required && registroForm.direccion.$touched" class="help-block">La direccion es obligatoria</span>
                  <span ng-if="registroForm.direccion.$error.minlength && registroForm.direccion.$touched" class="help-block">La direccion es demasiado corta.</span>
                  <span ng-if="registroForm.direccion.$error.maxlength && registroForm.direccion.$touched" class="help-block">La direccion es demasiado larga.</span>
                </div>
                
                <div class="form-group" ng-class="{'has-error':registroForm.email.$invalid && registroForm.email.$touched}">
                  <label for="email">Email</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.email" required minlength="5" maxlength="50" name="email" id="email" class="form-control" type="text" placeholder="Introduzca el email">
                    <span ng-if="registroForm.email.$invalid && registroForm.email.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.email.$error.required && registroForm.email.$touched" class="help-block">El email es obligatorio.</span>
                  <span ng-if="registroForm.email.$error.minlength && registroForm.email.$touched" class="help-block">El email es demasiado corto.</span>
                  <span ng-if="registroForm.email.$error.maxlength && registroForm.email.$touched" class="help-block">El email es demasiado largo.</span>
                </div>

	               <div class="form-group" ng-class="{'has-error':registroForm.telefono.$invalid && registroForm.telefono.$touched}">
                  <label for="telefono">Telefono</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.telefono" required minlength="5" maxlength="50" name="telefono" id="telefono" class="form-control" type="text" placeholder="Introduzca el telefono">
                    <span ng-if="registroForm.telefono.$invalid && registroForm.telefono.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.telefono.$error.required && registroForm.telefono.$touched" class="help-block">El telefono es obligatorio</span>
                  <span ng-if="registroForm.telefono.$error.minlength && registroForm.telefono.$touched" class="help-block">El telefono es demasiado corto.</span>
                  <span ng-if="registroForm.telefono.$error.maxlength && registroForm.telefono.$touched" class="help-block">El telefono es demasiado largo.</span>
                </div>
                
                <div class="form-group" ng-class="{'has-error':registroForm.provincia.$invalid && registroForm.provincia.$touched}">
                  <label for="provincia">Provincia</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.provincia" required minlength="5" maxlength="50" name="provincia" id="provincia" class="form-control" type="text" placeholder="Introduzca la provincia">
                    <span ng-if="registroForm.provincia.$invalid && registroForm.provincia.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.provincia.$error.required && registroForm.provincia.$touched" class="help-block">La provincia es obligatoria.</span>
                  <span ng-if="registroForm.provincia.$error.minlength && registroForm.provincia.$touched" class="help-block">La provincia es demasiado corta.</span>
                  <span ng-if="registroForm.provincia.$error.maxlength && registroForm.provincia.$touched" class="help-block">La provincia es demasiado larga.</span>
                </div>
			
				
				</form>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button ng-click="save(registro)" type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </div>
        </div>
      </div>








	


    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/productosproveedores.js"></script>
</body>
</html>
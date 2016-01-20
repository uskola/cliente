
<!DOCTYPE html>
<html ng-app="Proveedores">
<head>
    <title>Panel de Gestión - Proveedores</title>
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
					<a ng-click="showWindow()" href="#" class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></a>
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
                <div class="column col-sm-9" id="main">
                    <div class="padding">
                      <div class="full col-sm-9">
                        <br><br>
                          <!-- content -->

				
						<li ng-repeat="proveedor in proveedores | filter: {id: currentProveedor}"> 
                  
						<h2>
                          Proveedor: {{currentProveedorNombre}} 
						  <?php if ($Sesion->proveedores > 1){ ?>
							<a ng-click="actualizar()" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar Cambios</a>						  
                          
							<a ng-click="remove()" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-trash"></i> Eliminar Proveedor</a>
						
							<ul>
						    
							<?php } ?>
						   </ul>
						  </h2> 				
							  
							
<form method="get" action="#" name="formulario">

              <div class="form-group" ng-class="{'has-error':formulario.nombre.$invalid && formulario.nombre.$dirty}">
                  <label for="nombre">Nombre</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-bookmark"></i>
                    </div>
                    <input ng-model="user.nombre"  required minlength="5" maxlength="50" name="nombre" id="nombre" class="form-control" type="text" placeholder="Introduzca el Nombre">
                    <span ng-if="formulario.nombre.$invalid && formulario.nombre.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.nombre.$invalid && formulario.nombre.$dirty" class="help-block">El nombre es requerido.</span>
                </div>

                <div class="form-group" ng-class="{'has-error':formulario.direccion.$invalid && formulario.direccion.$touched}">
                  <label for="nick">direccion</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.direccion" required minlength="5" maxlength="50" name="direccion" id="direccion" class="form-control" type="text" placeholder="Introduzca la dirección">
                    <span ng-if="formulario.direccion.$invalid && formulario.direccion.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.direccion.$error.required && formulario.direccion.$touched" class="help-block">La dirección es obligatoria</span>
                  <span ng-if="formulario.direccion.$error.minlength && formulario.direccion.$touched" class="help-block">La dirección es demasiado corta.</span>
                  <span ng-if="formulario.direccion.$error.maxlength && formulario.direccion.$touched" class="help-block">La dirección es demasiado largo.</span>
                </div>
                
                <div class="form-group" ng-class="{'has-error':formulario.email.$invalid && formulario.email.$touched}">
                  <label for="pass">E-mail</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.email" required minlength="5" maxlength="50" name="email" id="email" class="form-control" type="email" placeholder="Introduzca el email">
                    <span ng-if="formulario.email.$invalid && formulario.email.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.email.$error.required && formulario.email.$touched" class="help-block">El email es obligatorio.</span>
                  <span ng-if="formulario.email.$error.minlength && formulario.email.$touched" class="help-block">El email demasiado corto.</span>
                  <span ng-if="formulario.email.$error.maxlength && formulario.email.$touched" class="help-block">El email es demasiado largo.</span>
				  <span ng-if="formulario.email.$error.email && formulario.email.$touched" class="help-block">Formato email no valido.</span>
                </div>
                		 
                 <div class="form-group" ng-class="{'has-error':formulario.telefono.$invalid && formulario.telefono.$touched}">
                  <label for="pass">Telefono</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.telefono" min="0" mas="9999999999999" required  name="telefono"  id="telefono" class="form-control" type="number"  placeholder="Introduzca el telefono">
                    <span ng-if="formulario.telefono.$invalid && formulario.telefono.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.telefono.$error.required && formulario.telefono.$touched" class="help-block">El telefono es obligatorio.</span>
                  <span ng-if="formulario.telefono.$error.minlength && formulario.telefono.$touched" class="help-block">El telefono demasiado corto.</span>
                  <span ng-if="formulario.telefono.$error.maxlength && formulario.telefono.$touched" class="help-block">El telefono es demasiado largo.</span>
				<span ng-if="formulario.telefono.$error.number && formulario.telefono.$touched" class="help-block">El telefono solo acepta numeros.</span>							
				</div>
    							
		
                 <div class="form-group" ng-class="{'has-error':formulario.provincia.$invalid && formulario.provincia.$touched}">
                  <label for="pass">Provincia</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.provincia" required minlength="5" maxlength="50" name="provincia" id="provincia" class="form-control" type="text" placeholder="Introduzca la provincia">
                    <span ng-if="formulario.provincia.$invalid && formulario.provincia.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.provincia.$error.required && formulario.provincia.$touched" class="help-block">La provincia es obligatoria.</span>
                  <span ng-if="formulario.provincia.$error.minlength && formulario.provincia.$touched" class="help-block">La provincia demasiado corta.</span>
                  <span ng-if="formulario.provincia.$error.maxlength && formulario.provincia.$touched" class="help-block">La provincia es demasiado larga.</span>
                </div>
    							
	

						
									</ul>
                      </div><!-- /col-9 -->
                    </div><!-- /padding -->
                </div>
                <!-- /main -->
              
            </div>
        </div>
    </div>
 </form>
			


    <!-- Registro form -->
      <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h4 class="modal-title" id="myModalLabel">Proveedor</h4>
            </div>
            <div class="modal-body">
              
              <form name="formulario" id="formulario">
                <p>Rellene la ficha por favor.</p>

          
                <div class="form-group" ng-class="{'has-error':formulario.nombre.$invalid && formulario.nombre.$dirty}">
                  <label for="nombre">Nombre</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-bookmark"></i>
                    </div>
                    <input ng-model="registro.nombre"  required minlength="5" maxlength="50" name="nombre" id="nombre" class="form-control" type="text" placeholder="Introduzca el Nombre">
                    <span ng-if="formulario.nombre.$invalid && formulario.nombre.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.nombre.$invalid && formulario.nombre.$dirty" class="help-block">El nombre es requerido.</span>
                </div>

                <div class="form-group" ng-class="{'has-error':formulario.direccion.$invalid && formulario.direccion.$touched}">
                  <label for="direccion">Dirección</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.direccion" required minlength="5" maxlength="50" name="direccion" id="direccion" class="form-control" type="text" placeholder="Introduzca la dirección">
                    <span ng-if="formulario.direccion.$invalid && formulario.direccion.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.direccion.$error.required && formulario.direccion.$touched" class="help-block">La direccion es obligatoria</span>
                  <span ng-if="formulario.direccion.$error.minlength && formulario.direccion.$touched" class="help-block">La direccion es demasiado corta.</span>
                  <span ng-if="formulario.direccion.$error.maxlength && formulario.direccion.$touched" class="help-block">La direccion es demasiado larga.</span>
                </div>
                
                <div class="form-group" ng-class="{'has-error':formulario.email.$invalid && formulario.email.$touched}">
                  <label for="email">Email</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.email" required minlength="5" maxlength="50" name="email" id="email" class="form-control" type="text" placeholder="Introduzca el email">
                    <span ng-if="formulario.email.$invalid && formulario.email.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.email.$error.required && formulario.email.$touched" class="help-block">El email es obligatorio.</span>
                  <span ng-if="formulario.email.$error.minlength && formulario.email.$touched" class="help-block">El email es demasiado corto.</span>
                  <span ng-if="formulario.email.$error.maxlength && formulario.email.$touched" class="help-block">El email es demasiado largo.</span>
                </div>

	               <div class="form-group" ng-class="{'has-error':formulario.telefono.$invalid && formulario.telefono.$touched}">
                  <label for="telefono">Telefono</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.telefono" required minlength="5" maxlength="50" name="telefono" id="telefono" class="form-control" type="text" placeholder="Introduzca el telefono">
                    <span ng-if="formulario.telefono.$invalid && formulario.telefono.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.telefono.$error.required && formulario.telefono.$touched" class="help-block">El telefono es obligatorio</span>
                  <span ng-if="formulario.telefono.$error.minlength && formulario.telefono.$touched" class="help-block">El telefono es demasiado corto.</span>
                  <span ng-if="formulario.telefono.$error.maxlength && formulario.telefono.$touched" class="help-block">El telefono es demasiado largo.</span>
                </div>
                
                <div class="form-group" ng-class="{'has-error':formulario.provincia.$invalid && formulario.provincia.$touched}">
                  <label for="provincia">Provincia</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.provincia" required minlength="5" maxlength="50" name="provincia" id="provincia" class="form-control" type="text" placeholder="Introduzca la provincia">
                    <span ng-if="formulario.provincia.$invalid && formulario.provincia.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="formulario.provincia.$error.required && formulario.provincia.$touched" class="help-block">La provincia es obligatoria.</span>
                  <span ng-if="formulario.provincia.$error.minlength && formulario.provincia.$touched" class="help-block">La provincia es demasiado corta.</span>
                  <span ng-if="formulario.provincia.$error.maxlength && formulario.provincia.$touched" class="help-block">La provincia es demasiado larga.</span>
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
    <script type="text/javascript" src="js/proveedores.js"></script>
</body>
</html>
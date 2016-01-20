
<!DOCTYPE html>
<html ng-app="Productos">
<head>
    <title>Panel de Gestión - Productos</title>
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
                      Productos &nbsp;<input type="text" ng-model="hacer.filtro" id="hacer.filtro" name="filtro" >  

                  
 <?php if ($Sesion->productos > 1){ ?>	
					<a ng-click="showWindow()" href="#" class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></a>
 <?php } ?>
					 <a href="#" class="pull-left"><i class="glyphicon glyphicon-search"></i></a>
					  </p>	
		
                      <ul class="nav">
                        <li ng-repeat="producto in productos | filter:hacer.filtro" ng-class="{active: isCurrentProducto(producto)}">
                            <a href="#" ng-click="setCurrentProducto(producto)"> <i class="glyphicon glyphicon-tags"></i> {{producto.nombre}}</a>
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

				
						<li ng-repeat="producto in productos | filter: {id: currentProducto}"> 
                  
						<h2>
                          Producto: {{currentProductoNombre}} 
						  <?php if ($Sesion->productos > 1){ ?>
							<a ng-click="actualizar()" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar Cambios</a>						  
                          
							<a ng-click="remove()" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-trash"></i> Eliminar Producto</a>
						
							<ul>
						    
							<?php } ?>
						   </ul>
						  </h2> 				
							  
							
<form method="get" action="#" name="formulario">

              <div class="form-group" ng-class="{'has-error':registroForm.nombre.$invalid && registroForm.nombre.$dirty}">
                  <label for="nombre">Nombre</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-bookmark"></i>
                    </div>
                    <input ng-model="user.nombre"  required minlength="5" maxlength="50" name="nombre" id="nombre" class="form-control" type="text" placeholder="Introduzca el Nombre">
                    <span ng-if="registroForm.nombre.$invalid && registroForm.nombre.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.nombre.$invalid && registroForm.nombre.$dirty" class="help-block">El nombre es requerido.</span>
                </div>

                <div class="form-group" ng-class="{'has-error':registroForm.precio.$invalid && registroForm.precio.$touched}">
                  <label for="nick">Precio Venta</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.precio" required minlength="1" maxlength="50" name="precio" id="precio" class="form-control" type="text" placeholder="Introduzca el precio">
                    <span ng-if="registroForm.precio.$invalid && registroForm.precio.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.precio.$error.required && registroForm.precio.$touched" class="help-block">El precio es obligatorio.</span>
                  <span ng-if="registroForm.precio.$error.minlength && registroForm.precio.$touched" class="help-block">El precio es demasiado corto.</span>
                  <span ng-if="registroForm.precio.$error.maxlength && registroForm.precio.$touched" class="help-block">El precio es demasiado largo.</span>
                </div>
                
                <div class="form-group" ng-class="{'has-error':registroForm.stock.$invalid && registroForm.stock.$touched}">
                  <label for="pass">Stock</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.stock" required minlength="1" maxlength="50" name="stock" id="stock" class="form-control" type="text" placeholder="Introduzca el stock">
                    <span ng-if="registroForm.stock.$invalid && registroForm.stock.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.stock.$error.required && registroForm.stock.$touched" class="help-block">El stock es obligatorio.</span>
                  <span ng-if="registroForm.stock.$error.minlength && registroForm.stock.$touched" class="help-block">El stock demasiado corto.</span>
                  <span ng-if="registroForm.stock.$error.maxlength && registroForm.stock.$touched" class="help-block">El stock es demasiado largo.</span>
                </div>
    
			
                 <div class="form-group" ng-class="{'has-error':registroForm.stockminimo.$invalid && registroForm.stockminimo.$touched}">
                  <label for="pass">Stock Minimo</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.stockminimo" required minlength="1" maxlength="50" name="stockminimo" id="stockminimo" class="form-control" type="text" placeholder="Introduzca el stock minimo">
                    <span ng-if="registroForm.stockminimo.$invalid && registroForm.stockminimo.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.stockminimo.$error.required && registroForm.stockminimo.$touched" class="help-block">La stockminimo es obligatoria.</span>
                  <span ng-if="registroForm.stockminimo.$error.minlength && registroForm.stockminimo.$touched" class="help-block">La stockminimo demasiado corta.</span>
                  <span ng-if="registroForm.stockminimo.$error.maxlength && registroForm.stockminimo.$touched" class="help-block">La stockminimo es demasiado larga.</span>
                </div>
    					
                 <div class="form-group" ng-class="{'has-error':registroForm.imagen.$invalid && registroForm.imagen.$touched}">
                  <label for="pass">Imagen</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.imagen" required minlength="5" maxlength="250" name="imagen" id="imagen" class="form-control" type="text" placeholder="Introduzca la imagen">
                    <span ng-if="registroForm.imagen.$invalid && registroForm.imagen.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.imagen.$error.required && registroForm.imagen.$touched" class="help-block">La imagen es obligatoria.</span>
                  <span ng-if="registroForm.imagen.$error.minlength && registroForm.imagen.$touched" class="help-block">La imagen demasiado corta.</span>
                  <span ng-if="registroForm.imagen.$error.maxlength && registroForm.imagen.$touched" class="help-block">La imagen es demasiado larga.</span>
                </div>
    							
                 <div class="form-group" ng-class="{'has-error':registroForm.caracteristicas.$invalid && registroForm.caracteristicas.$touched}">
                  <label for="pass">Caracteristicas</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                   <textarea ng-model="user.caracteristicas" required minlength="5" maxlength="50" name="caracteristicas" id="caracteristicas" class="form-control" type="text" placeholder="Introduzca la caracteristica"></textarea>
                    <span ng-if="registroForm.caracteristicas.$invalid && registroForm.caracteristicas.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.caracteristicas.$error.required && registroForm.caracteristicas.$touched" class="help-block">La caracteristica es obligatoria.</span>
                  <span ng-if="registroForm.caracteristicas.$error.minlength && registroForm.caracteristicas.$touched" class="help-block">La caracteristica demasiado corta.</span>
                  <span ng-if="registroForm.caracteristicas.$error.maxlength && registroForm.caracteristicas.$touched" class="help-block">La caracteristica es demasiado larga.</span>
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
              <h4 class="modal-title" id="myModalLabel">Producto</h4>
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
                    <input ng-model="registro.nombre"  required minlength="3" maxlength="50" name="nombre" id="nombre" class="form-control" type="text" placeholder="Introduzca el Nombre">
                    <span ng-if="registroForm.nombre.$invalid && registroForm.nombre.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.nombre.$invalid && registroForm.nombre.$dirty" class="help-block">El nombre es requerido.</span>
                </div>

                <div class="form-group" ng-class="{'has-error':registroForm.precio.$invalid && registroForm.precio.$touched}">
                  <label for="precio">Precio</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.precio" required minlength="1" maxlength="50" name="precio" id="precio" class="form-control" type="text" placeholder="Introduzca el precio">
                    <span ng-if="registroForm.precio.$invalid && registroForm.precio.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.precio.$error.required && registroForm.precio.$touched" class="help-block">El precio es obligatorio</span>
                  <span ng-if="registroForm.precio.$error.minlength && registroForm.precio.$touched" class="help-block">El precio es demasiado corto.</span>
                  <span ng-if="registroForm.precio.$error.maxlength && registroForm.precio.$touched" class="help-block">El precio es demasiado largo.</span>
                </div>
                
                <div class="form-group" ng-class="{'has-error':registroForm.stock.$invalid && registroForm.stock.$touched}">
                  <label for="stock">Stock</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.stock" required minlength="1" maxlength="50" name="stock" id="stock" class="form-control" type="text" placeholder="Introduzca el stock">
                    <span ng-if="registroForm.stock.$invalid && registroForm.stock.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.stock.$error.required && registroForm.stock.$touched" class="help-block">El stock es obligatorio.</span>
                  <span ng-if="registroForm.stock.$error.minlength && registroForm.stock.$touched" class="help-block">El stock es demasiado corto.</span>
                  <span ng-if="registroForm.stock.$error.maxlength && registroForm.stock.$touched" class="help-block">El stock es demasiado largo.</span>
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
    <script type="text/javascript" src="js/productos.js"></script>
</body>
</html>
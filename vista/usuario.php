
<!DOCTYPE html>
<html ng-app="Permisos">
<head>
    <title>Panel de Gestión - Permisos de Usuarios</title>
    <meta charset="utf-8"> 

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
                      Usuario &nbsp;<input type="text" ng-model="hacer.filtro" id="hacer.filtro" name="filtro" >
                     
                  
 <?php if ($Sesion->usuarios > 1){ ?>	
					<a ng-click="showWindow()" href="#" class="pull-right"><i class="glyphicon glyphicon-plus-sign"></i></a>
 <?php } ?>
					 <a href="#" class="pull-left"><i class="glyphicon glyphicon-search"></i></a>
					  </p>	
		
 
                    <ul class="nav">
                        <li ng-repeat="categoria in categorias | filter:hacer.filtro" ng-class="{active: isCurrentCategoria(categoria)}">
                            <a href="#" ng-click="setCurrentCategoria(categoria)"> <i class="glyphicon glyphicon-tags"></i> {{categoria.nombre}}</a>
                        </li>
                    </ul>
  

			</div>
                <!-- /sidebar -->
              
                <!-- main -->
                <div class="column col-sm-9" id="main">
                    <div class="padding">
                      <div class="full col-sm-9">
                        <br> <br>   
                          <!-- content -->

				
						  <ul>
                           <li ng-repeat="categoria in categorias | filter: {id: currentCategoria}">
							<h2>
                          Permisos: {{currentCategoriaNombre}} 
						  <?php if ($Sesion->usuarios > 1){ ?>
							<a ng-click="actualizar()" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar Cambios</a>						  
                          
							<a ng-click="remove()" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-trash"></i> Eliminar Usuario</a>
						
							<ul>
						    
                          <?php } ?>
						   </ul>
						  </h2>
							  
							
<form method="get" action="index.php" name="formulario">

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

                <div class="form-group" ng-class="{'has-error':registroForm.nick.$invalid && registroForm.nick.$touched}">
                  <label for="nick">Nick</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.nick" required minlength="5" maxlength="50" name="nick" id="nick" class="form-control" type="text" placeholder="Introduzca el nick">
                    <span ng-if="registroForm.nick.$invalid && registroForm.nick.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.nick.$error.required && registroForm.nick.$touched" class="help-block">El nick es obligatorio</span>
                  <span ng-if="registroForm.nick.$error.minlength && registroForm.nick.$touched" class="help-block">El nick es demasiado corto.</span>
                  <span ng-if="registroForm.nick.$error.maxlength && registroForm.nick.$touched" class="help-block">El nick es demasiado largo.</span>
                </div>
                
                <div class="form-group" ng-class="{'has-error':registroForm.pass.$invalid && registroForm.pass.$touched}">
                  <label for="pass">Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="user.pass" required minlength="5" maxlength="50" name="pass" id="pass" class="form-control" type="text" placeholder="Introduzca la contraseña">
                    <span ng-if="registroForm.pass.$invalid && registroForm.pass.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.pass.$error.required && registroForm.pass.$touched" class="help-block">La contraseña es obligatoria.</span>
                  <span ng-if="registroForm.pass.$error.minlength && registroForm.pass.$touched" class="help-block">La contraseña es demasiado corta.</span>
                  <span ng-if="registroForm.pass.$error.maxlength && registroForm.pass.$touched" class="help-block">La contraseña es demasiado larga.</span>
                </div>
                
						  
<?php
	 	$permisos = array('clientes', 'proveedores', 'productos','usuarios','pedidos','ventas','logs');
	
		for ($i=0; $i < count($permisos); $i++){
			echo '
								<p>
								<div class="col"
									 <ul>
										<div class="col-md-4">
										<li><label><u>'.$permisos[$i].'</u></label></li>
											<div ng-repeat="permiso in permisos" >
											   <li> 
												<input type="radio" ng-model="user.'.$permisos[$i].'" id="'.$permisos[$i].'" name="'.$permisos[$i].'" value="{{permiso.value}}" required="required"/>
												<label>&nbsp;{{permiso.nombre}}</label>
												</li>
											</div>
											
										<br>
										</div>
										
								</div>
							</p>
			';
		}
?>

						
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
              <h4 class="modal-title" id="myModalLabel">Usuario</h4>
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

                <div class="form-group" ng-class="{'has-error':registroForm.nick.$invalid && registroForm.nick.$touched}">
                  <label for="nick">Nick</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.nick" required minlength="5" maxlength="50" name="nick" id="nick" class="form-control" type="text" placeholder="Introduzca el nick">
                    <span ng-if="registroForm.nick.$invalid && registroForm.nick.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.nick.$error.required && registroForm.nick.$touched" class="help-block">El nick es obligatorio</span>
                  <span ng-if="registroForm.nick.$error.minlength && registroForm.nick.$touched" class="help-block">El nick es demasiado corto.</span>
                  <span ng-if="registroForm.nick.$error.maxlength && registroForm.nick.$touched" class="help-block">El nick es demasiado largo.</span>
                </div>
                
                <div class="form-group" ng-class="{'has-error':registroForm.pass.$invalid && registroForm.pass.$touched}">
                  <label for="pass">Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-link"></i>
                    </div>
                    <input ng-model="registro.pass" required minlength="5" maxlength="50" name="pass" id="pass" class="form-control" type="text" placeholder="Introduzca la contraseña">
                    <span ng-if="registroForm.pass.$invalid && registroForm.pass.$dirty" class="glyphicon glyphicon-remove form-control-feedback"></span>
                  </div>
                  <span ng-if="registroForm.pass.$error.required && registroForm.pass.$touched" class="help-block">La contraseña es obligatoria.</span>
                  <span ng-if="registroForm.pass.$error.minlength && registroForm.pass.$touched" class="help-block">La contraseña es demasiado corta.</span>
                  <span ng-if="registroForm.pass.$error.maxlength && registroForm.pass.$touched" class="help-block">La contraseña es demasiado larga.</span>
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
    <script type="text/javascript" src="js/app.js"></script>
</body>
</html>
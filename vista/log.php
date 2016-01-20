<!DOCTYPE html>
<html ng-app="Logs">
<head>
    <title>Panel de Gestión - Log de Usuarios</title>
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
                      Logs
                      <a href="#" class="pull-right"><i class="glyphicon glyphicon-folder-open"></i></a>
                    </p>

<form name="myFiltro">
  
    <label>Fecha Inicio: </label><br>
    <input ng-model="log.Inicio">
    <hr>

    <label>Fecha Final: </label><br>
    <input ng-model="log.Final">
    <hr>
					
     
    <label>Tipo Operacion: </label><br>
    

	<br>
	<label>Consulta:
    <input name="log.operacionSql" type="checkbox" ng-model="log.operacionSql"  ng-true-value="'Consulta'" ng-false-value="''" value="Consulta">
	</label><br/>
	<label>Editado:
    <input name="log.operacionEdit" type="checkbox" ng-model="log.operacionEdit" ng-true-value="'Editado'" ng-false-value="''"  value="Editado">
   </label><br/>
	
	<label>Insertado:
    <input name="log.operacionInsert" type="checkbox" ng-model="log.operacionInsert" ng-true-value="'Insertado'" ng-false-value="''" value="Insertado">
	</label><br/>
	<label>Eliminado:
    <input name="log.operacionDelete" type="checkbox" ng-model="log.operacionDelete" ng-true-value="'Eliminado'" ng-false-value="''" value="Eliminado">
   </label><br/>	
	<tt>Logs a Mostrar <br> {{log.operacionSql}} {{log.operacionEdit}} {{log.operacionInsert}} {{log.operacionDelete}} </tt><br/>
	
	<a ng-click="verlogs(log)" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Ver Logs</a>						  
    	
	
	
	</form>			
 


			</div>
                <!-- /sidebar -->
              
                <!-- main -->
                <div class="column col-sm-9" id="main">
                    <div class="padding">
                      <div class="full col-sm-9">
                        <br><br><br>
                          <!-- content -->

				
						
                           <li ng-repeat="listalog in listalogs">
							
							<i class="glyphicon glyphicon-tags"> {{listalog.id}} - {{listalog.usuario}} - {{listalog.fecha}} - {{listalog.operacion}} - {{listalog.consulta}} </i>
							  
							</li>
						</ul>
		 
 							
		
						
							 </li>
			


    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/logs.js"></script>
</body>
</html>
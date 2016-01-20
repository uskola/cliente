<!DOCTYPE html>
<html ng-app="Informes">
<head>
    <title>Panel de Gestión - Informes de Compras</title>
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
                      Informes
					  	<a ng-click="verlistainformes(informe)" href="#" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-floppy-disk"></i> Ver Informes</a>						  

                     
                    </p>

<form name="myFiltro">
  
    <label>Fecha Inicio: </label><br>
    <input ng-model="informe.Inicio"><br><br>


    <label>Fecha Final: </label><br>
    <input ng-model="informe.Final">
   
	<br><br>
     


	<label>Compra Abierta:
    <input name="informe.operacionAbierta" type="checkbox" ng-model="informe.operacionAbierta"  ng-true-value="'Abierta'" ng-false-value="''" value="Abierta">
	</label><br/>
	<label>Compra Cerrada:
    <input name="informe.operacionCerrada" type="checkbox" ng-model="informe.operacionCerrada" ng-true-value="'Cerrada'" ng-false-value="''"  value="Cerrada">
   </label><br/>
	

	
   	
	<label>Filtro Proveedores&nbsp;<br><input type="text" ng-model="search.nombre" id="search.nombre" name="nombre" >    </label><br/>

	<label>Filtro Usuario&nbsp;<br><input type="text" ng-model="search.usuario" id="search.usuario" name="usuario" >    </label><br/>

 
	
	</form>			
 


			</div>
                <!-- /sidebar -->
              
                <!-- main -->
                <div class="column col-sm-9" id="main">
                    <div class="padding">
                      <div class="full col-sm-9">
                        <br><br><br>
                          <!-- content -->

				
						
						
						
						
 <table ng-init="listainformes.total = {}" class="table table-condensed table-striped">
   <colgroup span="6">Informe de Compras -  Importe Total: {{listainformes.total.suma}} - Fechas entre  {{informe.Inicio}}  y {{informe.Final}} - {{informe.operacionAbierta}}   {{informe.operacionCerrada}} </colgroup>

   <tbody>
     <tr class="days">
       <th scope="col" title="Pedido">Pedido</th>
       <th scope="col" title="Referencia">Referencia</th>
       <th scope="col" title="Proveedor">Proveedor</th>
       <th scope="col" title="Fecha">Fecha</th>
       <th scope="col" title="Importe">Importe</th>
       <th scope="col" title="Usuario">Usuario</th>

     </tr>
     
          <tr ng-repeat="informe in listainformes | filter:search:strict" >
            	<td>
				<span ng-if="informe.totalpedido == 0">
				<i class="glyphicon glyphicon-tag"> {{informe.id}} </i>
				</span>
				<span ng-if="informe.totalpedido > 0">	
				<i class="glyphicon glyphicon-envelope"> {{informe.id}} </i>
				</span>
				</td><td> {{informe.referencia}} </td><td> {{informe.nombre}} 
				</td><td> {{informe.fecha}} </td><td ng-init="listainformes.total.suma  =  listainformes.total.suma +  parseInt(informe.totalpedido);"> {{informe.totalpedido}} </td><td> {{informe.usuario}} </td>
							  
		</tr>
  
     
 </tbody>
 </table>
						
						
						
                          
							
						
						</ul>
		 
 							
		
						
							 </li>
			


    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/informes.js"></script>
</body>
</html>
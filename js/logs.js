(function(){
    "use strict";

    angular.module('Logs',[
        //dependencies here
    ])

    .controller('MainController',function($scope, $http){
      $scope.name = 'Aitor'
		
	var today = new Date();

	 $scope.log = {
     operacionEdit : "Editado",
	 operacionInsert : "Insertado",
     operacionSql : "Consulta",
	 operacionDelete : "Eliminado",
	 Inicio : today.toISOString().substring(0, 10) + ' 00:00:00',
	 Final  : today.toISOString().substring(0, 10) + ' 23:59:59'	   
	 
     };


	$scope.cargarlista= function($log){
		var cadena = "?fechaInicio=" + $log.Inicio + "&fechaFinal=" + $log.Final + "&operacionSql="  
		+ $log.operacionSql + "&operacionEdit="  + $log.operacionEdit + "&operacionInsert="  + $log.operacionInsert + "&operacionDelete="  + $log.operacionDelete ;

		
		$http.get('controlador/json/logs/obtenerlogs.php' + cadena).
		success(function(data, status, headers, config) {
	
		 console.log(data);
		$scope.listalogs = data;
		})
	};
		 
	$scope.cargarlista($scope.log);  	 
	 
	 
	 
	 $scope.verlogs= function($log){

		var cadena = "?fechaInicio=" + $log.Inicio + "&fechaFinal=" + $log.Final + "&operacionSql="  
		+ $log.operacionSql + "&operacionEdit="  + $log.operacionEdit + "&operacionInsert="  + $log.operacionInsert + "&operacionDelete="  + $log.operacionDelete ;
		$http.get('controlador/json/logs/obtenerlogs.php' + cadena).
		success(function(data, status, headers, config) {
		$scope.listalogs = data;
		})
	};
		 
	
	 
	 
	 
	$scope.fecha = function() {
	 var fechaInicio = element(by.binding('fecha.Inicio'));
	 var fechaFinal = element(by.binding('fecha.Final'));
	 var today = new Date();

	 fechaInicio = today.toISOString().substring(0, 10);
	 fechaFinal = today.toISOString().substring(0, 10);
	 fechaFinal = "Hola";
	 
	};
 

	 
	 $scope.tipoOperacionSeleccionada= function() {
	  var operacionEdit = element(by.binding('log.operacionEdit'));
	  var operacionInsert = element(by.binding('log.operacionInsert'));
	  var operacionSql = element(by.binding('log.operacionSql'));
	  var operacionDelete = element(by.binding('log.operacionDelete'));
	  
	  expect(operacionEdit.getText()).toContain('Edit');
	  expect(operacionInsert.getText()).toContain('Insert');
	  expect(operacionSql.getText()).toContain('Sql');
	  expect(operacionDelete.getText()).toContain('Delete');
	  
	  element(by.model('log.operacionEdit')).click();
	  element(by.model('log.operacionInsert')).click();
	  element(by.model('log.operacionSql')).click();
	  element(by.model('log.operacionDelete')).click();	  

	  expect(operacionEdit.getText()).toContain('');
	  expect(operacionInsert.getText()).toContain('');
	  expect(operacionSql.getText()).toContain('');
	  expect(operacionDelete.getText()).toContain('');	  
	  
 

			  
	  
	};

		
		
		

        $scope.showWindow = function(registro){
            $scope.registroForm.$setPristine();
            $scope.registroForm.$setUntouched();

            registro = registro || {categoria:$scope.currentCategoria,id:''};
            $scope.registro = registro;
            $('#registroModal').modal('show');
        }

        $scope.save = function(registro){
			
			
            if($scope.registroForm.$valid){
                if(!registro.id){
                    var record = angular.copy(registro);
				
					var url = "controlador/json/usuarios/crearusuario.php";					
					var nuevoregistro = $http.post(url,record)
					console.log(nuevoregistro);
					$scope.cargarlista($http);
					$scope.setCurrentCategoria (nuevoregistro);
                }
                $('#registroModal').modal('hide');
            }
        }

		
        $scope.actualizar = function(){
 
			var url = "controlador/json/usuarios/actualizarpermisos.php";
			var data=$scope.user;  
			var id = $scope.user.id;

            data=JSON.stringify(data);
			
			console.log( $http.post(url, data));
			$scope.cargarlista($http);
			$http.get('controlador/json/usuarios/obtenerpermisos.php?id=' +id).
			success(function(data, status, headers, config) {
			$scope.user = data;
			})          
			

        }		
		

		
        $scope.remove = function(){
			  
			var id = $scope.user.id;
			$http.get('controlador/json/usuarios/eliminarusuario.php?id=' +id).
			success(function(data, status, headers, config) {
				
				$scope.user = "";		
			
			})

			$scope.cargarlista($http);
			$scope.setCurrentCategoria (0);
			$scope.currentCategoria =0;
			$scope.user ="";

        }
        
    });

})();
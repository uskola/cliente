(function(){
    "use strict";

    angular.module('Informes',[
      
    ])

    .controller('MainController',function($scope, $http){
      $scope.name = 'Aitor'
		
	var today = new Date();

		 $scope.informe = {
		 operacionAbierta : "Abierta",
		 operacionCerrada : "Cerrada",
		 Inicio : today.toISOString().substring(0, 10) + ' 00:00:00',
		 Final  : today.toISOString().substring(0, 10) + ' 23:59:59'	   
		 
		 };


		$scope.cargarlista= function(informe){
			
			var cadena = "?fechaInicio=" + informe.Inicio + "&fechaFinal=" + informe.Final + "&operacionAbierta="  
			+ informe.operacionAbierta + "&operacionCerrada="  + informe.operacionCerrada ;
			
			$http.get('controlador/json/informes/informes.php' + cadena).
			success(function(data, status, headers, config) {
			 console.log(data);
			$scope.listainformes = data;
			})
		};
			 
		$scope.cargarlista($scope.informe);  	 
	 
	 
	 
		 $scope.verlistainformes= function($informe){

			var cadena = "?fechaInicio=" + $informe.Inicio + "&fechaFinal=" + $informe.Final + "&operacionAbierta="  
			+ $informe.operacionAbierta + "&operacionCerrada="  + $informe.operacionCerrada ;
			$http.get('controlador/json/informes/informes.php' + cadena).
			success(function(data, status, headers, config) {
			$scope.listainformes = data;
			})
		};
		 
	
	 $scope.parseInt = parseInt;
	 
	 
		$scope.fecha = function() {
		 var fechaInicio = element(by.binding('fecha.Inicio'));
		 var fechaFinal = element(by.binding('fecha.Final'));
		 var today = new Date();

		 fechaInicio = today.toISOString().substring(0, 10);
		 fechaFinal = today.toISOString().substring(0, 10);
		 fechaFinal = "Hola";
		 
		};
 

	 
		$scope.tipoOperacionSeleccionada= function() {
		  var operacionAbierta = element(by.binding('informe.operacionAbierta'));
		  var operacionCerrada = element(by.binding('informe.operacionCerrada'));

		  
		  expect(operacionAbierta.getText()).toContain('Abierta');
		  expect(operacionCerrada.getText()).toContain('Cerrada');

		  
		  element(by.model('informe.operacionAbierta')).click();
		  element(by.model('informe.operacionCerrada')).click();


		  expect(operacionAbierta.getText()).toContain('');
		  expect(operacionCerrada.getText()).toContain('');

		  
		};

		
		
		



    });

})();
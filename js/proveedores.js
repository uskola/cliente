(function(){
    "use strict";

    angular.module('Proveedores',[
        //dependencies here
    ])

    .controller('MainController',function($scope, $http){
        $scope.name = 'Aitor'
		
		
		
				
		$scope.cargarlista= function($http){
			$http.get('controlador/json/proveedores/proveedores_json.php?accion=Listar').
			success(function(data, status, headers, config) {
			//data= JSON.parse(data);
			 console.log(data);
			$scope.proveedores = data;
			$scope.currentProveedor = 999999;
			
			})
		};
		

		
		
		$scope.cargarlista($http);




		 $scope.user = {};

		
        $scope.currentProveedor = '0';
		$scope.currentProveedorDireccion = '';
		$scope.currentProveedorEmail = '';
		$scope.currentProveedorTelefono = '';
		$scope.currentProveedorProvincia = '';


		
		$scope.setCurrentProveedor = function(proveedor){
			$scope.currentProveedor = "";
			$scope.currentProveedor = proveedor.id;
			$scope.user ="";	
			$http.get('controlador/json/proveedores/proveedores_json.php?accion=Obtener&id=' +proveedor.id).
			success(function(data, status, headers, config) {
				console.log(data);
				$scope.user = data;		
			
			})
			$scope.currentProveedorNombre = proveedor.nombre;
		}	

		$scope.setCurrentProveedorId = function(id){
			$scope.currentProveedor = "";
			$scope.currentProveedor = id;
			$scope.user ="";	
			$http.get('controlador/json/proveedores/proveedores_json.php?accion=Obtener&id=' +id).
			success(function(data, status, headers, config) {
			console.log(data);
			$scope.user = data;		
			$scope.currentProveedorNombre = data.nombre;
			
			})
		
		}	
	
		
		 $scope.isCurrentProveedorNombre = function(proveedor){
            return $scope.currentProveedorNombre === proveedor.nombre;
        }

		
        $scope.isCurrentProveedor = function(proveedor){
            return $scope.currentProveedor === proveedor;
        }

        $scope.showWindow = function(registro){
            $scope.formulario.$setPristine();
            $scope.formulario.$setUntouched();

            registro = registro || {proveedor:$scope.currentProveedor,id:''};
            $scope.registro = registro;
            $('#registroModal').modal('show');
        }

        $scope.save = function(registro, proveedor){
			
			
            if($scope.registroForm.$valid){
                if(!registro.id){
                    var record = angular.copy(registro);
				
					var url = "controlador/json/proveedores/proveedores_json.php?accion=Crear";					
					$http.post(url,record).success(function(data, status) {
					var id = data;

					$scope.cargarlista($http);
					$http.get('controlador/json/proveedores/proveedores_json.php?accion=Obtener&id=' +id).	success(function(data, status, headers, config) {
						//data= JSON.parse(data);
						 console.log(data);
						$scope.user = data;
						$scope.currentProveedor =id;
						$scope.setCurrentProveedorId (id);
					})          
				})
				}
                $('#registroModal').modal('hide');
            }
        }

		
        $scope.actualizar = function(){
 
			var url = "controlador/json/proveedores/proveedores_json.php?accion=Actualizar";
			var data=$scope.user;  
			var id = $scope.user.id;

            data=JSON.stringify(data);
			
			$http.post(url, data).success(function(data, status, headers, config) {
			$scope.cargarlista($http);
			$http.get('controlador/json/proveedores/proveedores_json.php?accion=Obtener&id=' +id).	success(function(data, status, headers, config) {
				//data= JSON.parse(data);
				 console.log(data);
				$scope.user = data;
				$scope.currentProveedor =id;
			
				$scope.setCurrentProveedorId (id);
			})          
			})

        }		
	
		
        $scope.remove = function(){
			  
			var id = $scope.user.id;
			$http.get('controlador/json/proveedores/proveedores_json.php?accion=Eliminar&id=' +id).
			success(function(data, status, headers, config) {
				
				$scope.user = "";	
				$scope.currentProveedor = 999999;
				$scope.cargarlista($http);

				$scope.currentProveedor =999999;
				$scope.user ="";				
			
			})

	

        }
        
    });

})();
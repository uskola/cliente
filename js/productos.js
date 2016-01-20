(function(){
    "use strict";

    angular.module('Productos',[
        //dependencies here
    ])

    .controller('MainController',function($scope, $http){
        $scope.name = 'Aitor'
		
		
		
				
		$scope.cargarlista= function($http){
			$http.get('controlador/json/productos/productos_json.php?accion=Listar').
			success(function(data, status, headers, config) {
			//data= JSON.parse(data);
			 console.log(data);
			$scope.productos = data;
			$scope.currentProducto = 999999;
			
			})
		};
		
		
		
		
		$scope.cargarlista($http);




		 $scope.user = {};

		
        $scope.currentProducto = '0';
		$scope.currentProductoDireccion = '';
		$scope.currentProductoEmail = '';
		$scope.currentProductoTelefono = '';
		$scope.currentProductoProvincia = '';


		
		$scope.setCurrentProducto = function(producto){
			$scope.currentProducto = "";
			$scope.currentProducto = producto.id;
			$scope.user ="";	
			$http.get('controlador/json/productos/productos_json.php?accion=Obtener&id=' +producto.id).
			success(function(data, status, headers, config) {
				console.log(data);
				$scope.user = data;		
			
			})
			$scope.currentProductoNombre = producto.nombre;
		}	

		$scope.setCurrentProductoId = function(id){
			$scope.currentProducto = "";
			$scope.currentProducto = id;
			$scope.user ="";	
			$http.get('controlador/json/productos/productos_json.php?accion=Obtener&id=' +id).
			success(function(data, status, headers, config) {
			console.log(data);
			$scope.user = data;		
			$scope.currentProductoNombre = data.nombre;
			
			})
		
		}	
	
		
		 $scope.isCurrentProductoNombre = function(producto){
            return $scope.currentProductoNombre === producto.nombre;
        }

		
        $scope.isCurrentProducto = function(producto){
            return $scope.currentProducto === producto;
        }

        $scope.showWindow = function(registro){
            $scope.registroForm.$setPristine();
            $scope.registroForm.$setUntouched();

            registro = registro || {producto:$scope.currentProducto,id:''};
            $scope.registro = registro;
            $('#registroModal').modal('show');
        }

        $scope.save = function(registro, producto){
			
			
            if($scope.registroForm.$valid){
                if(!registro.id){
                    var record = angular.copy(registro);
				
					var url = "controlador/json/productos/productos_json.php?accion=Crear";					
					$http.post(url,record).success(function(data, status) {
					var id = data;

					$scope.cargarlista($http);
					$http.get('controlador/json/productos/productos_json.php?accion=Obtener&id=' +id).	success(function(data, status, headers, config) {
						//data= JSON.parse(data);
						 console.log(data);
						$scope.user = data;
						$scope.currentProducto =id;
						$scope.setCurrentProductoId (id);
					})          
				})
				}
                $('#registroModal').modal('hide');
            }
        }

		
        $scope.actualizar = function(){
 
			var url = "controlador/json/productos/productos_json.php?accion=Actualizar";
			var data=$scope.user;  
			var id = $scope.user.id;

            data=JSON.stringify(data);
			
			$http.post(url, data).success(function(data, status, headers, config) {
			$scope.cargarlista($http);
			$http.get('controlador/json/productos/productos_json.php?accion=Obtener&id=' +id).	success(function(data, status, headers, config) {
				//data= JSON.parse(data);
				 console.log(data);
				$scope.user = data;
				$scope.currentProducto =id;
			
				$scope.setCurrentProductoId (id);
			})          
			})

        }		
	
		
        $scope.remove = function(){
			  
			var id = $scope.user.id;
			$http.get('controlador/json/productos/productos_json.php?accion=Eliminar&id=' +id).
			success(function(data, status, headers, config) {
				
				$scope.user = "";	
				$scope.currentProducto = 999999;
				$scope.cargarlista($http);

				$scope.currentProducto =999999;
				$scope.user ="";				
			
			})

	

        }
        
    });

})();
(function(){
    "use strict";

    angular.module('ProductosProveedores',[
        //dependencies here
    ])

    .controller('MainController',function($scope, $http){
        $scope.name = 'Aitor'
		
		
		
				
		$scope.cargarlista= function($http){
			$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=Listar').
			success(function(data, status, headers, config) {
			$scope.proveedores = data;
			$scope.currentProveedor = 999999;
			
			})
		};
		
		
		
		
		$scope.cargarlista($http);


		$scope.user = {};
		$scope.users = {};

		$scope.nouser = {};
		$scope.nousers = {};
		
        $scope.currentProveedor = '0';
		$scope.currentProveedorDireccion = '';
		$scope.currentProveedorEmail = '';
		$scope.currentProveedorTelefono = '';
		$scope.currentProveedorProvincia = '';


		
		$scope.setCurrentProveedor = function(proveedor){
			$scope.currentProveedor = "";
			$scope.currentProveedor = proveedor.id;
			$scope.user ="";	
			$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=Obtener&id=' +proveedor.id).
			success(function(data, status, headers, config) {
				console.log(data);
				$scope.users = data;		
			
			})
			
			$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=ObtenerNo&id=' +proveedor.id).
			success(function(data, status, headers, config) {
				console.log(data);
				$scope.nousers = data;		
			
			})
				
			$scope.currentProveedorNombre = proveedor.nombre;
		}	

		
		$scope.setCurrentProveedorId = function(id){
		
			$scope.currentProveedor = id;
			$scope.user ="";	
			$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=Obtener&id=' +id).
			success(function(data, status, headers, config) {
			console.log(data);
			$scope.users = data;		
			$scope.currentProveedorNombre = data.nombre;
			$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=ObtenerNo&id=' +id).
			success(function(data, status, headers, config) {
				console.log(data);
				$scope.nousers = data;		
			
			})
							
			})
		
		}	
	
		
		 $scope.isCurrentProveedorNombre = function(proveedor){
            return $scope.currentProveedorNombre === proveedor.nombre;
        }

		
        $scope.isCurrentProveedor = function(proveedor){
            return $scope.currentProveedor === proveedor;
        }

        $scope.showWindow = function(registro){
            $scope.registroForm.$setPristine();
            $scope.registroForm.$setUntouched();

            registro = registro || {proveedor:$scope.currentProveedor,id:''};
            $scope.registro = registro;
            $('#registroModal').modal('show');
        }

		
        $scope.save = function( id_producto, id_proveedor)
		{
			 id_proveedor = $scope.currentProveedor;

			var url = "";				
					
				$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=Crear&id_proveedor=' + id_proveedor + '&id_producto=' + id_producto).
				success(function(data, status, headers, config) {
				
					$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=Obtener&id=' + id_proveedor).
				success(function(data, status, headers, config) {
					console.log(data);
					$scope.users = data;		
			
					$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=ObtenerNo&id=' + id_proveedor).
					success(function(data, status, headers, config) {
						console.log(data);
						$scope.nousers = data;		
			
						$scope.currentProveedor =id_proveedor;
			
					})
				})
            })
        }

		
        $scope.actualizar = function(id_producto,id_proveedor, precio){
			console.log("Enviado: " + id_producto + " + " + id_proveedor + " + " + precio);
			
			var data = '{"id_producto":"' + id_producto + '","id_proveedor":"' + id_proveedor + '","precio":"' + precio + '"}';
			var url = "controlador/json/productosproveedores/productosproveedores_json.php?accion=Actualizar";
 			$http.post(url, data).success(function(data, status, headers, config) {
			$scope.cargarlista($http);
			
				$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=Obtener&id=' + id_proveedor).
				success(function(data, status, headers, config) {
					console.log(data);
					$scope.users = data;		
			
			
			
					$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=ObtenerNo&id=' + id_proveedor).
					success(function(data, status, headers, config) {
						console.log(data);
						$scope.nousers = data;		
					
			
						$scope.currentProveedor =id_proveedor;
					
			
					})
				})       
			})

        }		
	
		
        $scope.remove = function(id_producto , id_proveedor){
			  
		
			$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=Eliminar&id_producto=' + id_producto + '&id_proveedor=' + id_proveedor ).
			success(function(data, status, headers, config) {
				
				

				$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=Obtener&id=' + id_proveedor).
				success(function(data, status, headers, config) {
					console.log(data);
					$scope.users = data;		
			
			
			
					$http.get('controlador/json/productosproveedores/productosproveedores_json.php?accion=ObtenerNo&id=' + id_proveedor).
					success(function(data, status, headers, config) {
						console.log(data);
						$scope.nousers = data;		
					
			
						$scope.currentProveedor =id_proveedor;
					
			
					})
				})
			})

        }
        
    });

})();
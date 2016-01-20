(function(){
    "use strict";

    angular.module('Permisos',[
        //dependencies here
    ])

    .controller('MainController',function($scope, $http){
        $scope.name = 'Aitor'
		
		
		
				
		$scope.cargarlista= function($http){
			$http.get('controlador/json/usuarios/usuarios_json.php?accion=Listar').
			success(function(data, status, headers, config) {
			//data= JSON.parse(data);
			 console.log(data);
			$scope.categorias = data;
			$scope.currentCategoria = 999999;
			
			})
		};
		
		
		
		
		$scope.cargarlista($http);




		 $scope.user = {};

	
		$scope.permisosAcceso = [
		{id:1,nombre:'clientes',value:'clientes'},
		{id:2,nombre:'proveedores',value:'proveedores'},
		{id:3,nombre:'productos',value:'productos'},
		{id:4,nombre:'usuarios',value:'usuarios'},
		{id:5,nombre:'pedidos',value:'pedidos'},
		{id:6,nombre:'ventas',value:'ventas'},
		{id:7,nombre:'logs',value:'logs'}
		];
//		$scope.color = {
//       name: 'blue'
//		};
      
		$scope.permisos = [{"id":0, "value": "0", "nombre": "Sin Accesso"}, {"id":1,"value": "1", "nombre": "lectura"}, {"id":2,"value": "2", "nombre": "escritura"}];
		
		$scope.color0 = '0';
		
        $scope.currentCategoria = '0';
		$scope.currentCategoriaNombre = '';
		$scope.currentCategoriaClientes = '';
		$scope.currentCategoriaProveedores = '';
		$scope.currentCategoriaProductos = '';
		$scope.currentCategoriaUsuarios = '';		
		$scope.currentCategoriaPedidos = '';
		$scope.currentCategoriaVentas = '';
		$scope.currentCategoriaLogs = '';

		
		$scope.setCurrentCategoria = function(categoria){
			$scope.currentCategoria = "";
			$scope.currentCategoria = categoria.id;
			$scope.user ="";	
			$http.get('controlador/json/usuarios/usuarios_json.php?accion=Obtener&id=' +categoria.id).
			success(function(data, status, headers, config) {
				
				console.log(data);
				$scope.user = data;		
			
			})
			$scope.currentCategoriaNombre = categoria.nombre;
		}	

		$scope.setCurrentCategoriaId = function(id){
			$scope.currentCategoria = "";
			$scope.currentCategoria = id;
			$scope.user ="";	
			$http.get('controlador/json/usuarios/usuarios_json.php?accion=Obtener&id=' +id).
			success(function(data, status, headers, config) {
				
				console.log(data);
				$scope.user = data;		
				$scope.currentCategoriaNombre = data.nombre;
			
			})
		
		}	
	
		
		 $scope.isCurrentCategoriaNombre = function(categoria){
            return $scope.currentCategoriaNombre === categoria.nombre;
        }

		
        $scope.isCurrentCategoria = function(categoria){
            return $scope.currentCategoria === categoria;
        }

        $scope.showWindow = function(registro){
            $scope.registroForm.$setPristine();
            $scope.registroForm.$setUntouched();

            registro = registro || {categoria:$scope.currentCategoria,id:''};
            $scope.registro = registro;
            $('#registroModal').modal('show');
        }

        $scope.save = function(registro, categoria){
			
			
            if($scope.registroForm.$valid){
                if(!registro.id){
                    var record = angular.copy(registro);
				
					var url = "controlador/json/usuarios/usuarios_json.php?accion=Crear";					
					$http.post(url,record).success(function(data, status) {
					var id = data;

					$scope.cargarlista($http);
					$http.get('controlador/json/usuarios/usuarios_json.php?accion=Obtener&id=' +id).	success(function(data, status, headers, config) {
						//data= JSON.parse(data);
						 console.log(data);
						$scope.user = data;
						$scope.currentCategoria =id;
					
						$scope.setCurrentCategoriaId (id);
					})          



				})
				}
                $('#registroModal').modal('hide');
            }
        }

		
		

	
		
		
		
        $scope.actualizar = function(){
 
			var url = "controlador/json/usuarios/usuarios_json.php?accion=Actualizar";
			var data=$scope.user;  
			var id = $scope.user.id;
        /* post to server*/
            data=JSON.stringify(data);
			
			$http.post(url, data).success(function(data, status, headers, config) {
			$scope.cargarlista($http);
			$http.get('controlador/json/usuarios/usuarios_json.php?accion=Obtener&id=' +id).	success(function(data, status, headers, config) {
				//data= JSON.parse(data);
				 console.log(data);
				$scope.user = data;
				$scope.currentCategoria =id;
			
				$scope.setCurrentCategoriaId (id);
			})          
			})

        }		
	

	
			
			
		
        $scope.remove = function(){
			  
			var id = $scope.user.id;
			$http.get('controlador/json/usuarios/usuarios_json.php?accion=Eliminar&id=' +id).
			success(function(data, status, headers, config) {
				
				$scope.user = "";	
				$scope.currentCategoria = 999999;
				$scope.cargarlista($http);

				$scope.currentCategoria =999999;
				$scope.user ="";				
			
			})

	

        }
        
    });

})();
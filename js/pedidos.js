(function(){
    "use strict";

    angular.module('Pedidos',[
        //dependencies here
    ])

    .controller('MainController',function($scope, $http){
        $scope.name = 'Aitor'
		
		
	$scope.filterPedidos = function(tipopedido)
	{
		// Do some tests

		var consulta ="";
		if(tipopedido.mio)
		{
			consulta = "pedido.usuario_abre== " + $scope.thisUserId  + " or usuario_cierra== " + $scope.thisUserId;
		}
		if(tipopedido.abierto)
		{
			consulta = "pedido.proveedor == 0";
		}		
	
		if(tipopedido.cerrado)
		{
			consulta = "pedido.proveedor > 0";
		}		
	
		
	
		return consulta; // otherwise it won't be within the results
	};
		
		
		$scope.varpedidos= 
		{
			mio:1, 
			abiertos:1, 
			cerrados:1,
			usuario:""
		};
		
		$scope.setCurrentEstado = function(usuario){
			$scope.varpedidos.usuario = usuario; 
			$scope.cargarlista($http, $scope.varpedidos);
			
			
			
			
			
			
			
		}

		
		
		$scope.varpedidos.usuario = $scope.usuarioactual;
		
		$scope.user = {};
		$scope.users = {};

		$scope.nouser = {};
		$scope.nousers = {};
		$scope.listaprecios = {};		
		
        $scope.currentPedido = '0';
		$scope.currentPedidoDireccion = '';
		$scope.currentPedidoEmail = '';
		$scope.currentPedidoTelefono = '';
		$scope.currentPedidoProvincia = '';

		
		
		$scope.cargarlistaPrecios= function(idpedido){
			
			
			$http.get('controlador/json/pedidos/pedidos_json.php?accion=ListaPrecios&id=' + idpedido).
			success(function(data, status, headers, config) {
			$scope.listaprecios = data;
			
			
			})
		};
		



		$scope.cargarlista= function($http, varpedidos){
			
			
			$http.get('controlador/json/pedidos/pedidos_json.php?accion=Listar&mio=' + varpedidos.mio + '&abiertos=' + varpedidos.abiertos + '&cerrados=' + varpedidos.cerrados + '&usuario=' + varpedidos.usuario ).
			success(function(data, status, headers, config) {
			console.log(data);
			$scope.pedidos = data;
			$scope.listaprecios=[];
			
			})
		};


		
					
		
		
		
		$scope.setCurrentPedido = function(pedido){
			$scope.currentPedido = "";
			$scope.currentPedido = pedido.id;
			$scope.user ="";	
			$scope.listaprecios=[];
			$http.get('controlador/json/pedidos/pedidos_json.php?accion=Obtener&id=' +pedido.id).
			success(function(data, status, headers, config) {
				console.log(data);
				$scope.users = data;		
			
		
				$http.get('controlador/json/pedidos/pedidos_json.php?accion=ObtenerNo&id=' +pedido.id).
				success(function(data, status, headers, config) {
					console.log(data);
					$scope.nousers = data;		


					$http.get('controlador/json/pedidos/pedidos_json.php?accion=ListaPrecios&id=' + pedido.id).
					success(function(data, status, headers, config) {
					$scope.listaprecios = data;
					})
				
				})
			})
			$scope.currentPedidoNombre = pedido.nombre;
			$scope.cargarlistaPrecios(pedido.id);
			
			
		}	

		
		$scope.eliminarPedido = function(pedido){
			var idpedido = pedido.id;
			
			$scope.user ="";	
			$http.get('controlador/json/pedidos/pedidos_json.php?accion=EliminarPedido&id=' +pedido.id).
			success(function(data, status, headers, config) {
				console.log(data);
				$scope.nousers = [];
				$scope.users = [];
				$scope.listaprecios=[];
				$scope.cargarlista($http, $scope.varpedidos);
			
			})
		}	


		
		
		$scope.setCurrentPedidoCerrado = function(pedido){
			$scope.currentPedido = "";
			$scope.currentPedido = pedido.id;
			$scope.user ="";	
			$http.get('controlador/json/pedidos/pedidos_json.php?accion=Obtener&id=' +pedido.id).
			success(function(data, status, headers, config) {
				console.log(data);
				$scope.users = data;		
			
			})
		
			$scope.nousers = [];		
			$scope.listaprecios=[];
			
			$scope.currentPedidoNombre = pedido.nombre;
		}	
		
		

		
		$scope.setCurrentPedidoId = function(id){
		
			$scope.currentPedido = id;
			$scope.user ="";	
			$http.get('controlador/json/pedidos/pedidos_json.php?accion=Obtener&id=' +id).
			success(function(data, status, headers, config) {
			console.log(data);
			$scope.users = data;		
			$scope.currentPedidoNombre = data.nombre;
				$http.get('controlador/json/pedidos/pedidos_json.php?accion=ObtenerNo&id=' +id).
				success(function(data, status, headers, config) {
					console.log(data);
					$scope.nousers = data;		
					$scope.listaprecios=[];	
					$http.get('controlador/json/pedidos/pedidos_json.php?accion=ListaPrecios&id=' +id).
					success(function(data, status, headers, config) {
						$scope.ListaPrecios = data;		
					
					})
					
					
					
				
				})
							
			})
			$scope.currentPedido = id;
		
		}	
	
		
		 $scope.isCurrentPedidoNombre = function(pedido){
            return $scope.currentPedidoNombre === pedido.nombre;
        }

		
        $scope.isCurrentPedido = function(pedido){
            return $scope.currentPedido === pedido;
        }

        $scope.showWindow = function(registro){
            $scope.registroForm.$setPristine();
            $scope.registroForm.$setUntouched();

            registro = registro || {pedido:$scope.currentPedido,id:''};
            $scope.registro = registro;
            $('#registroModal').modal('show');
        }

		
        $scope.save = function( idproducto, idpedido)
		{
			 

			var url = "";				
					
			$http.get('controlador/json/pedidos/pedidos_json.php?accion=Crear&idpedido=' + idpedido + '&idproducto=' + idproducto).
			success(function(data, status, headers, config) {
				
				$scope.user = "";	
				$scope.currentPedido =idpedido;

     				$http.get('controlador/json/pedidos/pedidos_json.php?accion=Obtener&id=' +idpedido).
				success(function(data, status, headers, config) {
				console.log(data);
				$scope.users = data;		
				$scope.currentPedidoNombre = data.nombre;
					$http.get('controlador/json/pedidos/pedidos_json.php?accion=ObtenerNo&id=' +idpedido).
					success(function(data, status, headers, config) {
						console.log(data);
						$scope.nousers = data;		


						$http.get('controlador/json/pedidos/pedidos_json.php?accion=ListaPrecios&id=' + idpedido).
						success(function(data, status, headers, config) {
						$scope.listaprecios = data;
						})

						
					})
								
				})			
			})
		       
			$scope.currentPedido = idpedido;
			
		
        }

		
        $scope.actualizar = function(idproducto,idpedido, precio){
			
	//		alert ("Enviado: " + id_producto + " + " + id_pedido + " + " + precio);
			
			var data = '{"idproducto":"' + idproducto + '","idpedido":"' + idpedido + '","precio":"' + precio + '"}';
			

			var url = "controlador/json/pedidos/pedidos_json.php?accion=Actualizar";
 
			
			$http.post(url, data).success(function(data, status, headers, config) {
				$scope.cargarlista($http, $scope.varpedidos);
				$http.get('controlador/json/pedidos/pedidos_json.php?accion=Obtener&id=' +idpedido).
				success(function(data, status, headers, config) {
					console.log(data);
					$scope.users = data;		
					$scope.currentPedidoNombre = data.nombre;
						$http.get('controlador/json/pedidos/pedidos_json.php?accion=ObtenerNo&id=' +idpedido).
						success(function(data, status, headers, config) {
							console.log(data);
							$scope.nousers = data;		



							$http.get('controlador/json/pedidos/pedidos_json.php?accion=ListaPrecios&id=' + idpedido).
							success(function(data, status, headers, config) {
							console.log(data);
							
							$scope.listaprecios = data;
							})
							
						})
									
					})			
			})
			
			$scope.currentPedido = idpedido;
			
			
			

        }		

		
		
		$scope.CrearPedido= function(registro, usuario){
		
		         if($scope.registroForm.$valid){
		
                    var record = angular.copy(registro);
				
					var url = "controlador/json/pedidos/pedidos_json.php?accion=CrearPedido&nombre=" + record.nombre + "&usuario=" + usuario;					
					$http.get(url).success(function(data, status, headers, config) {
					var id = data;


						$http.get('controlador/json/pedidos/pedidos_json.php?accion=Obtener&id=' +id).
						success(function(data, status, headers, config) {
						console.log(data);
						$scope.users = data;		
						$scope.currentPedidoNombre = data.nombre;
							$http.get('controlador/json/pedidos/pedidos_json.php?accion=ObtenerNo&id=' +id).
							success(function(data, status, headers, config) {
								console.log(data);
								$scope.nousers = data;		
								$scope.listaprecios = [];
								
							$scope.cargarlista($http, $scope.varpedidos);			
								
								
								
								$scope.currentPedido = id;
							})
										
						})
		

					})
			
                $('#registroModal').modal('hide');
				
            }
			
		
		}	


		$scope.FinalizarPedido= function(idpedido, idproveedor, precio, usuario){
					
			var url = "controlador/json/pedidos/pedidos_json.php?accion=FinalizarPedido&idpedido=" + idpedido + "&idproveedor=" +  idproveedor + "&precio=" +  precio + "&usuario=" +  usuario;					
			$http.get(url).success(function(data, status, headers, config) {
			$scope.users = [];
			$scope.nousers = [];		
			$scope.listaprecios = [];
			
			$scope.cargarlista($http, $scope.varpedidos);			
			})
		
		}	






		
        $scope.remove = function(idproducto , idpedido){
			  
			$http.get('controlador/json/pedidos/pedidos_json.php?accion=Eliminar&idproducto=' + idproducto + '&idpedido=' + idpedido ).
			success(function(data, status, headers, config) {
				$scope.cargarlista($http, $scope.varpedidos);					
				$scope.user = "";	
				
				
				
	//			$scope.cargarlista($http, $scope.varpedidos);	
				
		
			$scope.currentPedido = idpedido;

				$http.get('controlador/json/pedidos/pedidos_json.php?accion=Obtener&id=' +idpedido).
				success(function(data, status, headers, config) {
				console.log(data);
				$scope.users = data;		
				$scope.currentPedidoNombre = data.nombre;
					$http.get('controlador/json/pedidos/pedidos_json.php?accion=ObtenerNo&id=' +idpedido).
					success(function(data, status, headers, config) {
						console.log(data);
						$scope.nousers = data;		
						
							$http.get('controlador/json/pedidos/pedidos_json.php?accion=ListaPrecios&id=' + idpedido).
							success(function(data, status, headers, config) {

							$scope.listaprecios = data;
					
						})
						
						
					
					})
								
				})						
				
			})
	
			$scope.currentPedido = idpedido;
        }
        
    });

})();
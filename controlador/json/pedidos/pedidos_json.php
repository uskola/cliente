<?php


	function array_posible($a, $p) 
	{
		$iniciado =false;
		foreach ($a as $i => $v)
		{
			foreach ($p as $j => $k)
			{
				if ($v == $k){
					if (!$iniciado)
					{
						$iniciado = true;
						$b[] = $v ;
					}else
					{
						if (!in_array($v, $b))
						{
							$b[] = $v ;
						}
					}
				}
			}
		}
		return $b;
	}
	
	
	


if (isset($_GET['accion']))
{
	
	require_once('../../../modelo/pedido.php');	
	require_once('../../../modelo/proveedor.php');	
	
	switch ($_GET['accion']) 
	{

    case "Listar":
		$consulta = 
        $pedido1 = new Pedidos();
		
		$lista = $pedido1->ListarPedidos($_GET['mio'], $_GET['abiertos'], $_GET['cerrados'], $_GET['usuario'] );
		echo json_encode($lista);
        break;
    case "Obtener":
		$pedido1 = new Pedidos();
		$lista = $pedido1->ListarDisponibles($_GET['id']);
		echo json_encode($lista);
        break;
		
    case "ObtenerNo":
		$consultacompleja = "";
		$pedido1 = new Pedidos();
		$listapedido = $pedido1->ListarDisponibles($_GET['id']);
		foreach ($listapedido as $linea)
		{
			$consultacompleja .= " and id_producto <> " . $linea->pid;
			$productos[] = $linea->pid;
			$cantidadproductos[] = $linea->cantidad;
		}
		
		$proveedor1 = new Proveedor();
		$listaProveedores = $proveedor1->Listar();
		foreach ($listaProveedores as $proveedor)
		{
			$proveedoresposibles[] =  $proveedor->id;
		}

		if (isset($productos)){
			for ($i=0; $i < count($productos); $i++){
				$listapedidoproveedores = $pedido1->ListarProveedores($productos[$i]);
				foreach ($listapedidoproveedores as $linea)
				{
					$proveedores2[] = $linea->id_proveedor;
				}
				$proveedoresposibles = array_posible($proveedoresposibles, $proveedores2);
				unset( $proveedores2);
			}
		}
	
		$consultacompleja .= " and ( producto_proveedor.id_proveedor = 0 " ;

		for ($i=0; $i < count($proveedoresposibles); $i++){
			$consultacompleja .= " or producto_proveedor.id_proveedor = " .$proveedoresposibles[$i];
		}
		$consultacompleja .= ")";
		$listapedidoproveedores = $pedido1->ListaMagica($consultacompleja, $_GET['id']);
		echo json_encode($listapedidoproveedores);
        break;	

    case "ListaPrecios":
		$consultacompleja = "";
		$pedido1 = new Pedidos();
		$listapedido = $pedido1->ListarDisponibles($_GET['id']);
		foreach ($listapedido as $linea)
		{
			$consultacompleja .= " and id_producto <> " . $linea->pid;
			$productos[] = $linea->pid;
			$cantidadproductos[] = $linea->cantidad;
		}
		
		$proveedor1 = new Proveedor();
		$listaProveedores = $proveedor1->Listar();
		foreach ($listaProveedores as $proveedor)
		{
			$proveedoresposibles[] =  $proveedor->id;
		}

		if (isset($productos)){
			for ($i=0; $i < count($productos); $i++){
				$listapedidoproveedores = $pedido1->ListarProveedores($productos[$i]);
				foreach ($listapedidoproveedores as $linea)
				{
					$proveedores2[] = $linea->id_proveedor;
				}
				$proveedoresposibles = array_posible($proveedoresposibles, $proveedores2);
				unset( $proveedores2);
			}
		}

		$consultacompleja .= " and ( producto_proveedor.id_proveedor = 0 " ;

		for ($i=0; $i < count($proveedoresposibles); $i++){
			$consultacompleja .= " or producto_proveedor.id_proveedor = " .$proveedoresposibles[$i];
		}
		$consultacompleja .= ")";
	
		if (isset($productos)){
			if ($proveedoresposibles){
				for ($i=0; $i < count($proveedoresposibles); $i++){
					$preciototal = 0;
					for ($j=0; $j < count($productos); $j++){
						$listapedidofinal = $pedido1->ListarProveedoresPosibles($productos[$j], $proveedoresposibles[$i]);
							foreach ($listapedidofinal as $lineaproducto)
						{
							$preciototal += ($lineaproducto->precio * $cantidadproductos[$j]);
							$proveedor = $lineaproducto->provider;
						}
					}
					$proveedor_pedido_id[] = $proveedoresposibles[$i];
					$proveedor_pedido_nombre[] = $proveedor ;
					$proveedor_pedido_precio[] = $preciototal;
					$proveedor_orden[] = array($proveedoresposibles[$i] => $preciototal);
				}

				asort($proveedor_pedido_precio);

				$contador = 0;		
				$cadenadevolver = "[";
				foreach ($proveedor_pedido_precio as $key => $val) {
					$contador ++;
					if ($contador == 1){
						$cadenadevolver .=  '{"proveedor_id":"'. $proveedor_pedido_id[$key]. '", "pedido":"' . $_GET['id']. '", "nombre":"' . $proveedor_pedido_nombre[$key]. '", "precio":"' . $proveedor_pedido_precio[$key]. '", "masbarato":"1"}';
					}else{
						$cadenadevolver .=  ',{"proveedor_id":"'. $proveedor_pedido_id[$key]. '", "pedido":"' .$_GET['id'] . '", "nombre":"' . $proveedor_pedido_nombre[$key]. '", "precio":"' . $proveedor_pedido_precio[$key]. '", "masbarato":"0"}';
					}
				}
				$cadenadevolver .= "]";
				echo $cadenadevolver;

			
			
			}
				
		}

	

        break;	


		
    case "Eliminar":
		$pedido1 = new Pedidos();
		$pedido1->Eliminar($_GET['idproducto'],$_GET['idpedido'] );
		echo $_GET['idpedido'];
        break;
    case "Crear":
		$pedido1 = new Pedidos();
		$nuevoid = $pedido1->Registrar($_GET['idproducto'],$_GET['idpedido'] );

		echo $_GET['idpedido'];
        break;		
    case "Actualizar":
		$data = json_decode(file_get_contents('php://input'), true);
		$pedido1 = new Pedidos();
		$pedido1->Actualizar($data); 
        break;		
    case "CrearPedido":
		$pedido1 = new Pedidos();
		$nuevoid = $pedido1->RegistrarNuevoPedido($_GET['nombre'], $_GET['usuario']);

		echo $_GET['idpedido'];
        break;	
    case "EliminarPedido":
		$pedido1 = new Pedidos();
		$nuevoid = $pedido1->EliminarPedido($_GET['id']);
		
        break;	
		
	
    case "FinalizarPedido":
		$pedido1 = new Pedidos();
	
		$nuevoid = $pedido1->FinalizarPedido($_GET['idpedido'], $_GET['idproveedor'],$_GET['precio'],$_GET['usuario']);
	
		
        break;	
		
	}	
}

?>
	



